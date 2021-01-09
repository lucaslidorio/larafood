<?php

use App\Models\Tenant;
use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tenant = Tenant::first();

        $tenant->users()->create([
            'name'=>'Lucas Lidório',
            'email' => 'lucaslidorio@hotmail.com',
            'password' =>bcrypt('123456'),

        ]);
    }
}
