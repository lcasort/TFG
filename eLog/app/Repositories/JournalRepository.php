<?php

namespace App\Repositories;

use App\Models\JournalEntry;
use App\Models\User;

class JournalRepository
{
    public function getPreviousJournalEntry(User $user, int $entryId): JournalEntry
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
        ]);

        if($entry->first()) {
            $entry->update([
                "prompt_id" => $data['prompt_id'] ?? null,
                "title" => $data['title'],
                "text" => $data['text']
            ]);
        } else {
            JournalEntry::create([
                "user_id" => $user->id,
                "prompt_id" => $data['prompt_id'] ?? null,
                "title" => $data['title'],
                "text" => $data['text']
            ]);
        }
    }
}