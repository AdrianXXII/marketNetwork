<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMarketPost;
use App\Location;
use App\Market;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MarketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($locationId)
    {
        return view('market.create', compact('locationId'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMarketPost $request, $locationId)
    {
        $market = new Market();
        $market->location_id = $locationId;
        $market->name = $request->get('name');
        $market->start_date = Carbon::createFromFormat('d.m.Y', $request->get('start_date'));
        $market->end_date = Carbon::createFromFormat('d.m.Y', $request->get('end_date'));
        $market->save();

        return redirect(route('location.edit', ['id' => $locationId]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($locationId, $id)
    {
        $market = Market::find($id);
        $members = Location::find($locationId)->members;
        return view('market.edit', compact('market', 'locationId', 'members'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreMarketPost $request, $locationId, $id)
    {
        $market = Market::find($id);
        $market->name = $request->get('name');
        $market->start_date = Carbon::createFromFormat('d.m.Y',$request->get('start_date'));
        $market->end_date = Carbon::createFromFormat('d.m.Y', $request->get('end_date'));
        $market->save();

        return redirect(route('location.edit', ['id' => $locationId]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($locationId, $id)
    {
        $market = Market::find($id);
        $market->delete();
        return redirect(route('location.edit', ['id' => $locationId]));
    }
}
