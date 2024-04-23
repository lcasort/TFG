<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        /*
        |-----------------------------------------------------------------------
        | FACTORIES
        |-----------------------------------------------------------------------
        */
        // \App\Models\User::factory(10)->create();

        /*
        |-----------------------------------------------------------------------
        | SEEDERS
        |-----------------------------------------------------------------------
        */
        $this->call(MoodSeeder::class);
        $this->call(InspirationalQuoteSeeder::class);
        $this->call(PromptSeeder::class);
    }
}
