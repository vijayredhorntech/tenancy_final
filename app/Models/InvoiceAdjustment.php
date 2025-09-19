<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InvoiceAdjustment extends Model
{
    use HasFactory;

    protected $fillable = [
        'original_invoice_id',
        'selected_application_id',
        'agency_id',
        'adjustment_number',
        'original_invoice_number',
        'original_amount',
        'adjusted_amount',
        'selected_application_number',
        'selected_client_name',
        'selected_application_amount',
        'processed_by',
        'internal_notes',
        'status',
        'adjustment_type',
        'processed_by_user_id',
        'adjustment_date',
    ];

    protected $casts = [
        'original_amount' => 'decimal:2',
        'adjusted_amount' => 'decimal:2',
        'selected_application_amount' => 'decimal:2',
        'adjustment_date' => 'datetime',
    ];

    /**
     * Get the original invoice (deduction) that was adjusted
     */
    public function originalInvoice(): BelongsTo
    {
        return $this->belongsTo(Deduction::class, 'original_invoice_id');
    }

    /**
     * Get the agency that owns this adjustment
     */
    public function agency(): BelongsTo
    {
        return $this->belongsTo(Agency::class);
    }

    /**
     * Get the user who processed this adjustment
     */
    public function processedByUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'processed_by_user_id');
    }

    /**
     * Get the selected application (visa booking) if any
     */
    public function selectedApplication(): BelongsTo
    {
        return $this->belongsTo(VisaBooking::class, 'selected_application_id');
    }

    /**
     * Scope to filter by agency
     */
    public function scopeForAgency($query, $agencyId)
    {
        return $query->where('agency_id', $agencyId);
    }

    /**
     * Scope to filter by status
     */
    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Get formatted adjustment number
     */
    public function getFormattedAdjustmentNumberAttribute()
    {
        return strtoupper($this->adjustment_number);
    }

    /**
     * Get formatted original amount
     */
    public function getFormattedOriginalAmountAttribute()
    {
        return '£' . number_format($this->original_amount, 2);
    }

    /**
     * Get formatted adjusted amount
     */
    public function getFormattedAdjustedAmountAttribute()
    {
        return '£' . number_format($this->adjusted_amount, 2);
    }

    /**
     * Get formatted selected application amount
     */
    public function getFormattedSelectedApplicationAmountAttribute()
    {
        return $this->selected_application_amount ? '£' . number_format($this->selected_application_amount, 2) : null;
    }
}
