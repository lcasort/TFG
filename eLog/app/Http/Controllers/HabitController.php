<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HabitController extends Controller
{
    public function list()
    {
        // TODO: Get all habits and entries for the month.
        return view('habits');
    }

    public function save()
    {
        // TODO: Save today's habit log.
    }

    public function delete()
    {
        // TODO: Detele today's habit elog.
    }
}
