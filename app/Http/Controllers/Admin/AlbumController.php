<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Album;
use App\Models\Photo;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use File;
use Auth;
use Carbon\Carbon;


class AlbumController extends Controller{

    public function index(Request $request)
    {
        $data['title'] = 'Album';
        $data['album'] =  Album::all();    
        return view('backend.gallery.album.index', compact('data'));
    }

    public function create()
    {
        
        $data['title'] = 'Tambah';
        $data['type'] = 'create';
        
        return view('backend.gallery.album.form', compact('data'));
    }

    public function store(Request $request)
    {

        if ($request->banner_img != NULL) {
            $file = $request->banner_img;
            $name = 'file/'.Str::slug($request->input('banner_img')).''.time().'-'.$file->getClientOriginalName();
            $file->move(public_path().'/file/', $name);  
            $fileMove = $name;  
        } else {
            $fileMove = NULL;
        }

        Album::create([
            'name'        => $request->name_def,
            'description' => ($request->description_def == '') ? null : $request->description_def,
            'banner'      => $fileMove,
            'created_by'  => auth()->user()['id'],
        ]);

        
        return redirect()->route('gallery.album.index');
    }

    public function edit($id)
    {
        $data['title'] = 'Edit';
        $data['type'] = strtolower($data['title']);
        $data['album'] = Album::find($id);
        
        return view('backend.gallery.album.form', compact('data'));
    }

    public function update(Request $request,$id)
    {
        
        if ($request->banner_img != NULL) {
            $file = $request->banner_img;
            $name = 'file/'.Str::slug($request->input('banner_img')).''.time().'-'.$file->getClientOriginalName();
            $file->move(public_path().'/file/', $name);  
            $fileMove = $name;  
        } else {
            $fileMove = $request->cover_lama;
        }
        
        $category = Album::find($id);
        $category->update([
            'name'        => $request->name_def,
            'description' => ($request->description_def == '') ? null : $request->description_def,
            'banner'      => $fileMove,
            'updated_by'  => auth()->user()['id'],
        ]);
        return redirect()->route('gallery.album.index');


    }


    public function destroy($id)
    {
        $data['album']  =  Album::where('id',$id)->first();

        Album::where('id',$id)->delete();
        File::delete($data['album']->banner);
        return redirect()->back();

    }


    public function photo($albumId)
    {
        $data['title'] = 'Photo';
        $data['album'] =  Album::findOrFail($albumId);
        $data['photo'] =  Photo::where('album_id', $albumId)->paginate(9);

        return view('backend.gallery.album.photo', compact('data'));
    }

    public function multiUpload(Request $request, $albumId)
    {
        
        $fileName = 'photo-'.$albumId.'-'.Str::random(10).'-'.Carbon::parse(now())->format('Ymd').'.'.$request->file('file')->guessExtension();
        $request->file('file')->move(public_path('userfile/album/'.$albumId), $fileName);

        Photo::create([
            'album_id' => $albumId,
            'file' => $fileName,
        ]);
    }

    public function updatePhoto(Request $request, $id)
    {
        $photo = Photo::find($id);
        $photo->update([
            'title' => ($request->title == '') ? null : $request->title,
            'description' => ($request->description == '') ? null : $request->description,
            'alt' => ($request->alt == '') ? null : $request->alt,
        ]);
        return back()->with('success', 'Edit photo successfully');

    }

    public function destroyPhoto($id)
    {
        $photo = Photo::find($id);

        $loc = public_path('userfile/album/'.$photo['album_id'].'/'.$photo['file']);
        File::delete($loc);
        
        $photo->delete();


        return back()->with('success', 'Edit photo successfully');

    }


}
