<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'email' => "admin@admin.com",
                "phone" => "01201791523",
                "first_name" => "Ahmed",
                "last_name" => "Reda",
                "salary" => 1000,
                'role' => 'manager',
                'password' => Hash::make('123456'),
            ]
        ];
        $faker = Faker::create();
        for ($i =0 ; $i > 10; $i++ )
            $users [] =[
                'email' => $faker->email,
                "phone" => $faker->phoneNumber,
                "first_name" => $faker->firstName,
                "last_name" => $faker->lastName(),
                "salary" => $faker->numberBetween(10,50)*100,
                'password' => Hash::make('123456'),
            ];

        User::insert($users);
    }
}
