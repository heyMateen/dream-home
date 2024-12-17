<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
   protected $fillable = ['name', 'address', 'phone_number', 'postal_code', 'city', 'state', 'country'];

   // Define the relationship to get the manager of the branch
   public function manager()
   {
      return $this->hasOne(Staff::class, 'branch_id')
         ->where('role', 'manager')
         ->with('user'); // Load the user details
   }

   // Optional: All staff related to this branch
   public function staff()
   {
      return $this->hasMany(Staff::class, 'branch_id');
   }
}
