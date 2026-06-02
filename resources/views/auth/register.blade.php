<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Register</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap"
        rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased bg-white" style="font-family: 'Plus Jakarta Sans', sans-serif;">

    <div class="w-screen h-screen overflow-hidden grid grid-cols-1 md:grid-cols-2 gap-12">

        <div class="w-full max-w-md mx-auto justify-center items-center flex">
            <div>
                <div class="flex flex-col justify-center items-center text-center mb-10 w-full">
                    <h2 class="text-4xl font-bold text-black mb-3">Get Started with Notesy</h2>
                    <p class="text-sm text-gray-600 leading-relaxed max-w-xs mx-auto">
                        Create an account to manage your notes easily
                    </p>
                </div>

                <form method="POST" action="{{ route('register') }}" class="space-y-4">
                    @csrf

                    <div>
                        <input id="name"
                            class="block w-full px-6 py-4 bg-[#F5F5F5] border border-transparent rounded-full text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#548CA1] focus:bg-white shadow-sm transition"
                            type="text" name="name" placeholder="Full Name" value="{{ old('name') }}" required
                            autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div>
                        <input id="email"
                            class="block w-full px-6 py-4 bg-[#F5F5F5] border border-transparent rounded-full text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#548CA1] focus:bg-white shadow-sm transition"
                            type="email" name="email" placeholder="Email" value="{{ old('email') }}" required
                            autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div>
                        <input id="password"
                            class="block w-full px-6 py-4 bg-[#F5F5F5] border border-transparent rounded-full text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#548CA1] focus:bg-white shadow-sm transition"
                            type="password" name="password" placeholder="Password" required
                            autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div>
                        <input id="password_confirmation"
                            class="block w-full px-6 py-4 bg-[#F5F5F5] border border-transparent rounded-full text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#548CA1] focus:bg-white shadow-sm transition"
                            type="password" name="password_confirmation" placeholder="Confirm Password" required
                            autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <div class="pt-10">
                        <button type="submit"
                            class="w-full py-4 bg-[#1A1A1A] hover:bg-black text-white font-medium rounded-full transition duration-200 shadow-md flex justify-center items-center">
                            {{ __('Register') }}
                        </button>
                    </div>

                    <div class="text-center pt-2">
                        <a class="text-sm text-gray-400 hover:text-gray-600 transition" href="{{ route('login') }}">
                            Already registered? Log in
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <div class="h-full w-full bg-[#1430FF] relative">
            <div class="absolute bottom-0 p-10">
                <h1 class="text-white text-[170px] font-bold leading-none">Hi, <br>User :D</h1>
            </div>
        </div>

    </div>

</body>

</html>
