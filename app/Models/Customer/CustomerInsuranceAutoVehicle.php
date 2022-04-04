<?php

namespace App\Models\Customer;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerInsuranceAutoVehicle extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $timestamps = false;

    protected $dates = ["first_circ", "date_achat"];

    public function auto()
    {
        return $this->belongsTo(CustomerInsuranceAuto::class, 'customer_insurance_auto_id');
    }
}
