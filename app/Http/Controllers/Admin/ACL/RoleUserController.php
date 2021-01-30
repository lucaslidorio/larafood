<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class RoleUserController extends Controller
{
    protected $user, $role;

    public function __construct(User  $user, Role $role)
    {
        //armazena na variavel repository um objeto de user
        $this->user = $user;
        $this->role = $role;

        $this->middleware(['can:users']);
    }

    public function roles($idUser){
        $user = $this->user->find($idUser);
        if(!$user){
            redirect()->back();
        }
        
        $roles = $user->roles()->paginate();

        return view('admin.pages.users.roles.roles', compact( 'user', 'roles'));
        

    }

    public function users($idRole){
        
        if(!$role = $this->role->find($idRole)){
            redirect()->back();
        }
        
        $users = $role->users()->paginate();

        return view('admin.pages.roles.users.users', compact(  'role','users'));
        

    }
    public function rolesAvailable(Request $request, $idUser){
        
        if(!$user = $this->user->find($idUser)){
            redirect()->back();
        }

        $filters = $request->except('_token');
        

        //
        $roles = $user->rolesAvailable($request->filter);

        return view('admin.pages.users.roles.available', compact( 'user', 'roles', 'filters'));
    
    }
    //Lista os perfils que estão vinculado a uma permissão
   
    
    //metodo que vincula a permissão 
    public function attachRolesUser(Request $request, $idUser){

        
        if(!$user = $this->user->find($idUser)){
            redirect()->back();
        }

        if(!$request->roles || count($request->roles) == 0){
            redirect()
                ->back()
                ->with('info', 'É necessário escolher pelo menos uma permissão');
        };

        $user ->roles()->attach($request->roles);
      
        return redirect()->route('users.roles', $user->id);

    }

    //metodo que desvincular a permissão

    public function detachRolesUser($idUser, $idRole){
        $user = $this->user->find($idUser);
        $role = $this->role->find($idRole);
        
        if(!$user || $role){
            redirect()->back();
        }
        //pega a permissão atraves do relacionamento roles e desvincula através do detach()
        $user->roles()->detach($role);
        return redirect()->route('users.roles', $user->id);
    }

    


}
