<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $table = 'g_photo';
    protected $primaryKey = 'id';
    protected $fillable = ['album_id', 'file', 'title', 'description', 'alt'];

    public function album()
    {
        return $this->belongsTo('App\Models\Album');
    }
}
