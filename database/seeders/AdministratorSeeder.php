<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdministratorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new User();
        $admin->name = 'Site Administrator';
        $admin->email = 'admin@performance-assessment.test';
        $admin->password = Hash::make('admin1234');
        $admin->division_id = '1';
        $admin->id_number = '-';
        $admin->gender = 'male';
        $admin->role = 'director';
        $admin->status = 'active';

        $admin->save();
        $this->command->info('User successfully added.');
    }
}
