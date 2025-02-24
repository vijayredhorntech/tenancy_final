<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TermsCondition;
use Auth; 


class TermsConditionController extends Controller
{


  /**
     * Display a listing of terms and conditions.
     */
    public function hs_index()
    {
        $terms = TermsCondition::all();
    
        return view('superadmin.pages.terms.terms', ['terms' => $terms]);

    }

    /**
     * Store a newly created terms and conditions in storage.
     */
    public function hs_store(Request $request)
    {
        $request->validate([
            'description' => 'required|string',
            'assign_for' => 'nullable|string',
        ]);
    
        $id = Auth::user()->id;
    
        // Deactivate existing active terms
        $existingTerms = TermsCondition::where('status', 1)->first();
        if ($existingTerms) {
            $existingTerms->status = 0;
            $existingTerms->save();
        }
    
        // Create new terms
        $terms = new TermsCondition();
        $terms->name = "super admin";
        $terms->description = $request->description;
        $terms->create_user = $id;
        $terms->assign_for = "agency";
        $terms->status = 1;
        $terms->save();
    
        return redirect()->route('superadmin.terms')->with('success', 'Terms and conditions assigned successfully');
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
