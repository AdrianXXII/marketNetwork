<?php

namespace App\Http\Controllers;

use App\Deployment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class DeploymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $deployments = array();
        $search = Input::get('search', null);
        if($search){
            $deployments = Deployment::where('title', 'like', $search . "%")
                ->orderBy('deployment_date')->orderBy('title')->get();
        } else {
            $deployments = Deployment::orderBy('deployment_date')->orderBy('title')->get();
        }
        return view('deployments.index', compact('deployments','search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('deployments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $deployment = new Deployment();
        $deployment->title            = $request->get('title');
        $deployment->description      = $request->get('description');
        $deployment->deployment_date  = $request->get('deployment_date');
        $deployment->duration         = $request->get('duration');
        $deployment->cost             = $request->get('cost');
        $deployment->save();


        return redirect(route('deployment.index'));
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
        $deployment = Deployment::find($id);
        return view('deployments.edit', compact('deployment'));
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
        $deployment = Deployment::find($id);
        $deployment->title            = $request->get('title');
        $deployment->description      = $request->get('description');
        $deployment->deployment_date  = $request->get('deployment_date');
        $deployment->duration         = $request->get('duration');
        $deployment->cost             = $request->get('cost');
        $deployment->save();

        return redirect(route('deployment.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deployment = Deployment::find($id);
        $deployment->delete();
        return redirect(route('deployment.index'));
    }
}
