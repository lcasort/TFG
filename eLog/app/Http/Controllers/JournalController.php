<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JournalController extends Controller
{
    public function list()
    {
        // TODO: Get all journal entries.
        // Add another null espace for today's entry if there's not an entry for
        // today yet.
        return view('journal');
    }

    public function view()
    {
        // TODO: Get a specific journal entry (by id).
    } 

    public function save()
    {
        // TODO: Save today's journal entry.
    }
}
