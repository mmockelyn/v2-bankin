<?php

namespace App\Models\Core;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agency extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $timestamps = false;

    public function transmisses()
    {
        return $this->hasMany(DocumentTransmiss::class);
    }
}
