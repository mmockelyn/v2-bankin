<?php

namespace App\Models\User;

use App\Models\Core\Agency;
use App\Models\Customer\Customer;
use Arcanedev\LaravelMessenger\Traits\Messagable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Lab404\AuthChecker\Interfaces\HasLoginsAndDevicesInterface;
use Lab404\AuthChecker\Models\HasLoginsAndDevices;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements HasLoginsAndDevicesInterface
{
    use HasApiTokens, HasFactory, Notifiable, TwoFactorAuthenticatable, HasLoginsAndDevices, Messagable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function routeNotificationForAuthy()
    {
        return $this->authy_id;
    }

    public function routeNotificationForTwilio()
    {
        if($this->customer->type_account == 'INDIVIDUAL') {
            return $this->customer->individual->phone;
        } else {
            return $this->customer->business->phone;
        }
    }

    public function routeNotificationForMail($notification)
    {
        // Return email address only...
        return $this->email;
    }

    public function customer()
    {
        return $this->hasOne(Customer::class);
    }

    public function agence()
    {
        return $this->belongsTo(Agency::class, 'agency_id');
    }
}
