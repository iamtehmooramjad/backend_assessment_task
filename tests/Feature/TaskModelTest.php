<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;
use Tests\TestCase;

class TaskModelTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_task()
    {
        $user = \App\Models\User::factory()->create();
        Auth::login($user);

        $task = Task::factory()->create([
            'user_id' => $user->id,
            'name' => 'Test',
            'description' => 'Testing',
            'status' => 'active',

        ]);

        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'name' => $task->name,
            'description' => $task->description,
            'status' => $task->status,
        ]);
    }

    public function test_can_update_task()
    {
        $user = \App\Models\User::factory()->create();
        Auth::login($user);

        $task = Task::factory()->create([
            'user_id' => $user->id,
            'name' => 'Test',
            'description' => 'Testing',
            'status' => 'active',
        ]);

        $task->update(['name' => 'Updated Task Name']);

        $this->assertEquals('Updated Task Name', $task->fresh()->name);
    }

    public function test_can_delete_task()
    {
        $user = \App\Models\User::factory()->create();
        Auth::login($user);

        $task = Task::factory()->create([
            'user_id' => $user->id,
            'name' => 'Test',
            'description' => 'Testing',
            'status' => 'active',
        ]);

        $task->delete();

        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
    }
}
