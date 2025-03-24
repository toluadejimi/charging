<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\Verification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SmsbusController extends Controller
{
    public function home(request $request)
    {

        $get_rate = Setting::where('id', 1)->first()->rate;
        $margin = Setting::where('id', 1)->first()->margin;


        $data['get_rate'] = Setting::where('id', 1)->first()->rate;
        $data['margin'] = Setting::where('id', 1)->first()->margin;


        $wcountries = get_bus_world_countries();
        $wservices = get_bus_world_services();

        $verification = Verification::latest()->where('user_id', Auth::id())->get();



        $data['wservices'] = $wservices;
        $data['wcountries'] = $wcountries;
        $data['verification'] = $verification;


        $data['q_orderuk'] = ck_av("2", "1012") ?? 0;

        $gcost = pool_cost("1012", "2");
        $data['ukamont'] = ($data['get_rate'] * $gcost) + $data['margin'];



        $data['pend'] = 0;

        $data['product'] = null;

        $data['orders'] = Verification::latest()->where('user_id', Auth::id())->get();


        return view('world', $data);
    }

}
