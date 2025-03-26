<?php

namespace Database\Seeders;
  
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use App\User;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::updateOrCreate(['name' => 'add patient']);
        Permission::updateOrCreate(['name' => 'view patient']);
        Permission::updateOrCreate(['name' => 'edit patient']);
        Permission::updateOrCreate(['name' => 'view all patients']);
        Permission::updateOrCreate(['name' => 'delete patient']);

        Permission::updateOrCreate(['name' => 'create health history']);
        Permission::updateOrCreate(['name' => 'delete health history']);

        Permission::updateOrCreate(['name' => 'add medical files']);
        Permission::updateOrCreate(['name' => 'delete medical files']);


        Permission::updateOrCreate(['name' => 'create appointment']);
        Permission::updateOrCreate(['name' => 'view all appointments']);
        Permission::updateOrCreate(['name' => 'delete appointment']);
        Permission::updateOrCreate(['name' => 'edit appointment']);

        Permission::updateOrCreate(['name' => 'create prescription']);
        Permission::updateOrCreate(['name' => 'view prescription']);
        Permission::updateOrCreate(['name' => 'view all prescriptions']);
        Permission::updateOrCreate(['name' => 'edit prescription']);
        Permission::updateOrCreate(['name' => 'delete prescription']);
        Permission::updateOrCreate(['name' => 'print prescription']);


        Permission::updateOrCreate(['name' => 'create drug']);
        Permission::updateOrCreate(['name' => 'edit drug']);
        Permission::updateOrCreate(['name' => 'view drug']);
        Permission::updateOrCreate(['name' => 'delete drug']);
        Permission::updateOrCreate(['name' => 'view all drugs']);

        Permission::updateOrCreate(['name' => 'create diagnostic test']);
        Permission::updateOrCreate(['name' => 'edit diagnostic test']);
        Permission::updateOrCreate(['name' => 'view all diagnostic tests']);
        Permission::updateOrCreate(['name' => 'delete diagnostic test']);

        Permission::updateOrCreate(['name' => 'create invoice']);
        Permission::updateOrCreate(['name' => 'edit invoice']);
        Permission::updateOrCreate(['name' => 'view invoice']);
        Permission::updateOrCreate(['name' => 'view all invoices']);
        Permission::updateOrCreate(['name' => 'delete invoice']);
        Permission::updateOrCreate(['name' => 'print invoice']);

        Permission::updateOrCreate(['name' => 'view all expenses']);
        Permission::updateOrCreate(['name' => 'create expense']);
        Permission::updateOrCreate(['name' => 'edit expense']);
        Permission::updateOrCreate(['name' => 'delete expense']);

        Permission::updateOrCreate(['name' => 'manage settings']);
        Permission::updateOrCreate(['name' => 'manage roles']);

        Permission::updateOrCreate(['name' => 'manage waiting room']);

        $role1 = Role::updateOrCreate(['name' => 'Admin']);
        $role2 = Role::updateOrCreate(['name' => 'Patient']);
        $role3 = Role::updateOrCreate(['name' => 'Receptionist']);

        $role1->givePermissionTo(Permission::all());

        $user = User::create([
            'name' => 'Doctorino',
            'email' => 'doctor@getdoctorino.com',
            'password' => Hash::make('doctorino'),
            'role' => 'staff',
        ]);

        $user->assignRole($role1);

    }
}
