<?php

namespace App\Http\Controllers;

use App\Helpers\AjaxReply;
use App\LocationMember;
use App\Member;
use Illuminate\Http\Request;

class LocationMemberController extends Controller
{
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
        $message = new AjaxReply();

        $message->code = 1;
        $message->message = "Standort erfolgreich erfasst";

        $member = Member::find($memberId);
        $member->locations()->attach($locationId);

        return $message;
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
        $message = new AjaxReply();

        $message->code = 1;
        $message->message = "Standort erfolgreich erfasst";

        $member = Member::find($memberId);
        $member->locations()->detach($oldLocationId);
        $member->locations()->attach($locationId);


        return $message;
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
        $message = new AjaxReply();

        $message->code = 1;
        $message->message = "Standort erfolgreich entfernt";

        $member = Member::find($memberId);
        $member->locations()->detach($oldLocationId);

        return $message;
    }
}
