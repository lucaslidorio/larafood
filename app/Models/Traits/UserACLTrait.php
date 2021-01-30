<?php

namespace App\Models\Traits;

use App\Models\Tenant;
use PhpParser\Node\Stmt\Foreach_;

trait UserACLTrait
{
    public function permissions():array
    {
       
        $permissionsPlan = $this->permissionsPlan();
        $permissionsRole = $this->permissionsRole();

        $permissions = [];
        foreach ($permissionsRole as $permission) {
           if(in_array($permission, $permissionsPlan))
           array_push($permissions, $permission);
        }
        
        return $permissions;
    }
    //retorna as permissões do Plano
    public function permissionsPlan(): array
    {
        //$tenant = $this->tenant()->first();
        //$plan = $tenant->plan;
        $tenant = Tenant::with('plan.profiles.permissions')->where('id', $this->tenant_id)->first();
        $plan =  $tenant->plan;        
        $permissions = [];
        foreach ($plan->profiles as $profile) {
            foreach ($profile->permissions as $permision) {
                array_push($permissions, $permision->name);
            }
        }
        return $permissions;
    }
    //retorna as permissões do cargo
    public function permissionsRole(): array
    {
        $roles = $this->roles()->with('permissions')->get();   
       
        $permissions = [];
        foreach ($roles as $role) {
            foreach ($role->permissions as $permission) {
                array_push($permissions, $permission->name);
            }
            
        }
        return $permissions;
    }

    public function hasPermission(string $permisionName): bool
    {
        return in_array($permisionName, $this->permissions());
    }
    public function isAdmin(): bool
    {
        return in_array($this->email, config('acl.admins'));
    }
}
