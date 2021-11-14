<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        if($this->command->confirm("Do you want to refresh database?" , 'yes')){
            $this->command->call('migrate:refresh');
            $this->command->info('Database has refreshed successfully.');
        }

        $this->call([
            PermissionTableSeeder::class,
            RoleTableSeeder::class,
            UserTableSeeder::class,
            AuthorSeeder::class,
            PublisherSeeder::class,
            BookSeeder::class
        ]);
    }
}
