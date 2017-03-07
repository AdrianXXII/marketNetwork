<?php

namespace App\Http\Controllers;

use App\Visa;
use Illuminate\Http\Request;

class VisaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($memberId)
    {
        $visas = Visa::where('member_id', '=', $memberId)->orderby('id')->get();
        return $visas;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($memberId)
    {
        $visa = new Visa();
        $visa->member_id = $memberId;
        $visa->title = "";
        $visa->describe  = "";
        $visa->save();

        return $visa;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $memberId)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($memberId, $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($memberId, $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $memberId, $id)
    {
        //
        $visa = Visa::where('member_id', '=', $memberId)->where('id', '=', $id)->first();
        $visa->title = $request->get('title');
        $visa->approved = $request->get('approved');
        $visa->describe  = $request->get('describe');
        $visa->save();
        return $visa;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($memberId, $id)
    {
        //
        $visa = Visa::where('member_id', '=', $memberId)->where('id', '=', $id)->first();
        $visa->delete();
        return $visa;
    }
}
