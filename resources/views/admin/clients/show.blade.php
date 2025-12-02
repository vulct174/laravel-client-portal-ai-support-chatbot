<x-app-layout>
    <x-slot name="header">
        Manage Client
    </x-slot>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Client Details & History -->
        <div class="lg:col-span-2 space-y-8">
            <!-- Details Card -->
            <div class="bg-[#1E1E2D] rounded-xl shadow-lg border border-[#2B2B40] p-6">
                <div class="flex items-center mb-6">
                    <div class="w-16 h-16 rounded-xl bg-[#7239EA] flex items-center justify-center text-white text-2xl font-bold mr-4 shadow-lg shadow-indigo-500/20">
                        {{ substr($client->first_name, 0, 1) }}
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-white">{{ $client->first_name }} {{ $client->last_name }}</h3>
                        <p class="text-[#92929f]">{{ $client->email }}</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="p-4 bg-[#2B2B40]/50 rounded-xl border border-[#2B2B40]">
                        <p class="text-[#92929f] text-xs uppercase font-bold mb-1">Company</p>
                        <p class="text-white font-medium">{{ $client->company ?? 'N/A' }}</p>
                    </div>
                    <div class="p-4 bg-[#2B2B40]/50 rounded-xl border border-[#2B2B40]">
                        <p class="text-[#92929f] text-xs uppercase font-bold mb-1">Phone</p>
                        <p class="text-white font-medium">{{ $client->phone ?? 'N/A' }}</p>
                    </div>
                    <div class="p-4 bg-[#2B2B40]/50 rounded-xl border border-[#2B2B40]">
                        <p class="text-[#92929f] text-xs uppercase font-bold mb-1">Language</p>
                        <p class="text-white font-medium">{{ strtoupper($client->language) }}</p>
                    </div>
                    <div class="p-4 bg-[#2B2B40]/50 rounded-xl border border-[#2B2B40]">
                        <p class="text-[#92929f] text-xs uppercase font-bold mb-1">Joined Date</p>
                        <p class="text-white font-medium">{{ $client->created_at->format('M d, Y') }}</p>
                    </div>
                </div>
            </div>

            <!-- Ticket History -->
            <div class="bg-[#1E1E2D] rounded-xl shadow-lg border border-[#2B2B40]">
                <div class="p-6 border-b border-[#2B2B40]">
                    <h3 class="text-lg font-bold text-white">Ticket History</h3>
                </div>
                <div class="p-6">
                    @if($tickets->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead>
                                    <tr class="text-left text-[#92929f] text-xs font-bold uppercase tracking-wider border-b border-[#2B2B40]">
                                        <th class="pb-4 pl-4">ID</th>
                                        <th class="pb-4">Subject</th>
                                        <th class="pb-4">Status</th>
                                        <th class="pb-4 text-right pr-4">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="text-sm">
                                    @foreach($tickets as $ticket)
                                        <tr class="border-b border-[#2B2B40] last:border-0 hover:bg-[#2B2B40]/50 transition-colors">
                                            <td class="py-4 pl-4 font-medium text-white">#{{ $ticket->id }}</td>
                                            <td class="py-4">
                                                <div class="text-white font-medium">{{ $ticket->category }}</div>
                                                <div class="text-[#92929f] text-xs mt-1 truncate max-w-xs">{{ Str::limit($ticket->description, 40) }}</div>
                                            </td>
                                            <td class="py-4">
                                                <span class="px-3 py-1 rounded-lg text-xs font-bold uppercase tracking-wider
                                                    {{ $ticket->status === 'open' ? 'bg-[#F6C000]/10 text-[#F6C000]' : '' }}
                                                    {{ $ticket->status === 'closed' ? 'bg-gray-500/10 text-gray-400' : '' }}
                                                    {{ $ticket->status === 'in_progress' ? 'bg-[#3699FF]/10 text-[#3699FF]' : '' }}">
                                                    {{ str_replace('_', ' ', $ticket->status) }}
                                                </span>
                                            </td>
                                            <td class="py-4 text-right pr-4">
                                                <a href="{{ route('admin.tickets.show', $ticket) }}" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-[#2B2B40] text-[#92929f] hover:text-white hover:bg-[#3699FF] transition-colors">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-[#92929f] text-center py-4">No tickets found.</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1 space-y-6">
            <!-- Plan Management -->
            <div class="bg-[#1E1E2D] rounded-xl shadow-lg border border-[#2B2B40] p-6">
                <h3 class="text-lg font-bold text-white mb-4">Manage Plan</h3>
                <form method="POST" action="{{ route('admin.clients.updatePack', $client) }}">
                    @csrf
                    @method('PATCH')
                    <div class="mb-4">
                        <label for="pack_id" class="block text-sm font-medium text-[#92929f] mb-2">Current Plan</label>
                        <select id="pack_id" name="pack_id" class="block w-full rounded-lg border-[#2B2B40] bg-[#151521] text-white focus:border-[#3699FF] focus:ring-[#3699FF] sm:text-sm px-4 py-3">
                            <option value="">None</option>
                            @foreach($packs as $pack)
                                <option value="{{ $pack->id }}" {{ $client->pack_id == $pack->id ? 'selected' : '' }}>
                                    {{ $pack->name }} (${{ $pack->price }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="w-full inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-lg text-white bg-[#3699FF] hover:bg-[#0073E9] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#3699FF] transition-colors">
                        Update Plan
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
