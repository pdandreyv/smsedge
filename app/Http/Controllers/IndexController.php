<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\User;
use App\Country;
use App\Send_log_aggregated;

class IndexController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'users' => User::all(),
            'countries' => Country::all(),
            'data' => [],
            'post' => ['date_from'=>'','date_to'=>'','usr_id'=>'','cnt_id'=>'']
        ];
        return view('main/index',$data);
    }
    
    public function post(Request $request)
    {
        $data = [
            'users' => User::all(),
            'countries' => Country::all(),
            'data' => Send_log_aggregated::getInfo($request->date_from, $request->date_to, $request->usr_id, $request->cnt_id),
            'post' => $request->toArray()
        ];
        return view('main/index',$data);
    }
}
