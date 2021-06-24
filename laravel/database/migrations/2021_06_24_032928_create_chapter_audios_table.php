<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChapterAudiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chapter_audios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('subname');
            $table->string('alias');
            $table->text('content');
            $table->bigInteger('view');
            $table->text('link');
            $table->bigInteger('story_audio_id')->unsigned()->index();
            $table->foreign('story_audio_id')->references('id')->on('audio_stories')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('chapter_audios');
    }
}
