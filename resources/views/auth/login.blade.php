<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/movielogin.css') }}">
</head>

<body>
    <div class="login-form">
        <div class="logo">
            <img src="{{ asset('assets/images/a.jpg') }}"alt="">
        </div>
        <x-auth-session-status class="mb-4" :status="session('status')" />
        <div class="title-text">
            <h3>Sign in to Your Account</h3>
        </div>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="container">
                <label for="email"> Your Email</label>
                <input id="email" class="block mt-1 w-full" type="email" name="email" autofocus required>
                <x-input-error :messages="$errors->get('email')" class="mt-2" />

                <label for="password"> Your password</label>
                <input id="password" class="block mt-1 w-full" type="password" name="password" required>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />

            </div>
            <div class="button"> <button type="submit" class="bn632-hover bn18">Sign in</button></div>
            <div class="new-account">
                <div class="flex items-center justify-end mt-4">
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                            href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif
                </div>
                <p>Don't have an account? <a href="{{ route('register') }}">Sign up</a></p>
            </div>
        </form>
    </div>
    <div class="image">
        <img src="{{ asset('assets/images/m.jpg') }}" alt="">


    </div>
</body>

</html>
