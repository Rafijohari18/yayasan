<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PageRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\ProfilAlumni;
use File;
use Str;
use App\Imports\ProfilAlumniImport;
use Maatwebsite\Excel\Facades\Excel;
use Response;


class ProfilAlumniController extends Controller{

    public function index(Request $request)
    {
        $data['title'] = 'Profil Alumni';
        $data['alumni'] = ProfilAlumni::orderBy('id','DESC')->get();
        
        return view('backend.profilalumni.index', compact('data'));
    }

    public function create()
    {
        
        $data['title'] = 'Profil Alumni';
        $data['type'] = 'create';
        
        return view('backend.profilalumni.create', compact('data'));
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
    

        ProfilAlumni::create([
            'foto'              => $fileMove,
            'nama'              => $request->nama,
            'pekerjaan'         => $request->pekerjaan,
            'alamat'            => $request->alamat,
            'angkatan'          => $request->angkatan,
            'moto_hidup'        => $request->moto_hidup,
            'pesan_kesan'       => $request->pesan_kesan,

        ]);

        return redirect()->route('profil.alumni.index');
    }

    public function edit($id)
    {
        $data['title'] = 'Edit';
        $data['type'] = strtolower($data['title']);
        $data['alumni'] = ProfilAlumni::find($id);
        
       
        return view('backend.profilalumni.edit', compact('data'));
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
        
        $category = ProfilAlumni::find($id);
        $category->update([
            'foto'              => $fileMove,
            'nama'              => $request->nama,
            'pekerjaan'         => $request->pekerjaan,
            'alamat'            => $request->alamat,
            'angkatan'          => $request->angkatan,
            'moto_hidup'        => $request->moto_hidup,
            'pesan_kesan'       => $request->pesan_kesan,

        ]);
        return redirect()->route('profil.alumni.index');


    }

    public function destroy($id)
    {
        $data['alumni']  =  ProfilAlumni::where('id',$id)->first();

        ProfilAlumni::where('id',$id)->delete();
        File::delete($data['alumni']->foto);
        return redirect()->back();

    }    

    public function import(Request $request)
    {

        $path1        = $request->file('import_file')->store('temp'); 
        $path         = storage_path('app').'/'.$path1;  
        $alumni        = Excel::import(new ProfilAlumniImport,$path);

        return back()->with('success', 'Import successfully');
    }

    public function download(){
        $path = base_path().'/public/format_profil_alumni.xlsx';
        return Response::download($path ,'Format_Profil_Alumni'.time().'.xlsx');
    }

}
