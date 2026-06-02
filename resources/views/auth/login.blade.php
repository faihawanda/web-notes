<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }} - Login</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap"
        rel="stylesheet">

</head>

<body class="antialiased bg-white" style="font-family: 'Plus Jakarta Sans', sans-serif;">

    <div class="w-screen h-screen overflow-hidden grid grid-cols-1 md:grid-cols-2 gap-12">

        <div class="h-full w-full bg-[#1430FF] relative">
            <div class="absolute bottom-0 p-10">
                <h1 class="text-white text-[170px] font-bold leading-none">Hello, <br>User :D</h1>
            </div>
        </div>

        <div class="w-full max-w-md mx-auto justify-center items-center flex">
            <div>
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <div class="flex flex-col justify-center items-center text-center mb-10 w-full">
                    <h2 class="text-4xl font-bold text-black mb-3">Glad to See You Again!</h2>
                    <p class="text-sm text-gray-600 leading-relaxed max-w-xs mx-auto">
                        Enter your account details to access Notesy
                    </p>
                </div>

                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf

                    <div>
                        <input id="email"
                            class="block w-full px-6 py-4 bg-[#F5F5F5] border border-transparent rounded-full text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#548CA1] focus:bg-white shadow-sm transition"
                            type="email" name="email" placeholder="Email" value="{{ old('email') }}" required
                            autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div>
                        <input id="password"
                            class="block w-full px-6 py-4 bg-[#F5F5F5] border border-transparent rounded-full text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#548CA1] focus:bg-white shadow-sm transition"
                            type="password" name="password" placeholder="Password" required
                            autocomplete="current-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div class="flex items-center ps-1 pt-1">
                        <label for="remember_me" class="inline-flex items-center cursor-pointer">
                            <input id="remember_me" type="checkbox"
                                class="w-5 h-5 rounded bg-gray-300 border-transparent text-[#1430FF] focus:ring-[#1430FF]"
                                name="remember">
                            <span class="ms-3 text-sm text-gray-600">Remember me</span>
                        </label>
                    </div>

                    <div class="pt-10">
                        <button type="submit"
                            class="w-full py-4 bg-[#1A1A1A] hover:bg-black text-white font-medium rounded-full transition duration-200 shadow-md flex justify-center items-center">
                            {{ __('Log in') }}
                        </button>
                    </div>

                    @if (Route::has('password.request'))
                        <div class="text-center">
                            <a class="text-sm text-gray-400 hover:text-gray-600 transition"
                                href="{{ route('password.request') }}">
                                Forgot your password?
                            </a>
                        </div>
                    @endif
                </form>
            </div>
        </div>

    </div>

</body>

</html>
