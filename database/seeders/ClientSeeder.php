<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('clients')->insert([
            'full_name' => Str::random(10),
            'email' => 'yaroshjeka@gmail.com',
            'phone' => '+380983515111',
            'password' => Hash::make('client'),
        ]);
    }
}
