<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CategoryProduct;
use App\Models\Product;

class CategoryProductController extends Controller{

    public function index(Request $request)
    {
        $data['title'] = 'Category Product';
        $data['category'] =  CategoryProduct::all();    
        return view('backend.catproduk.index', compact('data'));
    }

    public function create()
    {
        $data['title'] = 'Category Product';
        $data['type'] = 'create';
        
        return view('backend.catproduk.form', compact('data'));
    }

    public function store(Request $request)
    {
        CategoryProduct::create([
            'name'              => $request->name,
            'slug'              => $request->slug,
        ]);

        return redirect()->route('category.product.index');
    }

    public function edit($id)
    {
        $data['title'] = 'Edit';
        $data['type'] = strtolower($data['title']);
        $data['catproduk'] = CategoryProduct::find($id);
       
        return view('backend.catproduk.form', compact('data'));
    }

    public function update(Request $request,$id)
    {
        $category = CategoryProduct::find($id);
        $category->update([
            'name'              => $request->name,
            'slug'              => $request->slug,
        ]);
        return redirect()->route('category.product.index');

    }


    public function destroy($id)
    {
        CategoryProduct::where('id',$id)->delete();
        return redirect()->route('category.product.index');

    }


}
