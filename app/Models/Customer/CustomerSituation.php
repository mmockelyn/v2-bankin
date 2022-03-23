<?php

namespace App\Models\Customer;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerSituation extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $dates = ["created_at", "updated_at", "logement_at"];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
