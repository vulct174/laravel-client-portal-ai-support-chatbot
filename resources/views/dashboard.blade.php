<x-app-layout>
    <x-slot name="header">
        Dashboard
    </x-slot>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Account Info Card -->
        <div class="bg-[#1E1E2D] rounded-xl p-6 shadow-lg border border-[#2B2B40]">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-bold text-white">Profile Details</h3>
                <a href="{{ route('profile.edit') }}" class="p-2 bg-[#2B2B40] rounded-lg text-[#92929f] hover:text-white transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                </a>
            </div>
            <div class="flex flex-col items-center mb-6">
                <div class="w-20 h-20 bg-indigo-500 rounded-full flex items-center justify-center text-white text-2xl font-bold mb-3 ring-4 ring-[#2B2B40]">
                    {{ substr($user->first_name, 0, 1) }}
                </div>
                <h4 class="text-xl font-bold text-white">{{ $user->first_name }} {{ $user->last_name }}</h4>
                <p class="text-[#92929f]">{{ $user->email }}</p>
            </div>
            <div class="space-y-4">
                <div class="flex justify-between items-center py-3 border-b border-[#2B2B40]">
                    <span class="text-[#92929f]">Company</span>
                    <span class="text-white font-medium">{{ $user->company ?? 'N/A' }}</span>
                </div>
                <div class="flex justify-between items-center py-3 border-b border-[#2B2B40]">
                    <span class="text-[#92929f]">Phone</span>
                    <span class="text-white font-medium">{{ $user->phone ?? 'N/A' }}</span>
                </div>
                <div class="flex justify-between items-center py-3 border-b border-[#2B2B40]">
                    <span class="text-[#92929f]">Joined</span>
                    <span class="text-white font-medium">{{ $user->created_at->format('M Y') }}</span>
                </div>
            </div>
        </div>

        <!-- Current Plan Card -->
        <div class="lg:col-span-2 bg-[#1E1E2D] rounded-xl p-6 shadow-lg border border-[#2B2B40] relative overflow-hidden">
            <div class="relative z-10">
                <div class="flex justify-between items-start mb-6">
                    <div>
                        <h3 class="text-lg font-bold text-white">Current Subscription</h3>
                        <p class="text-[#92929f] text-sm mt-1">Manage your plan and features</p>
                    </div>
                    @if($pack)
                        <span class="px-3 py-1 bg-green-500/10 text-green-500 rounded-lg text-xs font-bold uppercase tracking-wider border border-green-500/20">Active</span>
                    @else
                        <span class="px-3 py-1 bg-red-500/10 text-red-500 rounded-lg text-xs font-bold uppercase tracking-wider border border-red-500/20">Inactive</span>
                    @endif
                </div>

                @if($pack)
                    <div class="flex flex-col md:flex-row gap-8 items-center">
                        <div class="flex-1">
                            <div class="text-4xl font-bold text-white mb-2">{{ $pack->name }}</div>
                            <p class="text-[#92929f] mb-6">{{ $pack->description }}</p>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                @foreach(array_slice($pack->features ?? [], 0, 4) as $feature)
                                    <div class="flex items-center text-sm text-[#92929f]">
                                        <div class="w-5 h-5 rounded-full bg-green-500/20 flex items-center justify-center mr-3 text-green-500">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                        </div>
                                        {{ $feature }}
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="bg-[#151521] p-6 rounded-xl border border-[#2B2B40] min-w-[200px] text-center">
                            <p class="text-[#92929f] text-sm mb-1">Monthly Cost</p>
                            <div class="text-3xl font-bold text-white mb-4">${{ number_format($pack->price, 0) }}</div>
                            <button class="w-full py-2 bg-[#3699FF] hover:bg-[#0073E9] text-white rounded-lg font-medium transition-colors">
                                Upgrade Plan
                            </button>
                        </div>
                    </div>
                @else
                    <div class="text-center py-8">
                        <div class="w-16 h-16 bg-[#2B2B40] rounded-full flex items-center justify-center mx-auto mb-4 text-[#92929f]">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-2">No Active Plan</h3>
                        <p class="text-[#92929f] mb-6">Choose a subscription to get started.</p>
                        <a href="#" class="inline-block px-6 py-2 bg-[#3699FF] hover:bg-[#0073E9] text-white rounded-lg font-medium transition-colors">View Plans</a>
                    </div>
                @endif
            </div>
            <!-- Decorative background element -->
            <div class="absolute top-0 right-0 -mt-20 -mr-20 w-80 h-80 bg-[#3699FF] opacity-5 rounded-full blur-3xl"></div>
        </div>
    </div>

    <!-- Recent Tickets Section -->
    <div class="mt-8 bg-[#1E1E2D] rounded-xl shadow-lg border border-[#2B2B40]">
        <div class="p-6 border-b border-[#2B2B40] flex justify-between items-center">
            <div>
                <h3 class="text-lg font-bold text-white">Recent Tickets</h3>
                <p class="text-[#92929f] text-sm mt-1">Latest support requests status</p>
            </div>
            <a href="{{ route('tickets.create') }}" class="px-4 py-2 bg-[#7239EA] hover:bg-[#5014D0] text-white rounded-lg font-medium transition-colors flex items-center">
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
            @else
                <div class="text-center py-12">
                    <div class="w-16 h-16 bg-[#2B2B40] rounded-full flex items-center justify-center mx-auto mb-4 text-[#92929f]">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                    </div>
                    <h3 class="text-lg font-bold text-white mb-2">No Tickets Yet</h3>
                    <p class="text-[#92929f] mb-6">Create your first ticket to get support.</p>
                    <a href="{{ route('tickets.create') }}" class="px-6 py-2 bg-[#7239EA] hover:bg-[#5014D0] text-white rounded-lg font-medium transition-colors">Create Ticket</a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
