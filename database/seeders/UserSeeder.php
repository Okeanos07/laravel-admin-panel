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

        
            $roleBlog = Role::Create(
            [
                'name' =>'blog-yoneticisi',
                'title' => 'Blog Yöneticisi,',
                'description' => 'Blog yönetimini sağlar',
            ]);

            $roleECommerce = Role::Create(
            [
                'name' =>'e-ticaret-yoneticisi',
                'title' => 'E-Ticaret Yöneticisi,',
                'description' => 'E-Ticaret yönetimini sağlar',
            ]);


        $user = User::create(
            [
            'name' => 'Hüseyin',
            'email' => 'emir@yildiz.com',
            'password' => bcrypt('12345678'),
        ]);
        $user->assignRole($role);

      if(User::count() == 1){
        $users = User::factory(100)->create();
        foreach ($users as $user) {
            $user->assignRole(rand(0, 1) == 1 ? $roleBlog : $roleECommerce);
        }
      }
    }
}
