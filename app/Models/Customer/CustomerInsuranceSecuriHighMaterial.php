<?php

namespace App\Models\Customer;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerInsuranceSecuriHighMaterial extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $timestamps = false;

    protected $dates = ["date_achat"];

    public function secure()
    {
        return $this->belongsTo(CustomerInsuranceSecuriHigh::class, 'high_id');
    }
}
