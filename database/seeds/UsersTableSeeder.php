<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\File;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

        $json = File::get('database/data/users.json');
        $users = json_decode($json);

        foreach ($users as $user) {
            User::create([
                'name' => $user->name,
                'email' => $user->email,
                'password' => bcrypt($user->password)
            ]);
        }
    }
}
