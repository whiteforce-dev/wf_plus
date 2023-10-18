<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'parent_id' => null,
            'name' => 'Admin',
            'email' => 'admin@white-force.com',
            'password' => Hash::make('12345678'),
            'contact' => '9876543210',
            'software_category' => null,
            'role' => 'admin'
        ];
        User::create($data);
        return 1;
    }
}
