<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UsersRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Services\UsersService;
use App\Models\User;
use Auth;
use DB;
use Image;
use Illuminate\Support\Str;

class UsersController extends Controller
{
    private $user ;

    public function __construct(UsersService $user)
    {
        $this->user  = $user;
    }

    public function index(Request $request)
    {
        $data['title'] = 'Users';
        $data['users'] = $this->user->getUsers($request);
        
      
        $data['total'] = $this->user->getTotalUsers($request);
        
        

        return view('backend.users.index', compact('data'));
    }

    public function create()
    {
        $data['title'] = 'Tambah';
        $data['type'] = strtolower($data['title']);
        $users = auth()->user();
    
        
        return view('backend.users.form', compact('data'));
    }
    public function store(UsersRequest $request)
    {
        $this->user->store($request);

        return redirect()->route('users.index')->with('success', 'Berhasil  Tambah User');
        
    }

    public function edit($id)
    {
        $data['title'] = 'Edit';
        $data['type'] = strtolower($data['title']);
        $data['users'] = $this->user->getUserById($id);
        $users = auth()->user();

      
        
       
        return view('backend.users.form', compact('data'));
    }

    public function update(Request $request, $id)
    {
        try {
           
            
            $users = $this->user->getUserById($id);
          
            $users->update([
                'name' => $request->name,
                'email' => $request->email,
                'level' => $request->level,
                'password' => ($request->password != '') ? Hash::make($request->password) : $users['password'],
                'updated_at' => date('Y-m-d H:i:s'),
            ]);


            $users->save();

                  
            
            return redirect()->route('users.index')->with('success', 'Edit users Berhasil');
            
        } catch (\Throwable $th) {
            //throw $th;
            return back()->with('failed', 'Edit users failed. please try again');
        }
    }

    public function destroy($id)
    {
        try {
            
            $users = $this->user->getUserById($id);
            $users->delete();
            
            return back()->with('success', 'Delete users successfully');
        } catch (\Throwable $th) {
            //throw $th;
            return back()->with('failed', 'Delete users failed. please try again');
        }
    }

    public function status($id)
    {
        try {
            
            $users = $this->user->getUserById($id);
            $users->fill([
                'active' => !$users['active'],
            ]);
            $users->save();

            return back()->with('success', 'Update status successfully');
        } catch (\Throwable $th) {
            //throw $th;
            return back()->with('failed', 'Update status failed. please try again');
        }
    }

    /**profile */
    public function profile()
    {
        $data['title'] = 'Profile';
    
        
        return view('backend.users.profile', compact('data'));
    }

    public function updateProfile(Request $request, $id)
    {   
          
            $users = $this->user->getUserById($id);

            $users->fill([
                'name'      => $request->name,
                'email'     => $request->email,
                'password'  => ($request->password != '') ? Hash::make($request->password) : $users['password'],
            ]);
            $users->save();

             
            
            return back()->with('success', 'Update profile successfully');
           
            
            
    }

    public function changePhoto(Request $request, $id)
    {
        
            
            $this->validate($request, [
                'photo' => 'required|mimes:jpg,jpeg,png,svg',
            ]);

            $users = $this->user->getUserById($id);
            if ($request->hasFile('photo')) {
                 

                 
                 $thumbnail = Image::make($request->file('photo')->getRealPath());
                 $thumbnail->resize(300,300);
                    
                 $imageName = Str::replaceLast(' ', '-', $users['name']).'-'.
                 date('Y-m-d-His').'.'.$request->file('photo')->guessExtension();
                 
                 $request->file('photo')->move(public_path('userfile/photo'), $imageName);

                if ($users['avatar'] != null) {
                    $location = public_path('userfile/photo/'.$users['avatar']);
                    File::delete($location);
                }

                $users['avatar'] = $imageName;
            }
            $users->save();

            return back()->with('success', 'Change photo successfully');
        
    }

    public function removePhoto($id)
    {
        try {
            
            $users = $this->user->getUserById($id);
            $location = public_path('userfile/photo/'.$users['photo']);
            File::delete($location);
            $users->photo = NULL;
            $users->save();

            return back()->with('success', 'Remove photo successfully');
        } catch (\Throwable $th) {
            //throw $th;
            return back()->with('faile', 'Remove photo failed. please try again');
        }
    }
}
