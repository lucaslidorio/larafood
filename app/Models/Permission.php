<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = ['name', 'description'];


    //Pega Perfis
public function profiles(){
    return $this->belongsToMany(Profile::class);

}

    //Pega Roles
    public function roles(){
        return $this->belongsToMany(Role::class);
    
    }

}
