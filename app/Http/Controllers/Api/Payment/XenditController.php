<?php

namespace App\Http\Controllers\Api\Payment;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Xendit\Xendit;
use App\Models\Payment;
class XenditController extends Controller
{
    // ini adalah token xendit yg sudah di generet
    private $token='xnd_development_cIjY3dSwcSKPfxn3z0jLXbE9DmyW6la4qp17BWD9G7DXZRMXu0LrfTQLJreJ';

    // controller untuk melihat list Virtual Account yang tersedia
    public function getListVa(){
        Xendit::setApiKey($this->token);
        $getVABanks= \Xendit\VirtualAccounts::getVABanks();
        return response()->json([
            'data'=>$getVABanks
        ])->setStatusCode(200);
        // return 'ok';
    }
    public function create(Request $request){
        //  return csrf_token();

        Xendit::setApiKey($this->token);

        $external_id = "va-".time();
        $params = ["external_id" => $external_id,
        "bank_code" => $request->bank,
        "name" => $request->email,
        "expected_amount" => $request->price,
        "is_closed" =>true,
        "expiration_date" => Carbon::now()->addDays(1)->toISOString(),
        "is_single_use"=>true
        ];
        $insert=Payment::insert([
            'external_id'=>$external_id,
            'payment_channel' => 'Virtual Account',
            'email' =>$request->email,
            'price'=> $request->price,

        ]);

        // dd($insert);
        $createVA = \Xendit\VirtualAccounts::create($params);
        return response()->json([
            'data'=>$createVA
        ])->setStatusCode(200);


    }
    public function callbackVa(Request $request){
        $external_id=$request->external_id;
        $status=$request->status;
        $payment=Payment::where('external_id',$external_id)->exists();
        if($payment){
            if($status =="ACTIVE"){
               $update= Payment::where('external_id',$external_id)->update([
                'status' =>1
                ]);
                if($update > 0){
                    return 'ok';
                }
                return 'false';
            }
        }else{
            return response()->json([
                'massage'=>'data tidak ada'
            ]);
        }
    }
}
