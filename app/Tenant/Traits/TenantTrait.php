<?php
namespace App\Tenant\Traits;

use App\Tenant\Observers\TenantObserver;
use App\Tenant\Scopes\TenantScope;

trait TenantTrait
{
    protected static  function boot()
    {
        parent::boot();

        static::observe(TenantObserver::class);

        //IMPORTA O SCOPO DE FILTRO PARA SÓ LISTA A CATEGORIA DO TENANT
        static::addGlobalScope(new TenantScope);

    }
}