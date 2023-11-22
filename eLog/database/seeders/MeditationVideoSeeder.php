<?php

namespace Database\Seeders;

use App\Models\MeditationVideo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MeditationVideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mv1 = new MeditationVideo();
        $mv1->link = 'https://www.youtube.com/watch?v=lS0kcSNlULw';
        $mv1->save();

        $mv2 = new MeditationVideo();
        $mv2->link = 'https://www.youtube.com/watch?v=ci4_qbCrraI';
        $mv2->save();

        $mv3 = new MeditationVideo();
        $mv3->link = 'https://www.youtube.com/watch?v=sG7DBA-mgFY';
        $mv3->save();

        $mv4 = new MeditationVideo();
        $mv4->link = 'https://www.youtube.com/watch?v=nFkHV7LfVUc';
        $mv4->save();

        $mv5 = new MeditationVideo();
        $mv5->link = 'https://www.youtube.com/watch?v=QtE00VP4W3Y';
        $mv5->save();

        $mv6 = new MeditationVideo();
        $mv6->link = 'https://www.youtube.com/watch?v=7Ob1sWh9u2I';
        $mv6->save();
    }
}