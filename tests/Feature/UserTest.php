<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_can_authenticate_a_user_and_return_access_token()
    {
        $user = User::factory()->create();

        $response = $this->postJson('/api/auth/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure(['access_token', 'token_type', 'expires_in']);
    }

    /** @test */
    public function it_returns_invalid_credentials_response_on_failed_login()
    {
        $response = $this->postJson('/api/auth/login', [
            'email' => 'nonexistent@example.com',
            'password' => 'wrongpassword',
        ]);

        $response->assertStatus(401);
        $response->assertJson(['message' => 'Invalid Credentials']);
    }

    /** @test */
    public function it_returns_authenticated_user_in_me_endpoint()
    {
        $user = User::factory()->create();
        $token = auth()->attempt(["email" => $user->email, "password" => "password"]);

        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $token])->get('/api/auth/me');

        $response->assertStatus(200);
        $response->assertJson([
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email
        ]);
    }

    /** @test */
    public function it_returns_unauthenticated_in_me_endpoint()
    {

        $response = $this->get('/api/auth/me');

        $response->assertStatus(401);
        $response->assertJson([
            'message' => 'Unauthenticated.',
        ]);
    }
}
