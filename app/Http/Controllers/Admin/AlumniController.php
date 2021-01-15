<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PageRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Alumni;
use File;
use Str;
use App\Imports\AlumniImport;
use Maatwebsite\Excel\Facades\Excel;
use Response;


class AlumniController extends Controller{

    public function index(Request $request)
    {
        $data['title'] = 'Alumni';
        $data['alumni'] = Alumni::orderBy('id','DESC')->get();
        
        return view('backend.alumni.index', compact('data'));
    }

    public function create()
    {
        
        $data['title'] = 'Alumni';
        $data['type'] = 'create';
        
        return view('backend.alumni.create', compact('data'));
    }

    public function store(Request $request)
    {
        
        if ($request->foto != NULL) {
                $file = $request->foto;
                $name = 'file/'.Str::slug($request->input('foto')).''.time().'-'.$file->getClientOriginalName();
                $file->move(public_path().'/file/', $name);  
                $fileMove = $name;  
        } else {
                $fileMove = NULL;
        }
    

        Alumni::create([
            'no_hp'             => $request->no_hp,
            'foto'              => $fileMove,
            'nama'              => $request->nama,
            'jk'                => $request->jk,
            'tempat_lahir'      => $request->tempat_lahir,
            'tgl_lahir'         => date('Y-m-d',strtotime($request->tgl_lahir)),
            'alamat'            => $request->alamat,
            'sekolah_ke'        => $request->sekolah_ke,
            'masuk_tahun'        => $request->masuk_tahun,
            'tamat_tahun'        => $request->tamat_tahun,

        ]);

        return redirect()->route('alumni.index');
    }

    public function edit($id)
    {
        $data['title'] = 'Edit';
        $data['type'] = strtolower($data['title']);
        $data['alumni'] = Alumni::find($id);
        
       
        return view('backend.alumni.edit', compact('data'));
    }

    public function update(Request $request,$id)
    {
        
        if ($request->foto != NULL) {
            $file = $request->foto;
            $name = 'file/'.Str::slug($request->input('foto')).''.time().'-'.$file->getClientOriginalName();
            $file->move(public_path().'/file/', $name);  
            $fileMove = $name;  
        } else {
            $fileMove = $request->foto_dulu;
        }
        
        $category = Alumni::find($id);
        $category->update([
            'no_hp'          => $request->no_hp,
            'foto'              => $fileMove,
            'nama'              => $request->nama,
            'jk'                => $request->jk,
            'tempat_lahir'      => $request->tempat_lahir,
            'tgl_lahir'         => date('Y-m-d',strtotime($request->tgl_lahir)),
            'alamat'            => $request->alamat,
            'sekolah_ke'        => $request->sekolah_ke,
            'masuk_tahun'        => $request->masuk_tahun,
            'tamat_tahun'        => $request->tamat_tahun,

        ]);
        return redirect()->route('alumni.index');


    }

    public function destroy($id)
    {
        $data['alumni']  =  Alumni::where('id',$id)->first();

        Alumni::where('id',$id)->delete();
        File::delete($data['alumni']->foto);
        return redirect()->back();
    }    

    public function import(Request $request)
    {

        $path1        = $request->file('import_file')->store('temp'); 
        $path         = storage_path('app').'/'.$path1;  
        $alumni        = Excel::import(new AlumniImport,$path);

        return back()->with('success', 'Import successfully');
    }

    public function download(){
        $path = base_path().'/public/format_alumni.xlsx';
        return Response::download($path ,'Format_Alumni'.time().'.xlsx');
    }
}
