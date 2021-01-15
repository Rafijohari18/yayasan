<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryContent extends Model
{
    protected $table = 'category_content';
    protected $guarded = [];
    
    public function Content(){
        return $this->hasMany('App\Models\Content');
      }
}
