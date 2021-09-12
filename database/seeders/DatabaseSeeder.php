<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */

    public function run()
    {

        $faker = Faker::create();


        DB::table('users')->insert([
            'name' => 'Test',
            'email' => 'test@testas.com',
            'password' => Hash::make('12345678'),
        ]);
        $ownersCount = 20;
        foreach (range(1, $ownersCount) as $_) {
            DB::table('owners')->insert([
                'name' => $faker->firstName(),
                'surname' => $faker->LastName(),
                'contacts' => $faker->phoneNumber()
            ]);
        }
        $doctorsCount = 10;
        $category = ['VET', 'Surgent', 'Chyropracter', 'Okulist'];
        foreach (range(1, $doctorsCount) as $_) {
            DB::table('doctors')->insert([
                'name' => $faker->firstName(),
                'surname' => $faker->LastName(),
                'category' => $category[rand(0, count($category) - 1)]
            ]);
        }
        $animals = ['Cat', 'Dog', 'Goose', 'Horse', 'Mouse', 'Snake', 'Parrot', 'Hamster', 'Crow', 'Turtle'];
        $document = ['Chips', 'Pasport', 'Birth certificate'];
        foreach (range(1, 200) as $_) {
            DB::table('pets')->insert([
                'name' => $faker->firstName(),
                'species' => $animals[rand(0, count($animals) - 1)],
                'birth_date' => $faker->date($format = 'Y-m-d', $max = 'now'),
                'document' => $document[rand(0, count($document) - 1)],
                'history' => $faker->paragraph(5),
                'owner_id' => rand(1, $ownersCount),
                'doctor_id' => rand(1, $doctorsCount),
            ]);
        }
    }
}