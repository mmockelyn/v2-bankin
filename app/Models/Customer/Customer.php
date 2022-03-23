<?php

namespace App\Models\Customer;

use App\Models\Core\Package;
use App\Models\User\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function loan()
    {
        return $this->hasMany(CustomerLoan::class);
    }

    public function individual()
    {
        return $this->hasOne(CustomerIndividual::class);
    }

    public function business()
    {
        return $this->hasOne(CustomerCompany::class);
    }

    public function wallets()
    {
        return $this->hasMany(CustomerWallet::class);
    }

    public function setting()
    {
        return $this->hasOne(CustomerSetting::class);
    }

    public function situation()
    {
        return $this->hasOne(CustomerSituation::class);
    }

    public function beneficiaires()
    {
        return $this->hasMany(CustomerBeneficiaire::class);
    }

    public function cards()
    {
        return $this->hasMany(CustomerCreditCard::class);
    }
}
