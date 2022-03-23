<?php

namespace App\Models\Core;

use App\Models\Customer\CustomerLoan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanPlan extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $timestamps = false;

    public function loans()
    {
        return $this->hasMany(CustomerLoan::class);
    }

    public function interests()
    {
        return $this->hasMany(LoanPlanInterest::class);
    }
}
