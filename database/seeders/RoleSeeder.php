<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\UserRole;
class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = ['admin','customer', 'vendor'];

        foreach ($roles as $roleName) {
            Role::firstOrCreate(['name' => $roleName,'slug' => $roleName]);
        }

        UserRole::create([
            'user_id' => 1,
            'role_id' => 1
        ]);

        $this->command->info('Roles seeded: ' . implode(', ', $roles));
    }
}
