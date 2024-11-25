<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ojb = new Admin();
        $ojb->name = 'Admin';
        $ojb->email = 'admin@gmail.com';
        $ojb->password = Hash::make('trongyb123');
        $ojb->save();
    }
}
