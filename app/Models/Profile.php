<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $table = 'profiles';
protected $fillable = ['name', 'description'];

//Pega Permissão
public function permissions(){
    return $this->belongsToMany(Permission::class, 'permission_profile');

}

//Pega Plans
public function  plans(){
    return $this->belongsToMany(Plan::class);
}

//Permissões disponiveis
public function permissionsAvailable($filter  = null){
    

$permissions = Permission::whereNotIn('permissions.id', function($query){
    $query->select('permission_profile.permission_id');
    $query->from('permission_profile');
    $query->whereRaw("permission_profile.profile_id={$this->id}");
})

->where(function($queryFilter) use ($filter){
    if($filter)
    $queryFilter->where('permissions.name', 'LIKE', "%{$filter}%");
})
->paginate();                 

return $permissions;

}

}
