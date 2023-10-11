<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // In a real application, you would fetch country data from a database.
        $countries = [
            ['name' => 'United States', 'code' => 'US' , 'lat' => '37.0902', 'lng' => '-95.7129'],
            ['name' => 'Canada', 'code' => 'CA', 'lat' => '56.1304', 'lng' => '-106.3468'],
            ['name' => 'United Kingdom', 'code' => 'UK', 'lat' => '55.3781', 'lng' => '-3.4360'],
            ['name' => 'Netherlands', 'code' => 'NL', 'lat' => '52.1326', 'lng' => '5.2913'],
            ['name' => 'Germany', 'code' => 'DE', 'lat' => '51.1657', 'lng' => '10.4515'],
            ['name' => 'France', 'code' => 'FR', 'lat' => '46.2276', 'lng' => '2.2137'],
            ['name' => 'Spain', 'code' => 'ES', 'lat' => '40.4637', 'lng' => '-3.7492'],
            ['name' => 'Italy', 'code' => 'IT', 'lat' => '41.8719', 'lng' => '12.5674'],
            ['name' => 'Sweden', 'code' => 'SE', 'lat' => '60.1282', 'lng' => '18.6435'],
            ['name' => 'Norway', 'code' => 'NO', 'lat' => '60.4720', 'lng' => '8.4689'],
            ['name' => 'Denmark', 'code' => 'DK', 'lat' => '56.2639', 'lng' => '9.5018'],
            ['name' => 'Finland', 'code' => 'FI', 'lat' => '61.9241', 'lng' => '25.7482'],
            ['name' => 'Belgium', 'code' => 'BE', 'lat' => '50.5039', 'lng' => '4.4699'],
            ['name' => 'Switzerland', 'code' => 'CH', 'lat' => '46.8182', 'lng' => '8.2275'],
            ['name' => 'Austria', 'code' => 'AT', 'lat' => '47.5162', 'lng' => '14.5501'],
            ['name' => 'Ireland', 'code' => 'IE', 'lat' => '53.1424', 'lng' => '-7.6921'],
        ];
        // return response()->json($countries);

        return view('welcome', compact('countries'));
    }
}
