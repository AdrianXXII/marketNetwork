<?php

namespace App\Http\Controllers;

use App\Abo;
use App\Http\Requests\StoreMemberPost;
use App\Location;
use App\Member;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class MembersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $members = array();
        $search = Input::get('search', null);
        $vendor = Input::get('vendor', null);
        $trial = Input::get('trial', null);
        if($search || $vendor || $trial){
            $query = Member::where(function($q) use($search){
                return $q->where('name', 'like', $search . "%")
                    ->orwhere('firstname', 'like', $search . "%")
                    ->orwhere('email', 'like', $search . "%")
                    ->orwhere('street', 'like', $search . "%");
            });
            if($vendor){
                $query->where('vendor','=',1);
            }
            if($trial){
                $query->where('trialperiode','=',1);
            }
            $members = $query->orderBy('name')->orderBy('firstname')->get();
        } else {
            $members = Member::orderBy('name')->orderBy('firstname')->get();
        }
        return view('members.index', compact('members','search','vendor','trial'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $member = new Member();
        $abos = Abo::orderBy('name')->get();
        return view('members.create', compact('member', 'abos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMemberPost $request)
    {
        $member = new \App\Member();
        $member->name           = $request->get('name');
        $member->firstname      = $request->get('firstname');
        $member->email          = $request->get('email');
        $member->street         = $request->get('street');
        $member->zip            = $request->get('zip');
        $member->city           = $request->get('city');
        $member->tel            = $request->get('tel');
        $member->abo_id         = $request->get('abo');

        $member->vendor         = $request->get('vendor') == null ? 0 : $request->get('vendor');
        if( $member->vendor ){
            $member->trialperiode   = true;
        }
        $member->save();
        return redirect(route('member.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $member = Member::find($id);
        $abos = Abo::orderBy('name')->get();
        $locations = Location::orderBy('name')->get();
        return view('members.edit', compact('member', 'abos', 'locations'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreMemberPost $request, $id)
    {
        //
        $member = Member::find($id);
        $member->name           = $request->get('name');
        $member->firstname      = $request->get('firstname');
        $member->email          = $request->get('email');
        $member->street         = $request->get('street');
        $member->zip            = $request->get('zip');
        $member->city           = $request->get('city');
        $member->tel            = $request->get('tel');
        $abo_restart            = $request->get('abo_restart') == null ? 0 : $request->get('abo_restart');

        $member->vendor         = $request->get('vendor') == null ? 0 : $request->get('vendor');
        $member->trialperiode   = $request->get('trialperiode') == null || $member->vendor == 0 ? 0 : $request->get('trialperiode');
        if( $member->vendor && $member->abo_id != $request->get('abo') ){
            $member->abo_id  = $request->get('abo');
            $member->abo_start = new Carbon();
        }
        if($abo_restart && $member->vendor && $member->abo_id != null ){
            $member->abo_start = new Carbon();
        }
        $member->save();

        $i = $member->abo->limit;

        foreach($member->locations as $location){
            if($i <= 0){
                foreach($member->markets as $market){
                    if($member->location_id = $location->id){
                        $member->markets()->detach($market->id);
                    }
                }
                $member->locations()->detach($location->id);
            }
            $i--;
        }

        if($request->get("save") == 'ok') {
            return redirect(route('member.index'));
        } else {
            return redirect(route('member.edit', ['id' => $id]));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $member = Member::find($id);
        foreach($member->markets as $market){
            $member->markets()->detach($market->id);
        }
        foreach($member->locations as $location){
            $member->locations()->detach($location->id);
        }
        $member->delete();
        return redirect(route('member.index'));

    }
}
