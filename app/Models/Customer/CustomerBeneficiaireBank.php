<?php

namespace App\Models\Customer;

use App\Models\Core\Bank;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerBeneficiaireBank extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $timestamps = false;

    public function beneficiaire()
    {
        return $this->belongsTo(CustomerBeneficiaire::class);
    }

    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }
}
