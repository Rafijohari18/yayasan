<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use File;
use Auth;

class SliderController extends Controller{

    public function index(Request $request)
    {
        $data['title'] = 'Slider';
        $data['slider'] =  Slider::all();    
        return view('backend.slider.index', compact('data'));
    }

    public function create()
    {
        
        $data['title'] = 'Slider';
        $data['type'] = 'create';
        
        return view('backend.slider.form', compact('data'));
    }

    public function store(Request $request)
    {
        
        if ($request->image != NULL) {
                $file = $request->image;
                $name = 'file/'.Str::slug($request->input('image')).''.time().'-'.$file->getClientOriginalName();
                $file->move(public_path().'/file/', $name);  
                $fileMove = $name;  
        } else {
                $fileMove = NULL;
        }
        

        Slider::create([
            'title'                 => $request->title,
            'content'              => $request->content,
            'image'                 => $fileMove,
        ]);

        return redirect()->route('slider.index');
    }

    public function edit($id)
    {
        $data['title'] = 'Edit';
        $data['type'] = strtolower($data['title']);
        $data['slider'] = Slider::find($id);
        
       
        return view('backend.slider.form', compact('data'));
    }

    public function update(Request $request,$id)
    {
        
        if ($request->image != NULL) {
            $file = $request->image;
            $name = 'file/'.Str::slug($request->input('image')).''.time().'-'.$file->getClientOriginalName();
            $file->move(public_path().'/file/', $name);  
            $fileMove = $name;  
        } else {
            $fileMove = $request->image_lama;
        }
        
        $category = Slider::find($id);
        $category->update([
            'title'                 => $request->title,
            'image'                 => $fileMove,
            'content'              => $request->content,

        ]);
        return redirect()->route('slider.index');


    }


    public function destroy($id)
    {
        $data['slider']  =  Slider::where('id',$id)->first();

        Slider::where('id',$id)->delete();
        File::delete($data['slider']->image);
        return redirect()->back();

    }


}
