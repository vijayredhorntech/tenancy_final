<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClientApplicationDocument extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'client_id',
        'application_id',
        'application_number',
        'document_name',
        'document_status',
        'agency_id',
        'user_id',
        'document_file',
        'rejection_reason'
    ];

    protected $casts = [
        'document_status' => 'integer',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function application()
    {
        return $this->belongsTo(Application::class);
    }

    public function agency()
    {
        return $this->belongsTo(Agency::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
