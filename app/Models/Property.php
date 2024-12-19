<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $guarded = [];
    public function owner(){
        return $this->belongsTo(User::class, 'owner_id', 'id');
    }
}
