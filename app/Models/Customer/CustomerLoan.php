<?php

namespace App\Models\Customer;

use App\Models\Core\LoanPlan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerLoan extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function plan()
    {
        return $this->belongsTo(LoanPlan::class);
    }

    public function wallet()
    {
        return $this->belongsTo(CustomerWallet::class);
    }
}
