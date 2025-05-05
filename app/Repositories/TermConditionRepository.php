<?php

namespace App\Repositories;


use App\Repositories\Interfaces\TermConditionRepositoryInterface;
use App\Models\TermsCondition;
use App\Models\TermType;

class TermConditionRepository implements TermConditionRepositoryInterface
{
    /**
     * Get all term conditions.
     */
    public function getAll()
    {
        return TermsCondition::all();
    }

    /**
     * Find a term condition by its ID.
     */
    public function find($id)
    {
        return TermsCondition::find($id);
    }

    /**
     * Create a new term condition.
     */
    public function create(array $data)
    {
       
        $data = [
            'termtype_id' => $data['termid'],
            'heading' => $data['termheading'],
            'description' => $data['description'],
            'display_invoice' => $data['displayinvoice']?? 0,
        ];
      
        return TermsCondition::create($data);
    }

    /**
     * Get all term types.
     **/

    public function termsConditions($id)
    {
        return TermType::with('terms')->where('id',$id)->first();  
    }

    /**
     * Update an existing term condition.
     */
    public function update($id, array $data)
    {
        $termCondition = TermsCondition::find($id);
        if ($termCondition) {
            $termCondition->update($data);
            return $termCondition;
        }
        return null;
    }

    /**
     * Delete a term condition.
     */
    public function delete($id)
    {
        $termCondition = TermsCondition::find($id);
        if ($termCondition) {
            $termCondition->delete();
            return true;
        }
        return false;
    }

    /******Create term type **** */

    public function termTypeCreate(array $data){     
        $data = [
            'type' => $data['name'],
            'description' => $data['description'],
            'status' => $data['status'] ?? 1,
        ];
        return TermType::create($data);
    }


    public function allTeamTypes(){
        return TermType::with('terms')->get();
    }

    /****Get BY Id *** */

    public function termTypeGetById($id){
        return TermType::with('terms')->where('id',$id)->first();
    }
}
