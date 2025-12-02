<x-app-layout>
    <x-slot name="header">
        Profile
    </x-slot>

    <div class="space-y-6">
        <div class="p-4 sm:p-8 bg-[#1E1E2D] shadow-lg border border-[#2B2B40] sm:rounded-xl">
            <div class="max-w-xl">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <div class="p-4 sm:p-8 bg-[#1E1E2D] shadow-lg border border-[#2B2B40] sm:rounded-xl">
            <div class="max-w-xl">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <div class="p-4 sm:p-8 bg-[#1E1E2D] shadow-lg border border-[#2B2B40] sm:rounded-xl">
            <div class="max-w-xl">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</x-app-layout>
