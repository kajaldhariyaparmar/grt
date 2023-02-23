<x-guest-layout>


    <!-- Begin Log In Section -->
    <section class="section-wrap login-register-section donation-login-section-wrap clear">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="section-title">
                        <h2>Log in</h2>
                        <!-- <h4>Need an account? <a href="register.html">Register here</a></h4> -->
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="login-form-wrap">
                        <div class="login-form-inner">
                                <x-auth-card>
                                    <x-slot name="logo">
                                        <a href="{{URL::to('/')}}">
                                            <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                                        </a>
                                    </x-slot>
                                    <!-- Session Status -->
                                    <x-auth-session-status class="mb-4" :status="session('status')" />

                                    <!-- Validation Errors -->
                                    <x-auth-validation-errors class="mb-4" :errors="$errors" />


                                    <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <!-- Email Address -->
                                    <div>
                                        <div class="custom-row">
                                            <!-- <x-label for="email" :value="__('Email address')" /> -->

                                            <x-input id="email" class="block mt-1 w-full input-bx" type="email" name="email" :value="old('email')" required autofocus placeholder="Email address" />
                                        </div>
                                    </div>

                                    <!-- Password -->
                                    <div>
                                        <div class="custom-row">
                                        <!-- <x-label for="password" :value="__('Password')" /> -->

                                        <x-input id="password" class="block mt-1 w-full input-bx"
                                                        type="password"
                                                        name="password"
                                                        required autocomplete="current-password" placeholder="Password" />
                                        </div>
                                    </div>

                                    <div class="custom-row">
                                        <x-button class="btn-wrap">
                                            {{ __('Log in') }}
                                        </x-button>
                                    </div>
                                    <!-- Forgot your password -->
                                    <div class="custom-row text-center">
                                        @if (Route::has('password.request'))
                                            <a class="link-txt" href="{{ route('password.request') }}">
                                                {{ __('Forgot your password?') }}
                                            </a>
                                        @endif
                                    </div>
                                </form>
                            </x-auth-card>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!--// End Log In Section -->
</x-guest-layout>
