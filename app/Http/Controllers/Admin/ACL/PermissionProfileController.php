<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Profile;
use Illuminate\Http\Request;

class PermissionProfileController extends Controller
{
    protected $profile, $permission;

    public function __construct(Profile  $profile, Permission $permission)
    {
        //armazena na variavel repository um objeto de profile
        $this->profile = $profile;
        $this->permission = $permission;
    }

    public function permissions($idProfile){
        $profile = $this->profile->find($idProfile);
        if(!$profile){
            redirect()->back();
        }
        
        $permissions = $profile->permissions()->paginate();

        return view('admin.pages.profiles.permissions.permission', compact( 'profile', 'permissions'));
        

    }

    public function profiles($idPermission){
        
        if(!$permission = $this->permission->find($idPermission)){
            redirect()->back();
        }
        
        $profiles = $permission->profiles()->paginate();

        return view('admin.pages.permissions.profiles.profiles', compact(  'permission','profiles'));
        

    }
    public function permissionsAvailable(Request $request, $idProfile){
        
        if(!$profile = $this->profile->find($idProfile)){
            redirect()->back();
        }

        $filters = $request->except('_token');
        

        //
        $permissions = $profile->permissionsAvailable($request->filter);

        return view('admin.pages.profiles.permissions.available', compact( 'profile', 'permissions', 'filters'));
    
    }
    //Lista os perfils que estão vinculado a uma permissão
   
    
    //metodo que vincula a permissão 
    public function attachPermissionsProfile(Request $request, $idProfile){

        
        if(!$profile = $this->profile->find($idProfile)){
            redirect()->back();
        }

        if(!$request->permissions || count($request->permissions) == 0){
            redirect()
                ->back()
                ->with('info', 'É necessário escolher pelo menos uma permissão');
        };

        $profile ->permissions()->attach($request->permissions);
      
        return redirect()->route('profiles.permissions', $profile->id);

    }

    //metodo que desvincular a permissão

    public function detachPermissionsProfile($idProfile, $idPermission){
        $profile = $this->profile->find($idProfile);
        $permission = $this->permission->find($idPermission);
        
        if(!$profile || $permission){
            redirect()->back();
        }
        //pega a permissão atraves do relacionamento permissions e desvincula através do detach()
        $profile->permissions()->detach($permission);
        return redirect()->route('profiles.permissions', $profile->id);
    }

    


}
