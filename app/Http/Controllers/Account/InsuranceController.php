<?php

namespace App\Http\Controllers\Account;

use App\Helpers\InsurancePriceHome;
use App\Helpers\InsuranceWarrantyHome;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InsuranceController extends Controller
{
    /**
     * @var InsurancePriceHome
     */
    private $priceHome;
    /**
     * @var InsuranceWarrantyHome
     */
    private $warrantyHome;

    /**
     * InsuranceController constructor.
     * @param InsurancePriceHome $priceHome
     * @param InsuranceWarrantyHome $warrantyHome
     */
    public function __construct(InsurancePriceHome $priceHome, InsuranceWarrantyHome $warrantyHome)
    {
        $this->priceHome = $priceHome;
        $this->warrantyHome = $warrantyHome;
    }

    public function index()
    {
        return view('account.insurance.index');
    }
}
