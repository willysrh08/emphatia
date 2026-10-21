<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>My Psychologist - Emphatia</title>
    
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link crossorigin href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet">
    
    <style>
        @layer base {
            html, body { margin: 0; padding: 0; }
            body { overscroll-behavior: none; }
            main>:first-child { margin-top: 0!important; }
            main>:last-child { margin-bottom: 0!important; }
        }
        ::-webkit-scrollbar { display: none; }
    </style>
    
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script id="tailwind-config">
        tailwind.config={darkMode:"class",theme:{extend:{colors:{"secondary-fixed-dim":"#55dbca","on-surface-variant":"#464554","tertiary":"#444eaa","tertiary-fixed-dim":"#bdc2ff","secondary-fixed":"#75f7e6","on-error":"#ffffff","on-secondary-fixed":"#00201c","on-background":"#0b1c30","surface-container":"#e5eeff","on-tertiary-fixed":"#000766","secondary":"#006a60","error-container":"#ffdad6","outline":"#767586","on-secondary":"#ffffff","inverse-primary":"#c0c1ff","outline-variant":"#c6c5d6","tertiary-fixed":"#dfe0ff","surface-container-highest":"#d3e4fe","surface-container-high":"#dce9ff","on-error-container":"#93000a","on-tertiary":"#ffffff","surface-container-lowest":"#ffffff","on-primary":"#ffffff","tertiary-container":"#5d67c4","on-primary-fixed-variant":"#2f30b8","error":"#ba1a1a","inverse-surface":"#213145","on-primary-container":"#f5f2ff","on-secondary-container":"#006f65","surface-variant":"#d3e4fe","primary-fixed":"#e1e0ff","on-surface":"#0b1c30","primary-container":"#5b5fe3","surface-container-low":"#eff4ff","secondary-container":"#72f5e3","on-tertiary-fixed-variant":"#333c98","primary-fixed-dim":"#c0c1ff","surface-tint":"#494cd1","surface-bright":"#f8f9ff","surface":"#f8f9ff","inverse-on-surface":"#eaf1ff","on-primary-fixed":"#05006c","primary":"#4144c9","on-secondary-fixed-variant":"#005048","background":"#f8f9ff","on-tertiary-container":"#f5f3ff","surface-dim":"#cbdbf5"},borderRadius:{"DEFAULT":"1rem","lg":"2rem","xl":"3rem","full":"9999px"},spacing:{"space-xs":"0.375rem","space-xl":"2.5rem","space-sm":"0.75rem","space-md":"1.25rem","margin":"2rem","gutter":"1.5rem","gutter-mobile":"1rem","space-lg":"1.75rem","margin-mobile":"1.25rem"},fontFamily:{"body-lg":["Plus Jakarta Sans"],"headline-sm":["Plus Jakarta Sans"],"label-md":["Plus Jakarta Sans"],"headline-lg-mobile":["Plus Jakarta Sans"],"display-lg-mobile":["Plus Jakarta Sans"],"title-md":["Plus Jakarta Sans"],"headline-lg":["Plus Jakarta Sans"],"caption":["Plus Jakarta Sans"],"display-lg":["Plus Jakarta Sans"],"body-md":["Plus Jakarta Sans"],"headline-md":["Plus Jakarta Sans"]}}}}
    </script>
