<?php

namespace App\Repositories;

use App\Models\JournalEntry;
use App\Models\Prompt;
use App\Models\User;

class JournalRepository
{    
    /**
     * Returns the user's previous journal entry to the current one.
     * If it doesn't exist, it returns null.
     *
     * @param  User $user
     * @param  int $entryId
     * @return JournalEntry|null
     */
    public function getPreviousJournalEntry(User $user, int $entryId): JournalEntry|null
    {
        $entry = null;
        if ($entryId !== 0) {
            $entry = JournalEntry::where([
                ['id', '=', $entryId],
                ['user_id', '=', $user->id]
            ])->firstOrFail();
        }

        $prevEntry = JournalEntry::where([
            ['user_id', '=', $user->id],
            ['created_at', '<=', $entry ? $entry->created_at->toDateString() : now()->toDateString()]
        ])->orderByDesc('created_at')->first();

        return $prevEntry ?? $entry;
    }
    
    /**
     * Returns the user's next journal entry to the current one.
     * If it doesn't exist, it returns null.
     *
     * @param  User $user
     * @param  int $entryId
     * @return JournalEntry
     */
    public function getNextJournalEntry(User $user, int $entryId): JournalEntry|null
    {
        $entry = null;
        if ($entryId !== 0) {
            $entry = JournalEntry::where([
                ['id', '=', $entryId],
                ['user_id', '=', $user->id]
            ])->firstOrFail();
        }

        $nextEntry = JournalEntry::where([
            ['user_id', '=', $user->id],
            ['created_at', '>=', $entry ? $entry->created_at->addDay()->toDateString() : now()->addDay()->toDateString()]
        ])->orderBy('created_at')->firstOrFail();

        return $nextEntry;
    }
    
    /**
     * Save today's journal entry for the authenticated user.
     *
     * @param  User $user
     * @param  array $data
     * @return void
     */
    public function saveUserJournalEntryToday(User $user, array $data): void
    {
        $entry = JournalEntry::where([
            ['user_id', '=', $user->id],
            ['created_at', 'like', now()->toDateString() . '%']
        ])->first();

        if(is_null($entry))
        {
            JournalEntry::create([
                "user_id" => $user->id,
                "prompt_id" => $data['prompt_id'] ?? null,
                "title" => $data['title'],
                "text" => $data['text']
            ]);
        }
    }
    
    /**
     * Update today's journal entry for the authenticated user.
     *
     * @param  User $user
     * @param  array $data
     * @return void
     */
    public function updateUserJournalEntryToday(User $user, array $data): void
    {
        $entry = JournalEntry::where([
            ['user_id', '=', $user->id],
            ['created_at', 'like', now()->toDateString() . '%']
        ])->firstOrFail();

        $entry->update([
            "prompt_id" => $data['prompt_id'] ?? null,
            "title" => $data['title'],
            "text" => $data['text']
        ]);
    }
    
    /**
     * Returns a random journaling prompt.
     *
     * @return Prompt
     */
    public function getRandomJournalingPrompt(): Prompt
    {
        $prompt = Prompt::inRandomOrder()->first();
        return $prompt;
    }
    
    /**
     * Returns user's journal entry for today if it exists.
     * If it doesn't, it returns null.
     *
     * @param  User $user
     * @return JournalEntry
     */
    public function getUserTodayJournalEntry(User $user): JournalEntry|null
    {
        $entry = JournalEntry::where([
                ['user_id', '=', $user->id],
                ['updated_at', 'like', now()->toDateString().'%']
            ])->with(['prompt'])->orderByDesc('updated_at')->first();

        return $entry;
    }
}