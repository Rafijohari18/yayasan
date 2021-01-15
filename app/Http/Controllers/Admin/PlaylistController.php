<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Playlist;
use App\Models\Video;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use File;
use Auth;

class PlaylistController extends Controller{

    public function index(Request $request)
    {
        $data['title'] = 'Playlist';
        $data['album'] =  Playlist::all();    
        return view('backend.gallery.playlist.index', compact('data'));
    }

    public function create()
    {
        
        $data['title'] = 'Create';
        $data['type'] = 'create';
        
        return view('backend.gallery.playlist.form', compact('data'));
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

        Playlist::create([
            'name'        => $request->name_def,
            'description' => ($request->description_def == '') ? null : $request->description_def,
            'banner'      => $fileMove,
            'created_by'  => auth()->user()['id'],
        ]);

        
        return redirect()->route('gallery.playlist.index');
    }

    public function edit($id)
    {
        $data['title'] = 'Edit';
        $data['type'] = strtolower($data['title']);
        $data['album'] = Playlist::find($id);
        
        return view('backend.gallery.playlist.form', compact('data'));
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
        
        $category = Playlist::find($id);
        $category->update([
            'name'        => $request->name_def,
            'description' => ($request->description_def == '') ? null : $request->description_def,
            'banner'      => $fileMove,
            'updated_by'  => auth()->user()['id'],
        ]);
        return redirect()->route('gallery.playlist.index');


    }


    public function destroy($id)
    {
        $data['playlist']  =  Playlist::where('id',$id)->first();

        Playlist::where('id',$id)->delete();
        File::delete($data['playlist']->banner);
        return redirect()->back();

    }

    public function video($playlistId)
    {
        $data['title'] = 'Video';
        $data['playlist'] = Playlist::find($playlistId);
        $data['video'] = Video::where('playlist_id', $playlistId)->paginate(9);

        return view('backend.gallery.playlist.video', compact('data'));
    }

    public function storeVideo(Request $request, $playlistId)
    {
        if ($request->hasFile('file')) {
            $fileName = 'video-'.$playlistId.'-'.Carbon::parse(now())->format('YmdHis').'.'.$request->file('file')->guessExtension();
            $request->file('file')->move(public_path('userfile/playlist/'.$playlistId), $fileName);
        }

        Video::create([
            'playlist_id' => $playlistId,
            'file' => ($request->file == '') ? null : $fileName,
            'youtube_id' => ($request->youtube_id == '') ? null : $request->youtube_id,
            'title' => ($request->title == '') ? null : $request->title,
            'description' => ($request->description == '') ? null : $request->description,
        ]);

        return back()->with('success', 'Add video successfully');
        
    }

    public function updateVideo (Request $request, $id)
    {
        $video = Video::find($id);
        
        $video->update([
            'title' => ($request->title == '') ? null : $request->title,
            'description' => ($request->description == '') ? null : $request->description,
        ]);

        return back()->with('success', 'Add video successfully');

    }

    public function destroyVideo($id)
    {
        $video = Video::find($id);

        $loc = public_path('userfile/playlist/'.$video['playlist_id'].'/'.$video['file']);
        File::delete($loc);

        $video->delete();

        return back()->with('success', 'Add video successfully');

       
    }

}
