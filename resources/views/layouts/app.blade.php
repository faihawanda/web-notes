<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Payroll App' }}</title>
    {{-- Remix Icon --}}
    <link href="https://cdn.jsdelivr.net/npm/remixicon/fonts/remixicon.css" rel="stylesheet">
    {{-- Google Font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap"
        rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#F8F9FC] antialiased overflow-hidden" style="font-family: 'Plus Jakarta Sans', sans-serif;">

    <div class="flex h-screen">

        {{-- ===== SIDEBAR ===== --}}
        <aside class="w-64 bg-white shadow-sm flex flex-col">

            {{-- Logo --}}
            <div class="h-20 flex items-center justify-center py-20 pt-16">
                <div class="flex justify-center items-center gap-3">
                    <i class="ri-booklet-fill text-xl bg-[#0367F8] text-white py-1 px-1.5 rounded"></i>
                    <span class="text-2xl font-bold text-[#0367F8]">Notesy</span>
                </div>
            </div>

            {{-- Menu --}}
            <nav class="flex-1 px-4 py-10 space-y-1">

                <a href="{{ route('dashboard') }}"
                    class="flex items-center gap-5 px-5 py-4 text-base font-semibold
                    {{ request()->routeIs('dashboard')
                    ? 'bg-[#F1F5FE] text-[#0367F8] border-l-[6px] border-[#0367F8] rounded-xl'
                    : 'border-l-[6px] border-transparent text-gray-600 hover:text-[#0367F8] transition-all' }}">
                    <i class="ri-home-line text-2xl"></i>
                    Dashboard
                </a>


                <a href="{{ route('allnotes.index') }}"
                    class="flex items-center gap-5 px-5 py-4 rounded-lg text-base font-semibold
                         {{ request()->routeIs('allnotes.*') ? 'bg-[#F1F5FE] text-[#0367F8] border-l-[6px] border-[#0367F8] rounded-xl'
                    : 'border-l-[6px] border-transparent text-gray-600 hover:text-[#0367F8] transition-all' }}">
                    <i class="ri-sticky-note-line text-2xl"></i>
                    All Notes
                </a>

                <a href="{{ route('category.index') }}"
                    class="flex items-center gap-5 px-5 py-4 rounded-lg text-base font-semibold
                         {{ request()->routeIs('category.*') ? 'bg-[#F1F5FE] text-[#0367F8] border-l-[6px] border-[#0367F8] rounded-xl'
                    : 'border-l-[6px] border-transparent text-gray-600 hover:text-[#0367F8] transition-all' }}">
                    <i class="ri-folder-3-line text-2xl"></i>
                    Categories
                </a>

                <a href="{{ route('tasklist.index') }}"
                    class="flex items-center gap-5 px-5 py-4 rounded-lg text-base font-semibold
                         {{ request()->routeIs('tasklist.*') ? 'bg-[#F1F5FE] text-[#0367F8] border-l-[6px] border-[#0367F8] rounded-xl'
                    : 'border-l-[6px] border-transparent text-gray-600 hover:text-[#0367F8] transition-all' }}">
                    <i class="ri-list-check-3 text-2xl"></i>
                    Task List
                </a>
            </nav>

            {{-- User Info + Logout --}}
            <div>
                <form method="POST" action="{{ route('logout') }}" class="px-5 py-4 pb-3">
                    @csrf
                    <button type="submit"
                        class="w-full flex items-center gap-5 px-5 py-4 rounded-lg text-base text-red-500 hover:bg-white font-medium transition">
                        <i class="ri-logout-box-line text-2xl"></i> 
                        Logout
                    </button>
                </form>
            </div>

        </aside>
        {{-- ===== END SIDEBAR ===== --}}

        {{-- ===== MAIN CONTENT ===== --}}
        <div class="flex-1 flex flex-col">

            {{-- Page Content --}}
            <main class="flex-1 p-14 overflow-y-auto">
                @yield('content')
            </main>

        </div>
        {{-- ===== END MAIN CONTENT ===== --}}

    </div>

</body>

</html>