<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoryQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history_questions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('question_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('no_question');
            $table->enum('answered',['a','b','c','d'])->nullable();
            $table->enum('is_corret',['0','1']);
            $table->timestamps();

            $table->foreign("question_id")->references("id")->on("questions")->onDelete('NO ACTION');
            $table->foreign("user_id")->references("id")->on("users")->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('history_questions');
    }
}
