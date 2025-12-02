<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = auth()->user()->tickets()->latest()->paginate(10);
        return view('tickets.index', compact('tickets'));
    }

    public function create()
    {
        return view('tickets.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required|string',
            'impact' => 'required|string',
            'description' => 'required|string',
            'attachments.*' => 'file|mimes:jpg,jpeg,png,pdf,doc,docx|max:2048',
        ]);

        $ticket = auth()->user()->tickets()->create([
            'category' => $request->category,
            'impact' => $request->impact,
            'description' => $request->description,
            'status' => 'open',
        ]);

        if ($request->hasFile('attachments')) {
            $paths = [];
            foreach ($request->file('attachments') as $file) {
                $paths[] = $file->store('attachments', 'public');
            }
            $ticket->attachments = $paths;
            $ticket->save();
        }

        return redirect()->route('dashboard')->with('status', 'Ticket created successfully!');
    }

    public function show(Ticket $ticket)
    {
        if ($ticket->user_id !== auth()->id()) {
            abort(403);
        }
        $ticket->load('messages.user');
        return view('tickets.show', compact('ticket'));
    }
}
