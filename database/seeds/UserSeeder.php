<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $admin = User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
            'uid' => Str::uuid()
        ]);

        $user = User::create([
            'name' => 'normal user',
            'email' => 'user@user.com',
            'password' => bcrypt('password'),
            'uid' => Str::uuid()
        ]);
    }
}
