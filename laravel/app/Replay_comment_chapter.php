<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Replay_comment_chapter extends Model
{
    protected $table     = 'replay_comment_chapter';

    public function comment_chapter()
    {
        return $this->belongsTo('App\Comment_chapter');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
