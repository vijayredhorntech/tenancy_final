<?php

namespace App\Http\Controllers\Agencies;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\AgencyService;
use App\Models\ClientDetails;
use App\Models\ClientDocument; // new model
use App\Models\ClientDocumentMovement; // new model
use App\Models\ClientDocumentSelection;
use App\Repositories\VisaRepository;
use App\Mail\ClientDocumentNotificationMail;
use App\Exports\ClientDocumentExport;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class ClientDocumentController extends Controller
{
    protected AgencyService $agencyService;
    protected VisaRepository $visaRepository;

    public function __construct(AgencyService $agencyService, VisaRepository $visaRepository)
    {
        $this->agencyService = $agencyService;
        $this->visaRepository = $visaRepository;
    }

    // List documents with returned_on etc.
    public function index(Request $request)
    {
        $agency = $this->agencyService->getAgencyData();
        // Ensure tenant connection exists for user_database usage
        if (!empty($agency->database_name)) {
            $this->agencyService->setConnectionByDatabase($agency->database_name);
        }

        $query = ClientDocument::with(['client'])
            ->where('agency_id', $agency->id);

        // Apply search filters
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->whereHas('client', function ($clientQuery) use ($request) {
                    $clientQuery->where('client_name', 'like', '%' . $request->search . '%')
                              ->orWhere('phone_number', 'like', '%' . $request->search . '%');
                })
                ->orWhere('document_name', 'like', '%' . $request->search . '%');
            });
        }

        $documents = $query->latest()->paginate(25);

        $clients = ClientDetails::on('user_database')
            ->where('agency_id', $agency->id)
            ->orderBy('first_name')
            ->get();

        return view('agencies.pages.clients.documents.index', compact('documents','clients'));
    }

    // Store a new client document (received)
    public function store(Request $request)
    {
        $agency = $this->agencyService->getAgencyData();
        if (!empty($agency->database_name)) {
            $this->agencyService->setConnectionByDatabase($agency->database_name);
        }

        $validated = $request->validate([
            'client_id' => 'required|exists:user_database.client_details,id',
            'document_names' => 'required|array|min:1',
            'document_names.*' => 'required|string|max:255',
            'received_on' => 'required|date',
            'remarks' => 'nullable|string|max:1000',
        ]);

        foreach ($validated['document_names'] as $name) {
            $doc = ClientDocument::create([
                'agency_id' => $agency->id,
                'client_id' => $validated['client_id'],
                'document_name' => $name,
                'received_on' => $validated['received_on'],
                'remarks' => $validated['remarks'] ?? null,
                'created_by' => Auth::id(),
            ]);

            // Optional: only if movement table exists in user_database
            if (Schema::connection('user_database')->hasTable('client_document_movements')) {
                ClientDocumentMovement::create([
                    'client_document_id' => $doc->id,
                    'action' => 'received',
                    'action_at' => $doc->received_on,
                    'remarks' => $doc->remarks,
                    'agency_id' => $agency->id,
                    'user_id' => Auth::id(),
                ]);
            }
        }

        return redirect()->route('client.documents.index')->with('success', 'Document added.');
    }

    // Mark as returned
    public function returnDocument(Request $request, $documentId)
    {
        $agency = $this->agencyService->getAgencyData();
        $document = ClientDocument::findOrFail($documentId);
        abort_if($document->agency_id !== $agency->id, 403);

        $validated = $request->validate([
            'returned_on' => 'required|date',
            'remarks' => 'nullable|string|max:1000',
        ]);

        $document->update([
            'returned_on' => $validated['returned_on'],
            'return_remarks' => $validated['remarks'] ?? null,
        ]);

        ClientDocumentMovement::create([
            'client_document_id' => $document->id,
            'action' => 'returned',
            'action_at' => $validated['returned_on'],
            'remarks' => $validated['remarks'] ?? null,
            'agency_id' => $agency->id,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('client.documents.index')->with('success', 'Document marked as returned.');
    }

    // Movement log
    public function movement(Request $request)
    {
        $agency = $this->agencyService->getAgencyData();
        if (!empty($agency->database_name)) {
            $this->agencyService->setConnectionByDatabase($agency->database_name);
        }
        // Search bookings to add
        $search = $request->search;
        $type = 'all';
        $bookings = $this->visaRepository->getBookingByid($agency->id, $type, $request);

        // Already selected rows (lower grid)
        $selected = ClientDocumentSelection::on('user_database')
            ->with(['booking.clint', 'booking.destination', 'booking.visasubtype', 'client'])
            ->where('agency_id', $agency->id)
            ->latest()
            ->get();

        return view('agencies.pages.clients.documents.movement', compact('bookings','selected'));
    }

    public function movementAdd($bookingId)
    {
        $agency = $this->agencyService->getAgencyData();
        if (!empty($agency->database_name)) {
            $this->agencyService->setConnectionByDatabase($agency->database_name);
        }
        $booking = $this->visaRepository->bookingDataById($bookingId);
        if (!$booking || $booking->agency_id !== $agency->id) {
            abort(404);
        }
        ClientDocumentSelection::on('user_database')->firstOrCreate([
            'agency_id' => $agency->id,
            'client_id' => $booking->client_id,
            'booking_id' => $booking->id,
        ]);
        return redirect()->route('client.documents.movement.add.form')->with('success','Added to emergency message page');
    }

    public function movementRemove($bookingId)
    {
        $agency = $this->agencyService->getAgencyData();
        if (!empty($agency->database_name)) {
            $this->agencyService->setConnectionByDatabase($agency->database_name);
        }
        ClientDocumentSelection::on('user_database')
            ->where('agency_id',$agency->id)
            ->where('booking_id',$bookingId)
            ->delete();
        return redirect()->route('client.documents.movement')->with('success','Removed');
    }

    // Delete document
    public function destroy($documentId)
    {
        $agency = $this->agencyService->getAgencyData();
        $document = ClientDocument::findOrFail($documentId);
        abort_if($document->agency_id !== $agency->id, 403);

        $document->delete();

        return redirect()->route('client.documents.index')->with('success', 'Document deleted successfully.');
    }

    // Send notification to clients
    public function sendNotification(Request $request)
    {
        $agency = $this->agencyService->getAgencyData();
        if (!empty($agency->database_name)) {
            $this->agencyService->setConnectionByDatabase($agency->database_name);
        }

        $validated = $request->validate([
            'message' => 'required|string|max:5000',
            'subject' => 'required|string|max:255',
            'message_type' => 'required|string',
            'include_document_details' => 'nullable|boolean',
        ]);

        // Get selected clients from ClientDocumentSelection
        $selected = ClientDocumentSelection::on('user_database')
            ->with(['booking.clint'])
            ->where('agency_id', $agency->id)
            ->get();

        $emailsSent = 0;

        foreach ($selected as $selection) {
            $client = $selection->booking->clint;

            if ($client && $client->email) {
                // Get recent documents if include_document_details is checked
                $document = null;
                if ($request->has('include_document_details')) {
                    $document = ClientDocument::with(['client'])
                        ->where('client_id', $client->id)
                        ->where('agency_id', $agency->id)
                        ->latest()
                        ->first();
                }

                Mail::to($client->email)->send(
                    new ClientDocumentNotificationMail(
                        $document,
                        $agency,
                        $validated['message']
                    )
                );

                $emailsSent++;
            }
        }

        // Clear selections after sending
        ClientDocumentSelection::on('user_database')
            ->where('agency_id', $agency->id)
            ->delete();

        return redirect()->route('client.documents.movement')
            ->with('success', "Notifications sent to {$emailsSent} client(s).");
    }

    // Send emergency message
    public function sendEmergencyMessage(Request $request)
    {
        $agency = $this->agencyService->getAgencyData();
        if (!empty($agency->database_name)) {
            $this->agencyService->setConnectionByDatabase($agency->database_name);
        }

        $validator = Validator::make($request->all(), [
            'message' => 'required|string|max:5000',
            'client_ids' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->route('client.documents.movement.add.form')
                ->withErrors($validator)
                ->withInput();
        }

        $validated = $validator->validated();

        // Get client IDs from the form
        $clientIds = explode(',', $validated['client_ids']);

        $emailsSent = 0;

        foreach ($clientIds as $clientId) {
            $client = ClientDetails::on('user_database')->find($clientId);

            if ($client && $client->email) {
                Mail::to($client->email)->send(
                    new ClientDocumentNotificationMail(
                        null, // No document
                        $agency,
                        $validated['message']
                    )
                );
                $emailsSent++;
            }
        }

        return redirect()->route('client.documents.movement')->with('success', "Emergency message sent to {$emailsSent} client(s).");
    }

    // Send message page
    public function sendMessage()
    {
        $agency = $this->agencyService->getAgencyData();
        if (!empty($agency->database_name)) {
            $this->agencyService->setConnectionByDatabase($agency->database_name);
        }

        // Get selected clients
        $selected = ClientDocumentSelection::on('user_database')
            ->with(['booking.clint'])
            ->where('agency_id', $agency->id)
            ->latest()
            ->get();

        return view('agencies.pages.clients.documents.send-message', compact('selected', 'agency'));
    }

    // New page for adding emergency messages
    public function movementAddForm(Request $request)
    {
        $agency = $this->agencyService->getAgencyData();
        if (!empty($agency->database_name)) {
            $this->agencyService->setConnectionByDatabase($agency->database_name);
        }

        // Get selected movements with pagination and search
        $query = ClientDocumentSelection::on('user_database')
            ->with(['booking.clint', 'booking.destination', 'booking.visasubtype', 'client'])
            ->where('agency_id', $agency->id);

        // Search functionality
        if ($request->filled('search')) {
            $query->whereHas('booking.clint', function ($clientQuery) use ($request) {
                $clientQuery->where('client_name', 'like', '%' . $request->search . '%')
                          ->orWhere('email', 'like', '%' . $request->search . '%')
                          ->orWhere('phone_number', 'like', '%' . $request->search . '%');
            });
        }

        $selected = $query->latest()->paginate(25);

        // Get all clients for dropdown
        $clients = ClientDetails::on('user_database')
            ->where('agency_id', $agency->id)
            ->whereNotNull('email')
            ->orderBy('client_name')
            ->get();

        return view('agencies.pages.clients.documents.add', compact('selected', 'clients', 'agency'));
    }

    // Store emergency message and send to movements
    public function movementAddStore(Request $request)
    {
        $agency = $this->agencyService->getAgencyData();
        if (!empty($agency->database_name)) {
            $this->agencyService->setConnectionByDatabase($agency->database_name);
        }

        $validated = $request->validate([
            'message' => 'required|string|max:5000',
            'client_ids' => 'required|string',
        ]);

        $clientIdString = $validated['client_ids'] ?? '';

        $clientIds = collect(explode(',', $clientIdString))
            ->map(fn ($id) => trim($id))
            ->filter()
            ->unique();

        if ($clientIds->isEmpty()) {
            $clientIds = ClientDocumentSelection::on('user_database')
                ->where('agency_id', $agency->id)
                ->pluck('client_id')
                ->filter()
                ->unique();
        }

        if ($clientIds->isEmpty()) {
            return redirect()->route('client.documents.movement.add.form')
                ->withErrors(['client_ids' => 'Please select at least one applicant to send the message.'])
                ->withInput();
        }

        $clients = ClientDetails::on('user_database')
            ->where('agency_id', $agency->id)
            ->whereIn('id', $clientIds)
            ->get();

        if ($clients->isEmpty()) {
            return redirect()->route('client.documents.movement.add.form')
                ->withErrors(['client_ids' => 'No clients were found for the selected entries.'])
                ->withInput();
        }

        $emailsSent = 0;

        foreach ($clients as $client) {
            if (!empty($client->email)) {
                Mail::to($client->email)->send(
                    new ClientDocumentNotificationMail(
                        null, // No document
                        $agency,
                        $validated['message']
                    )
                );
                $emailsSent++;
            }
        }

        ClientDocumentSelection::on('user_database')
            ->where('agency_id', $agency->id)
            ->whereIn('client_id', $clientIds)
            ->delete();

        return redirect()->route('client.documents.movement')->with('success', "Emergency message sent to {$emailsSent} client(s).");
    }

    // Export documents
    public function export(Request $request)
    {
        $agency = $this->agencyService->getAgencyData();

        return Excel::download(
            new ClientDocumentExport($agency->id, $request->search),
            'client-documents-' . now()->format('Y-m-d') . '.xlsx'
        );
    }
}
