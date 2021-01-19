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

class InformasiController extends Controller
{

    public function index($slug)
    {
        $data['category'] = CategoryContent::where('slug',$slug)->first();
        $data['content'] = Content::where('category_content_id',$data['category']->id)->get();
         
        return view('frontend.informasi',compact('data'));
    }

    public function preview(Request $request, $slug)
    {
        $data['content']        = Content::where('slug',$slug)->first();
        $data['content_news']   = Content::where('category_content_id',$data['content']->category_content_id)
                                    ->get()->take(5);
                            
        $data['category']       = CategoryContent::where('id',$data['content']->category_content_id)->first();
         
        return view('frontend.preview_informasi',compact('data'));
    }

    public function kontak()
    {
        $data['kontak'] = Config::where('id',10)->first();
        return view('frontend.kontak',compact('data'));
        

    }

    public function prevslider(Request $request, $id)
    {
        $data['slider'] = Slider::where('id',$id)->first();
        $data['content_news']   = Content::where('category_content_id',1)
        ->get()->take(5);

        return view('frontend.preview_slider',compact('data'));
    }

    public function tentang()
    {
        $data['visi']           = PageLang::where('id',4)->first();
        $data['misi']           = PageLang::where('id',5)->first();

        $data['sambutan']       = PageLang::where('id',1)->first();

        $data['foto_ketua']     = PageMedia::where('page_id',1)->get();
        

        return view('frontend.tentang',compact('data'));
    }

    public function pengurus()
    {
        $data['title']  = 'Profil Pengurus Yayasan';
        return view('frontend.pengurus',compact('data'));
        
    }

    public function programKerja()
    {
        $data['title']  = 'Program Kerja';
        $data['program'] = PageLang::where('id',7)->first();
        return view('frontend.programKerja',compact('data'));
        
    }
    
    public function panduanPPDB(){
        $data['title']  = 'Panduan Daftar Ulang';
        $data['program'] = PageLang::where('id',9)->first();
        return view('frontend.programKerja',compact('data'));
    }
    
    public function pengumumanPPDB(){
        $data['title']  = 'Pengumuman Hasil PPDB';
        $data['program'] = PageLang::where('id',10)->first();
        return view('frontend.programKerja',compact('data'));
    }
    
    
    public function profilAlumni()
    {
    
        $data['alumni']     = ProfilAlumni::orderBy('id','DESC')->get();
    
        return view('frontend.profil-alumni',compact('data'));
    }

    public function gallery()
    {
        $data['album']     = Album::whereNotIn('id',[3,4,5,6])->get();
        $data['photo']     = Photo::whereNotIn('album_id',[3,4,5,6])->with('album')->get();
     
    
        return view('frontend.gallery',compact('data'));
    }

}