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
                        <p class="text-sm text-slate-500" id="calendar-day-name">Today</p>
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
            <div
                class="bg-white p-10 rounded-xl shadow-sm flex flex-col items-center justify-center text-center py-8 h-full">
                <h2 class="text-2xl font-bold text-slate-800 mb-4">Pomodoro Time</h2>

                <!-- Custom Duration Input -->
                <div class="flex items-center gap-2 mb-4 bg-slate-50 px-2 py-4 rounded-xl border border-slate-200">
                    <label for="custom-minutes" class="text-xs text-slate-500 font-medium">Set Timer:</label>
                    <input type="number" id="custom-minutes" value="25" min="1" max="180"
                        class="w-12 bg-transparent text-center font-bold text-slate-700 border-b border-slate-300 focus:border-indigo-500 focus:outline-none text-sm">
                    <span class="text-xs text-slate-500 font-medium">min</span>
                </div>

                <!-- Timer Display -->
                <div class="text-7xl font-bold text-slate-800 tracking-tight mb-6 tabular-nums" id="timer-display">
                    25:00
                </div>

                <!-- Controls -->
                <div class="flex gap-2 w-full max-w-xs">
                    <button id="btn-start"
                        class="flex-1 bg-zinc-700 text-white font-medium py-3 rounded-xl hover:bg-zinc-800 transition text-sm">Start</button>
                    <button id="btn-pause"
                        class="flex-1 bg-slate-400 text-white font-medium py-3 rounded-xl hover:bg-slate-500 transition text-sm">Pause</button>
                    <button id="btn-reset"
                        class="flex-1 bg-slate-400 text-white font-medium py-3 rounded-xl hover:bg-slate-500 transition text-sm">Reset</button>
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

    <!-- Audio Element untuk Notifikasi Alami -->
    <audio id="notification-sound" src="https://assets.mixkit.co/active_storage/sfx/2869/2869-500.wav"
        preload="auto"></audio>

    <!-- JAVASCRIPT -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // ==========================================
            // 1. DINAMIS KALENDER SCRIPT
            // ==========================================
            let currentDate = new Date(); // Default ke hari ini

            const monthYearDisplay = document.getElementById('calendar-month-year');
            const dayNameDisplay = document.getElementById('calendar-day-name');
            const calendarGrid = document.getElementById('calendar-grid');
            const prevBtn = document.getElementById('prev-month');
            const nextBtn = document.getElementById('next-month');

            const months = ["January", "February", "March", "April", "May", "June", "July", "August", "September",
                "October", "November", "December"
            ];
            const days = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];

            function renderCalendar() {
                const year = currentDate.getFullYear();
                const month = currentDate.getMonth();

                // Set Header Bulan dan Tahun
                monthYearDisplay.textContent = `${months[month]}, ${year}`;

                // Set Subtitle Hari Ini
                const today = new Date();
                if (year === today.getFullYear() && month === today.getMonth()) {
                    dayNameDisplay.textContent = `Today: ${days[today.getDay()]}, ${today.getDate()}`;
                } else {
                    dayNameDisplay.textContent = `${months[month]} View`;
                }

                // Bersihkan grid kalender lama
                calendarGrid.innerHTML = '';

                // Mendapatkan hari pertama di bulan tersebut (0 = Minggu, 1 = Senin, dst)
                const firstDayIndex = new Date(year, month, 1).getDay();
                // Mendapatkan jumlah hari dalam bulan tersebut
                const totalDays = new Date(year, month + 1, 0).getDate();

                // Membuat cell kosong sebelum tanggal 1
                for (let i = 0; i < firstDayIndex; i++) {
                    const emptyCell = document.createElement('div');
                    calendarGrid.appendChild(emptyCell);
                }

                // Render tanggal-tanggalnya
                for (let day = 1; day <= totalDays; day++) {
                    const dayCell = document.createElement('div');
                    dayCell.className =
                        "py-2 flex items-center justify-center text-sm font-medium relative h-9 w-9 mx-auto";

                    // Menandai jika tanggal ini adalah HARI INI
                    if (day === today.getDate() && month === today.getMonth() && year === today.getFullYear()) {
                        dayCell.innerHTML =
                            `<span class="bg-rose-500 text-white w-8 h-8 flex items-center justify-center rounded-full font-bold shadow-sm">${day}</span>`;
                    } else {
                        dayCell.textContent = day;
                    }

                    calendarGrid.appendChild(dayCell);
                }
            }

            prevBtn.addEventListener('click', () => {
                currentDate.setMonth(currentDate.getMonth() - 1);
                renderCalendar();
            });

            nextBtn.addEventListener('click', () => {
                currentDate.setMonth(currentDate.getMonth() + 1);
                renderCalendar();
            });

            // Jalankan kalender pertama kali
            renderCalendar();


            // ==========================================
            // 2. POMODORO TIMER + CUSTOM + NOTIFIKASI
            // ==========================================
            let timer;
            let isRunning = false;

            const minutesInput = document.getElementById('custom-minutes');
            let timeLeft = parseInt(minutesInput.value) * 60;

            const display = document.getElementById('timer-display');
            const startBtn = document.getElementById('btn-start');
            const pauseBtn = document.getElementById('btn-pause');
            const resetBtn = document.getElementById('btn-reset');
            const audioNotif = document.getElementById('notification-sound');

            // Minta izin Notifikasi Browser (Pop-up) saat halaman dimuat
            if (Notification.permission !== "granted" && Notification.permission !== "denied") {
                Notification.requestPermission();
            }

            function updateTimerDisplay() {
                let m = Math.floor(timeLeft / 60);
                let s = timeLeft % 60;
                display.textContent = `${m.toString().padStart(2, '0')}:${s.toString().padStart(2, '0')}`;
            }

            // Jalankan fungsi update agar display awal mengikuti input
            updateTimerDisplay();

            // Mengubah timer otomatis saat input menit diubah oleh user
            minutesInput.addEventListener('input', () => {
                if (!isRunning) {
                    let val = parseInt(minutesInput.value);
                    if (isNaN(val) || val < 1) val = 1;
                    timeLeft = val * 60;
                    updateTimerDisplay();
                }
            });

            startBtn.addEventListener('click', () => {
                if (!isRunning) {
                    // Kunci input durasi saat timer berjalan
                    minutesInput.disabled = true;
                    isRunning = true;

                    timer = setInterval(() => {
                        if (timeLeft > 0) {
                            timeLeft--;
                            updateTimerDisplay();
                        } else {
                            clearInterval(timer);
                            triggerNotification();
                            resetTimer();
                        }
                    }, 1000);
                }
            });

            pauseBtn.addEventListener('click', () => {
                clearInterval(timer);
                isRunning = false;
                minutesInput.disabled = false;
            });

            resetBtn.addEventListener('click', () => {
                resetTimer();
            });

            function resetTimer() {
                clearInterval(timer);
                isRunning = false;
                minutesInput.disabled = false;
                let val = parseInt(minutesInput.value);
                timeLeft = (isNaN(val) || val < 1 ? 25 : val) * 60;
                updateTimerDisplay();
            }

            // Fungsi memicu Notifikasi Suara & Pop-up Browser
            function triggerNotification() {
                // 1. Putar Suara Alaram
                if (audioNotif) {
                    audioNotif.play().catch(e => console.log("Audio play diblokir browser sebelum ada interaksi: ",
                        e));
                }

                // 2. Munculkan Notifikasi Sistem Browser
                if (Notification.permission === "granted") {
                    new Notification("Pomodoro Time's Up! 🍅", {
                        body: "Waktu fokus kamu sudah habis. Istirahat sejenak yuk!",
                        icon: "https://cdn-icons-png.flaticon.com/512/3223/3223258.png" // Icon tomat opsional
                    });
                } else {
                    // Fallback jika izin notifikasi browser tidak diberikan
                    alert("Pomodoro Time's Up! Waktunya istirahat.");
                }
            }
        });
    </script>
@endsection
