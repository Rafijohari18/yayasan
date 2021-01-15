<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Response;
use Http;
use App\Models\Page;
use App\Models\PageLang;
use App\Models\PageMedia;
use App\Models\Content;
use Auth;
use Session;
use DB;

class ProfilController extends Controller
{

    public function index($slug)
    {
        $data['page']           = Page::where('slug',$slug)->first();
        
        $data['content']        = PageLang::where('page_id',$data['page']->id)->first();
        $data['page_media']     = PageMedia::where('page_id',$data['page']->parent)->first(); 
    
        return view('frontend.profil',compact('data'));
    }

    public function visimisi($slug)
    {
        $data['page']           = Page::where('slug',$slug)->first();
        
        $data['visi']           = PageLang::where('id',4)->first();
        $data['misi']           = PageLang::where('id',5)->first();


        $data['gambar_visi']    = PageMedia::where('page_id',$data['visi']->id)->first();
        $data['gambar_misi']    = PageMedia::where('page_id',$data['misi']->id)->first();

    
        return view('frontend.visimisi',compact('data'));

    }


}