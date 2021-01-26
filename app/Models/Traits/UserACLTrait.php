<?php

namespace App\Models\Traits;


trait UserACLTrait
{
 public function permissions(){

    $tenant = $this->tenant()->first();
    $plan = $tenant->plan;

    $permissions = [];
    foreach( $plan->profiles as $profile){
        foreach($profile->permissions as $permision){
            array_push($permissions, $permision->name);
        }
       

    }
     return $permissions;

 }
    public function hasPermission (string $permisionName): bool  
  {
      return in_array($permisionName, $this->permissions());

  }
    public function isAdmin(): bool
    {
        return in_array($this->email, config('acl.admins'));
    }
}