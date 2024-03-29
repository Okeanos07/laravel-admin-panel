<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

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
        
            $roleBlog = Role::create(
            [
                'name' =>'blog-yoneticisi',
                'title' => 'Blog Yöneticisi,',
                'description' => 'Blog yönetimini sağlar',
            ]);



            $roleECommerce = Role::create(
            [
                'name' =>'e-ticaret-yoneticisi',
                'title' => 'E-Ticaret Yöneticisi,',
                'description' => 'E-Ticaret yönetimini sağlar',
            ]);

            $permissions['blog-yoneticisi'] = [
                [
                    'title' => 'Yazıları Görüntüleyebilir',
                    'description' => 'Tüm yazıları görüntüleyebilir',
                ],
                [
                    'title' => 'Yazıları Düzenleyebilir',
                    'description' => 'Tüm yazıları düzeneyebilir',
                ],
                [
                    'title' => 'Yazı Kategorilerini Görüntüleyebilir',
                    'description' => 'Tüm yazı kategorilerini görüntüleyebilir',
                ],
                [
                    'title' => 'Yazı Kategorilerini Düzenleyebilir',
                    'description' => 'Tüm yazı kategorilerini düzenleyebilir',
                ],
            ];

            $permissions['e-ticaret-yoneticisi'] = [
                [
                    'title' => 'Siparişleri Görüntüleyebilir',
                    'description' => 'Tüm siparişleri görüntüleyebilir',
                ],
                [
                    'title' => 'Siparişleri Düzenleyebilir',
                    'description' => 'Tüm siparişerli düzeneyebilir',
                ],
                [
                    'title' => 'Ürünleri Görüntüleyebilir',
                    'description' => 'Tüm Ürünleri görüntüleyebilir',
                ],
                [
                    'title' => 'Ürünleri Düzenleyebilir',
                    'description' => 'Tüm ürünleri düzenleyebilir',
                ],
            ];

            foreach($permissions as $key => $permission) {
                $role = Role::where('name', $key)->first();

                foreach($permission as $p) {
                    $newPermission = Permission::create(
                        [
                            'name' => Str::slug($p['title']),
                            'title' => $p['title'],
                            'description' => $p['description'],
                        ]
                    );

                    $role->givePermissionTo($newPermission);
                }
            }


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
