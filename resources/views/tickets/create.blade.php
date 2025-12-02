<x-app-layout>
    <x-slot name="header">
        Open New Ticket
    </x-slot>

    <div class="max-w-3xl mx-auto">
        <div class="bg-[#1E1E2D] rounded-xl shadow-lg border border-[#2B2B40] p-8">
            <h3 class="text-xl font-bold text-white mb-6">Create Support Request</h3>
            
            <form method="POST" action="{{ route('tickets.store') }}" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <!-- Category -->
                <div>
                    <label for="category" class="block text-sm font-medium text-[#92929f] mb-2">Category</label>
                    <select id="category" name="category" class="block w-full rounded-lg border-[#2B2B40] bg-[#151521] text-white focus:border-[#3699FF] focus:ring-[#3699FF] sm:text-sm px-4 py-3">
                        <option value="Technical">Technical Issue</option>
                        <option value="Billing">Billing Question</option>
                        <option value="Feature Request">Feature Request</option>
                        <option value="General">General Inquiry</option>
                    </select>
                    <x-input-error :messages="$errors->get('category')" class="mt-2" />
                </div>

                <!-- Impact -->
                <div>
                    <label for="impact" class="block text-sm font-medium text-[#92929f] mb-2">Impact</label>
                    <select id="impact" name="impact" class="block w-full rounded-lg border-[#2B2B40] bg-[#151521] text-white focus:border-[#3699FF] focus:ring-[#3699FF] sm:text-sm px-4 py-3">
                        <option value="Low">Low - Can work around</option>
                        <option value="Medium">Medium - Affects work</option>
                        <option value="High">High - Critical issue</option>
                    </select>
                    <x-input-error :messages="$errors->get('impact')" class="mt-2" />
                </div>

                <!-- Description -->
                <div>
                    <label for="description" class="block text-sm font-medium text-[#92929f] mb-2">Description</label>
                    <textarea id="description" name="description" rows="5" class="block w-full rounded-lg border-[#2B2B40] bg-[#151521] text-white focus:border-[#3699FF] focus:ring-[#3699FF] sm:text-sm px-4 py-3" required placeholder="Please describe your issue in detail...">{{ old('description') }}</textarea>
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>

                <!-- Attachments -->
                <div>
                    <label for="attachments" class="block text-sm font-medium text-[#92929f] mb-2">Attachments (Optional)</label>
                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-[#2B2B40] border-dashed rounded-lg hover:border-[#3699FF] transition-colors bg-[#151521]">
                        <div class="space-y-1 text-center">
                            <svg class="mx-auto h-12 w-12 text-[#92929f]" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <div class="flex text-sm text-[#92929f]">
                                <label for="attachments" class="relative cursor-pointer bg-transparent rounded-md font-medium text-[#3699FF] hover:text-[#0073E9] focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-[#3699FF]">
                                    <span>Upload a file</span>
                                    <input id="attachments" name="attachments[]" type="file" multiple class="sr-only">
                                </label>
                                <p class="pl-1">or drag and drop</p>
                            </div>
                            <p class="text-xs text-[#92929f]">
                                PNG, JPG, PDF up to 2MB
                            </p>
                        </div>
                    </div>
                    <x-input-error :messages="$errors->get('attachments')" class="mt-2" />
                </div>

                <div class="flex items-center justify-end pt-4">
                    <a href="{{ route('dashboard') }}" class="text-[#92929f] hover:text-white mr-4 transition-colors">Cancel</a>
                    <button type="submit" class="inline-flex justify-center py-3 px-6 border border-transparent shadow-sm text-sm font-medium rounded-lg text-white bg-[#3699FF] hover:bg-[#0073E9] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#3699FF] transition-colors">
                        Submit Ticket
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
