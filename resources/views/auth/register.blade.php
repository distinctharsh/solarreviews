<x-guest-layout>
    @if(isset($googleData) || isset($otpVerified))
        <div class="mb-4 p-3 bg-green-50 border border-green-200 rounded-md">
            <p class="text-sm text-green-800">
                @if(isset($googleData))
                    <i class="fas fa-check-circle mr-2"></i>Google account connected. Please complete your registration.
                @elseif(isset($otpVerified))
                    <i class="fas fa-check-circle mr-2"></i>Email verified. Please complete your registration.
                @endif
            </p>
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- User Type -->
        <div class="mt-4">
            <x-input-label for="user_type_id" :value="__('Registering as')" />
            <select id="user_type_id" name="user_type_id" class="block mt-1 w-full" required>
                <option value="">{{ __('Select user type') }}</option>
                @foreach($userTypes ?? [] as $type)
                    <option value="{{ $type->id }}" {{ (int) old('user_type_id') === $type->id ? 'selected' : '' }}>
                        {{ $type->name }}
                    </option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('user_type_id')" class="mt-2" />
        </div>

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" 
                         :value="old('name', $googleData['name'] ?? '')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" 
                         :value="old('email', $prefilledEmail ?? '')" required autocomplete="username" 
                         {{ isset($prefilledEmail) ? 'readonly' : '' }} />
            @if(isset($prefilledEmail))
                <p class="mt-1 text-xs text-gray-500">Email verified via {{ isset($googleData) ? 'Google' : 'OTP' }}</p>
            @endif
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Phone -->
        <div class="mt-4">
            <x-input-label for="phone" :value="__('Phone Number')" />
            <x-text-input id="phone" class="block mt-1 w-full" type="tel" name="phone" 
                         :value="old('phone')" required autocomplete="tel" />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>

        @php
            $passwordOptional = (isset($googleData) || isset($otpVerified));
        @endphp

        <!-- Password (Optional if Google/OTP verified) -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            @if($passwordOptional)
                <p class="text-xs text-gray-500 mb-1">Optional - You can login with {{ isset($googleData) ? 'Google' : 'email OTP' }} instead</p>
            @endif

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            {{ $passwordOptional ? '' : 'required' }} autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" 
                            {{ $passwordOptional ? '' : 'required' }} autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Terms -->
        <div class="mt-4">
            <label class="flex items-center">
                <input type="checkbox" name="terms" value="1" required 
                       class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                <span class="ml-2 text-sm text-gray-600">
                    I agree to the <a href="#" class="underline">Terms & Conditions</a>
                </span>
            </label>
            <x-input-error :messages="$errors->get('terms')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
