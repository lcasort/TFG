<?php

namespace Database\Seeders;

use App\Models\InspirationalQuote;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InspirationalQuoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $iq1 = new InspirationalQuote();
        $iq1->title = 'Your potential is endless. Go do what you were created to do.';
        $iq1->body = null;
        $iq1->save();

        $iq2 = new InspirationalQuote();
        $iq2->title = 'I can and I will. Watch me.';
        $iq2->body = null;
        $iq2->save();

        $iq3 = new InspirationalQuote();
        $iq3->title = 'You already have what it takes.';
        $iq3->body = null;
        $iq3->save();

        $iq4 = new InspirationalQuote();
        $iq4->title = 'Purpose fuels passion.';
        $iq4->body = null;
        $iq4->save();

        $iq5 = new InspirationalQuote();
        $iq5->title = 'Strive for progress not perfection.';
        $iq5->body = null;
        $iq5->save();

        $iq6 = new InspirationalQuote();
        $iq6->title = 'There is no failure, you either win or learn.';
        $iq6->body = null;
        $iq6->save();
    }
}
