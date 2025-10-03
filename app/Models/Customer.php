<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = ['dob', 'phone', 'nrc', 'user_id', 'passport'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function documents()
    {
        return $this->hasMany(Documents::class);
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }
}