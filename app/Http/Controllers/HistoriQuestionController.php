<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HistoryQuestion;
use App\Models\Question;
use Carbon\Carbon;

class HistoriQuestionController extends Controller
{

    public function index(Request $request)
    {
        $userid = $request->userid;
        $page = $request->page;
        $question = HistoryQuestion::join('questions','questions.id','=','history_questions.question_id')
            ->whereDate('history_questions.created_at', Carbon::now()->format('Y-m-d'))
            ->where('history_questions.user_id', $userid)
            ->where('history_questions.no_question', $page)
            ->select('questions.*','questions.id as question_id', 'history_questions.is_doubht' ,'history_questions.id as id_history')
            ->first();
        return response()->json(["data" => $question, "code" => 200]);
    }

    public function showExamNavigation(Request $request)
    {
        $userid = $request->userid;
        $question = HistoryQuestion::join('questions','questions.id','=','history_questions.question_id')
            ->whereDate('history_questions.created_at', Carbon::now()->format('Y-m-d'))
            ->where('history_questions.user_id', $userid)
            ->select('history_questions.answered as answered',
                'history_questions.question_id as question_id',
                'history_questions.no_question',
                'history_questions.is_doubht',
                'history_questions.id as id_history')
            ->orderBy('history_questions.no_question', 'asc')
            ->get();
        return response()->json(["data" => $question, "code" => 200]);
    }
    
    public function store(Request $request)
    {
        $count = HistoryQuestion::where('user_id', $request->user_id)
            ->whereDate('created_at', Carbon::now()->format('Y-m-d'))->count();
        if($count == 0){
            $question = Question::inRandomOrder()->get();
            $no = 0;
            foreach($question as $row){
                $no++;
                HistoryQuestion::create([
                    'question_id' => $row->id,
                    'user_id' => $request->user_id,
                    'no_question' => $no,
                ]);
            }
        }
        return response()->json(["status" => true,"message" => "Successfull to start exam"]);
    }


}
