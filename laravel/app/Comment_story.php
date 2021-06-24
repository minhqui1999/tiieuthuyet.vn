<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment_story extends Model
{
    protected $table     = 'comment_story';

    public function story()
    {
        return $this->belongsTo('App\Story');
    }

    public function replay_comment()
    {
        return $this->hasMany('App\Replay_comment');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
