<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $tickets = Ticket::where('user_id', $user->id)->latest()->take(5)->get();
        $pack = $user->pack;

        return view('dashboard', compact('user', 'tickets', 'pack'));
    }
}
