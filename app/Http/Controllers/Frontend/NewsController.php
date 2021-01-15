<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Response;
use Http;
use App\Models\CategoryContent;
use App\Models\PageLang;
use App\Models\PageMedia;
use App\Models\CategoryProduct;
use App\Models\Product;
use App\Models\Page;
use App\Models\Album;
use App\Models\Photo;
use App\Models\Content;
use App\Models\ProfilAlumni;
use App\Models\Config;
use App\Models\Slider;
use App\Models\Dosen;
use Auth;
use Session;
use DB;

class NewsController extends Controller
{

    public function index()
    {
        
        $data['news'] = Content::where('category_content_id',7)->get();
        
        $data['content_news']   = Content::where('category_content_id',7)
        ->get()->take(3);

        return view('frontend.berita',compact('data'));
    }

    public function detail(Request $request, $slug)
    {
        $data['content']        = Content::where('slug',$slug)->first();
        $data['content_news']   = Content::where('category_content_id',$data['content']->category_content_id)
                                    ->get()->take(3);
                            
        $data['category']       = CategoryContent::where('id',$data['content']->category_content_id)->first();
         
        return view('frontend.detail_berita',compact('data'));
    }

  

}