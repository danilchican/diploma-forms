<?php

use App\Exceptions\SeederException;
use App\Models\Role;
use Illuminate\Database\Seeder;

class CreateRolesSeeder extends Seeder
{
    const ROLES_PROPERTY = 'app.roles';

    /**
     * Run the database seeds.
     *
     * @throws SeederException
     *
     * @return void
     */
    public function run()
    {
        $roles = config(self::ROLES_PROPERTY);

        if ($roles === null) {
            throw new SeederException('Roles to import are not found in property '
                . self::ROLES_PROPERTY . '. ' . $roles);
        }

        foreach ($roles as $slug => $title) {
            Role::create(['slug' => $slug, 'title' => $title]);
        }
    }
}
