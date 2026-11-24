<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_auth_pages_and_authenticated_navigation_are_accessible(): void
    {
        $this->get(route('login'))
            ->assertOk()
            ->assertSee('Masuk')
            ->assertSee(route('register'));

        $this->get(route('register'))
            ->assertOk()
            ->assertSee('Buat Akun')
            ->assertSee(route('login'));

        $this->actingAs(User::factory()->create())
            ->get('/')
            ->assertOk()
            ->assertSee(route('catatan.index'))
            ->assertSee(route('logout'));
    }

    public function test_a_user_can_register_and_is_logged_in(): void
    {
        $response = $this->post(route('register.store'), [
            'name' => 'Pengguna Baru',
            'email' => 'baru@example.com',
            'password' => 'password-aman',
            'password_confirmation' => 'password-aman',
        ]);

        $response->assertRedirect(route('catatan.index'));
        $this->assertAuthenticated();
        $this->assertDatabaseHas('users', ['email' => 'baru@example.com']);
        $this->assertTrue(Hash::check('password-aman', User::where('email', 'baru@example.com')->first()->password));
    }

    public function test_a_user_can_log_in_and_log_out(): void
    {
        $user = User::factory()->create(['password' => 'password-aman']);

        $this->post(route('login'), [
            'email' => $user->email,
            'password' => 'password-aman',
        ])->assertRedirect(route('catatan.index'));

        $this->assertAuthenticatedAs($user);

        $this->post(route('logout'))
            ->assertRedirect(route('login'));

        $this->assertGuest();
    }

    public function test_invalid_login_is_rejected(): void
    {
        User::factory()->create(['email' => 'user@example.com', 'password' => 'password-aman']);

        $this->from(route('login'))
            ->post(route('login'), [
                'email' => 'user@example.com',
                'password' => 'wrong-password',
            ])
            ->assertRedirect(route('login'))
            ->assertSessionHasErrors('email');

        $this->assertGuest();
    }
}
