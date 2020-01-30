<?php

use Illuminate\Database\Seeder;
use App\User;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = User::firstOrNew(['email' => 'admin@admin.com']);
        $user->fill([
            'name' => "Admin",
            'email' => "admin@admin.com",
            'id' => 1,
            'email_verified_at' => Carbon::now(),
            'password' => bcrypt('123456')
        ])->save();
        $user = User::firstOrNew(['email' => 'user1@users.com']);
        $user->fill([
            'name' => "User 1",
            'email' => "user1@user.com",
            'id' => 2,
            'email_verified_at' => Carbon::now(),
            'password' => bcrypt('123456')
        ])->save();

        $user = User::firstOrNew(['email' => 'user2@users.com']);
        $user->fill([
            'name' => "User 2",
            'email' => "user2@users.com",
            'id' => 3,
            'email_verified_at' => Carbon::now(),
            'password' => bcrypt('123456')
        ])->save();
    }
}
