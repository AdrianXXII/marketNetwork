<?php

namespace App\Http\Controllers;

use App\Market;
use App\Helpers\AjaxReply;
use App\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MarketMemberController extends Controller
{
    Const CODE_ERROR = -1;
    Const CODE_OKAY = 1;
    Const CODE_DUPLICATE = 2;
    //
    public function update(Request $request, $marketId, $vendorId){
        $message = new AjaxReply();

        $market = Market::find($marketId);

        if($market->hasVendor($vendorId)){
            $message->code = self::CODE_DUPLICATE;
            $message->message = "Member schon erfasst";
            $message->msgType = "Warning";
            $message->data = Member::find($vendorId);
        } else {
            $market->members()->attach($vendorId);
            $message->code = self::CODE_OKAY;
            $message->message = "Member erfolgreich erfasst";
            $message->data = Member::find($vendorId);
        }
        return response()->json($message);
    }


    public function destroy(Request $request, $marketId, $vendorId){
        $message = new AjaxReply();


        $market = Market::find($marketId);
        $market->members()->detach($vendorId);

        $message->code = self::CODE_OKAY;
        $message->message = "Member erfolgreich entfernt";
        $message->data = $market;

        return response()->json($message);
    }
}
