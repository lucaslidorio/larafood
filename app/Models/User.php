<?php

namespace App\Models;

use App\Models\Traits\UserACLTrait;
use Illuminate\Database\Eloquent\Builder;
use App\Observers\TenantObserver;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable, UserACLTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'tenant_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    //Scopo local

    public function  scopeTenantUser(Builder $query)
    {
       return $query->where('tenant_id', auth()->user()->tenant_id);
    }


    //Relacionamento para retornar 1 tenant
    public function tenant(){
        return $this->belongsTo(Tenant::class);
    }

    //Get Roles
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

        //Permissões disponiveis
public function rolesAvailable($filter  = null){
    

    $rules = Role::whereNotIn('roles.id', function($query){
        $query->select('role_user.role_id');
        $query->from('role_user');
        $query->whereRaw("role_user.user_id={$this->id}");
    })
    
    ->where(function($queryFilter) use ($filter){
        if($filter)
        $queryFilter->where('roles.name', 'LIKE', "%{$filter}%");
    })
    ->paginate();                 
    
    return $rules;
    
    }
}
