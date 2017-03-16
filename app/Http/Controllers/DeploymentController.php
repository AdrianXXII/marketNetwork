<?php

namespace App\Http\Controllers;

use App\Deployment;
use App\Http\Requests\StoreDeploymentPost;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class DeploymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $deployments = array();
        $search = $request->get('search', null);
        $date = $request->get('date', null);
        if($search || $date){
            $query = Deployment::where('title', 'like', $search . "%");
            if($date){
                $date = new Carbon($date);
                $query->where(function($q) use ($date){
                    $q->where(DB::raw('date(deployment_date)'), $date->toDateString());
                });
            }
            $deployments  =  $query->orderBy('deployment_date')->orderBy('title')->get();
        } else {
            $deployments = Deployment::orderBy('deployment_date')->orderBy('title')->get();
        }
        return view('deployments.index', compact('deployments','search','date'));
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
    public function store(StoreDeploymentPost $request)
    {
        $deployment = new Deployment();
        $deployment->title            = $request->get('title');
        $deployment->employee         = $request->get('employee');
        $deployment->description      = $request->get('description');
        $deployment->deployment_date  = Carbon::createFromFormat('d.m.Y H:i', $request->get('deployment_date') . " " . $request->get('deployment_start'));
        $deployment->deployment_end  =  Carbon::createFromFormat('d.m.Y H:i', $request->get('deployment_date') . " " . $request->get('deployment_end'));
        $deployment->duration         = $deployment->deployment_date->diffInMinutes($deployment->deployment_end) / 60;
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
    public function update(StoreDeploymentPost $request, $id)
    {
        $deployment = Deployment::find($id);
        $deployment->title            = $request->get('title');
        $deployment->description      = $request->get('description');
        $deployment->employee         = $request->get('employee');
        $deployment->deployment_date  = Carbon::createFromFormat('d.m.Y H:i', $request->get('deployment_date') . " " . $request->get('deployment_start'));
        $deployment->deployment_end   = Carbon::createFromFormat('d.m.Y H:i', $request->get('deployment_date') . " " . $request->get('deployment_end'));
        $deployment->duration         = $deployment->deployment_date->diffInMinutes($deployment->deployment_end) / 60;
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
