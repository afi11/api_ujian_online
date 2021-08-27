<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinishExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('finish_exams', function (Blueprint $table) {
            $table->id();
            $table->mediumText("question");
            $table->mediumText("option_1");
            $table->mediumText("option_2");
            $table->mediumText("option_3");
            $table->mediumText("option_4");
            $table->enum("answer",["a","b","c","d"]);
            $table->enum("key",["a","b","c","d"]);
            $table->date("exam_date");
            $table->bigInteger('user_id')->unsigned();
            $table->timestamps();

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
        Schema::dropIfExists('finish_exams');
    }
}
