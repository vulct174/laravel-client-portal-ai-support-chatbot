<x-app-layout>
    <x-slot name="header">
        Manage Ticket #{{ $ticket->id }}
    </x-slot>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Sidebar -->
        <div class="lg:col-span-1 space-y-6">
            <!-- Status Management -->
            <div class="bg-[#1E1E2D] rounded-xl shadow-lg border border-[#2B2B40] p-6">
                <h3 class="text-lg font-bold text-white mb-4">Update Status</h3>
                <form method="POST" action="{{ route('admin.tickets.updateStatus', $ticket) }}">
                    @csrf
                    @method('PATCH')
                    <select name="status" class="block w-full rounded-lg border-[#2B2B40] bg-[#151521] text-white focus:border-[#3699FF] focus:ring-[#3699FF] sm:text-sm px-4 py-3 mb-4">
                        <option value="open" {{ $ticket->status === 'open' ? 'selected' : '' }}>Open</option>
                        <option value="in_progress" {{ $ticket->status === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="closed" {{ $ticket->status === 'closed' ? 'selected' : '' }}>Closed</option>
                    </select>
                    <button type="submit" class="w-full inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-lg text-white bg-[#3699FF] hover:bg-[#0073E9] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#3699FF] transition-colors">
                        Update Status
                    </button>
                </form>
            </div>

            <!-- Client Info -->
            <div class="bg-[#1E1E2D] rounded-xl shadow-lg border border-[#2B2B40] p-6">
                <h3 class="text-lg font-bold text-white mb-4">Client Info</h3>
                <div class="space-y-4">
                    <div class="flex items-center">
                        <div class="w-10 h-10 rounded-lg bg-[#3699FF]/20 flex items-center justify-center text-[#3699FF] font-bold mr-3">
                            {{ substr($ticket->user->first_name, 0, 1) }}
                        </div>
                        <div>
                            <a href="{{ route('admin.clients.show', $ticket->user) }}" class="text-white font-medium hover:text-[#3699FF] transition-colors">
                                {{ $ticket->user->first_name }} {{ $ticket->user->last_name }}
                            </a>
                            <p class="text-[#92929f] text-xs">{{ $ticket->user->email }}</p>
                        </div>
                    </div>
                    <div class="pt-4 border-t border-[#2B2B40] space-y-2">
                        <div class="flex justify-between text-sm">
                            <span class="text-[#92929f]">Company</span>
                            <span class="text-white">{{ $ticket->user->company ?? 'N/A' }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-[#92929f]">Plan</span>
                            <span class="text-white">{{ $ticket->user->pack->name ?? 'None' }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Ticket Info -->
            <div class="bg-[#1E1E2D] rounded-xl shadow-lg border border-[#2B2B40] p-6">
                <h3 class="text-lg font-bold text-white mb-4">Ticket Details</h3>
                <div class="space-y-4">
                    <div>
                        <p class="text-[#92929f] text-xs uppercase font-bold">Category</p>
                        <p class="text-white">{{ $ticket->category }}</p>
                    </div>
                    <div>
                        <p class="text-[#92929f] text-xs uppercase font-bold">Impact</p>
                        <p class="text-white">{{ $ticket->impact }}</p>
                    </div>
                    <div>
                        <p class="text-[#92929f] text-xs uppercase font-bold">Created</p>
                        <p class="text-white">{{ $ticket->created_at->format('M d, Y H:i') }}</p>
                    </div>
                </div>
                @if($ticket->attachments)
                    <div class="mt-6 pt-6 border-t border-[#2B2B40]">
                        <p class="text-[#92929f] text-xs uppercase font-bold mb-2">Attachments</p>
                        <ul class="space-y-2">
                            @foreach($ticket->attachments as $attachment)
                                <li>
                                    <a href="{{ Storage::url($attachment) }}" target="_blank" class="flex items-center text-[#3699FF] hover:text-[#0073E9] text-sm transition-colors">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path></svg>
                                        View Attachment
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>

        <!-- Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Description -->
            <div class="bg-[#1E1E2D] rounded-xl shadow-lg border border-[#2B2B40] p-6">
                <h3 class="text-lg font-bold text-white mb-4">Description</h3>
                <div class="prose prose-invert max-w-none text-[#92929f]">
                    <p class="whitespace-pre-wrap">{{ $ticket->description }}</p>
                </div>
            </div>

            <!-- Messages -->
            <div class="space-y-4">
                @foreach($ticket->messages as $message)
                    <div class="flex {{ $message->user_id === auth()->id() ? 'justify-end' : 'justify-start' }}">
                        <div class="max-w-[80%] {{ $message->is_internal ? 'bg-[#F6C000]/10 border border-[#F6C000]/30' : ($message->user_id === auth()->id() ? 'bg-[#3699FF] text-white' : 'bg-[#2B2B40] text-[#92929f]') }} rounded-xl p-4 shadow-md">
                            <div class="flex justify-between items-center mb-2 gap-4">
                                <span class="font-bold text-xs {{ $message->is_internal ? 'text-[#F6C000]' : ($message->user_id === auth()->id() ? 'text-white/80' : 'text-white') }}">
                                    {{ $message->user->first_name }} {{ $message->user->last_name }}
                                    @if($message->is_internal) <span class="ml-2 px-1.5 py-0.5 bg-[#F6C000] text-black rounded text-[10px] font-bold uppercase">Internal</span> @endif
                                </span>
                                <span class="text-xs {{ $message->is_internal ? 'text-[#F6C000]/70' : ($message->user_id === auth()->id() ? 'text-white/60' : 'text-[#92929f]/60') }}">
                                    {{ $message->created_at->diffForHumans() }}
                                </span>
                            </div>
                            <p class="whitespace-pre-wrap text-sm {{ $message->is_internal ? 'text-[#F6C000]' : '' }}">{{ $message->message }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- AI Copilot -->
            <div class="bg-[#1E1E2D] rounded-xl shadow-lg border border-[#2B2B40] p-6 relative overflow-hidden">
                <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-[#7239EA]/10 rounded-full blur-xl"></div>
                <div class="flex justify-between items-center mb-4 relative z-10">
                    <h3 class="text-lg font-bold text-white flex items-center gap-2">
                        <svg class="w-5 h-5 text-[#7239EA]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        AI Copilot
                    </h3>
                    <form method="POST" action="{{ route('admin.tickets.aiReply', $ticket) }}">
                        @csrf
                        <button type="submit" class="text-xs bg-[#7239EA]/10 text-[#7239EA] hover:bg-[#7239EA]/20 px-3 py-1.5 rounded-lg font-bold uppercase tracking-wider transition-colors flex items-center gap-1">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                            Generate Draft
                        </button>
                    </form>
                </div>

                @if($ticket->ai_draft_reply)
                    <div class="bg-[#151521] rounded-lg p-4 border border-[#2B2B40] mb-4">
                        <p class="text-[#92929f] text-sm whitespace-pre-wrap" id="ai-draft-content">{{ $ticket->ai_draft_reply }}</p>
                    </div>
                    <button type="button" onclick="document.querySelector('textarea[name=message]').value = document.getElementById('ai-draft-content').innerText" class="text-sm text-[#3699FF] hover:text-[#0073E9] font-medium flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"></path></svg>
                        Use this draft
                    </button>
                @else
                    <p class="text-[#92929f] text-sm italic">Click "Generate Draft" to let AI suggest a response based on the ticket history.</p>
                @endif
            </div>

            <!-- Reply Form -->
            <div class="bg-[#1E1E2D] rounded-xl shadow-lg border border-[#2B2B40] p-6">
                <h3 class="text-lg font-bold text-white mb-4">Reply</h3>
                <form method="POST" action="{{ route('admin.tickets.messages.store', $ticket) }}">
                    @csrf
                    <textarea name="message" rows="4" class="block w-full rounded-lg border-[#2B2B40] bg-[#151521] text-white focus:border-[#3699FF] focus:ring-[#3699FF] sm:text-sm px-4 py-3 mb-4" placeholder="Type your message here..." required></textarea>
                    
                    <div class="flex items-center justify-between">
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="is_internal" value="1" class="rounded border-[#2B2B40] bg-[#151521] text-[#3699FF] shadow-sm focus:ring-[#3699FF]">
                            <span class="ml-2 text-sm text-[#92929f]">Internal Note (Client won't see this)</span>
                        </label>
                        <button type="submit" class="inline-flex justify-center py-2 px-6 border border-transparent shadow-sm text-sm font-medium rounded-lg text-white bg-[#3699FF] hover:bg-[#0073E9] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#3699FF] transition-colors">
                            Send Reply
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
