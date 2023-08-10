<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use Illuminate\Support\Str;
class LessonsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $lessons = Lesson::all();
        foreach($lessons as $lesson ){
            $lesson->slug = Str::slug($lesson->name,'-');
            $lesson->save();
        }
    }
}
