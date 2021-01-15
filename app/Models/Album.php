<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Album extends Model
{
    protected $table = 'g_album';
    protected $primaryKey = 'id';
    protected $fillable = ['name',  'description', 'banner', 'created_by', 'updated_by'];

    public function getFieldLang($field, $lang = null)
    {
        if ($lang == null) {
            $lang = config('app.fallback_locale');
        }
        return $this->hasMany('App\Models\Album', 'id')->first()[$field][$lang];
    }

    public function url($id)
    {
        $param = ['albumId' => $id];
        if (config('app.multiple_lang') == true) {
            $param = ['locale' => App::getLocale(), 'albumId' => $id];
        }

        return route('album.photo', $param);
    }

    public function photo()
    {
        return $this->hasMany('App\Models\Photo', 'album_id');
    }

    public function userCreated()
    {
        return $this->belongsTo('App\Models\User', 'created_by');
    }

    public function userUpdated()
    {
        return $this->belongsTo('App\Models\User', 'updated_by');
    }
}
