<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ['amount','payment_date', 'remark', 'payment_type', 'evidence', 'application_id'];

    public function application()
    {
        return $this->belongsTo(Application::class);
    }

}