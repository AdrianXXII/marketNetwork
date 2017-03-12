<?php

namespace App\Http\Controllers;

use App\Helpers\AjaxReply;
use App\Location;
use App\LocationMember;
use App\Member;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LocationMemberController extends Controller
{
    Const CODE_ERROR = -1;
    Const CODE_OKAY = 1;
    Const CODE_NO_ROOM = 2;
    Const CODE_IN_USE = 3;
    Const CODE_NO_ABO = 4;
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $memberId)
    {
        $oldLocationId = $request->get('old_location_id');
        $locationId = $request->get('location_id');
        $location = Location::find($locationId);
        $vendor = Member::find($memberId);
        $message = new AjaxReply();
        $validAbo = false;
        $inUse = false;

        foreach($location->markets as $market){
            if($market->hasVendor($memberId)) {
                $inUse = true;
            }
        }

        if($vendor->abo != null){
            $date = (new Carbon($vendor->abo_start))->addMonth($vendor->abo->duration);
            if($date->diffInDays(new Carbon()) < 0 ) {
                $validAbo = true;
            }
        }

        if($validAbo) {
            $message->code = self::CODE_NO_ABO;
            $message->message = "Das Abo ist nicht mehr gültig.";

        } else if($inUse) {
            $message->code = self::CODE_IN_USE;
            $message->message = "Der Verkäufer ist in einem Mackt eingetragen";

        } else if($location->limit <= count($location->members) ){
            $message->code = self::CODE_NO_ROOM;
            $message->message = "Der Standort hat keinen Platz mehr";

        } else {
            $message->code = self::CODE_OKAY;
            $message->message = "Standort erfolgreich erfasst";
            $location->members()->attach($locationId);
        }

        return response()->json($message);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $memberId)
    {
        $oldLocationId = $request->get('old_location_id');
        $locationId = $request->get('location_id');
        $location = Location::find($locationId);
        $vendor = Member::find($memberId);
        $message = new AjaxReply();
        $validAbo = false;
        $inUse = false;

        foreach($location->markets as $market){
            if($market->hasVendor($memberId)) {
                $inUse = true;
            }
        }

        if($vendor->abo != null){
            $date = (new Carbon($vendor->abo_start))->addMonth($vendor->abo->duration);
            if($date->diffInDays(new Carbon()) < 0 ) {
                $validAbo = true;
            }
        }

        if($validAbo) {
            $message->code = self::CODE_NO_ABO;
            $message->message = "Das Abo ist nicht mehr gültig.";

        } else if($inUse){
            $message->code = self::CODE_NO_ROOM;
            $message->message = "Der Verkäufer ist in einem Mackt eingetragen";

        } else {
            $message->code = self::CODE_OKAY;
            $message->message = "Standort erfolgreich erfasst";
            $vendor->locations()->detach($oldLocationId);
            $vendor->locations()->attach($locationId);
        }

        return response()->json($message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $memberId)
    {
        $oldLocationId = $request->get('old_location_id');
        $location = Location::find($oldLocationId);
        $vendor = Member::find($memberId);
        $message = new AjaxReply();
        $validAbo = false;
        $inUse = false;

        foreach($location->markets as $market){
            if($market->hasVendor($memberId)) {
                $inUse = true;
            }
        }

        if($vendor->abo != null){
            $date = (new Carbon($vendor->abo_start))->addMonth($vendor->abo->duration);
            if($date->diffInDays(new Carbon()) < 0 ) {
                $validAbo = true;
            }
        }

        if($inUse){
            $message->code = self::CODE_IN_USE;
            $message->message = "Der Verkäufer ist in einem Mackt eingetragen";

        } else {
            $message->code = self::CODE_OKAY;
            $message->message = "Standort erfolgreich entfernt";
            $vendor->locations()->detach($oldLocationId);
        }

        return response()->json($message);
    }
}