</head>
<body class="bg-background font-body-md text-on-surface min-h-screen selection:bg-secondary-fixed selection:text-on-secondary-fixed antialiased">
    <svg aria-hidden="true" class="inline-defs-container" style="position:absolute;width:0;height:0;overflow:hidden"></svg>

    <!-- SIDEBAR -->
    <aside class="fixed left-0 top-0 h-full bg-surface-container-lowest border-r border-slate-200/70 z-50 flex flex-col justify-between py-space-md px-3 transition-all duration-300 ease-in-out w-60" id="mainSidebar">
        <div class="flex flex-col gap-4">
            <!-- Brand & Collapse Toggle -->
            <div class="flex items-center justify-between px-1.5 h-10">
                <div class="flex items-center gap-2.5 overflow-hidden">
                    <div class="flex items-center sidebar-text transition-opacity duration-200 overflow-hidden">
                        <span class="text-xl font-bold text-primary tracking-tight">Emphatia</span>
                    </div>
                </div>
                <button class="p-1.5 rounded-lg text-outline hover:text-on-surface hover:bg-surface-container-low transition-colors" id="sidebarToggleBtn" onclick="toggleSidebar()" title="Toggle Sidebar" type="button">
                    <span class="material-symbols-outlined text-[19px]" id="collapseIcon">keyboard_double_arrow_left</span>
                </button>
            </div>
            <!-- Navigation List -->
            <nav class="flex flex-col gap-1 mt-1">
                <a class="group relative flex items-center gap-3 px-3 py-2 rounded-xl text-on-surface-variant hover:bg-surface-container-low hover:text-primary transition-colors font-medium text-[13.5px]" href="{{ route('dashboard') }}" title="Dashboard">
                    <span class="material-symbols-outlined text-[19px] shrink-0 text-outline">grid_view</span>
                    <span class="sidebar-text truncate">Dashboard</span>
                </a>
                <a class="group relative flex items-center gap-3 px-3 py-2 rounded-xl bg-gradient-to-r from-[#5b5fe3] to-[#20b2aa] text-white font-medium text-[13.5px] shadow-sm shadow-[#5b5fe3]/25" href="{{ route('psychologists.index') }}" title="My Psychologist">
                    <span class="material-symbols-outlined text-[19px] shrink-0 text-white" style="font-variation-settings: 'FILL' 1;">clinical_notes</span>
                    <span class="sidebar-text truncate font-semibold">My Psychologist</span>
                </a>
                <a class="group relative flex items-center gap-3 px-3 py-2 rounded-xl text-on-surface-variant hover:bg-surface-container-low hover:text-primary transition-colors font-medium text-[13.5px]" href="{{ route('moods.index') }}" title="Mood Journal">
                    <span class="material-symbols-outlined text-[19px] text-outline group-hover:text-primary transition-colors shrink-0">auto_graph</span>
                    <span class="sidebar-text truncate">Mood Journal</span>
                </a>
                <a class="group relative flex items-center gap-3 px-3 py-2 rounded-xl text-on-surface-variant hover:bg-surface-container-low hover:text-primary transition-colors font-medium text-[13.5px]" href="{{ route('sleeps.index') }}" title="Sleep Tracker">
                    <span class="material-symbols-outlined text-[19px] text-outline group-hover:text-primary transition-colors shrink-0">bedtime</span>
                    <span class="sidebar-text truncate">Sleep Tracker</span>
                </a>
                <a class="group relative flex items-center gap-3 px-3 py-2 rounded-xl text-on-surface-variant hover:bg-surface-container-low hover:text-primary transition-colors font-medium text-[13.5px]" href="#" title="Articles">
                    <span class="material-symbols-outlined text-[19px] text-outline group-hover:text-primary transition-colors shrink-0">local_library</span>
                    <span class="sidebar-text truncate">Articles</span>
                </a>
                <a class="group relative flex items-center gap-3 px-3 py-2 rounded-xl text-on-surface-variant hover:bg-surface-container-low hover:text-primary transition-colors font-medium text-[13.5px]" href="{{ route('chat.index') }}" title="AI Companion">
                    <span class="material-symbols-outlined text-[19px] text-outline group-hover:text-primary transition-colors shrink-0">psychology_alt</span>
                    <span class="sidebar-text truncate">AI Companion</span>
                </a>
                <a class="group relative flex items-center gap-3 px-3 py-2 rounded-xl text-on-surface-variant hover:bg-surface-container-low hover:text-primary transition-colors font-medium text-[13.5px]" href="#" title="Settings">
                    <span class="material-symbols-outlined text-[19px] text-outline group-hover:text-primary transition-colors shrink-0">settings</span>
                    <span class="sidebar-text truncate">Settings</span>
                </a>
            </nav>
        </div>
        <!-- Bottom User Profile Pill -->
        <div class="flex items-center gap-2.5 p-2 rounded-xl bg-surface-container-low/70 border border-slate-200/50 overflow-hidden">
            <div class="w-8 h-8 rounded-full bg-gradient-to-tr from-[#5b5fe3] to-[#20b2aa] flex items-center justify-center text-white text-[13px] font-semibold shrink-0 shadow-xs">
                {{ strtoupper(substr(Auth::user()->name ?? 'W', 0, 1)) }}
            </div>
            <div class="sidebar-text flex flex-col min-w-0 flex-1 truncate">
                <span class="text-[13px] font-semibold text-on-surface truncate">{{ Auth::user()->name ?? 'Willy' }}</span>
                <span class="text-[11px] text-[#006a60] font-medium truncate">Active</span>
            </div>
        </div>
    </aside>

    <!-- MAIN WRAPPER -->
    <div class="transition-all duration-300 ease-in-out pl-60" id="mainContent">
        <!-- Minimal Header -->
        <header class="fixed top-0 right-0 h-14 bg-surface/90 backdrop-blur-md border-b border-slate-200/60 z-40 transition-all duration-300 ease-in-out left-60" id="mainHeader">
            <div class="h-14 w-full px-6 flex items-center justify-between gap-4">
                <div class="flex items-center gap-3 flex-1 max-w-sm">
                    <div class="relative w-full flex items-center">
                        <span class="material-symbols-outlined absolute left-3 text-outline text-[18px]">search</span>
                        <input class="w-full pl-9 pr-3 py-1.5 rounded-lg bg-surface-container-lowest border border-slate-200/80 text-on-surface placeholder:text-outline/70 font-body-sm text-[13px] focus:outline-none focus:ring-1 focus:ring-primary focus:border-primary transition-all" placeholder="Search practitioners, session notes, clinical topics..." type="text">
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <div class="hidden sm:flex items-center gap-1.5 text-on-surface-variant text-[12px] px-2.5 py-1 rounded-md bg-surface-container-low">
                        <span class="material-symbols-outlined text-[15px] text-primary">calendar_today</span>
                        <span id="realtime-date">Loading...</span>
                    </div>
                    <button class="relative p-1.5 rounded-lg text-on-surface-variant hover:bg-surface-container-low transition-colors" title="Notifications" type="button">
                        <span class="material-symbols-outlined text-[20px]">notifications</span>
                        @if(isset($hasUnreadNotifications) && $hasUnreadNotifications)
                            <span class="absolute top-1.5 right-1.5 w-2 h-2 rounded-full bg-[#5b5fe3]"></span>
                        @endif
                    </button>
                </div>
            </div>
        </header>

        <!-- Dashboard Body -->
        <main class="relative pt-14 w-full px-6 lg:px-8 bg-surface min-h-screen">
            <div class="flex flex-col w-full pb-16 gap-6 max-w-7xl mx-auto">
                
                <!-- Section 1: Header & Ambient Hero Intro -->
                <div class="relative w-full pt-4 pb-2 flex flex-col md:flex-row md:items-end justify-between gap-6">
                    <div class="flex flex-col gap-1.5 max-w-xl">
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-primary/10 w-fit text-primary font-label-md text-label-md uppercase tracking-wider">
                            <span class="w-1.5 h-1.5 rounded-full bg-primary animate-pulse"></span>
                            CONSULTATION & CARE
                        </div>
                        <h1 class="font-headline-lg text-headline-lg text-on-surface tracking-tight">My Psychologist</h1>
                        <p class="font-body-md text-body-md text-on-surface-variant">Your dedicated clinical care and personalized journey.</p>
                    </div>
                    <!-- Quick Action Hub -->
                    <div class="flex items-center gap-3 shrink-0">
                        <button class="px-5 py-2.5 rounded-full bg-surface-container-lowest text-on-surface hover:bg-surface-container-low transition-all duration-200 font-label-md text-label-md shadow-sm hover:shadow flex items-center gap-2" type="button">
                            <span class="material-symbols-outlined text-[18px] text-outline">history</span>
                            Session History
                        </button>
                        <button class="px-6 py-2.5 rounded-full bg-gradient-to-r from-primary-container to-[#1FB6A6] text-white hover:opacity-95 transition-all duration-200 font-label-md text-label-md shadow-md shadow-primary/20 flex items-center gap-2" type="button">
                            <span class="material-symbols-outlined text-[18px]">add</span>
                            Book New Session
                        </button>
                    </div>
                </div>

                <!-- Section 2: Active / Primary Psychologist Spotlight Hero Card -->
                <div class="relative w-full rounded-3xl bg-surface-container-lowest p-6 lg:p-8 shadow-sm hover:shadow-md transition-shadow duration-300 overflow-hidden">
                    <div class="absolute -right-20 -top-20 w-80 h-80 rounded-full bg-gradient-to-br from-[#5b5fe3]/15 to-[#1FB6A6]/20 blur-3xl pointer-events-none"></div>
                    <div class="absolute left-1/3 -bottom-24 w-64 h-64 rounded-full bg-primary-fixed/30 blur-2xl pointer-events-none"></div>
                    <div class="relative flex flex-col xl:flex-row items-start xl:items-center justify-between gap-8">
                        <!-- Practitioner Identity -->
                        <div class="flex flex-col sm:flex-row items-start sm:items-center gap-6">
                            <div class="relative shrink-0">
                                <div class="w-24 h-24 lg:w-28 lg:h-28 rounded-2xl overflow-hidden shadow-sm ring-4 ring-surface-container-low">
                                    <img class="w-full h-full object-cover" src="{{ $nextSession->psychologist_photo }}" alt="Psychologist">
                                </div>
                                <span class="absolute -bottom-1 -right-1 w-6 h-6 rounded-full bg-[#1FB6A6] text-white flex items-center justify-center shadow-sm" title="Licensed & Verified">
                                    <span class="material-symbols-outlined text-[14px]">verified</span>
                                </span>
                            </div>
                            <div class="flex flex-col gap-2">
                                <div class="flex items-center gap-3">
                                    <h2 class="font-headline-md text-headline-md text-on-surface font-semibold tracking-tight">{{ $nextSession->psychologist_name }}</h2>
                                    <span class="px-2.5 py-0.5 rounded-full bg-secondary-container/40 text-on-secondary-container font-caption text-caption uppercase tracking-wider font-semibold">Lead Psychologist</span>
                                </div>
                                <div class="flex items-center gap-3 pt-1 text-on-surface-variant text-[14px]">
                                    <span>CBT & Somatic Therapy</span>
                                    <span class="w-1 h-1 rounded-full bg-outline-variant"></span>
                                    <span class="flex items-center gap-1 text-amber-500 font-medium">
                                        <span class="material-symbols-outlined text-[16px]" style="font-variation-settings: 'FILL' 1;">star</span>
                                        <span class="text-on-surface font-semibold text-[13px]">4.9</span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!-- Live Session Notification & Instant CTA -->
                        <div class="w-full xl:w-auto flex flex-col sm:flex-row xl:flex-col items-stretch xl:items-end gap-3.5 pt-4 xl:pt-0">
                            <div class="flex items-center gap-3 p-3.5 px-5 rounded-2xl bg-surface-container-low text-on-surface">
                                <div class="w-2.5 h-2.5 rounded-full bg-[#1FB6A6] shrink-0 animate-pulse"></div>
                                <div class="flex flex-col min-w-0">
                                    <span class="font-caption text-caption text-on-surface-variant uppercase tracking-wider">Next Session</span>
                                    <span class="font-title-md text-title-md font-semibold text-on-surface">{{ $nextSession->schedule }} • 45m</span>
                                </div>
                            </div>
                            <div class="flex items-center gap-2">
                                <a href="{{ $nextSession->join_url }}" class="flex-1 sm:flex-initial px-6 py-2.5 rounded-full bg-gradient-to-r from-primary-container to-[#1FB6A6] text-white hover:opacity-95 transition-all duration-200 font-label-md text-label-md shadow-md shadow-primary/20 flex items-center justify-center gap-2 text-decoration-none">
                                    <span class="material-symbols-outlined text-[19px]">videocam</span>
                                    <span>Enter Room</span>
                                </a>
                                <button class="p-2.5 rounded-full bg-surface-container-low hover:bg-surface-container text-on-surface transition-colors" title="Message *****" type="button">
                                    <span class="material-symbols-outlined text-[19px] text-primary">chat_bubble</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section 3: Dual Column Clinical Dashboard -->
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start w-full">
                    <!-- Left Column: Care Plan & Shared Homework (Span 7) -->
                    <div class="lg:col-span-7 flex flex-col gap-8">
                        <!-- Care Plan & Goals Card -->
                        <div class="rounded-3xl bg-surface-container-lowest p-6 lg:p-7 shadow-sm flex flex-col gap-6">
                            <div class="flex items-center justify-between pb-1">
                                <div class="flex items-center gap-2.5">
                                    <div class="w-9 h-9 rounded-xl bg-primary/10 flex items-center justify-center text-primary">
                                        <span class="material-symbols-outlined text-[20px]">flag</span>
                                    </div>
                                    <div>
                                        <h3 class="font-title-md text-title-md text-on-surface font-semibold">Care Plan</h3>
                                        <p class="font-caption text-caption text-on-surface-variant">Cycle 2 • Anxiety & Somatic Balance</p>
                                    </div>
                                </div>
                                <span class="px-3 py-1 rounded-full bg-surface-container-low text-primary font-label-md text-label-md font-semibold">68% Complete</span>
                            </div>
                            <div class="flex flex-col gap-3">
                                <div class="p-3.5 rounded-2xl bg-surface-container-low flex flex-col gap-2">
                                    <div class="flex items-center justify-between">
                                        <span class="font-body-md text-body-md font-medium text-on-surface">Cognitive Restructuring</span>
                                        <span class="font-caption text-caption text-[#006a60] font-semibold">Done</span>
                                    </div>
                                    <div class="w-full h-1.5 rounded-full bg-surface-container-highest overflow-hidden">
                                        <div class="h-full bg-[#1FB6A6] w-full rounded-full"></div>
                                    </div>
                                </div>
                                <div class="p-3.5 rounded-2xl bg-surface-container-low flex flex-col gap-2">
                                    <div class="flex items-center justify-between">
                                        <span class="font-body-md text-body-md font-medium text-on-surface">Vagus Nerve Reset & Breathwork</span>
                                        <span class="font-caption text-caption text-primary font-semibold">Active</span>
                                    </div>
                                    <div class="w-full h-1.5 rounded-full bg-surface-container-highest overflow-hidden">
                                        <div class="h-full bg-gradient-to-r from-primary to-[#1FB6A6] w-3/5 rounded-full"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="pt-1 flex items-center justify-end text-on-surface-variant font-caption text-caption">
                                <a class="text-primary hover:underline font-semibold flex items-center gap-1 text-[13px]" href="#">View Roadmap <span class="material-symbols-outlined text-[14px]">arrow_forward</span></a>
                            </div>
                        </div>

                        <!-- Shared Reflections & Clinical Homework -->
                        <div class="rounded-3xl bg-surface-container-lowest p-6 lg:p-7 shadow-sm flex flex-col gap-5">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-2.5">
                                    <div class="w-9 h-9 rounded-xl bg-[#1FB6A6]/10 flex items-center justify-center text-[#1FB6A6]">
                                        <span class="material-symbols-outlined text-[20px]">edit_note</span>
                                    </div>
                                    <div>
                                        <h3 class="font-title-md text-title-md text-on-surface font-semibold">Shared Notes</h3>
                                        <p class="font-caption text-caption text-on-surface-variant">Private reflection with ****</p>
                                    </div>
                                </div>
                                <button class="px-3 py-1 rounded-full bg-surface-container-low text-primary text-label-md font-label-md hover:bg-surface-container transition-colors" type="button">+ Add</button>
                            </div>
                            <div class="p-4 rounded-2xl bg-surface-container-low flex flex-col gap-3">
                                <div class="flex items-center justify-between text-caption font-caption">
                                    <span class="font-semibold uppercase tracking-wider text-primary">Current Focus</span>
                                    <span class="text-outline">Today, 09:30</span>
                                </div>
                                <p class="font-body-md text-body-md text-on-surface font-normal">"Practiced 4-7-8 breathing during morning tension. Felt chest relaxation within 5 minutes."</p>
                                <div class="flex items-center justify-between pt-1 border-t border-slate-200/50">
                                    <span class="font-caption text-caption text-secondary font-medium flex items-center gap-1">
                                        <span class="material-symbols-outlined text-[15px]">done_all</span> Shared
                                    </span>
                                    <button class="text-outline hover:text-on-surface text-[12px] font-medium flex items-center gap-1" type="button">
                                        <span class="material-symbols-outlined text-[14px]">edit</span> Edit
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column: Timeline & Emergency Support (Span 5) -->
                    <div class="lg:col-span-5 flex flex-col gap-8">
                        <!-- Session Schedule Timeline -->
                        <div class="rounded-3xl bg-surface-container-lowest p-6 lg:p-7 shadow-sm flex flex-col gap-5">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-2.5">
                                    <div class="w-9 h-9 rounded-xl bg-primary/10 flex items-center justify-center text-primary">
                                        <span class="material-symbols-outlined text-[20px]">calendar_today</span>
                                    </div>
                                    <div>
                                        <h3 class="font-title-md text-title-md text-on-surface font-semibold">Upcoming Sessions</h3>
                                        <p class="font-caption text-caption text-on-surface-variant">Telehealth consultations</p>
                                    </div>
                                </div>
                            </div>
                            <div class="flex flex-col gap-2.5">
                                <div class="p-3.5 rounded-2xl bg-surface-container-low flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <div class="w-9 h-9 rounded-xl bg-primary/10 text-primary flex items-center justify-center shrink-0">
                                            <span class="material-symbols-outlined text-[18px]">videocam</span>
                                        </div>
                                        <div>
                                            <div class="font-body-md text-body-md font-semibold text-on-surface">Today, 16:00 WIB</div>
                                            <div class="font-caption text-caption text-on-surface-variant">45 min consultation</div>
                                        </div>
                                    </div>
                                    <span class="px-2.5 py-0.5 rounded-full bg-secondary-container/40 text-on-secondary-container font-caption text-caption font-semibold">In 2h</span>
                                </div>
                                <div class="p-3.5 rounded-2xl bg-surface-container-low flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <div class="w-9 h-9 rounded-xl bg-surface-container text-outline flex items-center justify-center shrink-0">
                                            <span class="material-symbols-outlined text-[18px]">event</span>
                                        </div>
                                        <div>
                                            <div class="font-body-md text-body-md font-semibold text-on-surface">Fri, May 31, 16:00 WIB</div>
                                            <div class="font-caption text-caption text-on-surface-variant">Follow-up review</div>
                                        </div>
                                    </div>
                                    <button class="text-outline hover:text-primary p-1" type="button">
                                        <span class="material-symbols-outlined text-[18px]">edit_calendar</span>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Help & Emergency Crisis Resource Pill -->
                        <div class="p-4 rounded-2xl bg-surface-container-low flex items-center justify-between">
                            <div class="flex items-center justify-center gap-2 py-1 text-on-surface-variant font-caption text-caption w-full">
                                <span class="material-symbols-outlined text-[16px] text-outline">support_agent</span>
                                <span>Need immediate support?</span>
                                <a class="font-semibold text-primary hover:underline" href="tel:988">Emergency Hotline</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </main>
    </div>

    <!-- SCRIPTS: Real-time clock & Sidebar toggle -->
    <script>
        let isSidebarCollapsed = false;

        function toggleSidebar() {
            isSidebarCollapsed = !isSidebarCollapsed;
            const sidebar = document.getElementById('mainSidebar');
            const mainContent = document.getElementById('mainContent');
            const mainHeader = document.getElementById('mainHeader');
            const collapseIcon = document.getElementById('collapseIcon');
            const sidebarTexts = document.querySelectorAll('.sidebar-text');

            if (isSidebarCollapsed) {
                sidebar.classList.remove('w-60');
                sidebar.classList.add('w-[72px]', 'px-2');
                mainContent.classList.remove('pl-60');
                mainContent.classList.add('pl-[72px]');
                mainHeader.classList.remove('left-60');
                mainHeader.classList.add('left-[72px]');
                collapseIcon.innerText = 'keyboard_double_arrow_right';
                sidebarTexts.forEach(el => el.classList.add('hidden'));
            } else {
                sidebar.classList.remove('w-[72px]', 'px-2');
                sidebar.classList.add('w-60', 'px-3');
                mainContent.classList.remove('pl-[72px]');
                mainContent.classList.add('pl-60');
                mainHeader.classList.remove('left-[72px]');
                mainHeader.classList.add('left-60');
                collapseIcon.innerText = 'keyboard_double_arrow_left';
                sidebarTexts.forEach(el => el.classList.remove('hidden'));
            }
        }

        // Real-time clock updater di Header
        function updateRealtimeClock() {
            const now = new Date();
            const options = { month: 'short', day: 'numeric', hour: '2-digit', minute: '2-digit', hour12: false };
            const formattedString = now.toLocaleDateString('en-US', options);
            const dateElement = document.getElementById('realtime-date');
            if (dateElement) {
                dateElement.innerText = formattedString;
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            updateRealtimeClock();
            setInterval(updateRealtimeClock, 60000); // Update setiap 1 menit
        });
    </script>
</body>
</html>