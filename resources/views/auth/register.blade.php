<head>
    <title>Register Account</title>
    <style>
        .bordered-input {
            border: 1px solid #ccc;
            border-radius: 4px;
            width: 100%;
            padding: 2px;
            box-sizing: border-box;
        }
    </style>
</head>
<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <img src="image/logo_aplikasi.png"  class="rounded-circle mx-auto d-block mt-3" style="width: 150px">
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">


        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Name')" />

                <x-input id="name" class="block mt-1 w-full bordered-input" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full bordered-input" type="email" name="email" :value="old('email')" required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full bordered-input"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full bordered-input"
                                type="password"
                                name="password_confirmation" required />
            </div>

          
            <div class="d-flex justify-content-center mt-3">
                <div>
                    <x-button >
                        {{ __('Register') }}
                    </x-button>
                </div>
            </div>

            <div class="d-flex justify-content-center mt-3">
                <div>
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a>
                </div>
            </div>

            
        </form>
    </x-auth-card>
</x-guest-layout>
