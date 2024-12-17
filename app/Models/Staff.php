<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $fillable = ['user_id', 'branch_id', 'role'];

    // Relationship to get the user details of this staff member
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relationship to get the branch this staff belongs to
    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }
}
