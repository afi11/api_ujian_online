<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinishExam extends Model
{
    use HasFactory;
    protected $table = "finish_exams";
    protected $fillable = ["question","option_1","option_2","option_3","option_4","answer",
        "key","exam_date","user_id","skor"];
}
