<?php

namespace Database\Factories;

use App\RoleSpatie;
use Illuminate\Database\Eloquent\Factories\Factory;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSpatieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name
        ];
    }

    public function adminRole()
    {
        return $this->state([
            'name' => 'admin'
        ]);
    }
    public function deleterRole()
    {
        return $this->state([
            'name' => 'deleter'
        ]);
    }
    public function creatorRole()
    {
        return $this->state([
            'name' => 'creator'
        ]);
    }
    public function auditorRole()
    {
        return $this->state([
            'name' => 'auditor'
        ]);
    }

    public function configure()
    {
        return $this->afterCreating(function(Role $role){

            if($role->name === 'admin'){
                $permissions = Permission::all()
                    ->pluck('name' , 'id');
                $role->syncPermissions($permissions);

            }else if($role->name === 'creator'){
                $permissions = Permission::where('name' , 'LIKE' , '%-create')
                    ->orwhere('name' , 'LIKE' , '%-list')
                    ->pluck('name' , 'id');;
                $role->syncPermissions($permissions);

            }else if($role->name === 'auditor'){
                $permissions = Permission::where('name' , 'LIKE' , '%-edit')
                    ->orwhere('name' , 'LIKE' , '%-list')
                    ->pluck('name' , 'id');;
                $role->syncPermissions($permissions);

            }else if($role->name === 'deleter'){
                $permissions = Permission::where('name' , 'LIKE' , '%-delete')
                    ->orwhere('name' , 'LIKE' , '%-list')
                    ->pluck('name' , 'id');;
                $role->syncPermissions($permissions);
            }
        });
    }



}
