<?php

namespace App\Models\Customer;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerInsuranceHome extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $dates = ["created_at", "updated_at", "date_effective"];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function service()
    {
        return $this->hasOne(CustomerInsuranceHomeService::class);
    }

    public function home()
    {
        return $this->hasOne(CustomerInsuranceHomeHouse::class);
    }

    public function equipement()
    {
        return $this->hasOne(CustomerInsuranceHomeEquip::class);
    }

    public function assures()
    {
        return $this->hasMany(CustomerInsuranceHomeAssure::class);
    }
}
