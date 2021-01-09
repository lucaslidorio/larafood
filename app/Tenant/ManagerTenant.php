<?php

namespace App\Tenant;

use App\Models\Tenant;

class ManagerTenant
{

    public function getTenantIdentify(): int
    {
        return auth()->user()->tenant_id;
    }

    public function getTanant(): Tenant
    {
        return auth()->user()->tenant;
    }

    public function isAdmin(): bool
    {
        return is_array(auth()->user()->email, config('tenant.admins'));
    }
}
