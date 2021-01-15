<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Page extends Model
{
    protected $table = 'c_pages';
    protected $primaryKey = 'id';
    protected $fillable = ['parent', 'slug', 'position', 'created_by', 'updated_by'];


    public function childs()
    {
        $request = request();
        $query = $this->hasMany('App\Models\Page', 'parent', 'id');
        if (request()->get('q') != '') {
            $query->when($request->q, function ($query) use ($request) {
                return $query->whereHas('pageLang', function ($query) use ($request) {
                    $query->where('title', 'like', "%{$request->q}%");
                });
            });
        }

        if (request()->get('s') != '') {
            $query->where('publish', request()->get('s'));
        }

        return $query->orderBy('position', 'ASC');
    }

    public function getFieldLang($lang = null)
    {
        
        return $this->hasMany('App\Models\PageLang', 'page_id')->first();
    }

    public function url($id, $slug)
    {
        $param = ['id' => $id, 'slug' => $slug];
        if (config('app.multiple_lang') == true) {
            $param = ['locale' => App::getLocale(), 'id' => $id, 'slug' => $slug];
        }

        return route('content.page', $param);
    }

    public function pageLang()
    {
        return $this->hasMany('App\Models\PageLang', 'page_id');
    }

    public function pagesLang()
    {
        return $this->hasOne('App\Models\PageLang', 'page_id');
    }

    public function userCreated()
    {
        return $this->belongsTo('App\Models\User', 'created_by');
    }

    public function userUpdated()
    {
        return $this->belongsTo('App\Models\User', 'updated_by');
    }

    public function parentNo($parent)
    {
        return Page::where('parent',$parent)->get();
    }
}
