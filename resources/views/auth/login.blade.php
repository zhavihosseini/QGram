<head>
<title>Login</title>
<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit"
        async defer>
</script>
<script src="https://kit.fontawesome.com/9067ae8a47.js" crossorigin="anonymous"></script>
</head>
<x-guest-layout>
    <div class="cards or1">
    <x-jet-authentication-card>
        <x-slot name="logo">
            <img src="{{asset('qr-codes6.png')}}" class="block h-12 w-auto" />
        </x-slot>
        <x-jet-validation-errors class="mb-4" />
        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
            {{ session('status') }}
        </div>
        @endif
        @if(session('email'))
            <div class="container-fluid float-left" id="snackbar" style="background-color: red"><strong>{{session('email')}}</strong></div>
        @endif
{{--        <form method="POST" action="{{route('login','en')}}">--}}
{{--            @csrf--}}
{{--            <div>--}}
{{--                <x-jet-label value="Username" />--}}
{{--                <x-jet-input class="block mt-1 w-full" type="text" name="username" :value="old('username')" required autofocus />--}}
{{--            </div>--}}
{{--            <div class="mt-4">--}}
{{--                <x-jet-label for="password" value="{{ __('Password') }}" />--}}
{{--                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />--}}
{{--            </div>--}}
{{--            <br>--}}
{{--            <div class="block mt-4">--}}
{{--                <label for="remember_me" class="flex items-center">--}}
{{--                    <input id="remember_me" type="checkbox" class="form-checkbox" name="remember">--}}
{{--                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>--}}
{{--                </label>--}}
{{--            </div>--}}

{{--            <div class="flex items-center justify-end mt-4">--}}
{{--                @if (Route::has('password.request'))--}}
{{--                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{'password.request'}}">--}}
{{--                        {{ __('Forgot your password?') }}--}}
{{--                    </a>--}}
{{--                @endif--}}

{{--                <x-jet-button class="ml-4">--}}
{{--                    {{ __('Login') }}--}}
{{--                </x-jet-button>--}}
{{--            </div>--}}
{{--        </form>--}}
        <a href="{{ url('auth/google') }}" target="_blank">
            <button class="loginBtn loginBtn--google" style="width: 100%" title="Signup with Google">
                Login with Google
            </button>
        </a>
        <div class="or-container">
            <div class="line-separator"></div>
            <div class="or-label">or</div>
            <div class="line-separator"></div>
        </div>
                <form method="POST" action="{{route('login')}}">
                    @csrf
                    <div>
                        {{--<x-jet-label for="username" value="Username" class="fas fa-question-circle"/>--}}
                        <x-jet-input class="block mt-1 w-full username" type="text" name="username" :value="old('username')" required autofocus placeholder="Username"/>
                    </div>
                    <div class="mt-4">
                        {{--<x-jet-label for="password" value="{{ __('Password') }}" />--}}
                        <x-jet-input class="block mt-1 w-full password" type="password" name="password" required autocomplete="current-password" placeholder="Password"/>
                    </div>
                  {{--  <div class="mt-3">
                        <label for="remember_me" class="flex">
                            <input id="remember_me" type="checkbox" class="form-checkbox" name="remember" style="float: left">
                            <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                            @if (Route::has('password.request'))
                                <a class="text-sm text-gray-600 hover:text-gray-900" href="{{route('password.request')}}" style="float: right;margin-left: 140px">
                                    {{ __('Forgot your password?') }}
                                </a>
                            @endif
                        </label>
                    </div>--}}
                    <div class="clearfix">
                        <div class="floatRight"><input id="remember_me" type="checkbox" class="form-checkbox" name="remember">
                            <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span></div>
                        <div class="floatLeft"> @if (Route::has('password.request'))
                                <a class="text-sm text-gray-600 hover:text-gray-900" href="{{route('password.request')}}">
                                    {{ __('Forgot your password?') }}
                                </a>
                            @endif</div>
                        <br />
                    </div>
                    <div class="col-md-12" style="text-align: center;">
                        <div class="form-group{{$errors->has('g-recaptcha-response') ? ' has-error' : '' }}">
                            <div class="col-md-6 pull-center" style="display: inline-block;">
                                {!! app('captcha')->display() !!}
                            </div>
                        </div>
                    </div>
                    {!! NoCaptcha::renderJs() !!}
                    <x-jet-button class="block mt-1 w-full center-block justify-content-center" style="border:1px solid lightgrey;color: black;font-weight: bold;border-radius: 0px;text-align: center">
                        {{__('login.loginb')}}
                    </x-jet-button>
                </form>
    </x-jet-authentication-card>
    </div>
</x-guest-layout>
<script> {{-- var x = document.getElementById("snackbar");
    x.className = "show";
    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);</script>
--}}
