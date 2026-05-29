<div class="bg-white rounded-[24px] border border-[#EDF0FA] shadow-sm p-5 mb-5">

    <!-- TOP -->
    <div class="flex justify-between items-start">

        <div class="flex items-center gap-2">

            <span
                class="h-7 px-3 flex items-center justify-center rounded-full bg-[#EAF2FF] text-[#2F6BFF] text-[12px] font-medium leading-none">
                High
            </span>

            <span
                class="h-7 px-3 flex items-center justify-center rounded-full bg-[#FFECEF] text-[#FF7D92] text-[12px] font-medium leading-none">
                RPL
            </span>
        </div>

        <button class="text-[#2F6BFF] text-xl">
            <i class="ri-more-2-fill"></i>
        </button>
    </div>

    <!-- TITLE -->
    <h3
        class="text-[#2F6BFF] text-[24px] font-semibold mt-5 mb-4 leading-tight">

        Final Project Semester II
    </h3>

    <!-- CHECKLIST -->
    <div class="space-y-3">

        @for($j = 0; $j < 4; $j++)
        <div class="flex items-center gap-2">

            <div
                class="w-5 h-5 rounded-full border-2 border-[#2F6BFF] shrink-0">
            </div>

            <span class="text-[17px] text-[#707991] leading-none">
                Design The Dashboard
            </span>
        </div>
        @endfor
    </div>

    <!-- FOOTER -->
    <div class="flex justify-between items-center mt-6">

        <div class="flex items-center gap-2 text-[#98A2B3] text-sm">

            <i class="ri-calendar-line text-[18px]"></i>

            <span>24 Desember 2026</span>
        </div>

        <button
            class="text-[18px]"
            style="color: {{ $deleteColor }}">
            <i class="ri-delete-bin-6-line"></i>
        </button>

    </div>
</div>