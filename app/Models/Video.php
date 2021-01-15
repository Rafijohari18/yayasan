<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $table = 'g_video';
    protected $primaryKey = 'id';
    protected $fillable = ['playlist_id', 'file', 'youtube_id', 'title', 'description', 'position'];

    public function album()
    {
        return $this->belongsTo('App\Playlist');
    }
}
