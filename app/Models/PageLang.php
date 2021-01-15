<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class PageLang extends Model
{
    protected $table = 'c_pages_lang';
    protected $primaryKey = 'id';
    protected $fillable = ['page_id', 'title','content'];

    public $timestamps = false;

    public function page()
    {
        return $this->belongsTo('App\Models\Page');
    }
    public function pages()
    {
        return $this->belongsTo('App\Models\Page');
    }
}
