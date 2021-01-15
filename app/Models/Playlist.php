<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Playlist extends Model
{
    protected $table = 'g_playlist';
    protected $primaryKey = 'id';
    protected $fillable = ['name',  'description', 'banner', 'created_by', 'updated_by'];
  

    public function getFieldLang($field, $lang = null)
    {
        if ($lang == null) {
            $lang = config('app.fallback_locale');
        }
        return $this->hasMany('App\Playlist', 'id')->first()[$field][$lang];
    }

    public function url($id)
    {
        $param = ['playlistId' => $id];
        if (config('app.multiple_lang') == true) {
            $param = ['locale' => App::getLocale(), 'playlistId' => $id];
        }

        return route('playlist.video', $param);
    }

    public function video()
    {
        return $this->hasMany('App\Video', 'playlist_id');
    }

    public function userCreated()
    {
        return $this->belongsTo('App\User', 'created_by');
    }

    public function userUpdated()
    {
        return $this->belongsTo('App\User', 'updated_by');
    }
}
