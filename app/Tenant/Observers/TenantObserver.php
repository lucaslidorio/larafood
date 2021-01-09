<?php

namespace App\Tenant\Observers;

use App\Tenant\ManagerTenant;
use Illuminate\Database\Eloquent\Model;

class TenantObserver
{

    /**
     * Handle the category "creating" event.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model;
     * @return void
     */
    public function creating(Model $model)
    {
        //antes de criar um categoryo, pega o nome e junta para criar uma url
        $managerTenant = app(ManagerTenant::class);
        
        $model->tenant_id = $managerTenant->getTenantIdentify();  
    }
}