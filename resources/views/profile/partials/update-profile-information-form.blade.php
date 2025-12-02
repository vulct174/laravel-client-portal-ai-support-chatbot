<section>
    <header>
        <h2 class="text-lg font-medium text-white">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-[#92929f]">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="first_name" :value="__('First Name')" class="text-[#92929f]" />
            <x-text-input id="first_name" name="first_name" type="text" class="mt-1 block w-full bg-[#151521] border-[#2B2B40] text-white focus:border-[#3699FF] focus:ring-[#3699FF]" :value="old('first_name', $user->first_name)" required autofocus autocomplete="given-name" />
            <x-input-error class="mt-2" :messages="$errors->get('first_name')" />
        </div>

        <div>
            <x-input-label for="last_name" :value="__('Last Name')" class="text-[#92929f]" />
            <x-text-input id="last_name" name="last_name" type="text" class="mt-1 block w-full bg-[#151521] border-[#2B2B40] text-white focus:border-[#3699FF] focus:ring-[#3699FF]" :value="old('last_name', $user->last_name)" required autocomplete="family-name" />
            <x-input-error class="mt-2" :messages="$errors->get('last_name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" class="text-[#92929f]" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full bg-[#151521] border-[#2B2B40] text-white focus:border-[#3699FF] focus:ring-[#3699FF]" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-[#92929f]">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-[#3699FF] hover:text-[#0073E9] rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#3699FF]">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-400">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div>
            <x-input-label for="company" :value="__('Company')" class="text-[#92929f]" />
            <x-text-input id="company" name="company" type="text" class="mt-1 block w-full bg-[#151521] border-[#2B2B40] text-white focus:border-[#3699FF] focus:ring-[#3699FF]" :value="old('company', $user->company)" />
            <x-input-error class="mt-2" :messages="$errors->get('company')" />
        </div>

        <div>
            <x-input-label for="phone" :value="__('Phone')" class="text-[#92929f]" />
            <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full bg-[#151521] border-[#2B2B40] text-white focus:border-[#3699FF] focus:ring-[#3699FF]" :value="old('phone', $user->phone)" />
            <x-input-error class="mt-2" :messages="$errors->get('phone')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button class="bg-[#3699FF] hover:bg-[#0073E9] border-transparent">{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-400"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
