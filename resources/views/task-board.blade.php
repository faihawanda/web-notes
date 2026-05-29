@extends('layouts.app')

@section('content')
<div class="bg-[#F8F9FC] min-h-screen p-8">

    <!-- TOP HEADER -->
    <div class="flex flex-col lg:flex-row justify-between lg:items-start gap-6 mb-8">

        <!-- LEFT -->
        <div>
            <h1 class="text-[42px] md:text-[52px] font-bold text-black leading-tight">
                Welcome {{ auth()->user()->name }}!
            </h1>

            <!-- TEAM -->
            <div class="flex flex-wrap items-center gap-4 mt-6">

                <h2 class="font-semibold text-[22px] text-black">
                    Teams
                </h2>

                <button
                    class="h-[48px] px-8 rounded-full bg-[#2F6BFF] text-white font-medium shadow-sm hover:scale-105 duration-300">
                    RPL
                </button>

                <button
                    class="h-[48px] px-8 rounded-full border border-[#C9C9FF] bg-white text-[#7067F5] font-medium hover:bg-[#F7F8FF] duration-300">
                    Magazine
                </button>

                <button
                    class="h-[48px] px-8 rounded-full border border-[#F0D38A] bg-white text-[#D9A01E] font-medium hover:bg-[#FFF9ED] duration-300">
                    Tahfidz
                </button>

                <button
                    class="w-[48px] h-[48px] rounded-full border border-[#D4D8F0] bg-white text-[#2F6BFF] flex items-center justify-center text-2xl hover:bg-[#F5F7FF] duration-300">

                    <i class="ri-add-line"></i>
                </button>

            </div>
        </div>

        <!-- RIGHT -->
        <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4">

            <!-- SEARCH -->
            <div
                class="flex items-center bg-white border border-[#E5E8F5] rounded-full px-5 h-[56px] w-full sm:w-[430px] shadow-sm">

                <i class="ri-search-line text-[#2F6BFF] text-[22px]"></i>

                <input
                    type="text"
                    placeholder="Find Your Task"
                    class="w-full ml-3 bg-transparent outline-none text-[#667085] placeholder:text-[#98A2B3]">

            </div>

            <!-- PROFILE -->
            <div
                class="bg-white border border-[#E5E8F5] rounded-full px-3 py-2 flex items-center shadow-sm min-w-[190px]">

                <div
                    class="w-[50px] h-[50px] rounded-full bg-gray-300 overflow-hidden">
                </div>

                <div class="ml-3">
                    <h3 class="font-semibold text-[15px] leading-none">
                        {{ auth()->user()->name }}
                    </h3>

                    <p class="text-[#98A2B3] text-sm mt-1">
                        User
                    </p>
                </div>

            </div>
        </div>
    </div>

    <!-- BOARD -->
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

        <!-- TO DO -->
        <div class="bg-[#FBFCFF] border border-[#E3E8F4] rounded-[30px] p-4">

            <!-- HEADER -->
            <div
                class="bg-[#EEF2FF] rounded-[22px] px-5 py-4 flex items-center justify-between mb-5">

                <div class="flex items-center gap-3">

                    <div
                        class="w-10 h-10 rounded-full bg-[#6D77FF] flex items-center justify-center text-white">
                        <i class="ri-time-line"></i>
                    </div>

                    <h2 class="font-semibold text-[28px] text-[#111827]">
                        To-Do
                    </h2>

                    <span
                        class="h-7 px-3 flex items-center justify-center rounded-full bg-[#DDE7FF] text-[#2F6BFF] text-sm font-medium">
                        4
                    </span>

                </div>

                <button class="text-[#6B7280] text-xl">
                    <i class="ri-more-2-fill"></i>
                </button>
            </div>

            <!-- TASKS -->
            @for($i = 0; $i < 2; $i++)
                @include('partials.task-card', [
                    'deleteColor' => '#FF7C93'
                ])
            @endfor

            <!-- BUTTON -->
            <button
                class="w-full h-[58px] bg-[#2F6BFF] rounded-[20px] text-white text-xl font-medium hover:scale-[1.02] duration-300 flex items-center justify-center gap-2">

                <i class="ri-add-line text-2xl"></i>
                Add Task
            </button>
        </div>


        <!-- IN PROGRESS -->
        <div class="bg-[#FBFCFF] border border-[#E3E8F4] rounded-[30px] p-4">

            <div
                class="bg-[#F1EEFF] rounded-[22px] px-5 py-4 flex items-center justify-between mb-5">

                <div class="flex items-center gap-3">

                    <div
                        class="w-10 h-10 rounded-full bg-[#8C7AE6] flex items-center justify-center text-white">
                        <i class="ri-loader-4-line"></i>
                    </div>

                    <h2 class="font-semibold text-[28px]">
                        In Progress
                    </h2>

                    <span
                        class="h-7 px-3 flex items-center justify-center rounded-full bg-[#DDE7FF] text-[#2F6BFF] text-sm font-medium">
                        4
                    </span>
                </div>

                <button class="text-[#6B7280] text-xl">
                    <i class="ri-more-2-fill"></i>
                </button>
            </div>

            @for($i = 0; $i < 2; $i++)
                @include('partials.task-card', [
                    'deleteColor' => '#FF7C93'
                ])
            @endfor

            <button
                class="w-full h-[58px] bg-[#8C7AE6] rounded-[20px] text-white text-xl font-medium flex items-center justify-center gap-2">

                <i class="ri-add-line text-2xl"></i>
                Add Task
            </button>
        </div>


        <!-- DONE -->
        <div class="bg-[#FBFCFF] border border-[#E3E8F4] rounded-[30px] p-4">

            <div
                class="bg-[#EDF9F0] rounded-[22px] px-5 py-4 flex items-center justify-between mb-5">

                <div class="flex items-center gap-3">

                    <div
                        class="w-10 h-10 rounded-full bg-[#43C06B] flex items-center justify-center text-white">
                        <i class="ri-check-line"></i>
                    </div>

                    <h2 class="font-semibold text-[28px]">
                        Done
                    </h2>

                    <span
                        class="h-7 px-3 flex items-center justify-center rounded-full bg-[#DDE7FF] text-[#2F6BFF] text-sm font-medium">
                        4
                    </span>
                </div>

                <button class="text-[#6B7280] text-xl">
                    <i class="ri-more-2-fill"></i>
                </button>
            </div>

            @for($i = 0; $i < 2; $i++)
                @include('partials.task-card', [
                    'deleteColor' => '#43C06B'
                ])
            @endfor

            <button
                class="w-full h-[58px] bg-[#43C06B] rounded-[20px] text-white text-xl font-medium flex items-center justify-center gap-2">

                <i class="ri-add-line text-2xl"></i>
                Add Task
            </button>
        </div>

    </div>
</div>
@endsection