<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VisaServices extends Model
{
    use HasFactory;

    protected $table = 'visa_types'; // Specify the table name

    protected $fillable = [
        'title_image',
        'origin',
        'destination',
    ];

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'origin');
    }

    public function destinationCountry(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'destination');
    }


  
    public function VisavisaSubtype()
    {
        return $this->hasMany(VisaSubtype::class,'visa_type_id', 'id');
    }



    public function visaServiceTypes()
    {
        return $this->hasMany(VisaServiceType::class);
    }

    public function attachTitleImage($image)
    {
        $this->title_image ? \Storage::disk('public')->delete($this->title_image) : '';
        $this->update([
            'title_image' => $image->hashName()
        ]);
        $image->store('visa-service/' . $this->id . '/images', 'public');
    }

    public function titleImage()
    {
        return asset('storage/visa-service/' . $this->id . '/images/' . $this->title_image);
    }
}
