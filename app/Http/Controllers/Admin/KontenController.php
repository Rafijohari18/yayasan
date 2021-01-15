<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CategoryContent;
use App\Models\Content;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use File;
use Auth;

class KontenController extends Controller{

    public function index(Request $request,$id)
    {
        $data['title'] = 'Content';
        $data['category'] =  Content::where('category_content_id',$id)->get();    
        return view('backend.content.preview', compact('data'));
    }

    public function create($category_content_id)
    {
        
        $data['title'] = 'Content';
        $data['type'] = 'create';
        
        return view('backend.content.formcontent', compact('data'));
    }

    public function store(Request $request)
    {
        
        if ($request->cover != NULL) {
                $file = $request->cover;
                $name = 'file/'.Str::slug($request->input('cover')).''.time().'-'.$file->getClientOriginalName();
                $file->move(public_path().'/file/', $name);  
                $fileMove = $name;  
        } else {
                $fileMove = NULL;
        }
        

        Content::create([
            'category_content_id'   => $request->category_content_id,
            'title'                 => $request->title,
            'cover'                 => $fileMove,
            'slug'                  => $request->slug,
            'content'               => $request->content,
            'created_by'            => Auth::user()['id']
        ]);

        return redirect()->route('content.index',['id'=> $request->category_content_id]);
    }

    public function edit($category_content_id,$id)
    {
        $data['title'] = 'Edit';
        $data['type'] = strtolower($data['title']);
        $data['content'] = Content::find($id);
        
       
        return view('backend.content.formcontent', compact('data'));
    }

    public function update(Request $request,$id)
    {
        
        if ($request->cover != NULL) {
            $file = $request->cover;
            $name = 'file/'.Str::slug($request->input('cover')).''.time().'-'.$file->getClientOriginalName();
            $file->move(public_path().'/file/', $name);  
            $fileMove = $name;  
        } else {
            $fileMove = $request->cover_lama;
        }
        
        $category = Content::find($id);
        $category->update([
            'title'                 => $request->title,
            'cover'                 => $fileMove,
            'slug'                  => $request->slug,
            'content'               => $request->content,
            'created_by'            => Auth::user()['id']
        ]);
        return redirect()->route('content.index',['id'=> $request->category_content_edit]);


    }


    public function destroy($id)
    {
        $data['content']  =  Content::where('id',$id)->first();

        Content::where('id',$id)->delete();
        File::delete($data['content']->cover);
        return redirect()->back();

    }


}
