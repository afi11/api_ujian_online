<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Score;
use App\Models\Question;
use App\Models\User;
use DB;

class DashboardController extends Controller
{
    public function index()
    {
        $low = Score::select(DB::raw('MIN(score) as score_low'))->first();
        $high = Score::select(DB::raw('MAX(score) as score_high'))->first();
        $user = User::where('account_type','student')->count();
        $question = Question::count();
        $count = array("score_low" => $low->score_low, 
            "score_high" => $high->score_high, 
            "count_user" => $user, 
            "count_question" => $question);
        $topHigh = Score::join('users','users.id','=','scores.user_id')
            ->orderBy('scores.score','desc')
            ->select("users.name","users.email","users.photo","scores.score")
            ->limit(5)
            ->get();
        $topLow = Score::join('users','users.id','=','scores.user_id')
            ->orderBy('scores.score','asc')
            ->select("users.name","users.email","users.photo","scores.score")
            ->limit(5)
            ->get();
        return response()->json([
            "code" => 200,
            "count" => $count,
            "tophigh" => $topHigh,
            "toplow" => $topLow
        ]);
    }
}
