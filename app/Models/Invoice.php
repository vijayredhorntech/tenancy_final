<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    /**
     * Mass‑assignable columns.
     */
    protected $fillable = [
        'receiver_name',
        'invoice_date',
        'invoice_number',   // ✅ Newly added
        'agency_id',        // ✅ Newly added
        'client_id', 
        'due_date',
        'different_name',     // ← NEW date column
        'address',
        'bookingid',
        'visa_applicant',
        'service_id',
        'billing_id',
        'applicant_id',
        'amount',
        'discount',
        'payment_type',
        'visa_fee',
        'new_price',
        'type',
        'new_invoice_number',
        'status',
        'service_charge',
        'payment_methods',
        'card_last_4_digit',
    ];


        
    /**
     * Attribute casting.
     */
    protected $casts = [
        'invoice_date'   => 'date',
        'due_date'       => 'date',
        'discount'       => 'decimal:2',
        'payment_methods' => 'array',
    ];



    public function invoicedetails()
    {
        return $this->hasOne(Deduction::class,'id','bookingid');
    }   

    public function deductions()
{
    return $this->hasMany(Deduction::class, 'invoice_number', 'invoice_number');


}

    public function cancel_invoice()
    {
        return $this->hasOne(CancelInvoice::class);
    }

    public function cancel_invoices()
    {
        return $this->hasMany(CancelInvoice::class);
    }

    
    /* ───── Optional relationships ─────
   
    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function billing()
    {
        return $this->belongsTo(Billing::class);
    }

    public function applicant()
    {
        return $this->belongsTo(Applicant::class);
    }
    */
}
