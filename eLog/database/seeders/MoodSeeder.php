<?php

namespace Database\Seeders;

use App\Models\Mood;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /*
        |-----------------------------------------------------------------------
        | TRUST
        |-----------------------------------------------------------------------
        */
        $peaceful = new Mood;
        $peaceful->name = 'peaceful';
        $peaceful->key = 'trust';
        $peaceful->color = '#50C878';
        $peaceful->emoji = '/img/moods/peaceful.png';
        $peaceful->save();

        $hopeful = new Mood;
        $hopeful->name = 'hopeful';
        $hopeful->key = 'trust';
        $hopeful->color = '#228B22';
        $hopeful->emoji = '/img/moods/hopeful.png';
        $hopeful->save();


        /*
        |-----------------------------------------------------------------------
        | FEAR
        |-----------------------------------------------------------------------
        */
        $cautious = new Mood;
        $cautious->name = 'cautious';
        $cautious->key = 'fear';
        $cautious->color = '#D3D3D3';
        $cautious->emoji = '/img/moods/cautious.png';
        $cautious->save();

        $anxious = new Mood;
        $anxious->name = 'anxious';
        $anxious->key = 'fear';
        $anxious->color = '#A9A9A9';
        $anxious->emoji = '/img/moods/anxious.png';
        $anxious->save();


        /*
        |-----------------------------------------------------------------------
        | SURPRISE
        |-----------------------------------------------------------------------
        */
        $confused = new Mood;
        $confused->name = 'confused';
        $confused->key = 'surprise';
        $confused->color = '#F8C8DC';
        $confused->emoji = '/img/moods/confused.png';
        $confused->save();

        $amazed = new Mood;
        $amazed->name = 'amazed';
        $amazed->key = 'surprise';
        $amazed->color = '#FF69B4';
        $amazed->emoji = '/img/moods/amazed.png';
        $amazed->save();


        /*
        |-----------------------------------------------------------------------
        | SAD
        |-----------------------------------------------------------------------
        */
        $hurt = new Mood;
        $hurt->name = 'hurt';
        $hurt->key = 'sad';
        $hurt->color = '#0047AB';
        $hurt->emoji = '/img/moods/hurt.png';
        $hurt->save();

        $unhappy = new Mood;
        $unhappy->name = 'unhappy';
        $unhappy->key = 'sad';
        $unhappy->color = '#89CFF0';
        $unhappy->emoji = '/img/moods/unhappy.png';
        $unhappy->save();


        /*
        |-----------------------------------------------------------------------
        | DISGUST
        |-----------------------------------------------------------------------
        */
        $pissed = new Mood;
        $pissed->name = 'pissed';
        $pissed->key = 'disgust';
        $pissed->color = '#F0CEFF';
        $pissed->emoji = '/img/moods/pissed.png';
        $pissed->save();

        $indifferent = new Mood;
        $indifferent->name = 'indifferent';
        $indifferent->key = 'disgust';
        $indifferent->color = '#CA8DFD';
        $indifferent->emoji = '/img/moods/indifferent.png';
        $indifferent->save();


        /*
        |-----------------------------------------------------------------------
        | ANGER
        |-----------------------------------------------------------------------
        */
        $frustrated = new Mood;
        $frustrated->name = 'frustrated';
        $frustrated->key = 'anger';
        $frustrated->color = '#F0CEFF';
        $frustrated->emoji = '/img/moods/frustrated.png';
        $frustrated->save();

        $angry = new Mood;
        $angry->name = 'angry';
        $angry->key = 'anger';
        $angry->color = '#CA8DFD';
        $angry->emoji = '/img/moods/angry.png';
        $angry->save();


        /*
        |-----------------------------------------------------------------------
        | ANTICIPATION
        |-----------------------------------------------------------------------
        */
        $eager = new Mood;
        $eager->name = 'eager';
        $eager->key = 'anticipation';
        $eager->color = '#FF7518';
        $eager->emoji = '/img/moods/eager.png';
        $eager->save();

        $interested = new Mood;
        $interested->name = 'interested';
        $interested->key = 'anticipation';
        $interested->color = '#FFA500';
        $interested->emoji = '/img/moods/interested.png';
        $interested->save();

        /*
        |-----------------------------------------------------------------------
        | HAPPY
        |-----------------------------------------------------------------------
        */
        $confident = new Mood;
        $confident->name = 'confident';
        $confident->key = 'happy';
        $confident->color = '#FFFAA0';
        $confident->emoji = '/img/moods/confident.png';
        $confident->save();

        $joyful = new Mood;
        $joyful->name = 'joyful';
        $joyful->key = 'happy';
        $joyful->color = '#FCF55F';
        $joyful->emoji = '/img/moods/joyful.png';
        $joyful->save();
    }
}
