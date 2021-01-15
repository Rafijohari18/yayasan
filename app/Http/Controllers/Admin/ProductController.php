<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CategoryContent;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use File;
use Auth;

class ProductController extends Controller{

    public function index(Request $request)
    {
        $data['title'] = 'Product';
        $data['web'] =  Product::find(1);    

        return view('backend.product.index', compact('data'));
    }

      public function update(Request $request,$id)
    {
        
        $category = Product::find($id);
        $category->update([
            'iframe'              => $request->iframe,
            'created_by'          => Auth::user()['id']
        ]);

        return redirect()->route('product.index');
    }


}
