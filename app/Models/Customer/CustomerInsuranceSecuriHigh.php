<?php

namespace App\Models\Customer;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerInsuranceSecuriHigh extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $dates = ["created_at", "updated_at", "date_effective"];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}
