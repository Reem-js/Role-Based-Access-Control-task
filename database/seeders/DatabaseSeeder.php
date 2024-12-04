<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Task;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
  
    public function run(): void
    {

    // Create 2 Admin users
    User::factory()->count(2)->create([
        'role_id' => 1, // Assuming 1 is the Admin role ID
    ]);

    // Create 2 Manager users
    User::factory()->count(2)->create([
        'role_id' => 2, // Assuming 2 is the Manager role ID
    ]);

    // Create 6 Regular users
    User::factory()->count(6)->create([
        'role_id' => 3, // Assuming 3 is the User role ID
    ]);

       Task::factory(50)->create();
    }
}
