<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            {{-- <div>

                <x-jet-label for="patient" value="Je suis un patient" />
                <x-jet-input id="userTypePatient" class="block mt-1 w-full" type="radio" name="userType" :value="old('userTypePatient')" required autofocus autocomplete="userTypePatient" />

                <x-jet-label for="userType" value="Je suis un professionel de la santé" />
                <x-jet-input id="userTypeDoctor" class="block mt-1 w-full" type="radio" name="userType" :value="old('userTypeDoctor')" required autofocus autocomplete="userTypeDoctor" />
            </div> --}}

            <div class="form-check">
                <input class="form-check-input" type="radio" value="patient" name="type">
                <label class="form-check-label" for="flexCheckDefault">
                    Je suis un patient
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" value="doctor" name="type" >
                <label class="form-check-label" for="flexCheckChecked">
                    Je suis un professionel de la santé
                </label>
              </div>

            {{-- <div>
                <x-jet-label for="name" value="{{ __('Name') }}" />
                <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div> --}}

            <div>
                <x-jet-label for="firstName" value="{{ __('FirstName') }}" />
                <x-jet-input id="firstName" class="block mt-1 w-full" type="text" name="first_name" :value="old('firstName')" required autofocus autocomplete="firstName" />
            </div>

            <div>
                <x-jet-label for="lastName" value="{{ __('lastName') }}" />
                <x-jet-input id="lastName" class="block mt-1 w-full" type="text" name="last_name" :value="old('lastName')" required autofocus autocomplete="lastName" />
            </div>

            <div class="mt-4">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <div class="mt-4">
                <x-jet-label for="phone" value="{{ __('Phone') }}" />
                <x-jet-input id="phone" class="block mt-1 w-full" type="number" name="phone" :value="old('phone')" required />
            </div>

            <div class="mt-4">
                <x-jet-label for="title" value="{{ __('Votre titre / métier') }}" />
                <x-jet-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" required />
            </div>

            <div class="mt-4">
                <x-jet-label for="adress" value="{{ __('Adress') }}" />
                <x-jet-input id="adress" class="block mt-1 w-full" type="text" name="adress" :value="old('adress')" required />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-jet-label for="terms">
                        <div class="flex items-center">
                            <x-jet-checkbox name="terms" id="terms"/>

                            <div class="ml-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-jet-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-jet-button class="ml-4">
                    {{ __('Register') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
