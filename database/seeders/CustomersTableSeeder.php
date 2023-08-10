<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;


class CustomersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $customers = Customer::all();
        foreach ($customers as $customer) {
            $customer->slug = Str::slug($customer->fullname,'-');
            $customer->save();
        }
    }
}
