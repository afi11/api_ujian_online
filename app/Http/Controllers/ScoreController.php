<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Score;

class ScoreController extends Controller
{

    public function index()
    {
        $score = Score::join('users','users.id','=','scores.user_id')
            ->orderBy('scores.exam_date', 'asc')
            ->get();
        return response()->json(["code" => 200, "data" => $score]);
    }


}
