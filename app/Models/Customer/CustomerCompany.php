<?php

namespace App\Models\Customer;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerCompany extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
