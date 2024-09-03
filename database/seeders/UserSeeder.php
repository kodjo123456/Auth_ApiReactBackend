<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void


    {
        //php artisan db:seed --class=userSeeder pour faire entrer les données dans le db

        User::factory()->create([
            'name' => 'amele',
            'email' => 'amelealaglo@gmail.com',
            'password' => 'amele1234',
        ]);
    }
}
