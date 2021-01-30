<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class PermissionRoleController extends Controller
{
    protected $role, $permission;

    public function __construct(Role  $role, Permission $permission)
    {
        //armazena na variavel repository um objeto de role
        $this->role = $role;
        $this->permission = $permission;

        $this->middleware(['can:roles']);
    }

    public function permissions($idRole){
        $role = $this->role->find($idRole);
        if(!$role){
            redirect()->back();
        }
        
        $permissions = $role->permissions()->paginate();

        return view('admin.pages.roles.permissions.permission', compact( 'role', 'permissions'));
        

    }

    public function roles($idPermission){
        
        if(!$permission = $this->permission->find($idPermission)){
            redirect()->back();
        }
        
        $roles = $permission->roles()->paginate();

        return view('admin.pages.permissions.roles.roles', compact(  'permission','roles'));
        

    }
    public function permissionsAvailable(Request $request, $idRole){
        
        if(!$role = $this->role->find($idRole)){
            redirect()->back();
        }

        $filters = $request->except('_token');
        

        //
        $permissions = $role->permissionsAvailable($request->filter);

        return view('admin.pages.roles.permissions.available', compact( 'role', 'permissions', 'filters'));
    
    }
    //Lista os perfils que estão vinculado a uma permissão
   
    
    //metodo que vincula a permissão 
    public function attachPermissionsRole(Request $request, $idRole){

        
        if(!$role = $this->role->find($idRole)){
            redirect()->back();
        }

        if(!$request->permissions || count($request->permissions) == 0){
            redirect()
                ->back()
                ->with('info', 'É necessário escolher pelo menos uma permissão');
        };

        $role ->permissions()->attach($request->permissions);
      
        return redirect()->route('roles.permissions', $role->id);

    }

    //metodo que desvincular a permissão

    public function detachPermissionsRole($idRole, $idPermission){
        $role = $this->role->find($idRole);
        $permission = $this->permission->find($idPermission);
        
        if(!$role || $permission){
            redirect()->back();
        }
        //pega a permissão atraves do relacionamento permissions e desvincula através do detach()
        $role->permissions()->detach($permission);
        return redirect()->route('roles.permissions', $role->id);
    }

    


}
