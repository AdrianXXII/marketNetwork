<?php

namespace App\Http\Controllers;

use App\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $locations = array();
        $search = Input::get('search', null);
        if($search){
            $locations = Location::where('name', 'like', $search . "%")
                ->orwhere('street', 'like', $search . "%")
                ->orderBy('name')->orderBy('street')->get();
        } else {
            $locations = Location::orderBy('name')->orderBy('street')->get();
        }
        return view('locations.index', compact('locations','search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('locations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $location = new Location();
        $location->name           = $request->get('name');
        $location->street         = $request->get('street');
        $location->zip            = $request->get('zip');
        $location->city           = $request->get('city');
        $location->member_max     = $request->get('member_max');
        $location->save();
        return redirect(route('location.index'));
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
        $location  = Location::find($id);
        return view('locations.edit', compact('location'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $location = Location::find($id);
        $location->name           = $request->get('name');
        $location->street         = $request->get('street');
        $location->zip            = $request->get('zip');
        $location->city           = $request->get('city');
        $location->member_max     = $request->get('member_max');
        $location->save();
        return redirect(route('location.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $location = Location::find($id);
        $location->delete();
        return redirect(route('location.index'));
    }
}
