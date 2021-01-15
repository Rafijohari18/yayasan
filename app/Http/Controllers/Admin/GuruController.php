<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PageRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Guru;
use File;
use Str;
use App\Imports\GuruImport;
use Maatwebsite\Excel\Facades\Excel;
use Response;

class GuruController extends Controller{

    public function index(Request $request)
    {
        $data['title'] = 'Guru';
        $data['guru'] = Guru::orderBy('id','DESC')->get();
        
        return view('backend.guru.index', compact('data'));
    }

    public function create()
    {
        
        $data['title'] = 'Guru';
        $data['type'] = 'create';
        
        return view('backend.guru.create', compact('data'));
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
        
        Guru::create([
            'nama'              => $request->nama,
            'foto'              => $fileMove,
            'pendidikan'        => $request->pendidikan,
            'tgl_lahir'         => date('Y-m-d',strtotime($request->tgl_lahir)),
            'pelatihan'         => $request->pelatihan,
            'prestasi'          => $request->prestasi,
            'penghargaan'       => $request->penghargaan,
            'jabatan'           => $request->jabatan,
            'tempat_lahir'      => $request->tempat_lahir,
            'thn_masuk'         => date('Y-m-d',strtotime($request->thn_masuk)),
            'tmt'               => date('Y-m-d',strtotime($request->tmt)),
            'alamat'            => $request->alamat,
            'jk'                => $request->jk,
            'agama'             => $request->agama,
            
        ]);

        return redirect()->route('guru.index');
    }

    public function edit($id)
    {
        $data['title'] = 'Edit';
        $data['type'] = strtolower($data['title']);
        $data['guru'] = Guru::find($id);
        
       
        return view('backend.guru.edit', compact('data'));
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

        

        
        $category = Guru::find($id);
        $category->update([
            'nama'              => $request->nama,
            'foto'              => $fileMove,
            'pendidikan'        => $request->pendidikan,
            'tgl_lahir'         => date('Y-m-d',strtotime($request->tgl_lahir)),
            'pelatihan'         => $request['pelatihan'][0] == null ? NULL : $request['pelatihan'],
            'prestasi'          => $request['prestasi'][0] == null ? NULL : $request['prestasi'],
            'penghargaan'       => $request['penghargaan'][0] == null ? NULL : $request['penghargaan'],
            'jabatan'           => $request->jabatan,
            'tempat_lahir'      => $request->tempat_lahir,
            'thn_masuk'         => date('Y-m-d',strtotime($request->thn_masuk)),
            'tmt'               => date('Y-m-d',strtotime($request->tmt)),
            'alamat'            => $request->alamat,
            'jk'                => $request->jk,
            'agama'             => $request->agama,

        ]);
        return redirect()->route('guru.index');


    }

    public function destroy($id)
    {
        $data['guru']  =  Guru::where('id',$id)->first();

        Guru::where('id',$id)->delete();
        File::delete($data['guru']->foto);
        return redirect()->back();
    }    

    public function import(Request $request)
    {

        $path1        = $request->file('import_file')->store('temp'); 
        $path         = storage_path('app').'/'.$path1;  
        $guru        = Excel::import(new GuruImport,$path);

        return back()->with('success', 'Import successfully');
    }

    public function download(){
        $path = base_path().'/public/format_guru.xlsx';
        return Response::download($path ,'Format_Guru'.time().'.xlsx');
    }
}
