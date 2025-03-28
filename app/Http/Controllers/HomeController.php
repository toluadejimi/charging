<?php

namespace App\Http\Controllers;

use App\Models\AccountDetail;
use App\Models\Box;
use App\Models\Deposit;
use App\Models\ManualPayment;
use App\Models\PaymentMethod;
use App\Models\Setting;
use App\Models\SoldLog;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Verification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;


class HomeController extends Controller
{
    public function index(request $request)
    {

        $boxes = Box::all();
        $data['boxes'] = $boxes;

        return view('welcome', $data);
    }


    public function assign_box(request $request)
    {
        $data['box'] = Box::where('id', $request->id)->first();
        return view('assign-box', $data);
    }

    public function assign_box_now(request $request)
    {

        $now = Carbon::now();
        $code = random_int(00000, 99999);
        $trx = new Transaction();
        $trx->name =  $request->name;
        $trx->box_id =  $request->box_id;
        $trx->phone =  $request->phone;
        $trx->address =  $request->address;
        $trx->items =  $request->items;
        $trx->code =  $code;
        $trx->amount =  500;
        $trx->time_in = $now->format('Y-m-d H:i');
        $trx->time_out = $now->setTime(22, 30, 0)->format('Y-m-d H:i');
        $trx->save();

        Box::where('id', $request->box_id)->update(['status' => 'occupied']);

        $data['time_in'] = $trx->time_in;
        $data['code'] = $trx->code;
        $data['amount'] = $trx->amount;
        $data['time_out'] = $trx->time_out;
        $data['box'] = $trx->box_id;


        return view('success', $data);
    }


    public function success(request $request)
    {
        $data['trx'] = [];
        return view('success', $data);
    }


    public function check_out(request $request)
    {
        $get_code = Transaction::where('box_id', $request->box_id)->first()->code;
        if($get_code == $request->code){
            Box::where('id', $request->box_id)->update(['status' => 'available']);
            Transaction::where('box_id', $request->box_id)->update(['collected_by' => $request->collect_by]);
            return redirect('/')->with('message', 'Transaction Completed');

        }else{
            return redirect('/')->with('error', 'Invalid Code');

        }
    }






}
