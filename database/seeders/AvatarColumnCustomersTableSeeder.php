<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer;
class AvatarColumnCustomersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $customers = Customer::all();
        foreach($customers as $customer ){
            $customer->avatar = env('USER_NO_IMAGE');
            $customer->save();
        }
    }
}
