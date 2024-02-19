<?php

namespace Database\Seeders;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = Role::create(
        [
            'name' =>'yonetici',
            'title' => 'Yönetici',
            'description' => 'Sitenin genel yönetimini sağlar',
        ]);

        $user = User::create(
            [
            'name' => 'Hüseyin',
            'email' => 'emir@yildiz.com',
            'password' => bcrypt('12345678'),
        ]);
        $user->assignRole($role);

        User::factory(100)->create();
    }
}
