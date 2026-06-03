@extends('layouts.app')

@section('content')
    <div class="w-fit h-full grid grid-cols-1 md:grid-cols-12 gap-6">

        {{-- LEFT COLUMN --}}
        <div class="md:col-span-7 flex flex-col gap-6">

            {{-- Categories --}}
            <div class="bg-[#4187E7]  rounded-xl shadow-sm relative">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-10 p-10 ">
                    <div>
                        <h2 class="text-white text-4xl font-bold pb-20">Create categories to group your notes</h2>
                        <p class="text-white/85 text-base">Keep everything organized and clutter-free.</p>
                    </div>

                    <div class="w-full flex justify-end items-end pt-5 ">
                        <a href="{{ route('category.index') }}">
                            <button
                                class="bg-white hover:bg-gray-50 text-[#4187E7] font-bold py-3 px-6 rounded-xl text-lg shadow-sm transition duration-200">
                                Add New Category
                            </button>
                        </a>
                    </div>
                </div>
            </div>

            {{-- Calender --}}
            <div class="bg-white p-10 rounded-xl shadow-sm flex-1">
                <div class="flex justify-between items-start mb-5">
                    <div class="flex flex-col">
                        <h2 class="text-2xl font-bold" id="calendar-month-year">May, 2026</h2>
                        <p class="text-sm text-slate-500" id="calendar-day-name">Today View</p>
                    </div>

                    <!-- Navigation Buttons -->
                    <div class="flex gap-1 bg-slate-100 p-1 rounded-xl">
                        <button id="prev-month"
                            class="px-3 py-1 text-slate-600 hover:bg-white rounded-lg transition font-bold">&lt;</button>
                        <button id="next-month"
                            class="px-3 py-1 text-slate-600 hover:bg-white rounded-lg transition font-bold">&gt;</button>
                    </div>
                </div>

                <!-- Days -->
                <div class="grid grid-cols-7 text-center text-xs font-bold text-slate-400 mb-2">
                    <div>Su</div>
                    <div>Mo</div>
                    <div>Tu</div>
                    <div>We</div>
                    <div>Th</div>
                    <div>Fr</div>
                    <div>Sa</div>
                </div>

                <!-- Grid -->
                <div class="grid grid-cols-7 gap-y-2 text-center text-sm font-medium text-slate-700" id="calendar-grid">
                    <!-- Generated via JS -->
                </div>
            </div>

        </div>

        {{-- RIGHT COLUMN --}}
        <div class="md:col-span-5 flex flex-col gap-6">

            {{-- Pomodoro --}}
            <div class="bg-white p-10 rounded-xl shadow-sm flex flex-col items-center justify-center text-center py-8 h-full">
                <h2 class="text-2xl font-bold text-slate-800 mb-14">Pomodoro Time</h2>

                <div class="text-8xl font-bold text-slate-800 tracking-tight mb-20 tabular-nums" id="timer-display">
                    25:00
                </div>

                <div class="flex gap-2 w-full max-w-xs">
                    <button id="btn-start"
                        class="flex-1 bg-[#5FBB7A] text-white font-medium py-3 rounded-xl hover:bg-zinc-800 transition text-sm">Start</button>
                    <button id="btn-pause"
                        class="flex-1 bg-[#8581E0] text-white font-medium py-3 rounded-xl hover:bg-slate-500 transition text-sm">Pause</button>
                    <button id="btn-reset"
                        class="flex-1 bg-[#EF7452] text-white font-medium py-3 rounded-xl hover:bg-slate-500 transition text-sm">Reset</button>
                </div>
            </div>

            {{-- Project Manager --}}
            <div class="bg-[#F5BA46] p-10 rounded-xl shadow-sm">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-10 p-4 ">

                    <div class="w-full flex justify-start items-start ">
                        <a href="{{ route('tasks.index') }}">
                            <button
                                class="bg-white hover:bg-gray-50 text-[#F5BA46] font-bold py-3 px-6 rounded-xl text-lg shadow-sm transition duration-200">
                                Try It Now
                            </button>
                        </a>
                    </div>

                    <div class="">
                        <h2 class="text-white text-3xl font-bold pb-16">Manage your project</h2>
                        <p class="text-white/85 text-base">Keep everything organized and clutter-free.</p>
                    </div>


                </div>
            </div>
        </div>

    </div>

    <!-- JS -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // KALENDER
            let currentDate = new Date();
            const months = ["January", "February", "March", "April", "May", "June", "July", "August", "September",
                "October", "November", "December"
            ];

            function renderCalendar() {
                const year = currentDate.getFullYear();
                const month = currentDate.getMonth();

                // Tampilkan nama bulan dan tahun di header
                document.getElementById('calendar-month-year').textContent = `${months[month]}, ${year}`;

                const calendarGrid = document.getElementById('calendar-grid');
                calendarGrid.innerHTML = ''; 

                const firstDayIndex = new Date(year, month, 1).getDay();
                const totalDays = new Date(year, month + 1, 0).getDate();
                const today = new Date();

                // kotak kosong untuk hari sebelum tanggal 1
                for (let i = 0; i < firstDayIndex; i++) {
                    calendarGrid.appendChild(document.createElement('div'));
                }

                // render tanggal 1 sampai habis
                for (let day = 1; day <= totalDays; day++) {
                    const dayCell = document.createElement('div');
                    dayCell.className =
                        "py-2 flex items-center justify-center text-sm font-medium relative h-9 w-9 mx-auto";

                    // lingkaran merah
                    if (day === today.getDate() && month === today.getMonth() && year === today.getFullYear()) {
                        dayCell.innerHTML =
                            `<span class="bg-rose-500 text-white w-8 h-8 flex items-center justify-center rounded-full font-bold">${day}</span>`;
                    } else {
                        dayCell.textContent = day;
                    }

                    calendarGrid.appendChild(dayCell);
                }
            }

            // Tombol Navigasi Bulan
            document.getElementById('prev-month').addEventListener('click', () => {
                currentDate.setMonth(currentDate.getMonth() - 1);
                renderCalendar();
            });

            document.getElementById('next-month').addEventListener('click', () => {
                currentDate.setMonth(currentDate.getMonth() + 1);
                renderCalendar();
            });

            renderCalendar(); // Jalankan kalender pertama kali


            // POMODORO
            let timer;
            let isRunning = false;
            let timeLeft = 25 * 60; // 25 menit (dalam detik)

            const display = document.getElementById('timer-display');

            function updateTimerDisplay() {
                let m = Math.floor(timeLeft / 60);
                let s = timeLeft % 60;
                // mengubah angka satuan jadi dua digit
                display.textContent = `${m.toString().padStart(2, '0')}:${s.toString().padStart(2, '0')}`;
            }

            document.getElementById('btn-start').addEventListener('click', () => {
                if (!isRunning) {
                    isRunning = true;
                    timer = setInterval(() => {
                        if (timeLeft > 0) {
                            timeLeft--;
                            updateTimerDisplay();
                        } else {
                            clearInterval(timer);
                            isRunning = false;
                            alert("Pomodoro Time's Up!");
                            resetTimer();
                        }
                    }, 1000); // jalan setiap 1 detik
                }
            });

            document.getElementById('btn-pause').addEventListener('click', () => {
                clearInterval(timer);
                isRunning = false;
            });

            document.getElementById('btn-reset').addEventListener('click', () => {
                resetTimer();
            });

            function resetTimer() {
                clearInterval(timer);
                isRunning = false;
                timeLeft = 25 * 60; // kembalikan ke 25 menit
                updateTimerDisplay();
            }

            updateTimerDisplay(); // jalankan display awal (25:00)
        });
    </script>
@endsection
