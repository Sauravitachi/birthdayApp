<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $chunkSize = 1000;
        $totalUsers = 100000;

        for ($i = 1; $i <= $totalUsers; $i += $chunkSize) {
            $users = [];

            for ($j = 0; $j < $chunkSize && ($i + $j) <= $totalUsers; $j++) {
                $users[] = [
                    'first_name'    => $faker->firstName,
                    'last_name'     => $faker->lastName,
                    'email'         => 'user' . ($i + $j) . '@gmail.com',
                    'phone'         => $faker->numerify('##########'),
                    'date_of_birth' => $faker->dateTimeBetween('1950-01-01', '2005-12-31')->format('Y-m-d'),
                    'address'       => $faker->streetAddress,
                    'city'          => $faker->city,
                    'country'       => $faker->country,
                    'occupation'    => $faker->jobTitle,
                    'status'        => $faker->randomElement(['Active', 'Inactive', 'Suspended']),
                    'role'          => 'User',
                    'password'      => Hash::make('password'),
                    'created_at'    => now(),
                    'updated_at'    => now(),
                ];
            }

            User::insert($users);

            echo "Inserted " . min($i + $chunkSize - 1, $totalUsers) . " users...\n";
        }
    }
}
