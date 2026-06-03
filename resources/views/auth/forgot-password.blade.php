<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Forgot Password</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-white">

    <div class="min-h-screen flex items-center justify-center p-6">
        <div class="w-full max-w-md mx-auto">

            <div class="flex flex-col justify-center items-center text-center mb-6 w-full">
                <h2 class="text-3xl font-bold text-black mb-3">Reset Password</h2>
                <p class="text-sm text-gray-500 leading-relaxed max-w-xs mx-auto">
                    {{ __('We’ll send you a password reset link.') }}
                </p>
            </div>

            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
                @csrf

                <div>
                    <input id="email" 
                           class="block w-full px-6 py-4 bg-[#F5F5F5] border border-transparent rounded-full text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#548CA1] focus:bg-white shadow-sm transition" 
                           type="email" 
                           name="email" 
                           placeholder="Email Address"
                           value="{{ old('email') }}" 
                           required 
                           autofocus />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full py-4 bg-[#1A1A1A] hover:bg-black text-white font-medium rounded-full transition duration-200 shadow-md flex justify-center items-center">
                        {{ __('Email Password Reset Link') }}
                    </button>
                </div>

                <div class="text-center pt-2">
                    <a class="text-sm text-gray-400 hover:text-gray-600 transition" href="{{ route('login') }}">
                        Back to Log in
                    </a>
                </div>
            </form>

        </div>
    </div>

</body>
</html>