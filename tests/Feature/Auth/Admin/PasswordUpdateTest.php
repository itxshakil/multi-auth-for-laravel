<?php

namespace Tests\Feature\Auth\Admin;

use App\Models\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class PasswordUpdateTest extends TestCase
{
    use RefreshDatabase;

    public function test_password_can_be_updated(): void
    {
        $admin = Admin::factory()->create();

        $response = $this
            ->actingAs($admin, 'admin')
            ->from('/admin/profile')
            ->put('/admin/password', [
                'current_password' => 'password',
                'password' => 'new-password',
                'password_confirmation' => 'new-password',
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/admin/profile');

        $this->assertTrue(Hash::check('new-password', $admin->refresh()->password));
    }

    public function test_correct_password_must_be_provided_to_update_password(): void
    {
        $admin = Admin::factory()->create();

        $response = $this
            ->actingAs($admin, 'admin')
            ->from('/admin/profile')
            ->put('/admin/password', [
                'current_password' => 'wrong-password',
                'password' => 'new-password',
                'password_confirmation' => 'new-password',
            ]);

        $response
            ->assertSessionHasErrors('current_password')
            ->assertRedirect('/admin/profile');
    }
}
