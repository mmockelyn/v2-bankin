<?php

namespace App\Models\Customer;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerInsuranceHomeEquip extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $timestamps = false;

    public function insurance()
    {
        return $this->belongsTo(CustomerInsuranceHome::class);
    }
}
