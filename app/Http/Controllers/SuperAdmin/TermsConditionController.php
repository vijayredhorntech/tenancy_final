<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TermsCondition;
use App\Repositories\Interfaces\TermConditionRepositoryInterface;
use Auth; 


class TermsConditionController extends Controller
{


    protected $termConditionRepo;

    public function __construct(TermConditionRepositoryInterface $termConditionRepo)
    {
        $this->termConditionRepo = $termConditionRepo;
    }

  /**
     * Display a listing of terms and conditions.
     */
    public function hs_termtypeindex()
    {
        $termtypes = $this->termConditionRepo->allTeamTypes();
        return view('superadmin.pages.terms.termstype', ['termtypes' => $termtypes]);
    }

  /**
     * Flight Details View
     */
    public function hs_termtype_store(Request $request)
    {  
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:term_types,type',
            'description' => 'required|string',
        ]);
        $termsAndConditions = $this->termConditionRepo->termTypeCreate($request->all());
        return redirect()->route('superadmin.termtype')->with('success', 'Terms and conditions created successfully');
    }

    /****Term create *** */

    public function hs_TermsCreate($id){
        $termtype = $this->termConditionRepo->termTypeGetById($id);
        return view('superadmin.pages.terms.termcreate',compact('termtype'));
    }
    /**
     * Store a newly created terms and conditions in storage.
     */
    public function hs_store(Request $request)
    {
       
        $validated = $request->validate([
            'termid'         => 'required|exists:term_types,id',
            'name'           => 'required|string|max:255',
            'termheading'    => 'required|string|max:255',
            'description'    => 'string',
            'displayinvoice' => 'required|in:0,1', // Accepts only 0 or 1
        ]);
     

        $termtype = $this->termConditionRepo->create($request->all());
           
        return redirect()->route('superadmin.termtype')->with('success', 'Terms and conditions assigned successfully');
    }

    public function hs_viewTerms($id){
        $terms = $this->termConditionRepo->termsConditions($id);
        return view('superadmin.pages.terms.terms',compact('terms'));
    }
    /**
     * Display the specified terms and conditions.
     */
    public function hs_edit($id)
    {
       
        $terms = TermsCondition::find($id);
      
        if ($terms) {
        
              return view('superadmin.pages.terms.editterms',[
                'terms'=>$terms
              ]);
        }
       
    }

    /**
     * Update the specified terms and conditions.
     */
    public function hs_update(Request $request, $id)
    {

        $request->validate([
            'name' => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'create_user' => 'sometimes|integer',
            'assign_for' => 'nullable|string',
            'status' => 'sometimes|in:0,1',
        ]);

        $terms = TermsCondition::find($id);
        if (!$terms) {
            return response()->json(['message' => 'Terms and Conditions not found'], 404);
        }

        $terms->update($request->all());
        return response()->json(['message' => 'Terms and Conditions updated successfully', 'data' => $terms]);
    }

    /**
     * Remove the specified terms and conditions.
     */
    public function destroy($id)
    {
        $terms = TermsCondition::find($id);
        if (!$terms) {
            return response()->json(['message' => 'Terms and Conditions not found'], 404);
        }

        $terms->delete();
        return response()->json(['message' => 'Terms and Conditions deleted successfully']);
    }

}
