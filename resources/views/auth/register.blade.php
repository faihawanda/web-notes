<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <!-- Remixicon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-poppins bg-white overflow-x-hidden">
    <!--register-->
    <section class="flex items-center justify-center px-6 py-20 min-h-screen relative overflow-hidden">
        <!--blur-->
        <div class="absolute -top-40 -right-20 w-[300px] h-[400px] bg-blue-600 rounded-full blur-[120px] opacity-40"></div>
        <div class="absolute bottom-0 -left-20 w-[300px] h-[400px] bg-blue-600 rounded-full blur-[120px] opacity-40"></div>

        <!--card-->
        <div class="w-full max-w-md relative z-10">
            <!--title-->
            <div class="text-center mb-10">
                <h2 class="text-3xl font-medium">Create Account</h2>
                <p class="text-sm text-gray-500 mt-3">Register and start your journey with us.</p>
            </div>

            <!--form-->
            <form method="POST" action="{{ route('register') }}" class="space-y-6">
                @csrf
                <!--name-->
                <div>
                    <label class="text-sm tracking-wide">Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" placeholder="Enter your name" class="w-full mt-2 px-4 py-3 border border-gray-300 focus:outline-none focus:border-blue-600 transition"/>
                    @error('name')
                        <p class="text-red-500 text-sm mt-2">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!--email-->
                <div>
                    <label class="text-sm tracking-wide">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required autocomplete="username" placeholder="Enter your email" class="w-full mt-2 px-4 py-3 border border-gray-300 focus:outline-none focus:border-blue-600 transition"/>
                    @error('email')
                        <p class="text-red-500 text-sm mt-2">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!--password-->
                <div>
                    <label class="text-sm tracking-wide">Password</label>
                    <input type="password" name="password" required autocomplete="new-password" placeholder="Enter your password" class="w-full mt-2 px-4 py-3 border border-gray-300 focus:outline-none focus:border-black transition"/>
                    @error('password')
                        <p class="text-red-500 text-sm mt-2">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!--confirm password-->
                <div>
                    <label class="text-sm tracking-wide">Confirm Password</label>
                    <input type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm your password" class="w-full mt-2 px-4 py-3 border border-gray-300 focus:outline-none focus:border-black transition"/>
                    @error('password_confirmation')
                        <p class="text-red-500 text-sm mt-2">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!--button-->
                <button type="submit" class="w-full mt-4 uppercase tracking-widest text-sm py-3 border border-black hover:bg-blue-600 hover:text-white hover:border-white transition">
                    Register
                </button>
            </form>

            <!--login-->
            <div class="text-center mt-10 text-sm">
                Already have an account?
                <a href="{{ route('login') }}"class="underline hover:opacity-60">Log in</a>
            </div>
        </div>
    </section>

</body>
</html>