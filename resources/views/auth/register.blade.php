<!DOCTYPE html>
<html>

<head>
    <title>Sign Up </title>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/moviesignup.css') }}">
</head>

<body>
    <div class="signup-form">
        <div class="logo">
            <img src="{{ asset('assets/images/a.jpg') }}" alt="">
        </div>
        <div class="title-text">
            <h3>Create an Account</h3>
        </div>
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="container">

                <div>
                    <label for="email"> Your Email</label>
                    <input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                        required>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
                <div>
                    <label for="text"> Your Name</label>
                    <input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                        required autofocus>
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>
                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" />

                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                        autocomplete="new-password" />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div class="mt-4">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                    <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                        name="password_confirmation" required autocomplete="new-password" />

                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

            </div>

            <div class="button"> <button type="submit" class="bn632-hover bn18">Sign Up</button></div>
        </form>
        <div class="login-link">
            <p>Already have an account? <a href="{{ route('login') }}">Log in</a></p>
        </div>
    </div>
    <div class="image">
        <img src="{{ asset('assets/images/m.jpg') }}" alt="">
    </div>
</body>

</html>
