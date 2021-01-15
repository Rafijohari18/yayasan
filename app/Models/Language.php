<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class Language extends Model
{
    protected $table = 'co_language';
    protected $primaryKey = 'id';
    protected $fillable = ['lang', 'name', 'icon', 'status'];
    
    public function setUpperField($value)
    {
        return strtoupper($value);
    }

    public function urlSwitcher($segment, $lang)
    {
        return Str::replaceFirst($segment, $lang, str_replace(url('/'), '', URL::full()));
    }
}
