<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;
use Carbon\Carbon;

class StudentController extends Controller
{
 
    public function index()
    {
        $schedule = Schedule::where('day', Carbon::now()->format('Y-m-d'))->get();
        return response()->json(["data" => $schedule, "code" => 200]);
    }

}
