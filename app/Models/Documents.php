<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Documents extends Model
{
    protected $fillable = ['customer_id', 'document_type', 'file_path'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}