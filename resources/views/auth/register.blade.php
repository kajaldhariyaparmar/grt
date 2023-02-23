<x-guest-layout>
    <x-auth-card>
        <!-- Begin Register Section -->
        <section class="cf-section-wrap cf-new-campaign-section cf-register-section">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="cf-section-title">
                            <h2>Create an account</h2>
                            <h4>Already have an account? <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">{{ __('Log in') }}</a></h4>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="cf-new-campaign-wrap">
                            <div class="cf-new-campaign-inner">
                                <x-slot name="logo">
                                    <a href="{{URL::to('/')}}" class="cf-register-login-logo">
                                        <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                                    </a>
                                </x-slot>

                                <!-- Validation Errors -->
                                <x-auth-validation-errors class="mb-4" :errors="$errors" />

                                <form method="POST" action="{{ route('register') }}">
                                    @csrf

                                    <!-- Name -->
                                    <div>
                                        <div class="custom-row">
                                            <!-- <x-label for="name" :value="__('Full name')" /> -->

                                            <x-input id="name" class="block mt-1 w-full cf-input-bx" type="text" name="name" :value="old('name')" required autofocus placeholder="Full name" />
                                        </div>
                                    </div>

                                    <!-- Email Address -->
                                    <div>
                                        <div class="custom-row">
                                            <!-- <x-label for="email" :value="__('Email address')" /> -->

                                            <x-input id="email" class="block mt-1 w-full cf-input-bx" type="email" name="email" :value="old('email')" placeholder="Email address" required />
                                        </div>
                                    </div>

                                    <!-- Password -->
                                    <div class="password-wrap">
                                        <div class="custom-row">
                                            <!-- <x-label for="password" :value="__('Password')" /> -->
                                            <x-input id="password" class="block mt-1 w-full cf-input-bx" type="password" name="password" placeholder="Password" required autocomplete="new-password" />
                                            <span class="password-info">Must be at least 8 characters</span>
                                        </div>
                                    </div>

                                    <!-- Confirm Password -->
                                    <div>
                                        <div class="custom-row">
                                            <!-- <x-label for="password_confirmation" :value="__('Confirm Password')" /> -->
                                            <x-input id="password_confirmation" class="block mt-1 w-full cf-input-bx" type="password" name="password_confirmation" placeholder="Confirm password" required />
                                        </div>
                                    </div>

                                    <!-- Register button -->
                                    <div class="custom-row">
                                        <x-button class="cf-btn-wrap">
                                            {{ __('Register') }}
                                        </x-button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section><!--// End Register Section -->
    </x-auth-card>
</x-guest-layout>
