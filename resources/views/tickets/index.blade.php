<x-app-layout>
    <x-slot name="header">
        My Tickets
    </x-slot>

    <div class="bg-[#1E1E2D] rounded-xl shadow-lg border border-[#2B2B40]">
        <div class="p-6 border-b border-[#2B2B40] flex justify-between items-center">
            <div>
                <h3 class="text-lg font-bold text-white">All Support Tickets</h3>
                <p class="text-[#92929f] text-sm mt-1">Manage and track your requests</p>
            </div>
            <a href="{{ route('tickets.create') }}" class="px-4 py-2 bg-[#3699FF] hover:bg-[#0073E9] text-white rounded-lg font-medium transition-colors flex items-center">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                New Ticket
            </a>
        </div>

        <div class="p-6">
            @if($tickets->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="text-left text-[#92929f] text-xs font-bold uppercase tracking-wider border-b border-[#2B2B40]">
                                <th class="pb-4 pl-4">Ticket ID</th>
                                <th class="pb-4">Subject</th>
                                <th class="pb-4">Status</th>
                                <th class="pb-4">Last Updated</th>
                                <th class="pb-4 text-right pr-4">Action</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm">
                            @foreach($tickets as $ticket)
                                <tr class="border-b border-[#2B2B40] last:border-0 hover:bg-[#2B2B40]/50 transition-colors">
                                    <td class="py-4 pl-4 font-medium text-white">#{{ $ticket->id }}</td>
                                    <td class="py-4">
                                        <div class="text-white font-medium">{{ $ticket->category }}</div>
                                        <div class="text-[#92929f] text-xs mt-1 truncate max-w-xs">{{ Str::limit($ticket->description, 50) }}</div>
                                    </td>
                                    <td class="py-4">
                                        <span class="px-3 py-1 rounded-lg text-xs font-bold uppercase tracking-wider
                                            {{ $ticket->status === 'open' ? 'bg-[#F6C000]/10 text-[#F6C000]' : '' }}
                                            {{ $ticket->status === 'closed' ? 'bg-gray-500/10 text-gray-400' : '' }}
                                            {{ $ticket->status === 'in_progress' ? 'bg-[#3699FF]/10 text-[#3699FF]' : '' }}">
                                            {{ str_replace('_', ' ', $ticket->status) }}
                                        </span>
                                    </td>
                                    <td class="py-4 text-[#92929f]">{{ $ticket->updated_at->diffForHumans() }}</td>
                                    <td class="py-4 text-right pr-4">
                                        <a href="{{ route('tickets.show', $ticket) }}" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-[#2B2B40] text-[#92929f] hover:text-white hover:bg-[#3699FF] transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-4">
                    {{ $tickets->links() }}
                </div>
            @else
                <div class="text-center py-12">
                    <div class="w-16 h-16 bg-[#2B2B40] rounded-full flex items-center justify-center mx-auto mb-4 text-[#92929f]">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                    </div>
                    <h3 class="text-lg font-bold text-white mb-2">No tickets found</h3>
                    <p class="text-[#92929f] mb-6">You haven't created any support tickets yet.</p>
                    <a href="{{ route('tickets.create') }}" class="px-6 py-2 bg-[#3699FF] hover:bg-[#0073E9] text-white rounded-lg font-medium transition-colors">Create Ticket</a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
