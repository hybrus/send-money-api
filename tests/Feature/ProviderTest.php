<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Provider;
use App\Models\Bank;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Log;

class ProviderTest extends TestCase
{
    use DatabaseTransactions;

    public function test_get_all_providers()
    {
        $provider1 = Provider::factory()->create();
        $provider2 = Provider::factory()->create();
        $provider3 = Provider::factory()->create();

        $bank1 = Bank::factory()->create();
        $bank2 = Bank::factory()->create();
        $bank3 = Bank::factory()->create();

        $provider1->banks()->attach([$bank1->id, $bank2->id]);
        $provider2->banks()->attach([$bank2->id, $bank3->id]);
        $provider3->banks()->attach([$bank1->id, $bank3->id]);

        $user = User::factory()->create();
        $token = auth()->attempt(["email" => $user->email, "password" => "password"]);

        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $token])->get(route('get-providers'));

        $response->assertStatus(200);

        $response->assertJsonCount(3, '*');

        $response->assertJsonStructure([
            '*' => [
                'id',
                'name',
                'is_disabled',
                'is_active',
                'banks' => [
                    '*' => [
                        'id',
                        'name',
                        'is_disabled',
                        'is_active',
                    ],
                ],
            ],
        ]);

        $response->assertJsonFragment(['name' => $provider1->name]);
        $response->assertJsonFragment(['name' => $provider2->name]);
        $response->assertJsonFragment(['name' => $provider3->name]);

        $response->assertJsonFragment(['name' => $bank1->name], 'data.0.banks');
        $response->assertJsonFragment(['name' => $bank2->name], 'data.0.banks');
        $response->assertJsonFragment(['name' => $bank2->name], 'data.1.banks');
        $response->assertJsonFragment(['name' => $bank3->name], 'data.1.banks');
        $response->assertJsonFragment(['name' => $bank1->name], 'data.2.banks');
        $response->assertJsonFragment(['name' => $bank3->name], 'data.2.banks');
    }

    public function test_get_all_providers_unauthenticated()
    {
        $provider1 = Provider::factory()->create();

        $bank1 = Bank::factory()->create();

        $provider1->banks()->attach([$bank1->id]);


        $response = $this->get(route('get-providers'));

        $response->assertStatus(401);

        $response->assertJson([
            'message' => 'Unauthenticated.',
        ]);
    }
}
