<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Replay_comment extends Model
{
    protected $table     = 'replay_comment';

    public function comment_story()
    {
        return $this->belongsTo('App\Comment_story');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
