<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
class EmailVerifyColumnUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();
        foreach($users as $user ){
            $user->email_verified = random_int(000000,999999);
            $user->save();
        }
    }
}
