<?php

namespace App\Http\Controllers;

use App\Helpers\Customer\DocumentFile;
use App\Helpers\Customer\Transaction;
use App\Mail\Account\CheckoutCheck;
use App\Models\Customer\Customer;
use App\Models\Customer\CustomerTransfer;
use App\Models\Customer\CustomerWallet;
use App\Services\Github;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PDF;

class TestController extends Controller
{
    public function test()
    {
        $wallet = CustomerWallet::find(3);
        $customer = $wallet->customer;
        $agence = $wallet->agency;
        $header = view()
            ->make("agence.pdf.header_basic")
            ->with('agence', $agence)
            ->with('customer', $wallet->customer)
            ->render();

        $file = new DocumentFile();
        $reference = \Str::upper(\Str::random(10));

        $name = "rib";

        $document = $file->createDocument($name, $wallet->customer, 4, $reference);

        $pdf = $pdf = PDF::loadView('agence.pdf.account.rib', compact('agence', 'customer', 'document', 'name', 'wallet'));
        $pdf->setOption('enable-local-file-access', true);
        $pdf->setOption('viewport-size', '1280x1024');
        $pdf->setOption('header-html', $header);
        $pdf->setOption('footer-right', '[page]/[topage]');
        $pdf->setOption('footer-font-size', 8);
        $pdf->setOption('margin-left', 0);
        $pdf->setOption('margin-right', 0);
        return $pdf->inline("rib.pdf");
    }
}
