<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierPaymentDetail extends Model
{
    use HasFactory;

    protected $table = 'supplier_paymentdetails';

    protected $fillable = [
        'booking_id',
        'invoice_number',
        'service_id',
        'supplier_name',
        'payment_type',
        'payment_date',
        'paying_amount',
        'balance',
    ];
}
