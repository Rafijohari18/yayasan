<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CategoryContent;
use App\Models\Content;


class CategoryKontenController extends Controller{

    public function index(Request $request)
    {
        $data['title'] = 'Category Content';
        $data['category'] =  CategoryContent::all();    
        return view('backend.content.index', compact('data'));
    }

    public function create()
    {
        $data['title'] = 'Category Content';
        $data['type'] = 'create';
        
        
        return view('backend.content.form', compact('data'));
    }

    public function store(Request $request)
    {
        CategoryContent::create([
            'name'              => $request->name,
            'slug'              => $request->slug,
        ]);

        return redirect()->route('category.content.index');
    }

    public function edit($id)
    {
        $data['title'] = 'Edit';
        $data['type'] = strtolower($data['title']);
        $data['content'] = CategoryContent::find($id);
       
        return view('backend.content.form', compact('data'));
    }

    public function update(Request $request,$id)
    {
        $category = CategoryContent::find($id);
        $category->update([
            'name'              => $request->name,
            'slug'              => $request->slug,
        ]);
        return redirect()->route('category.content.index');

    }


    public function destroy($id)
    {
        CategoryContent::where('id',$id)->delete();
        return redirect()->route('category.content.index');

    }


}
