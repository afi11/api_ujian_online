<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HistoryQuestion;
use Carbon\Carbon;

class ExamController extends Controller
{

    public function countQuestion(Request $request)
    {
        $userid = $request->userid;
        $count_question = HistoryQuestion::whereDate('created_at', Carbon::now()->format('Y-m-d'))
            ->where('user_id', $userid)
            ->count();
        return response()->json(["data" => $count_question, "code" => 200]);
    }

    public function addDoubht(Request $request)
    {
        $exam = HistoryQuestion::find($request->id);
        $exam->is_doubht = $request->is_doubht;
        $exam->save();
        return response()->json(["message" => "successfull to add doubht answer", "code" => 200]);
    }
    
    public function answer(Request $request)
    {
        $is_correct = AnsweredCheck($request->answered, $request->question_id);
        $exam = HistoryQuestion::find($request->id);
        $exam->answered = $request->answered;
        $exam->is_corret = $is_correct;
        $exam->save();
        return response()->json(["message" => $is_correct, "code" => 200]);
    }

    public function checkAnswer(Request $request)
    {
        $idhistory = $request->idhistory;
        $question = HistoryQuestion::where('id', $idhistory)
            ->first();
        return response()->json(["data" => $question->answered, "code" => 200]);
    }

    public function finishExam(Request $request)
    {
        
    }

}
