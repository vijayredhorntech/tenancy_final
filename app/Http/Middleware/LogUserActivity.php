<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\UserActivityLog;
use Auth; 
use App\Services\AgencyService;

class LogUserActivity
{

    protected $agencyService;
    public function __construct(AgencyService $agencyService)
    {
       
        $this->agencyService = $agencyService;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $setConnection= $this->agencyService->setDatabaseConnection();  
        if ($setConnection) {
            // dd("heelo");
            return redirect()->route('agency_dashboard');
        }
         
        $response = $next($request);
        UserActivityLog::create([
            'user_id' => Auth::id(), // Get authenticated user ID
            'url' => $request->fullUrl(), // Full URL with query parameters
            'method' => $request->method(), // GET, POST, etc.
            'ip' => $request->ip(), // User's IP address
            'user_agent' => $request->userAgent(), // Browser info
        ]);
        return $response;
    }
}
