<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FinishExam;
use App\Models\HistoryQuestion;
use App\Models\Score;
use Carbon\Carbon;

class FinishExamController extends Controller
{

    public function checkExam($id)
    {
        $finish = FinishExam::where('user_id', $id)
            ->groupBy('exam_date')
            ->get();
        $already = FinishExam::where('exam_date', Carbon::now()->format('Y-m-d'))
            ->where('user_id', $id)
            ->count();
        $array = array();
        foreach($finish as $row){
            array_push($array,[
                "exam_date" => $row->exam_date,
                "score" => GetScore($row->user_id, $row->exam_date),
                "max_score" => maxScore($row->user_id, $row->exam_date),
                "user_id" => $id
            ]);
        }
        return response()->json([
            "data" => $array,
            "already" => $already,
            "code" => 200
        ]);
    }
    
    public function store(Request $request)
    {
        $score = 0;
        $data = HistoryQuestion::join("questions","questions.id","=","history_questions.question_id")
            ->where("history_questions.user_id", $request->user_id)
            ->whereDate("history_questions.created_at", Carbon::now()->format('Y-m-d'))
            ->get();
        foreach($data as $row){
            FinishExam::create([
                "question" => $row->question_name,
                "option_1" => $row->option_1,
                "option_2" => $row->option_2,
                "option_3" => $row->option_3,
                "option_4" => $row->option_4,
                "answer" => $row->answered,
                "user_id" => $request->user_id,
                "exam_date" => Carbon::now()->format('Y-m-d'),
                "key" => $row->answer_key,
                "skor" => $row->skor
            ]);
        }
        $hasil = FinishExam::where("user_id", $request->user_id)
            ->whereDate("created_at", Carbon::now()->format('Y-m-d'))
            ->get();
        foreach($hasil as $row){
            if($row->key == $row->answer){
                $score = $score + $row->skor;
            }
        }
        Score::create([
            "exam_date" => Carbon::now()->format('Y-m-d'),
            "user_id" => $request->user_id,
            "score" => $score
        ]);
        return response()->json(["message" => "Successfull to finish exam", "code" => 200]);
    }

}
