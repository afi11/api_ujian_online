<?php

use App\Models\Question;
use App\Models\FinishExam;
use Carbon\Carbon;

function AnsweredCheck($answer, $id)
{
    $cek = Question::find($id);
    if($cek->answer_key == $answer) return "1";
    else return "0";
}

function GetAnswer($id)
{
    $cek = Question::find($id);
    return $cek->answer_key;
}

function CountAllQuestion($id){
    $finish = FinishExam::where('user_id', $id)
        ->where('exam_date', Carbon::now()->format('Y-m-d'))
        ->count();
    return $finish;
}

function maxScore($id, $tgl) {
    $finish = FinishExam::where('user_id', $id)
        ->where('exam_date', $tgl)
        ->get();
    $correct = 0;
    foreach($finish as $row){
        $correct = $correct + $row->skor;
    }
    return $correct;
}

function GetScore($id, $tgl){
    $finish = FinishExam::where('user_id', $id)
        ->where('exam_date', $tgl)
        ->get();
    $correct = 0;
    foreach($finish as $row){
        if($row->answer == $row->key){
            $correct = $correct + $row->skor;
        }
    }
    return $correct;
}