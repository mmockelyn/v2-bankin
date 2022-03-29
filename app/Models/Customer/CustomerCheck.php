<?php

namespace App\Models\Customer;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use function Symfony\Component\Console\Output\doWrite;

class CustomerCheck extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function wallet()
    {
        return $this->belongsTo(CustomerWallet::class, 'customer_wallet_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function getStatus($value)
    {
        switch ($value) {
            case 'checkout':
                return '<span class="badge badge-primary">Commandé</span>';
                break;

            case 'manufacture':
                return '<span class="badge badge-warning">Fabrication en cours</span>';
                break;

            case 'ship':
                return '<span class="badge badge-warning">Envoie effectuer</span>';
                break;

            case 'outstanding':
                return '<span class="badge badge-success">En cours d\'utilisation</span>';
                break;

            case 'finish':
                return '<span class="badge badge-info">Terminer</span>';
                break;

            case 'destroy':
                return '<span class="badge badge-danger">Détruit</span>';
                break;

            default:
                return '<span class="badge badge-black">Inconnue</span>';
                break;

        }
    }
}
