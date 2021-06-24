<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment_chapter extends Model
{
    protected $table     = 'comment_chapter';

    public function chapters()
    {
        return $this->belongsTo('App\Chapter');
    }

    public function replay_comment_chapter()
    {
        return $this->hasMany('App\Replay_comment_chapter');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
