<?php

namespace App\Traits\Leaves;

use Carbon\Carbon;
use App\Models\Leave;
use App\Models\ApplyUserLeave;
use App\Models\LeaveBalance;
use Auth; 

trait ManageLeaveTrait
{
    /**
     * Calculate the total number of leave days between two dates.
     *
     * @param string $from
     * @param string $to
     * @return int
     */
    public function calculateLeaveDays($from, $to)
    {
        $startDate = Carbon::parse($from);
        $endDate = Carbon::parse($to);
        return (int) ($startDate->diffInDays($endDate) + 1);
    }

    /**
     * Update leave balance when modifying a leave request.
     *
     * @param int $leaveId
     * @param string $newFrom
     * @param string $newTo
     * @param string|null $reason
     * @return array
     */
    public function checkLeaveBalance($startdate, $enddate, $data): bool
    {
        // Ensure the date difference is correctly calculated
        $leave_days = (int) ($startdate->diffInDays($enddate) + 1);
    
        // Fetch leave balance
        $leavebalance = LeaveBalance::where('leave_id', $data['leave_type'])->first();
    
        if ($leavebalance) {
            $totalleave = $leavebalance->balance;
        } else {
            $leave = Leave::where('id', $data['leave_type'])->first();
            $totalleave = $leave ? $leave->total_days : 0; // Handle null case
        }
    
        // Ensure total leave is set and compare with requested leave days
        return isset($totalleave) && $totalleave >= $leave_days;
    }
    
    /******Check Leave ***** */
    public function checkLeaves()
    {
        $user = Auth::user();
    
        return ApplyUserLeave::where('user_id', $user->id)
            ->where('status_of_leave', 'pending')
            ->exists(); // Returns true if a pending leave exists, otherwise false
    }

    /***Update superadin *** */

    public function superadminedit($data){

        $leave=ApplyUserLeave::where('id', $data['leaveid'])
        ->where('status_of_leave', 'pending')
        ->first();
        $leave->start_date=$data['from'];
        $leave->end_date=$data['to'];
        $leave->status_of_leave=$data['status'];;
        $leave->save();
     
        if($data['status']=='approved'){

            $this->reduceleavebalance($data['from'],$data['to'],$leave->leave_id);
            return true; 
        }else{
            return false; 
        }
         
    }

    public function reduceleavebalance($startdate,$enddate,$leaveid){
     
     
        $start_date = Carbon::parse($startdate);
        $end_date = Carbon::parse($enddate);
        // $leave_days = $start_date->diffInDays($end_date) + 1;
        $leave_days = (int) ($start_date->diffInDays($end_date) + 1);

        $check_leave = LeaveBalance::where('leave_id', $leaveid)
        ->where('user_id', auth()->id())
        ->first();
        if (!empty($check_leave)) {
            $check_leave->balance -= $leave_days;
            $check_leave->used = $leave_days+$check_leave->used;
            $check_leave->save();
          
        } else {
            // Fetch total allowed leaves from the Leave table
            $leaveType = Leave::where('id',$leaveid)->first();
            $total_leaves = $leaveType ? $leaveType->total_days : 0;
    
            // Ensure balance does not go negative
            $balance = max(0, $total_leaves - $leave_days);
    
            // Create a new leave balance entry
            $leave_balance = new LeaveBalance();
            $leave_balance->leave_id = $leaveid;
            $leave_balance->user_id = auth()->id();
            $leave_balance->balance = $balance;
            $leave_balance->used = $leave_days;
            $leave_balance->status = 'active';
            $leave_balance->save();

        }
        return true; 
       
    }

    /****Update Student Leaves ******/
    public function useredit($data){
        $leave=ApplyUserLeave::where('id', $data['leaveid'])
        ->where('status_of_leave', 'pending')
        ->first();
        $leave->start_date=$data['from'];
        $leave->end_date=$data['to'];
        $leave->save();
        return true; 
    }
}
