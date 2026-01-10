<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="photo" value="Photo Profile" />

            <div class="flex items-center gap-4 mt-2">

                {{-- PREVIEW FOTO (KLIKABLE) --}}
                <label for="photo"
                    class="w-20 h-20 rounded-full overflow-hidden bg-gray-100 border cursor-pointer
               flex items-center justify-center group">

                    @if ($user->photo)
                    <img id="photoPreview"
                        src="{{ asset('storage/profile/'.$user->photo) }}"
                        class="w-full h-full object-cover">
                    @else
                    <div id="photoPreview"
                        class="flex items-center justify-center h-full w-full text-gray-400 text-sm">
                        No Photo
                    </div>
                    @endif

                    {{-- Overlay hover --}}
                    <div class="absolute opacity-0 group-hover:opacity-100 transition
                    bg-black/40 text-white text-xs px-2 py-1 rounded">
                        Change
                    </div>
                </label>

                {{-- INPUT FILE (HIDDEN) --}}
                <input type="file"
                    id="photo"
                    name="photo"
                    accept="image/*"
                    class="hidden"
                    onchange="previewPhoto(event)">

            </div>


            <x-input-error :messages="$errors->get('photo')" class="mt-2" />
        </div>


        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
            <div>
                <p class="text-sm mt-2 text-gray-800">
                    {{ __('Your email address is unverified.') }}

                    <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        {{ __('Click here to re-send the verification email.') }}
                    </button>
                </p>

                @if (session('status') === 'verification-link-sent')
                <p class="mt-2 font-medium text-sm text-green-600">
                    {{ __('A new verification link has been sent to your email address.') }}
                </p>
                @endif
            </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
            <p
                x-data="{ show: true }"
                x-show="show"
                x-transition
                x-init="setTimeout(() => show = false, 2000)"
                class="text-sm text-gray-600">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>