<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_round_robin_task_assignment()
    {
  
        $users = User::factory()->count(3)->create(['role_id' => 3]); 

     
        $task = Task::factory()->create(['assigned_user_id' => null]);

        $response = $this->actingAs(User::factory()->create(['role_id' => 2])) 
                         ->post(route('tasks.assign', $task));

        $response->assertRedirect(route('tasks.index'));

     
        $assignedTask = Task::find($task->id);
        $this->assertNotNull($assignedTask->assigned_user_id);
        $this->assertTrue($users->pluck('id')->contains($assignedTask->assigned_user_id));

       
        foreach (range(1, 6) as $i) {
            $task = Task::factory()->create(['assigned_user_id' => null]);
            $this->post(route('tasks.assign', $task));
        }

        $workloads = $users->map(fn($user) => $user->tasks()->count())->toArray();
        $this->assertEquals([2, 2, 2], $workloads); 
    }
}
