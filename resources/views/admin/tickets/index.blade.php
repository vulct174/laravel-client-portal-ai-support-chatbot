<x-app-layout>
    <x-slot name="header">
        All Tickets
    </x-slot>

    <div class="bg-[#1E1E2D] rounded-xl shadow-lg border border-[#2B2B40]">
        <div class="p-6 border-b border-[#2B2B40] flex justify-between items-center">
            <div>
                <h3 class="text-lg font-bold text-white">Ticket Management</h3>
                <p class="text-[#92929f] text-sm mt-1">View and manage all client support requests</p>
            </div>
            <div class="flex gap-2">
                <!-- Filter Mock -->
                <button class="px-4 py-2 bg-[#2B2B40] hover:bg-[#323248] text-[#92929f] hover:text-white rounded-lg font-medium transition-colors flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                    Filter
                </button>
            </div>
        </div>

        <div class="p-6">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="text-left text-[#92929f] text-xs font-bold uppercase tracking-wider border-b border-[#2B2B40]">
                            <th class="pb-4 pl-4">ID</th>
                            <th class="pb-4">Client</th>
                            <th class="pb-4">Category</th>
                            <th class="pb-4">Status</th>
                            <th class="pb-4">Created</th>
                            <th class="pb-4 text-right pr-4">Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm">
                        @foreach($tickets as $ticket)
                            <tr class="border-b border-[#2B2B40] last:border-0 hover:bg-[#2B2B40]/50 transition-colors">
                                <td class="py-4 pl-4 font-medium text-white">#{{ $ticket->id }}</td>
                                <td class="py-4">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 rounded-lg bg-[#3699FF]/20 flex items-center justify-center text-[#3699FF] font-bold mr-3">
                                            {{ substr($ticket->user->first_name, 0, 1) }}
                                        </div>
                                        <div>
                                            <a href="{{ route('admin.clients.show', $ticket->user) }}" class="text-white font-medium hover:text-[#3699FF] transition-colors">
                                                {{ $ticket->user->first_name }} {{ $ticket->user->last_name }}
                                            </a>
                                            <div class="text-[#92929f] text-xs">{{ $ticket->user->company ?? 'No Company' }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-4 text-[#92929f]">{{ $ticket->category }}</td>
                                <td class="py-4">
                                    <span class="px-3 py-1 rounded-lg text-xs font-bold uppercase tracking-wider
                                        {{ $ticket->status === 'open' ? 'bg-[#F6C000]/10 text-[#F6C000]' : '' }}
                                        {{ $ticket->status === 'closed' ? 'bg-gray-500/10 text-gray-400' : '' }}
                                        {{ $ticket->status === 'in_progress' ? 'bg-[#3699FF]/10 text-[#3699FF]' : '' }}">
                                        {{ str_replace('_', ' ', $ticket->status) }}
                                    </span>
                                </td>
                                <td class="py-4 text-[#92929f]">{{ $ticket->created_at->format('M d, Y') }}</td>
                                <td class="py-4 text-right pr-4">
                                    <a href="{{ route('admin.tickets.show', $ticket) }}" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-[#2B2B40] text-[#92929f] hover:text-white hover:bg-[#3699FF] transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
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
        </div>
    </div>
</x-app-layout>
