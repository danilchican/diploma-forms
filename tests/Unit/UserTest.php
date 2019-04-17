<?php

namespace Tests\Unit;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_user()
    {
        $adminRole = factory(\App\Models\Role::class)->state('admin')->create();

        $user = User::create([
            'name'     => 'Sample User Name',
            'email'    => 'sample_user@example.com',
            'password' => Hash::make('secret'),
            'role_id'  => $adminRole->id,
        ]);

        $this->assertEquals('sample_user@example.com', $user->getEmail());
        $this->assertEquals('Sample User Name', $user->getName());
        $this->assertTrue(Hash::check('secret', $user->password));
        $this->assertEquals($adminRole->id, $user->role_id);
    }

    public function test_user_should_have_a_role()
    {
        $adminRole = factory(\App\Models\Role::class)->state('admin')->create();

        $user = new User([
            'name'     => 'Sample User Name 2',
            'email'    => 'sample_user@example2.com',
            'password' => Hash::make('secret2'),
        ]);

        $user->role()->associate($adminRole);
        $user->save();

        $this->assertEquals('sample_user@example2.com', $user->getEmail());
        $this->assertEquals('Sample User Name 2', $user->getName());
        $this->assertTrue(Hash::check('secret2', $user->password));

        $this->assertTrue($user->isAdministrator());
        $this->assertTrue($user->hasRole([Role::ADMIN_ROLE_SLUG]));
        $this->assertTrue($user->hasRole(Role::ADMIN_ROLE_SLUG));
    }
}
