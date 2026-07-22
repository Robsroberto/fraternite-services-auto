<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_screen_requires_admin(): void
    {
        $gestionnaire = User::factory()->create(['role' => 'gestionnaire']);

        $response = $this->actingAs($gestionnaire)->get('/utilisateurs/creer');

        $response->assertStatus(403);
    }

    public function test_admin_can_view_registration_screen(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->get('/utilisateurs/creer');

        $response->assertStatus(200);
    }

    public function test_admin_can_register_new_users(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->post('/utilisateurs', [
            'name' => 'Nouvel Utilisateur',
            'email' => 'nouveau@fraternite-services.sn',
            'role' => 'gestionnaire',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $this->assertDatabaseHas('users', ['email' => 'nouveau@fraternite-services.sn', 'role' => 'gestionnaire']);
        $response->assertRedirect(route('dashboard', absolute: false));
    }
}
