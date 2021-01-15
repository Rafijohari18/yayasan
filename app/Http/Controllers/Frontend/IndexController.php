<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Response;
use Http;
use App\Models\CategoryContent;
use App\Models\PageLang;
use App\Models\Product;
use App\Models\Page;
use App\Models\Content;
use App\Models\Config;
use Auth;
use Session;
use DB;

class IndexController extends Controller
{

    public function index()
    {
        
        $data['judul_informasi'] = CategoryContent::find(5);
        $data['list_informasi']  = Content::where('category_content_id',5)->take(4)->get();
        return view('frontend.index',compact('data'));
    }

}