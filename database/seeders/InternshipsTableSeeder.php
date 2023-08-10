<?php

namespace Database\Seeders;

use App\Models\Internship;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;


class InternshipsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $internships = Internship::all();
        foreach ($internships as $internship) {
            $internship->slug = Str::slug($internship->title,'-');
            $internship->save();
        }
    }
}
