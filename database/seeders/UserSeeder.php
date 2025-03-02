<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Silber\Bouncer\BouncerFacade;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (User::first())
            return;
        $superAdmin = User::firstOrCreate(['email' => 'info@codeweb.com'], [
            'name' => 'super admin',
            'password' => '123456789',
        ]);
        BouncerFacade::allow($superAdmin)->everything();
    }
}
