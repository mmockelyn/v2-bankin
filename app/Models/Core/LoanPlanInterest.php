<?php

namespace App\Models\Core;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanPlanInterest extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $timestamps = false;

    public function loan()
    {
        return $this->belongsTo(LoanPlan::class);
    }
}
