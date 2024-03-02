<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $users = User::factory(10)->create();

         $tasks = Task::factory(30)
             ->recycle($users)
             ->create();

         $tasks->each(function (Task $task) use ($users) {
             $task->team()->attach(
                 $users->shuffle()
                     ->take(fake()->numberBetween(1, 4))
                     ->pluck('id')
             );
         });
    }
}
