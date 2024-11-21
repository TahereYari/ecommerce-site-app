<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = Role::where('name','admin')->first();
        $user = User::query()->create([
            'name' => 'admin',
                'email' => 'admin@mail.com',
                'password' => bcrypt('admin12'),
                'role'=> 'admin',
                'tel' =>'12345678910',
                'national_code' =>'12345678910',

               
           ]);

           $user->assignRole($role);
    }
}
