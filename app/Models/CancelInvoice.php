<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CancelInvoice extends Model
{
    use HasFactory;

    protected $table = 'cancel_invoices';

    protected $fillable = [
        'invoice_id',
        'application_number',
        'type',
        'remark',
        'reason',
        'cancelled_by',
        'status',
        'amount',
        'safi',
        'atol',
        'credit_charge',
        'penalty',
        'admin',
        'misc',
        'cancelled_date',
    ];

    protected $casts = [
        'cancelled_date' => 'datetime',
        'amount' => 'decimal:2',
    ];

        public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}
