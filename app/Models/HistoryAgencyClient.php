<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryAgencyClient extends Model
{
    use HasFactory;

    // Table name (optional, Laravel will guess this correctly)
    protected $table = 'history_agency_clients';

    // Fillable columns
    protected $fillable = [
        'user_id',
        'client_id',
        'agency_id',
        'date_time',
        'type',
        'description',
        'status',
    ];

      /**
     * Relationship: HistoryAgencyClient belongs to a User
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id'); 
        // 'user_id' is the foreign key in history_agency_clients table
    }
}
