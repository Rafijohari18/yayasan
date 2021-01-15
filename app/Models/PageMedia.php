<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PageMedia extends Model
{
    protected $table = 'c_pages_media';
    protected $primaryKey = 'id';
    protected $fillable = ['page_id', 'position','file','title'];

    public $incrementing = false;
    public $timestamps = false;

    public function getExtension($path)
    {
        return pathinfo(public_path($path))['extension'];
    }

    public function limitText($text, $limit)
    {
        return Str::limit($text, $limit);
    }

    public function replaceExtension($replace, $path)
    {
        return Str::replaceFirst($replace, '', $path);
    }
}
