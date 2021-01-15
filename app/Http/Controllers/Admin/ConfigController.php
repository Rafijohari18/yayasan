<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ConfigService;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use App\Repositories\Repository;
use \Response;
use Config;
use App\Models\Config as C;
use Illuminate\Support\Str;


class ConfigController extends Controller
{
    private $service,$model;

    public function __construct(ConfigService $service, C $config )
    {
        $this->service = $service;
        $this->model = new Repository($config);
    }

    public function config()
    {
        $data['title'] = 'Konfigurasi Web';
        $data['config'] = $this->service->get();
    
        $data['web']          = C::where('group_by',1)->get();
        
        $data['logo']         = C::where('id',9)->get();
        $data['background']   = C::where('id',8)->get();
        $data['sosmed']       = C::where('group_by',4)->get();
     
      
        return view('backend.config.web-config', compact('data'));
    }

    public function updateConfig(Request $request)
    {
        // dd($request->all());
        try {
            
            
            
            foreach ($request->name as $key => $value) {
            
                $this->service->updateConfig($key, $value);
            }

            return back()->with('success', 'Config Berhasil di Update');

        } catch (\Exception $th) {
            //throw $th;
            return back()->with('failed', $th->getMessage());
        }
    }

    
    public function destroy($id)
    {
        $this->model->delete($id);
        return back()->with('success','Config Berhasil di Hapus !');
    }


    public function updateConfigLogo(Request $request)
    {
        
        if ($request->logo != NULL) {
            $file = $request->logo;
            $name = 'file/'.Str::slug($request->input('logo')).''.time().'-'.$file->getClientOriginalName();
            $file->move(public_path().'/file/', $name);  
            $fileMove = $name;  
        } else {
            $fileMove = $request->logo_lama;
        }
        
        $config = C::where('name','c_logo')->first();
        
        $config->update([
            'value'  => $fileMove,

        ]);
        return back()->with('success', 'Config Berhasil di Update');
    
    }

    public function updateConfigBackground(Request $request)
    {
        
        if ($request->background != NULL) {
            $file = $request->background;
            $name = 'file/'.Str::slug($request->input('background')).''.time().'-'.$file->getClientOriginalName();
            $file->move(public_path().'/file/', $name);  
            $fileMove = $name;  
        } else {
            $fileMove = $request->background_lama;
        }
        
        $config = C::where('name','c_background')->first();
        
        $config->update([
            'value'  => $fileMove,

        ]);
        return back()->with('success', 'Config Berhasil di Update');
    
    }

    

}
