<?php

namespace Database\Seeders;

use App\Models\WeekDay;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'permission-list',
            'permission-create',
            'permission-edit',
            'permission-delete',
            'book-list',
            'book-create',
            'book-edit',
            'book-delete',
            'author-list',
            'author-create',
            'author-edit',
            'author-delete',
            'publisher-list',
            'publisher-create',
            'publisher-edit',
            'publisher-delete',

        ];

        foreach($data as $permission){
            Permission::create(['name' => $permission]);
        }

//        $data = ['monday' , 'tuesday' , 'wednesday' , 'thursday' , 'friday' , 'saturday' , 'sunday'];
//
//        foreach($data as $permission){
//            WeekDay::create(['name' => $permission]);
//        }
    }
}
