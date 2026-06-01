@extends('layouts.app')

@section('content')

 {{-- Header --}}
    <div class="flex items-center gap-5 mb-8">
        <h1 class="text-4xl font-bold text-gray-800 mb-2">NoteSpace</h1>
    </div>
    <div class="flex items-center gap-5 mb-8 mt-20">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Recent Notes</h1>
        <div class="py-1 px-2 font-semibold border border-2 border-black rounded-xl">
            <button onclick="openAddModal()">
                <i class="ri-add-line text-black"></i>
            </button>
        </div>
    </div>

     {{-- Content --}}
    <div class="grid grid-cols-4 gap-x-10 gap-y-10 w-fit">

         {{-- card yellow --}}
            <div class="w-[320px] h-[380px] bg-[#F1BB45] rounded-[24px] p-5 relative">
                {{-- top --}}
                <div class="flex items-center justify-between mb-4">
                    <h1 class="text-white text-[20px] font-semibold">Groceries</h1>
                    <button class="text-white text-[32px] leading-none">+</button>
                </div>
                {{-- paper --}}
                <div class="bg-[#F4F4F4] rounded-[18px] h-[285px] px-5 py-5 relative">
                    <h1 class="text-[16px] font-semibold text-[#111111]">Grocery List</h1>

                    <div class="w-full h-[1px] bg-gray-300 mt-3 mb-5"></div>
                    <ul class="space-y-1 text-[14px] text-[#222222]">
                        <li>Milk</li>
                        <li>Chicken</li>
                        <li>Juice</li>
                        <li>Mango</li>
                    </ul>
                    {{-- date --}}
                    <span class="absolute bottom-4 right-5 text-[12px] text-gray-400">12/12/2026</span>
                </div>
            </div>
    </div>
@endsection