<?php

namespace App\Repositories;

use App\Models\JournalEntry;
use App\Models\Prompt;
use App\Models\User;

class JournalRepository
{
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
            ['created_at', '<=', $entry ? $entry->created_at->subDay()->toDateString() : now()->subDay()->toDateString()]
        ])->orderByDesc('created_at')->first();

        return $prevEntry ?? $entry;
    }

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

    public function getRandomJournalingPrompt(): Prompt
    {
        $prompt = Prompt::inRandomOrder()->first();
        return $prompt;
    }

    public function getUserLastJournalEntry(User $user): JournalEntry|null
    {
        $entry = JournalEntry::where([
                ['user_id', '=', $user->id],
                ['updated_at', '<=', now()->subDay()->toDateString()]
            ])->with(['prompt'])->orderByDesc('updated_at')->first();

        return $entry;
    }

    public function getUserTodayJournalEntry(User $user): JournalEntry|null
    {
        $entry = JournalEntry::where([
                ['user_id', '=', $user->id],
                ['updated_at', 'like', now()->toDateString().'%']
            ])->with(['prompt'])->orderByDesc('updated_at')->first();

        return $entry;
    }
}