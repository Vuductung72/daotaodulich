<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Profession;
class ProfessionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $professions = Profession::all();
        foreach($professions as $key => $profession){
            $profession->update(['profession_code' => "NN00$key"]);
        }
    }
}
