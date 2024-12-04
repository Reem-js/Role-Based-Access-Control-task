<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_efficiency_calculation_is_correct()
    {
 
        Task::factory()->count(30)->create(['status' => 'completed']);
        Task::factory()->count(20)->create(['status' => 'pending']);
        
        $response = $this->actingAs(User::factory()->create(['role_id' => 1])) 
                         ->get(route('admin.dashboard'));

        $response->assertStatus(200);
        $response->assertSee('Efficiency');
        
        $expectedEfficiency = (30 / 50) * 100;

        $this->assertStringContainsString(
            number_format($expectedEfficiency, 2),
            $response->getContent()
        );
    }
}
