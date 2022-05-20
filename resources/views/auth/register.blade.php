<script>
/*    import Button from "@/Jetstream/Button";
    export default {
        components: {Button}
    }*/
</script>
<script src="https://kit.fontawesome.com/9067ae8a47.js" crossorigin="anonymous"></script>
<x-guest-layout>
    <div class="cards or1">
    <x-jet-authentication-card>
        <x-slot name="logo">
            <img src="{{asset('qr-codes6.png')}}" class="block h-12 w-auto" />
        </x-slot>
        <x-jet-validation-errors class="mb-4" />
        <a href="{{ url('auth/google') }}" target="_blank">
        <button class="loginBtn loginBtn--google" style="width: 100%" title="Signup with Google">
            Signup with Google
        </button>
        </a>
        {{--<button class="loginBtn loginBtn--facebook" style="width: 100%" title="Signup with Facebook">
            Signup with Facebook</button>
        <br>--}}
        <div class="or-container">
            <div class="line-separator"></div>
            <div class="or-label">or</div>
            <div class="line-separator"></div>
        </div>
        <div class="or"></div>
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div>
                {{--<x-jet-label for="name" value="{{ __('Firstname and lastname') }}" />--}}
                <x-jet-input id="name" class="b block mt-1 w-full" type="text" name="name" :value="old('name')" placeholder="Firstname and lastname" required autofocus autocomplete="name" />
            </div>
            <br>
            <div>
                {{--<x-jet-label for="username" value="{{ __('UserName') }}" />--}}
                <x-jet-input id="username" class="b block mt-1 w-full{{ $errors->first('username') ? ' is-invalid' : '' }}" type="text" name="username" :value="old('username')" placeholder="UserName" required autofocus autocomplete="username" />
            </div>
            <div class="mt-4">
                {{--<x-jet-label for="email" value="{{ __('Email') }}" />--}}
                <x-jet-input id="email" class="b block mt-1 w-full" type="email" name="email" :value="old('email')" placeholder="Email" required />
            </div>
            <div class="mt-4">
                {{--<x-jet-label for="password" value="{{ __('Password') }}" />--}}
                <x-jet-input id="password" class="b block mt-1 w-full" type="password" name="password" placeholder="Password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                {{--<x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />--}}
                <x-jet-input id="password_confirmation" class="b block mt-1 w-full" type="password" name="password_confirmation" placeholder="Confirm Password" required autocomplete="new-password" />
            </div>
            <div class="mt-4">
                <input class="form-checkbox" type="checkbox" name="Confirms" value="Confirm" style="margin-right: 3px;border-radius: 0px">I read the <a href="{{route('privacy')}}" style="color: blue">Privacy-policy</a> and <a href="{{route('term')}}" style="color: blue">Terms-of-use</a> and I agree with it<br/>
            </div>
            <br>
            <div class="col-md-12" style="text-align: center;">
                <div class="form-group{{$errors->has('g-recaptcha-response') ? ' has-error' : '' }}">
                    <div class="col-md-6 pull-center" style="display: inline-block;">
                        {!! app('captcha')->display() !!}
                    </div>
                </div>
            </div>
            {!! NoCaptcha::renderJs() !!}
            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}" title="Click if you have registered">
                    {{ __('Already registered?') }}
                </a>
                <x-jet-button class="c ml-4" style="border:1px solid lightgrey;color: black;font-weight: bold;border-radius: 0px;text-align: center">
                    {{ __('Register') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
    @if(session('error'))
    <div class="container-fluid float-left" id="snackbar" style="background-color: red"><strong>{{session('error')}}</strong></div>
    @endif
</x-guest-layout>
<script> {{-- var x = document.getElementById("snackbar");
    x.className = "show";
    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);</script>
--}}
