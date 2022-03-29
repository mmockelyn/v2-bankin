<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function index()
    {
        return view('account.document.index');
    }
}
