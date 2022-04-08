<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ListController extends Controller
{
    public function cars()
    {
        $results = \Http::get('https://databases.one/api/?format=json&select=make&api_key=Your_Database_Api_Key')->object()->result;
        return response()->json($results);
    }
}
