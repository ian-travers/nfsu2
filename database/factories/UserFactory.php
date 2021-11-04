<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'username' => $this->faker->unique()->word(),
            'country' => Arr::random(['BY', 'UA', 'GB', 'US', 'PL', 'LV', 'LT']),
            'email' => $this->faker->unique()->safeEmail(),
            'role' => 'user',
            'is_admin' => false,
            'is_browser_notified' => false,
            'is_email_notified' => false,
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'locale' =>'en',
        ];
    }

    public function unverified()
    {
        return $this->state([
            'email_verified_at' => null,
        ]);
    }

    public function admin()
    {
        return $this->state([
            'is_admin' => true,
        ]);
    }

    public function racer()
    {
        return $this->state([
            'role' => $this->model::ROLE_RACER,
        ]);
    }

    public function browserNotified()
    {
        return $this->state([
            'is_browser_notified' => true,
        ]);
    }

    public function emailNotified()
    {
        return $this->state([
            'is_email_notified' => true,
        ]);
    }
}
