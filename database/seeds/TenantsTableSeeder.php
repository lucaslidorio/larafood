<?php

use App\Models\Plan;
use App\Models\Tenant;
use Illuminate\Database\Seeder;

class TenantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $plan = Plan::first();

        $plan->tenants()->create([
            'cnpj' =>'238893990000134',
            'name' => 'Especializa TI',
            'url' =>'especializati',
            'email' => 'lucaslidorio@hotmail.com',
     ]);
    }
}
