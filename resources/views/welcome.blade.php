<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        html,
        body {
            overflow-y: auto !important;
            height: auto !important;
            scroll-behavior: smooth;
            background-color: #F8F9FC;
        }
    </style>
</head>

<div class="w-full min-h-screen block relative" style="overflow-y: auto !important;">

    {{-- HERO SECTION --}}
    <section id="home" class="relative h-screen overflow-hidden bg-[#2D2DFF]">
        <div id="particles" class="absolute inset-0 z-0"></div>

        <div class="fixed top-8 left-10 z-50">
            <h1 class="text-white text-5xl font-medium tracking-wide">NOTESY</h1>
        </div>

        <nav class="fixed top-6 right-6 z-50">
            <button id="menuBtn"
                class="bg-white text-black rounded-full px-8 py-4 flex items-center gap-3 font-medium shadow-lg transition-all duration-300 hover:scale-105">
                <span id="menuText">MENU</span>
                <div class="w-2 h-2 bg-black rounded-full"></div>
            </button>

            <div id="popupMenu" class="hidden mt-4 flex flex-col gap-4 items-end">

                <div class="w-[320px] rounded-[28px] bg-[#F3F3F3] p-8 shadow-2xl">
                    <div class="flex flex-col gap-8 text-[20px] font-medium">

                        <a href="#home" class="flex items-center justify-between group">HOME
                            <div
                                class="w-2 h-2 rounded-full bg-black opacity-0 group-hover:opacity-100 transition-all duration-300">
                            </div>
                        </a>
                        <a href="#about" class="flex items-center justify-between group">ABOUT US
                            <div class="w-2 h-2 rounded-full bg-black opacity-100"></div>
                        </a>
                        <a href="#feature" class="flex items-center justify-between group">FEATURE
                            <div
                                class="w-2 h-2 rounded-full bg-black opacity-0 group-hover:opacity-100 transition-all duration-300">
                            </div>
                        </a>
                        <a href="#" class="flex items-center justify-between group">CONTACT
                            <div
                                class="w-2 h-2 rounded-full bg-black opacity-0 group-hover:opacity-100 transition-all duration-300">
                            </div>
                        </a>
                    </div>
                </div>

                <div class="w-[320px] flex flex-col gap-4">
                    <a href="{{ route('register') }}">
                        <button
                            class="w-full bg-black text-white rounded-[22px] px-6 py-5 flex items-center justify-between text-2xl shadow-2xl hover:scale-[1.02] transition-all duration-300">
                            <span>◉ SIGN UP</span>
                            <span>↗</span>
                        </button>
                    </a>

                    <a href="{{ route('login') }}">
                        <button
                            class="w-full bg-black text-white rounded-[22px] px-6 py-5 flex items-center justify-between text-2xl shadow-2xl hover:scale-[1.02] transition-all duration-300">
                            <span>◉ LOG IN</span>
                            <span>↗</span>
                        </button>
                    </a>
                </div>
            </div>
        </nav>

        <div class="relative z-10 flex flex-col items-center justify-center h-[70vh] text-center pt-60">
            <p class="text-white uppercase tracking-[4px] mb-28">YOUR SECOND BRAIN STARTS HERE</p>
            <h1 class="hero-title text-white font-light leading-none text-[150px] mb-20">Think Bigger. <br>Remember Everything.</h1>
            <a href="{{ route('register') }}">
                <button
                    class="mt-20 bg-white px-10 py-5 rounded-full flex items-center gap-4 hover:scale-105 transition-all duration-500">GET
                    STARTED</button>
            </a>
        </div>
    </section>

    {{-- ABOUT SECTION --}}
    <section id="about" class="about block relative w-full" style="height: auto !important; min-h: 50vh;">
        <div class="glow"></div>

        <h2 class="about-title">
            We help students organize tasks,
            manage deadlines, and stay productive
            through a simple and collaborative
            note-taking experience.
        </h2>

        <div class="arrow">
            ↓
        </div>
    </section>

    {{-- FEATURE SECTION --}}
    <section id="feature" class="expertise block relative w-full" style="height: auto !important;">
        <div class="top-info">
            <p>
                ALL-IN-ONE PRODUCTIVITY HUB FOR MANAGING TASKS, NOTES, AND DAILY WORKFLOWS.
            </p>
        </div>

        <h1 class="title">
            WORK OF <br>
            ORGANIZING <br>
        </h1>

        <div class="cards">
            <div class="card strategy">
                <h2>NOTE MANAGEMENT</h2>
                <ul>
                    <li>Create Notes</li>
                    <li>Edit Notes</li>
                    <li>Delete Notes</li>
                    <li>Organize Notes</li>
                </ul>
            </div>

            <div class="card creative">
                <h2>PROGRESS TRACKING</h2>
                <ul>
                    <li>To Do Tasks</li>
                    <li>In Progress Tasks</li>
                    <li>Completed Tasks</li>
                    <li>Status Updates</li>
                </ul>
            </div>

            <div class="card tech">
                <h2>ORGANIZATION</h2>
                <ul>
                    <li>Categories</li>
                    <li>Note Classification</li>
                    <li>Structured Workflow</li>
                    <li>Easy Navigation</li>
                </ul>
            </div>

            <div class="card production">
                <h2>PRODUCTIVITY</h2>
                <ul>
                    <li>Calendar</li>
                    <li>Pomodoro Timer</li>
                    <li>Dashboard Overview</li>

                </ul>
            </div>
        </div>
    </section>

    {{-- FOOTER --}}
    <section id="contact"
        class="bg-white text-black min-h-screen py-16 px-6 md:px-12 lg:px-20 block relative w-full flex flex-col justify-between rounded-t-[48px] shadow-[0_-10px_30px_rgba(0,0,0,0.03)]"
        style="z-index: 999;">

        <!-- Bagian Atas Header -->
        <div class="flex flex-col lg:flex-row justify-between gap-12 pt-8">
            <div>
                <p class="text-sm uppercase tracking-[0.3em] text-blue-600 font-semibold mb-4">
                    Contact
                </p>
                <h2 class="text-5xl md:text-7xl font-light leading-tight tracking-tight">
                    Get In Touch
                    <br>
                    With Notesy
                </h2>
            </div>


            <div class="max-w-md flex flex-col gap-6">
                <div>
                    <p class="text-gray-500 text-lg leading-relaxed mb-6">
                        Have questions about Notesy?
                        Feel free to reach out and let's connect.
                    </p>

                    <!-- Status Indicator -->
                    <div
                        class="inline-flex items-center gap-2 bg-blue-100 text-blue-700 text-xs font-medium px-4 py-2 rounded-full border border-blue-200/60 shadow-sm w-fit">
                        <span class="w-2 h-2 rounded-full bg-blue-500 animate-pulse"></span>
                        Open for collaboration & feedback
                    </div>
                </div>


                <!-- Link Sosial Media -->
                <div class="flex gap-6 text-sm font-medium text-gray-600">
                    <a href="#" class="hover:text-blue-600 transition duration-300">Instagram ↗</a>
                    <a href="#" class="hover:text-blue-600 transition duration-300">LinkedIn ↗</a>
                    <a href="#" class="hover:text-blue-600 transition duration-300">Dribbble ↗</a>
                </div>
            </div>
        </div>


        <!-- Bagian Tengah: Grid Informasi Kontak -->
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-12 border-t border-gray-200/80 pt-12 my-auto">
            <div>
                <p class="text-gray-400 uppercase text-xs font-semibold tracking-wider mb-4">
                    Assignment
                </p>
                <a href="mailto:hello@notesy.com"
                    class="text-xl text-gray-800 hover:text-blue-600 font-medium transition duration-300">
                    Final Project
                </a>
            </div>


            <div>
                <p class="text-gray-400 uppercase text-xs font-semibold tracking-wider mb-4">
                    Class & Major
                </p>
                <a href="#" class="text-xl text-gray-800 hover:text-blue-600 font-medium transition duration-300">
                    10 RPL — SMK
                </a>
            </div>


            <div>
                <p class="text-gray-400 uppercase text-xs font-semibold tracking-wider mb-4">
                    Team Members
                </p>
                <p class="text-xl text-gray-800 font-medium">
                    Faiha, Mutiara, <br>Hani
                </p>
            </div>


            <div>
                <p class="text-gray-400 uppercase text-xs font-semibold tracking-wider mb-4">
                    App Title
                </p>
                <p class="text-xl text-gray-800 font-medium">
                    Notesy Productivity
                </p>
            </div>
        </div>


        <!-- Bagian Paling Bawah: Copyright & Arrow -->
        <div class="flex flex-col md:flex-row justify-between items-center pt-8 border-t border-gray-200/80 pb-4">
            <p class="text-gray-400 text-sm">
                © 2026 Notesy. All Rights Reserved.
            </p>
            <a href="#home"
                class="bg-black text-white mt-6 md:mt-0 w-14 h-14 border border-black rounded-full flex items-center justify-center hover:bg-white hover:text-black transition duration-300 shadow-md">
                ↑
            </a>
        </div>
    </section>

</div>
