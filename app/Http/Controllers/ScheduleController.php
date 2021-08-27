<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;
use Carbon\Carbon;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schedule = Schedule::all();
        return response()->json(["data" => $schedule]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cek = Schedule::whereDate('created_at', Carbon::now()->format('Y-m-d'))->count();
        if($cek > 0){
            $state = false;
            $message = "You have to choose another date";
        }else{
            $state = true;
            $message = "Successfull to input schedule data";
            $time_end = addTime($request->time_start, $request->duration);
            $schedule = Schedule::create($request->except([
                "time_end"
            ])+["time_end" => $time_end]);
        }
        return response()->json(["status" => true,"message" => $message]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $schedule = Schedule::find($id);
        return response()->json(["data" => $schedule]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
    public function update(Request $request, $id)
    {
        $schedule = Schedule::find($id);
        $schedule->day = $request->day;
        $schedule->time_start = $request->time_start;
        $schedule->duration = $request->duration;
        $schedule->desc = $request->desc;
        $schedule->time_end = addTime($request->time_start, $request->duration);
        $schedule->save();
        return response()->json(["status" => true,"message" => "Successfull to edit schedule data"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $schedule = Schedule::find($id);
        $schedule->delete();
        return response()->json(["status" => true,"message" => "Successfull to delete schedule data"]);
    }
}
