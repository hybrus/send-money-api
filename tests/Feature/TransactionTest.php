<?php

namespace Tests\Feature;

use App\Models\Bank;
use App\Models\Provider;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class TransactionTest extends TestCase
{
    use RefreshDatabase;

    public function testMakeTransactionSuccess()
    {

        $provider = Provider::factory()->create();
        $bank = Bank::factory()->create();

        $provider->banks()->attach([$bank->id]);

        $user = User::factory()->create();
        $this->actingAs($user);
        $user->getAccount()->update(['available_balance' => 5000]);

        $payload = [
            "type" => "bank",
            "provider_id" => $provider->id,
            "bank_id" => $bank->id,
            "amount" => 200,
        ];

        $response = $this->post(route('make-transaction'), $payload);

        Log::error('mess', Transaction::get()->toArray());

        $response->assertStatus(200);

        $response->assertJson([
            'message' => 'Success.'
        ]);
    }
}
