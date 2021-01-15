<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $table = 'content';
    protected $guarded = [];

    public function CategoryContent()
    {
    	return $this->belongsTo(CategoryContent::class);
    }

    public function User()
    {
    	return $this->belongsTo(User::class,'created_by');
    }
    
}
