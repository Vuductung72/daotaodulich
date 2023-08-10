<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Expert;
class ExpertsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Expert::query()->update(['social_network' => '{"facebook":null,"tiktok":null,"zalo":null}']);
    }
}
