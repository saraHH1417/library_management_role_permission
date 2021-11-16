<?php

namespace Database\Seeders;

use App\RoleSpatie;
use Database\Factories\RoleSpatieFactory;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRole = RoleSpatie::factory()->adminRole()->create();
        $creatorRole = RoleSpatie::factory()->creatorRole()->create();
        $auditorRole = RoleSpatie::factory()->auditorRole()->create();
        $deleterRole = RoleSpatie::factory()->deleterRole()->create();

    }
}
