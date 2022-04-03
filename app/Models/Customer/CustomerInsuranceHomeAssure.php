<?php

namespace App\Models\Customer;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerInsuranceHomeAssure extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $timestamps = false;
    protected $dates = ["date_birth"];

    public function insurance()
    {
        return $this->belongsTo(CustomerInsuranceHome::class);
    }
}
