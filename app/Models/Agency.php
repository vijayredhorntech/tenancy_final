<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agency extends Model
{
    use HasFactory;

    // The table associated with the model
    protected $table = 'agencies';

    // The attributes that are mass assignable
    protected $fillable = [
        'name', 
        'email', 
        'phone', 
        'address', 
        'contact_person', 
        'contact_phone', 
        'country', 
        'database_name', 
        'user_id',
    ];

    // Define the relationship to the User model
    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }

    /**get domains data***/
    
       public function domains()
        {
            return $this->hasOne(Domain::class);
        }


         public function userAssignments()
            {
                return $this->hasMany(UserServiceAssignment::class, 'agency_id');
            }


        public function balance(){
                 return $this->hasOne(Balance::class, 'agency_id');
        }

        public function transactions() // Adjust the name based on your table
        {
            return $this->hasMany(AddBalance::class);
        }

        public function deduction() // Adjust the name based on your table
        {
            return $this->hasMany(Deduction::class);
        }

}
