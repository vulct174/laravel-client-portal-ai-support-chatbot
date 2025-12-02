<x-app-layout>
    <x-slot name="header">
        Admin Dashboard
    </x-slot>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
        <!-- Open Tickets -->
        <div class="bg-[#1E1E2D] rounded-xl p-6 shadow-lg border border-[#2B2B40] relative overflow-hidden group">
            <div class="flex justify-between items-start z-10 relative">
                <div>
                    <p class="text-[#92929f] text-sm font-bold uppercase tracking-wider">Open Tickets</p>
                    <h3 class="text-3xl font-bold text-white mt-2">{{ $openTickets }}</h3>
                </div>
                <div class="p-3 bg-[#F6C000]/10 rounded-xl text-[#F6C000]">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
            </div>
            <div class="mt-4 flex items-center text-sm text-[#92929f] z-10 relative">
                <span class="text-[#F6C000] font-bold mr-2">Action Required</span>
                <span>on pending items</span>
            </div>
            <div class="absolute right-0 bottom-0 opacity-5 transform translate-x-4 translate-y-4 group-hover:scale-110 transition duration-500">
                <svg class="w-32 h-32 text-[#F6C000]" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"></path></svg>
            </div>
        </div>

        <!-- Total Tickets -->
        <div class="bg-[#1E1E2D] rounded-xl p-6 shadow-lg border border-[#2B2B40] relative overflow-hidden group">
            <div class="flex justify-between items-start z-10 relative">
                <div>
                    <p class="text-[#92929f] text-sm font-bold uppercase tracking-wider">Total Tickets</p>
                    <h3 class="text-3xl font-bold text-white mt-2">{{ $totalTickets }}</h3>
                </div>
                <div class="p-3 bg-[#3699FF]/10 rounded-xl text-[#3699FF]">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                </div>
            </div>
            <div class="mt-4 flex items-center text-sm text-[#92929f] z-10 relative">
                <span class="text-[#3699FF] font-bold mr-2">Lifetime</span>
                <span>support requests</span>
            </div>
            <div class="absolute right-0 bottom-0 opacity-5 transform translate-x-4 translate-y-4 group-hover:scale-110 transition duration-500">
                <svg class="w-32 h-32 text-[#3699FF]" fill="currentColor" viewBox="0 0 24 24"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z"></path></svg>
            </div>
        </div>

        <!-- Total Clients -->
        <div class="bg-[#1E1E2D] rounded-xl p-6 shadow-lg border border-[#2B2B40] relative overflow-hidden group">
            <div class="flex justify-between items-start z-10 relative">
                <div>
                    <p class="text-[#92929f] text-sm font-bold uppercase tracking-wider">Total Clients</p>
                    <h3 class="text-3xl font-bold text-white mt-2">{{ $totalClients }}</h3>
                </div>
                <div class="p-3 bg-[#7239EA]/10 rounded-xl text-[#7239EA]">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </div>
            </div>
            <div class="mt-4 flex items-center text-sm text-[#92929f] z-10 relative">
                <span class="text-[#7239EA] font-bold mr-2">Active</span>
                <span>users registered</span>
            </div>
            <div class="absolute right-0 bottom-0 opacity-5 transform translate-x-4 translate-y-4 group-hover:scale-110 transition duration-500">
                <svg class="w-32 h-32 text-[#7239EA]" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"></path></svg>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Tickets by Status (Mock) -->
        <div class="bg-[#1E1E2D] rounded-xl p-6 shadow-lg border border-[#2B2B40]">
            <h3 class="text-lg font-bold text-white mb-6">Tickets by Status</h3>
            <div class="space-y-6">
                <div>
                    <div class="flex justify-between text-sm mb-2">
                        <span class="text-[#92929f]">Open</span>
                        <span class="text-[#F6C000] font-bold">{{ round(($openTickets / max($totalTickets, 1)) * 100) }}%</span>
                    </div>
                    <div class="w-full bg-[#2B2B40] rounded-full h-2">
                        <div class="bg-[#F6C000] h-2 rounded-full" style="width: {{ ($openTickets / max($totalTickets, 1)) * 100 }}%"></div>
                    </div>
                </div>
                <div>
                    <div class="flex justify-between text-sm mb-2">
                        <span class="text-[#92929f]">In Progress</span>
                        <span class="text-[#3699FF] font-bold">25%</span>
                    </div>
                    <div class="w-full bg-[#2B2B40] rounded-full h-2">
                        <div class="bg-[#3699FF] h-2 rounded-full" style="width: 25%"></div>
                    </div>
                </div>
                <div>
                    <div class="flex justify-between text-sm mb-2">
                        <span class="text-[#92929f]">Closed</span>
                        <span class="text-[#7239EA] font-bold">45%</span>
                    </div>
                    <div class="w-full bg-[#2B2B40] rounded-full h-2">
                        <div class="bg-[#7239EA] h-2 rounded-full" style="width: 45%"></div>
                    </div>
                </div>
            </div>
            <div class="mt-8 flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <span class="w-3 h-3 rounded-full bg-[#F6C000]"></span>
                    <span class="text-xs text-[#92929f]">Open</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="w-3 h-3 rounded-full bg-[#3699FF]"></span>
                    <span class="text-xs text-[#92929f]">In Progress</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="w-3 h-3 rounded-full bg-[#7239EA]"></span>
                    <span class="text-xs text-[#92929f]">Closed</span>
                </div>
            </div>
        </div>

        <!-- Recent Activity / Tickets -->
        <div class="lg:col-span-2 bg-[#1E1E2D] rounded-xl shadow-lg border border-[#2B2B40]">
            <div class="p-6 border-b border-[#2B2B40] flex justify-between items-center">
                <div>
                    <h3 class="text-lg font-bold text-white">Recent Activity</h3>
                    <p class="text-[#92929f] text-sm mt-1">Latest tickets from clients</p>
                </div>
                <a href="{{ route('admin.tickets.index') }}" class="text-[#3699FF] hover:text-[#0073E9] text-sm font-bold">View All</a>
            </div>
            <div class="p-6">
                @if($recentTickets->count() > 0)
                    <div class="space-y-4">
                        @foreach($recentTickets as $ticket)
                            <div class="flex items-center justify-between p-4 bg-[#2B2B40]/50 rounded-xl hover:bg-[#2B2B40] transition-colors">
                                <div class="flex items-center gap-4">
                                    <div class="w-10 h-10 rounded-lg bg-[#3699FF]/20 flex items-center justify-center text-[#3699FF] font-bold">
                                        {{ substr($ticket->user->first_name, 0, 1) }}
                                    </div>
                                    <div>
                                        <h4 class="text-white font-medium text-sm">{{ $ticket->category }}</h4>
                                        <p class="text-[#92929f] text-xs">by {{ $ticket->user->first_name }} {{ $ticket->user->last_name }} • {{ $ticket->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-4">
                                    <span class="px-3 py-1 rounded-lg text-xs font-bold uppercase tracking-wider
                                        {{ $ticket->status === 'open' ? 'bg-[#F6C000]/10 text-[#F6C000]' : '' }}
                                        {{ $ticket->status === 'closed' ? 'bg-gray-500/10 text-gray-400' : '' }}
                                        {{ $ticket->status === 'in_progress' ? 'bg-[#3699FF]/10 text-[#3699FF]' : '' }}">
                                        {{ str_replace('_', ' ', $ticket->status) }}
                                    </span>
                                    <a href="{{ route('admin.tickets.show', $ticket) }}" class="p-2 text-[#92929f] hover:text-white transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-[#92929f] text-center py-4">No recent activity.</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
