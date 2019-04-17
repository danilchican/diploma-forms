<?php

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class CreateAdminAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'     => config('app.admin.name'),
            'email'    => config('app.admin.email'),
            'password' => Hash::make(config('app.admin.password')),
            'role_id'  => Role::named(Role::ADMIN_ROLE_SLUG)->firstOrFail()->id,
        ]);
    }
}
