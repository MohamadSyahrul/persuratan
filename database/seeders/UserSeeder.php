<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'nik' => '32323232',
            'nama' => 'Holifah',
            'email' => 'holifahaja@gmail.com',
            'password' => Hash::make('12345678'),
            'level' => 'admin'
        ]);

        User::create([
            'nik' => '433282',
            'nama' => 'user',
            'email' => 'iser@gmail.com',
            'password' => Hash::make('12345678'),
            'level' => 'user'
        ]);
    }
}
