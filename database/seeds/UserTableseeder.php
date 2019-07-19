<?php
use Illuminate\Database\Seeder;
use Carbon\Carbon;
class UserTableseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
                'name' => 'Supper',
                'email' => 'admin@admin.com',
                'password' => bcrypt('12345678'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'img'=>'2019-07-19-04-16-22-profile.jpg',
            ]
        ];
        DB::table('users')->insert($user);

        $permissions = [
            [
                'id' => '1',
                'name' => 'role-list',
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => '2',
                'name' => 'role-create',
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => '3',
                'name' => 'role-edit',
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => '4',
                'name' => 'role-delete',
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => '9',
                'name' => 'user-list',
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => '10',
                'name' => 'user-create',
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => '11',
                'name' => 'user-edit',
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => '12',
                'name' => 'user-delete',
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];
        DB::table('permissions')->insert($permissions);

//
        $role_has_permissions = [
            [
                'permission_id' => '1',
                'role_id'=>'1',
            ],
            [
                'permission_id' => '2',
                'role_id'=>'1',
            ],
            [
                'permission_id' => '3',
                'role_id'=>'1',
            ],
            [
                'permission_id' => '4',
                'role_id'=>'1',
            ],
            [
                'permission_id' => '9',
                'role_id'=>'1',
            ],
            [
                'permission_id' => '10',
                'role_id'=>'1',
            ],
            [
                'permission_id' => '11',
                'role_id'=>'1',
            ],
            [
                'permission_id' => '12',
                'role_id'=>'1',
            ],
        ];
        DB::table('role_has_permissions')->insert($role_has_permissions);
    }
}
