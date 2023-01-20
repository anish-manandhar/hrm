<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            {{-- <x-jet-authentication-card-logo/> --}}
        </x-slot>

        <x-jet-validation-errors class="mb-4"/>

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <div class="app app-auth-sign-in align-content-stretch d-flex flex-wrap justify-content-end">
            <div class="app-auth-background">
            </div>
            <div class="app-auth-container">
                <div class="logo">
                    <a href="#">UpTechSys</a>
                </div>
                <p class="auth-description">Please sign-in to your account and continue to the dashboard.</p>
    
                <form method="POST" action="{{ route('login') }}">
                    @csrf
        
                    @php
                        $value = config('app.debug') ? 'super@hrm.com' : old('email');
                    @endphp
                    <div class="auth-credentials m-b-xxl">
                        <x-jet-label for="email" class="form-label" value="{{ __('Email') }}"/>
                        <x-jet-input id="email" class="form-control m-b-md block mt-1 w-full" type="email" name="email" :value="$value" required autofocus />
        
                        <x-jet-label for="password" class="form-label" value="{{ __('Password') }}"/>
                        <x-jet-input id="password" class="form-control block mt-1 w-full" type="password" value="{{ config('app.debug') ? '#Machine786' : '' }}" name="password" required autocomplete="current-password" />
                    </div>        
                    <div class="auth-submit">
                        <x-jet-button class="ml-4 btn btn-primary">
                            {{ __('Log in') }}
                        </x-jet-button>
                    </div>
                </form>
            </div>
        </div>
    </x-jet-authentication-card>
</x-guest-layout>
