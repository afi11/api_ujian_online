<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryQuestion extends Model
{
    use HasFactory;
    protected $fillable = ['question_id','user_id','no_question','answered','is_corret','is_doubht'];
}
