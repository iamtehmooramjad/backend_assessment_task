<?php

namespace Database\Factories;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends Factory<Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'comment' => fake()->sentence,
            'user_id' => function () {
                return DB::table('users')->insertGetId([
                    'name' => Str::random(10),
                    'email' => Str::random(10).'@gmail.com',
                    'password' => Hash::make('password'),
                ]);
            },
            'task_id' => function () {
                return DB::table('tasks')->insertGetId([
                    'name' => fake()->sentence,
                    'description' => fake()->paragraph,
                    'status' => fake()->randomElement(['active', 'inactive']),
                    'user_id' => function () {
                        return DB::table('users')->insertGetId([
                            'name' => Str::random(10),
                            'email' => Str::random(10).'@gmail.com',
                            'password' => Hash::make('password'),
                        ]);
                    },
                ]);
            },
        ];
    }
}
