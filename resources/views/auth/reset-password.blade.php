
<x-guest-layout>
    <!-- Begin Reset password Section -->
    <section class="section-wrap login-register-section donation-login-section-wrap clear">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="section-title">
                        <h2>Reset password</h2>
                        <!-- <h4>No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.</h4> -->
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

                                <form method="POST" action="{{ route('password.update') }}">
                                    @csrf

                                    <!-- Password Reset Token -->
                                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                                    <!-- Email Address -->
                                    <div>
                                        <div class="custom-row">
                                            <!-- <x-label for="email" :value="__('Email address')" /> -->

                                            <x-input id="email" class="block mt-1 w-full input-bx" type="email" name="email" :value="old('email', $request->email)" required autofocus placeholder="Email address" />
                                        </div>
                                    </div>

                                    <!-- Password -->
                                    <div>
                                        <div class="custom-row">
                                            <!-- <x-label for="password" :value="__('Password')" /> -->

                                            <x-input id="password" class="block mt-1 w-full input-bx" type="password" name="password" required placeholder="Password" />
                                        </div>
                                    </div>

                                    <!-- Confirm Password -->
                                    <div>
                                        <div class="custom-row">
                                            <!-- <x-label for="password_confirmation" :value="__('Confirm Password')" /> -->

                                            <x-input id="password_confirmation" class="block mt-1 w-full input-bx"
                                                                type="password"
                                                                name="password_confirmation" required placeholder="Confirm password" />
                                        </div>
                                    </div>

                                    <div class="custom-row">
                                        <x-button class="btn-wrap">
                                            {{ __('Reset password') }}
                                        </x-button>
                                    </div>
                                </form>
                            </x-auth-card>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!--// End Reset password Section -->
</x-guest-layout>

