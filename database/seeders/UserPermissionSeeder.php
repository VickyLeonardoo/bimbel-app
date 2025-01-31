<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Role::create([
            'name' => 'admin',
        ]);

        $instructor = Role::create([
            'name' => 'instructor',
        ]);

        $client = Role::create([
            'name' => 'client',
        ]);

        //Admin
        $userAdmin = User::create([
            'name' => 'Christian',
            'email' => 'admin@example.com',
            'password' => bcrypt('123'),
            'email_verified_at' => '2021-01-01 00:00:00',
        ]);

        $userInstructor = User::create([
            'name' => 'John Doe',
            'email' => 'instructor@example.com',
            'password' => bcrypt('123'),
            'email_verified_at' => '2021-01-01 00:00:00',
        ]);

        $userClient = User::create([
            'name' => 'Fedro',
            'email' => 'user1@example.com',
            'password' => bcrypt('123'),
            'email_verified_at' => '2021-01-01 00:00:00',
        ]);

        $userAdmin->assignRole($admin);
        $userInstructor->assignRole($instructor);
        $userClient->assignRole($client);
       
    }
}
