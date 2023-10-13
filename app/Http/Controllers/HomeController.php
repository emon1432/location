<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $countries = DB::table('countries')->get();
        // return response()->json($countries);

        return view('welcome', compact('countries'));
    }

    public function getState(Request $request)
    {
        $states = DB::table('states')->where('country_id', $request->country_id)->orderBy('name', 'asc')->get();
        return response()->json($states);
    }

    public function getCity(Request $request)
    {
        $cities = DB::table('cities')->where('state_id', $request->state_id)->orderBy('name', 'asc')->get();
        return response()->json($cities);
    }
}
