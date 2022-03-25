<?php

namespace App\Policies\Account;

use App\Models\Customer\Customer;
use App\Models\Customer\CustomerWallet;
use App\Models\User\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SubscriptionPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function access(CustomerWallet $wallet)
    {
        return $wallet->outstanding != 0;
    }
}
