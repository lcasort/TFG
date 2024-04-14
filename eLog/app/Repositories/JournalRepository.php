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
            ['created_at', '<', $entry ? $entry->created_at->toDateString() : now()->toDateString()]
        ])->orderByDesc('created_at')->firstOrFail();

        return $prevEntry;
    }
}