<x-app-layout>
    <x-slot name="header">
        Ticket Details
    </x-slot>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Ticket Info Sidebar -->
        <div class="lg:col-span-1 space-y-6">
            <div class="bg-[#1E1E2D] rounded-xl shadow-lg border border-[#2B2B40] p-6">
                <div class="flex justify-between items-start mb-4">
                    <h3 class="text-lg font-bold text-white">Ticket Info</h3>
                    <span class="px-3 py-1 rounded-lg text-xs font-bold uppercase tracking-wider
                        {{ $ticket->status === 'open' ? 'bg-[#F6C000]/10 text-[#F6C000]' : '' }}
                        {{ $ticket->status === 'closed' ? 'bg-gray-500/10 text-gray-400' : '' }}
                        {{ $ticket->status === 'in_progress' ? 'bg-[#3699FF]/10 text-[#3699FF]' : '' }}">
                        {{ str_replace('_', ' ', $ticket->status) }}
                    </span>
                </div>
                
                <div class="space-y-4">
                    <div>
                        <p class="text-[#92929f] text-xs uppercase font-bold">Ticket ID</p>
                        <p class="text-white font-mono">#{{ $ticket->id }}</p>
                    </div>
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

        <!-- Conversation Area -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Original Description -->
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
                        <div class="max-w-[80%] {{ $message->user_id === auth()->id() ? 'bg-[#3699FF] text-white' : 'bg-[#2B2B40] text-[#92929f]' }} rounded-xl p-4 shadow-md">
                            <div class="flex justify-between items-center mb-2 gap-4">
                                <span class="font-bold text-xs {{ $message->user_id === auth()->id() ? 'text-white/80' : 'text-white' }}">
                                    {{ $message->user->first_name }} {{ $message->user->last_name }}
                                </span>
                                <span class="text-xs {{ $message->user_id === auth()->id() ? 'text-white/60' : 'text-[#92929f]/60' }}">
                                    {{ $message->created_at->diffForHumans() }}
                                </span>
                            </div>
                            <p class="whitespace-pre-wrap text-sm">{{ $message->message }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Reply Form -->
            <div class="bg-[#1E1E2D] rounded-xl shadow-lg border border-[#2B2B40] p-6">
                <h3 class="text-lg font-bold text-white mb-4">Reply</h3>
                <form method="POST" action="{{ route('tickets.messages.store', $ticket) }}">
                    @csrf
                    <textarea name="message" rows="4" class="block w-full rounded-lg border-[#2B2B40] bg-[#151521] text-white focus:border-[#3699FF] focus:ring-[#3699FF] sm:text-sm px-4 py-3 mb-4" placeholder="Type your message here..." required></textarea>
                    <div class="flex justify-end">
                        <button type="submit" class="inline-flex justify-center py-2 px-6 border border-transparent shadow-sm text-sm font-medium rounded-lg text-white bg-[#3699FF] hover:bg-[#0073E9] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#3699FF] transition-colors">
                            Send Reply
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
