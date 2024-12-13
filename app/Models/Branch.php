<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
   public function manager(){
    return $this->belongsTo(Staff::class,'manager_id', 'staff_id');
   } 
}
