<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableReplayCommentChapterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('replay_comment_chapter', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('comment_chapter_id')->unsigned()->index();
            $table->foreign('comment_chapter_id')->references('id')->on('comment_chapter')->onDelete('cascade');
            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->text('content');
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
        Schema::drop('replay_comment_chapter');
    }
}
