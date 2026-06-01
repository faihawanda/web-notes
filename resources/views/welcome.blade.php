<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>


<section class="relative h-screen overflow-hidden bg-[#2D2DFF]">
    <!--particles-->
    <div id="particles" class="absolute inset-0 z-0"></div>

    <!--logo-->
    <div class="fixed top-8 left-10 z-50">
        <h1 class="text-white text-5xl font-medium tracking-wide">NOTESY</h1>
    </div>

    <!--navbar-->
    <nav class="fixed top-6 right-6 z-50">
        <!--button-->
        <button id="menuBtn" class="bg-white text-black rounded-full px-8 py-4 flex items-center gap-3 font-medium shadow-lg transition-all duration-300 hover:scale-105">
            <span id="menuText">MENU</span>
            <!--dot-->
            <div class="w-2 h-2 bg-black rounded-full"></div>
        </button>

        <!--popup wrapper-->
        <div id="popupMenu" class="hidden mt-4 flex flex-col gap-4 items-end">

            <!--menu popup-->
            <div class="w-[320px] rounded-[28px] bg-[#F3F3F3] p-8 shadow-2xl">
                <!--menu list-->
                <div class="flex flex-col gap-8 text-[20px] font-medium">

                    <a href="#" class="flex items-center justify-between group">HOME
                        <div class="w-2 h-2 rounded-full bg-black opacity-0 group-hover:opacity-100 transition-all duration-300"></div>
                    </a>
                    <a href="#" class="flex items-center justify-between group">ABOUT US
                        <div class="w-2 h-2 rounded-full bg-black opacity-100"></div>
                    </a>
                    <a href="#" class="flex items-center justify-between group">FEATURE
                        <div class="w-2 h-2 rounded-full bg-black opacity-0 group-hover:opacity-100 transition-all duration-300"></div>
                    </a>
                    <a href="#" class="flex items-center justify-between group">CONTACT
                        <div class="w-2 h-2 rounded-full bg-black opacity-0 group-hover:opacity-100 transition-all duration-300"></div>
                    </a>
                </div>
            </div>

            <!--auth popup-->
            <div class="w-[320px] flex flex-col gap-4">
                <!--sign up-->
                <a href="{{ route ('register') }}">
                <button class="w-full bg-black text-white rounded-[22px] px-6 py-5 flex items-center justify-between text-2xl shadow-2xl hover:scale-[1.02] transition-all duration-300">
                    <span>◉ SIGN UP</span>
                    <span>↗</span>
                </button>
                </a>

                <!--log in-->
                <a href="{{ route ('login') }}">
                <button class="w-full bg-black text-white rounded-[22px] px-6 py-5 flex items-center justify-between text-2xl shadow-2xl hover:scale-[1.02] transition-all duration-300">
                    <span>◉ LOG IN</span>
                    <span>↗</span>
                </button>
                </a>
            </div>
        </div>
    </nav>

    <!--hero-->
    <div class="relative z-10 flex flex-col items-center justify-center h-[70vh] text-center pt-60">
        <p class="text-white uppercase tracking-[4px] mb-10">IS YOUR BIG IDEA READY TO GO WILD?</p>
        <h1 class="hero-title text-white font-light leading-none">Let's work <br>together!</h1>
        <button class="mt-20 bg-white px-10 py-5 rounded-full flex items-center gap-4 hover:scale-105 transition-all duration-500">CONTINUE TO SCROLL</button>
    </div>
</section>