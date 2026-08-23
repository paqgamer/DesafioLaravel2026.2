<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class UserFactory extends Factory
{

    protected static ?string $password;


    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('123123'),
            // mudei a senha pra 123123 pra digitar mais rapido pra testar
            'remember_token' => Str::random(10),
            'cpf' => fake()->unique()->numerify('###########'), //vou ser preso por fazer gerador de cfp
            'phone' => fake()->phoneNumber(),
            'birth_date' => fake()->dateTimeBetween('-70 years', '-18 years')->format('Y-m-d'),
            'is_admin' => false,
            'saldo' => fake()->randomFloat(2, 0, 500),
            'cep' => fake()->numerify('#####-###'),
            'street' => fake()->streetName(),
            'number' => (string) fake()->numberBetween(1, 2000),
            'neighborhood' => fake()->words(2, true),
            'city' => fake()->city(),
            'state' => fake()->randomElement(['SP', 'RJ', 'MG', 'ES', 'BA', 'PR', 'SC', 'RS', 'GO', 'DF']), //depois faço a merda da API cep
            'complement' => fake()->optional()->secondaryAddress(),
        ];
    }

 
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}