<?php

namespace Tests\Unit;

use App\Models\Role;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RoleTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_role()
    {
        Role::create([
            'title' => 'Sample Role Title',
            'slug'  => 'sample-role-slug',
        ]);

        $role = Role::firstOrFail();

        $this->assertEquals('Sample Role Title', $role->getTitle());
        $this->assertEquals('sample-role-slug', $role->getSlug());
    }

    public function test_can_find_role_by_slug()
    {
        Role::create([
            'title' => 'Sample Role Title',
            'slug'  => 'sample-role-slug',
        ]);

        $expectedRole = Role::firstOrFail();
        $actualRole = Role::named('sample-role-slug')->firstOrFail();

        $this->assertEquals($expectedRole->id, $actualRole->id);
        $this->assertEquals('sample-role-slug', $actualRole->getSlug());
        $this->assertEquals('Sample Role Title', $actualRole->getTitle());
    }
}
