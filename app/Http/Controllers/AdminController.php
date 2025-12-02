<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\User;
use App\Models\Pack;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $openTickets = Ticket::where('status', 'open')->count();
        $totalTickets = Ticket::count();
        $totalClients = User::where('role', 'client')->count();
        $recentTickets = Ticket::with('user')->latest()->take(5)->get();

        return view('admin.dashboard', compact('openTickets', 'totalTickets', 'totalClients', 'recentTickets'));
    }

    public function tickets()
    {
        $tickets = Ticket::with('user')->latest()->paginate(10);
        return view('admin.tickets.index', compact('tickets'));
    }

    public function showTicket(Ticket $ticket)
    {
        $ticket->load('messages.user', 'user.pack');
        return view('admin.tickets.show', compact('ticket'));
    }

    public function updateTicketStatus(Request $request, Ticket $ticket)
    {
        $request->validate([
            'status' => 'required|in:open,in_progress,closed',
        ]);

        $ticket->update(['status' => $request->status]);

        return back()->with('status', 'Ticket status updated.');
    }

    public function storeTicketMessage(Request $request, Ticket $ticket)
    {
        $request->validate([
            'message' => 'required|string',
            'is_internal' => 'boolean',
        ]);

        $ticket->messages()->create([
            'user_id' => auth()->id(),
            'message' => $request->message,
            'is_internal' => $request->boolean('is_internal'),
        ]);

        return back()->with('status', 'Message sent.');
    }

    public function clients()
    {
        $clients = User::where('role', 'client')->with('pack')->latest()->paginate(10);
        return view('admin.clients.index', compact('clients'));
    }

    public function showClient(User $client)
    {
        $packs = Pack::all();
        $tickets = $client->tickets()->latest()->get();
        return view('admin.clients.show', compact('client', 'packs', 'tickets'));
    }

    public function updateClientPack(Request $request, User $client)
    {
        $request->validate([
            'pack_id' => 'nullable|exists:packs,id',
        ]);

        $client->update(['pack_id' => $request->pack_id]);

        return back()->with('status', 'Client pack updated.');
    }

    public function generateAiReply(\App\Models\Ticket $ticket, \App\Services\AIService $aiService)
    {
        $draft = $aiService->generateDraftReply($ticket);

        if ($draft) {
            $ticket->update(['ai_draft_reply' => $draft]);
            return back()->with('status', 'AI draft generated successfully.');
        }

        return back()->withErrors(['ai_error' => 'Failed to generate AI response. Please check logs or API key.']);
    }
}
