<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PageRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Siswa;
use File;
use Str;
use App\Imports\SiswaImport;
use Maatwebsite\Excel\Facades\Excel;
use Response;

class SiswaController extends Controller{

    public function index(Request $request)
    {
        $data['title'] = 'Siswa';
        $data['siswa'] = Siswa::orderBy('id','DESC')->get();
        
        return view('backend.siswa.index', compact('data'));
    }

    public function create()
    {
        
        $data['title'] = 'Siswa';
        $data['type'] = 'create';
        
        return view('backend.siswa.create', compact('data'));
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
    

        Siswa::create([
            'no_induk'          => $request->no_induk,
            'nisn'              => $request->nisn,
            'foto'              => $fileMove,
            'nama'              => $request->nama,
            'jk'                => $request->jk,
            'tempat_lahir'      => $request->tempat_lahir,
            'tgl_lahir'         => date('Y-m-d',strtotime($request->tgl_lahir)),
            'umur'              => $request->umur,
            'agama'             => $request->agama,
            'alamat'            => $request->alamat,
            'nama_ortu'         => $request->nama_ortu,
            'pendidikan_ortu'   => $request->pendidikan_ortu,
            'alamat_ortu'       => $request->alamat_ortu,
            'keterangan'        => $request->keterangan,

        ]);

        return redirect()->route('siswa.index');
    }

    public function edit($id)
    {
        $data['title'] = 'Edit';
        $data['type'] = strtolower($data['title']);
        $data['siswa'] = Siswa::find($id);
        
       
        return view('backend.siswa.edit', compact('data'));
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
        
        $category = Siswa::find($id);
        $category->update([
            'no_induk'          => $request->no_induk,
            'nisn'              => $request->nisn,
            'foto'              => $fileMove,
            'nama'              => $request->nama,
            'jk'                => $request->jk,
            'tempat_lahir'      => $request->tempat_lahir,
            'tgl_lahir'     => date('Y-m-d',strtotime($request->tgl_lahir)),
            'umur'              => $request->umur,
            'agama'             => $request->agama,
            'alamat'            => $request->alamat,
            'nama_ortu'         => $request->nama_ortu,
            'pendidikan_ortu'   => $request->pendidikan_ortu,
            'alamat_ortu'       => $request->alamat_ortu,
            'keterangan'        => $request->keterangan,

        ]);
        return redirect()->route('siswa.index');


    }

    public function destroy($id)
    {
        $data['siswa']  =  Siswa::where('id',$id)->first();

        Siswa::where('id',$id)->delete();
        File::delete($data['siswa']->foto);
        return redirect()->back();

    }    

    public function import(Request $request)
    {

        $path1        = $request->file('import_file')->store('temp'); 
        $path         = storage_path('app').'/'.$path1;  
        $siswa        = Excel::import(new SiswaImport,$path);

        return back()->with('success', 'Import successfully');
    }

    public function download(){
        $path = base_path().'/public/format_siswa.xlsx';
        return Response::download($path ,'Format_Siswa'.time().'.xlsx');
    }
}
