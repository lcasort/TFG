<?php

namespace Database\Seeders;

use App\Models\Prompt;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PromptSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $p1 = new Prompt();
        $p1->text = "Things that inspire you";
        $p1->type = "list";
        $p1->save();

        $p2 = new Prompt();
        $p2->text = "Things that you are grateful for";
        $p2->type = "list";
        $p2->save();

        $p3 = new Prompt();
        $p3->text = "Possitive affirmations about your body";
        $p3->type = "list";
        $p3->save();

        $p4 = new Prompt();
        $p4->text = "Letter to yourself";
        $p4->type = "letter";
        $p4->save();

        $p5 = new Prompt();
        $p5->text = "Letter to your past self";
        $p5->type = "letter";
        $p5->save();

        $p6 = new Prompt();
        $p6->text = "Letter to your future self";
        $p6->type = "letter";
        $p6->save();

        $p7 = new Prompt();
        $p7->text = "What is a challange you've overcome?";
        $p7->type = "past";
        $p7->save();

        $p8 = new Prompt();
        $p8->text = "What have you changed in the past year?";
        $p8->type = "past";
        $p8->save();

        $p9 = new Prompt();
        $p9->text = "Is there anything you regret?";
        $p9->type = "past";
        $p9->save();

        $p10 = new Prompt();
        $p10->text = "What are the small things that make you happy?";
        $p10->type = "present";
        $p10->save();

        $p11 = new Prompt();
        $p11->text = "What do I need to get off my chest?";
        $p11->type = "present";
        $p11->save();

        $p12 = new Prompt();
        $p12->text = "How do you feel in this moment?";
        $p12->type = "present";
        $p12->save();

        $p13 = new Prompt();
        $p13->text = "Where do you want to be a year from now";
        $p13->type = "future";
        $p13->save();

        $p14 = new Prompt();
        $p14->text = "What is a dream you hope for?";
        $p14->type = "future";
        $p14->save();

        $p15 = new Prompt();
        $p15->text = "Picture your future self. How do they live and feel?";
        $p15->type = "future";
        $p15->save();
    }
}
