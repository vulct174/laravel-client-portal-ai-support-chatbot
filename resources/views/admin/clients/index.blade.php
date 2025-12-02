<x-app-layout>
    <x-slot name="header">
        All Clients
    </x-slot>

    <div class="bg-[#1E1E2D] rounded-xl shadow-lg border border-[#2B2B40]">
        <div class="p-6 border-b border-[#2B2B40] flex justify-between items-center">
            <div>
                <h3 class="text-lg font-bold text-white">Client Management</h3>
                <p class="text-[#92929f] text-sm mt-1">View and manage all registered clients</p>
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
                            <th class="pb-4 pl-4">Name</th>
                            <th class="pb-4">Company</th>
                            <th class="pb-4">Email</th>
                            <th class="pb-4">Current Plan</th>
                            <th class="pb-4 text-right pr-4">Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm">
                        @foreach($clients as $client)
                            <tr class="border-b border-[#2B2B40] last:border-0 hover:bg-[#2B2B40]/50 transition-colors">
                                <td class="py-4 pl-4">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 rounded-lg bg-[#7239EA]/20 flex items-center justify-center text-[#7239EA] font-bold mr-3">
                                            {{ substr($client->first_name, 0, 1) }}
                                        </div>
                                        <span class="text-white font-medium">{{ $client->first_name }} {{ $client->last_name }}</span>
                                    </div>
                                </td>
                                <td class="py-4 text-[#92929f]">{{ $client->company ?? 'N/A' }}</td>
                                <td class="py-4 text-[#92929f]">{{ $client->email }}</td>
                                <td class="py-4">
                                    @if($client->pack)
                                        <span class="px-3 py-1 rounded-lg text-xs font-bold uppercase tracking-wider bg-[#3699FF]/10 text-[#3699FF]">
                                            {{ $client->pack->name }}
                                        </span>
                                    @else
                                        <span class="text-[#92929f] text-xs italic">None</span>
                                    @endif
                                </td>
                                <td class="py-4 text-right pr-4">
                                    <a href="{{ route('admin.clients.show', $client) }}" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-[#2B2B40] text-[#92929f] hover:text-white hover:bg-[#3699FF] transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path></svg>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                {{ $clients->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
