<?php

namespace Tests\Feature\Auth\Admin;

use App\Models\Admin;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\URL;
use Tests\TestCase;

class EmailVerificationTest extends TestCase
{
    use RefreshDatabase;

    public function test_email_verification_screen_can_be_rendered(): void
    {
        $admin = Admin::factory()->create([
            'email_verified_at' => null,
        ]);

        $response = $this->actingAs($admin, 'admin')->get('/admin/verify-email');

        $response->assertStatus(200);
    }

    public function test_email_can_be_verified(): void
    {
        $admin = Admin::factory()->create([
            'email_verified_at' => null,
        ]);

        Event::fake();

        $verificationUrl = URL::temporarySignedRoute(
            'admin.verification.verify',
            now()->addMinutes(60),
            ['id' => $admin->id, 'hash' => sha1($admin->email)]
        );

        $response = $this->actingAs($admin, 'admin')->get($verificationUrl);

        Event::assertDispatched(Verified::class);
        $this->assertTrue($admin->fresh()->hasVerifiedEmail());
        $response->assertRedirect(RouteServiceProvider::ADMIN_HOME.'?verified=1');
    }

    public function test_email_is_not_verified_with_invalid_hash(): void
    {
        $admin = Admin::factory()->create([
            'email_verified_at' => null,
        ]);

        $verificationUrl = URL::temporarySignedRoute(
            'admin.verification.verify',
            now()->addMinutes(60),
            ['id' => $admin->id, 'hash' => sha1('wrong-email')]
        );

        $this->actingAs($admin, 'admin')->get($verificationUrl);

        $this->assertFalse($admin->fresh()->hasVerifiedEmail());
    }
}
