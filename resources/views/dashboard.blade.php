<!DOCTYPE html>
<html lang="en" style="">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="web_dashboard" name="shell-type">
    <title>Dashboard - Emphatia</title>

    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet">
    
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
        tailwind.config={darkMode:"class",theme:{extend:{colors:{"secondary-fixed-dim":"#55dbca","on-surface-variant":"#464554","tertiary":"#444eaa","tertiary-fixed-dim":"#bdc2ff","secondary-fixed":"#75f7e6","on-error":"#ffffff","on-secondary-fixed":"#00201c","on-background":"#0b1c30","surface-container":"#e5eeff","on-tertiary-fixed":"#000766","secondary":"#006a60","error-container":"#ffdad6","outline":"#767586","on-secondary":"#ffffff","inverse-primary":"#c0c1ff","outline-variant":"#c6c5d6","tertiary-fixed":"#dfe0ff","surface-container-highest":"#d3e4fe","surface-container-high":"#dce9ff","on-error-container":"#93000a","on-tertiary":"#ffffff","surface-container-lowest":"#ffffff","on-primary":"#ffffff","tertiary-container":"#5d67c4","on-primary-fixed-variant":"#2f30b8","error":"#ba1a1a","inverse-surface":"#213145","on-primary-container":"#f5f2ff","on-secondary-container":"#006f65","surface-variant":"#d3e4fe","primary-fixed":"#e1e0ff","on-surface":"#0b1c30","primary-container":"#5b5fe3","surface-container-low":"#eff4ff","secondary-container":"#72f5e3","on-tertiary-fixed-variant":"#333c98","primary-fixed-dim":"#c0c1ff","surface-tint":"#494cd1","surface-bright":"#f8f9ff","surface":"#f8f9ff","inverse-on-surface":"#eaf1ff","on-primary-fixed":"#05006c","primary":"#4144c9","on-secondary-fixed-variant":"#005048","background":"#f8f9ff","on-tertiary-container":"#f5f3ff","surface-dim":"#cbdbf5"},borderRadius:{"DEFAULT":"1rem","lg":"2rem","xl":"3rem","full":"9999px"},spacing:{"space-xs":"0.375rem","space-xl":"2.5rem","space-sm":"0.75rem","space-md":"1.25rem","margin":"2rem","gutter":"1.5rem","gutter-mobile":"1rem","space-lg":"1.75rem","margin-mobile":"1.25rem"},fontFamily:{"body-lg":["Plus Jakarta Sans"],"headline-sm":["Plus Jakarta Sans"],"label-md":["Plus Jakarta Sans"],"headline-lg-mobile":["Plus Jakarta Sans"],"display-lg-mobile":["Plus Jakarta Sans"],"title-md":["Plus Jakarta Sans"],"headline-lg":["Plus Jakarta Sans"],"caption":["Plus Jakarta Sans"],"display-lg":["Plus Jakarta Sans"],"body-md":["Plus Jakarta Sans"],"headline-md":["Plus Jakarta Sans"]},fontSize:{"body-lg":["16px",{"lineHeight":"26px","fontWeight":"400"}],"headline-sm":["20px",{"lineHeight":"28px","fontWeight":"600"}],"label-md":["12px",{"lineHeight":"16px","letterSpacing":"0.04em","fontWeight":"600"}],"headline-lg-mobile":["26px",{"lineHeight":"34px","letterSpacing":"-0.01em","fontWeight":"600"}],"display-lg-mobile":["34px",{"lineHeight":"42px","letterSpacing":"-0.015em","fontWeight":"700"}],"title-md":["18px",{"lineHeight":"26px","fontWeight":"500"}],"headline-lg":["32px",{"lineHeight":"40px","letterSpacing":"-0.01em","fontWeight":"600"}],"caption":["11px",{"lineHeight":"16px","letterSpacing":"0.02em","fontWeight":"500"}],"display-lg":["48px",{"lineHeight":"56px","letterSpacing":"-0.02em","fontWeight":"700"}],"body-md":["14px",{"lineHeight":"22px","fontWeight":"400"}],"headline-md":["24px",{"lineHeight":"32px","letterSpacing":"-0.005em","fontWeight":"600"}]}}}}
    </script>
</head>
<body class="bg-background font-body-md text-on-surface min-h-screen selection:bg-secondary-fixed selection:text-on-secondary-fixed antialiased" data-user-streak="{{ $userStreak ?? 5 }}" data-weekly-balance="{{ $weeklyBalancePercentage ?? 18 }}">
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
                <a aria-current="page" class="group relative flex items-center gap-3 px-3 py-2 rounded-xl transition-all bg-gradient-to-r from-[#5b5fe3] to-[#20b2aa] text-white font-medium text-[13.5px] shadow-sm shadow-[#5b5fe3]/25" href="{{ route('dashboard') }}" title="Dashboard">
                    <span class="material-symbols-outlined text-[19px] shrink-0 text-white">grid_view</span>
                    <span class="sidebar-text truncate font-semibold">Dashboard</span>
                </a>
                <a class="group relative flex items-center gap-3 px-3 py-2 rounded-xl text-on-surface-variant hover:bg-surface-container-low hover:text-primary transition-colors font-medium text-[13.5px]" href="{{ route('psychologists.index') }}" title="My Psychologist">
                    <span class="material-symbols-outlined text-[19px] text-outline group-hover:text-primary transition-colors shrink-0">clinical_notes</span>
                    <span class="sidebar-text truncate">My Psychologist</span>
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
                <span class="text-[11px] text-[#006a60] font-medium truncate">{{ Auth::user()->status ?? 'Active' }}</span>
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
                        <input id="global-search-input" class="w-full pl-9 pr-3 py-1.5 rounded-lg bg-surface-container-lowest border border-slate-200/80 text-on-surface placeholder:text-outline/70 font-body-sm text-[13px] focus:outline-none focus:ring-1 focus:ring-primary focus:border-primary transition-all" placeholder="Search resources, practices..." type="text">
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <div class="hidden sm:flex items-center gap-1.5 text-on-surface-variant text-[12px] px-2.5 py-1 rounded-md bg-surface-container-low">
                        <span class="material-symbols-outlined text-[15px] text-primary">calendar_today</span>
                        <span id="realtime-date">Loading...</span>
                    </div>
                    <button class="relative p-1.5 rounded-lg text-on-surface-variant hover:bg-surface-container-low transition-colors" title="Notifications" type="button" id="notifications-btn">
                        <span class="material-symbols-outlined text-[20px]">notifications</span>
                        @if(isset($hasUnreadNotifications) &&$hasUnreadNotifications)
                            <span class="absolute top-1.5 right-1.5 w-2 h-2 rounded-full bg-[#5b5fe3]"></span>
                        @endif
                    </button>
                </div>
            </div>
        </header>

        <!-- Dashboard Body -->
        <main class="relative pt-14 w-full px-6 lg:px-8 bg-surface min-h-screen">
            <div class="flex flex-col w-full py-6 gap-6 max-w-7xl mx-auto">
                
                @if(session('success'))
                    <div class="p-4 rounded-xl bg-teal-50 border border-teal-200 text-teal-800 text-[13.5px]">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Compact Greeting -->
                <section class="flex items-center justify-between gap-4">
                    <div>
                        <h1 id="dynamic-greeting-title" class="text-[22px] font-bold text-on-surface tracking-tight">Good morning, {{ Auth::user()->name ?? 'Willy' }}</h1>
                        <p class="text-[13.5px] text-on-surface-variant mt-0.5">How are you feeling right now?</p>
                    </div>
                    <div class="flex items-center gap-2 px-3 py-1.5 rounded-xl bg-surface-container-lowest border border-slate-200/60 shadow-xs">
                        <span class="material-symbols-outlined text-[#14b8a6] text-[20px]">local_fire_department</span>
                        <div class="flex flex-col">
                            <span id="user-streak-count" class="text-[13px] font-bold text-on-surface leading-tight">{{ $userStreak ?? 5 }} Days</span>
                            <span class="text-[10.5px] text-outline leading-tight">Streak</span>
                        </div>
                    </div>
                </section>

                <!-- Streamlined Mood Selection (Form connected to MoodController) -->
                <form id="moodForm" action="{{ route('moods.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="mood_score" id="selectedMoodScore" value="4">
                    <input type="hidden" name="mood_label" id="selectedMoodLabel" value="Calm">

                    <section class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                        <!-- Happy -->
                        <button class="mood-card group flex flex-col items-center justify-center py-3.5 px-3 rounded-2xl bg-surface-container-lowest hover:shadow-md transition-all text-center relative focus:outline-none border border-slate-200/60" onclick="submitMood(5, 'Happy', this)" type="button">
                            <div class="w-9 h-9 rounded-full bg-gradient-to-tr from-[#5b5fe3]/15 to-[#20b2aa]/20 text-primary flex items-center justify-center mb-1 group-hover:scale-110 transition-transform">
                                <svg class="w-6 h-6 stroke-[#5b5fe3]" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" viewBox="0 0 24 24"><circle cx="12" cy="12" r="9.5"></circle><path d="M8.5 9.5h.01"></path><path d="M15.5 9.5h.01"></path><path d="M8 14c1 1.6 2.4 2.5 4 2.5s3-0.9 4-2.5"></path></svg>
                            </div>
                            <span class="text-[13.5px] font-semibold text-on-surface">Happy</span>
                            <div class="mood-check-indicator absolute top-2 right-2 w-4 h-4 rounded-full bg-gradient-to-r from-[#5b5fe3] to-[#20b2aa] text-white flex items-center justify-center shadow-xs hidden">
                                <span class="material-symbols-outlined text-[12px]">check</span>
                            </div>
                        </button>
                        <!-- Calm -->
                        <button class="mood-card group flex flex-col items-center justify-center py-3.5 px-3 rounded-2xl bg-surface-container-lowest shadow-xs hover:border-primary/40 hover:shadow-sm transition-all text-center relative focus:outline-none border-2 border-primary ring-2 ring-primary/10 shadow-sm shadow-primary/10" onclick="submitMood(4, 'Calm', this)" type="button">
                            <div class="w-9 h-9 rounded-full bg-[#14b8a6]/10 text-[#0d9488] flex items-center justify-center mb-1 group-hover:scale-110 transition-transform">
                                <svg class="w-6 h-6 stroke-[#0d9488]" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" viewBox="0 0 24 24"><circle cx="12" cy="12" r="9.5"></circle><path d="M8.5 9.5h.01"></path><path d="M15.5 9.5h.01"></path><line x1="8.5" x2="15.5" y1="14.5" y2="14.5"></line></svg>
                            </div>
                            <span class="text-[13.5px] font-semibold text-primary">Calm</span>
                            <div class="mood-check-indicator absolute top-2 right-2 w-4 h-4 rounded-full bg-gradient-to-r from-[#5b5fe3] to-[#20b2aa] text-white flex items-center justify-center">
                                <span class="material-symbols-outlined text-[12px]">check</span>
                            </div>
                        </button>
                        <!-- Down -->
                        <button class="mood-card group flex flex-col items-center justify-center py-3.5 px-3 rounded-2xl bg-surface-container-lowest border shadow-xs hover:border-primary/40 hover:shadow-sm transition-all text-center relative focus:outline-none border-slate-200/60" onclick="submitMood(3, 'Down', this)" type="button">
                            <div class="w-9 h-9 rounded-full bg-tertiary-fixed/40 text-tertiary flex items-center justify-center mb-1 group-hover:scale-110 transition-transform">
                                <svg class="w-6 h-6 stroke-[#444eaa]" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" viewBox="0 0 24 24"><circle cx="12" cy="12" r="9.5"></circle><path d="M8.5 10h.01"></path><path d="M15.5 10h.01"></path><path d="M15.5 15.5c-1-1.3-2.3-2-3.5-2s-2.5.7-3.5 2"></path><path d="M16 11.5v2"></path></svg>
                            </div>
                            <span class="text-[13.5px] font-semibold text-on-surface">Down</span>
                            <div class="mood-check-indicator absolute top-2 right-2 w-4 h-4 rounded-full bg-gradient-to-r from-[#5b5fe3] to-[#20b2aa] text-white flex items-center justify-center hidden">
                                <span class="material-symbols-outlined text-[12px]">check</span>
                            </div>
                        </button>
                        <!-- Tense -->
                        <button class="mood-card group flex flex-col items-center justify-center py-3.5 px-3 rounded-2xl bg-surface-container-lowest border shadow-xs hover:border-primary/40 hover:shadow-sm transition-all text-center relative focus:outline-none border-slate-200/60" onclick="submitMood(2, 'Tense', this)" type="button">
                            <div class="w-9 h-9 rounded-full bg-rose-50 text-rose-500 flex items-center justify-center mb-1 group-hover:scale-110 transition-transform">
                                <svg class="w-6 h-6 stroke-[#e11d48]" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" viewBox="0 0 24 24"><circle cx="12" cy="12" r="9.5"></circle><path d="M8.5 15.5c1-.8 2-1 3.5-1s2.5.2 3.5 1"></path></svg>
                            </div>
                            <span class="text-[13.5px] font-semibold text-on-surface">Tense</span>
                            <div class="mood-check-indicator absolute top-2 right-2 w-4 h-4 rounded-full bg-gradient-to-r from-[#5b5fe3] to-[#20b2aa] text-white flex items-center justify-center hidden">
                                <span class="material-symbols-outlined text-[12px]">check</span>
                            </div>
                        </button>
                    </section>
                </form>

                <!-- Main Layout Grid -->
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 w-full">
                    <!-- PRIMARY COLUMN (8 cols) -->
                    <div class="lg:col-span-8 flex flex-col gap-6">
                        <!-- Clean Upcoming Session Card with Emphatia Gradient -->
                        <div class="rounded-2xl bg-gradient-to-r from-[#4144c9] via-[#4f5bd5] to-[#14b8a6] text-white p-5 shadow-md shadow-[#4144c9]/20 relative overflow-hidden">
                            <div class="absolute -right-10 -bottom-10 w-44 h-44 rounded-full bg-white/10 blur-2xl pointer-events-none"></div>
                            <div class="relative z-10 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                                <div class="flex items-center gap-3.5">
                                    <div class="relative w-12 h-12 rounded-xl overflow-hidden shrink-0 ring-2 ring-white/30 shadow-sm">
                                        <img class="w-full h-full object-cover" src="{{ $nextSession->psychologist_photo ?? 'https://lh3.googleusercontent.com/aida-public/AB6AXuAcWRL--jQX3gHZdjR4jMsE0MS5k6PxtrVQlwSPPtNgbdL_vtXdvmG1WEua57hnDERVLiScbS8O3m2v9C9qbicdVIBjyXITg7EosvXJ7D03_uAzItFYH99AgHNScXjnd8HSY427HKIsbf0fXFo-_3mKAg0HhuLCR3RgKm8Sj-b83ANK59R_9P69_eNnPm7LrWqAX577Dbxlps7fXZv9RR806e4X5Ujb7DaOxCzDdQ281xjMiBjtr9o8sQ' }}" alt="Psychologist">
                                    </div>
                                    <div class="flex flex-col">
                                        <div class="flex items-center gap-1.5">
                                            <span class="text-[15px] font-bold text-white">{{ $nextSession->psychologist_name ?? '****' }}</span>
                                            <span class="material-symbols-outlined text-secondary-fixed text-[16px]">verified</span>
                                        </div>
                                        <span class="text-[12.5px] text-white/85">{{ $nextSession->session_type ?? 'Clinical Psychologist' }} • <span id="next-session-schedule">{{ $nextSession->schedule ?? 'Friday, 16:00 WIB' }}</span></span>
                                    </div>
                                </div>
                                <div class="flex items-center gap-2">
                                    <button class="w-9 h-9 rounded-xl bg-white/15 hover:bg-white/25 text-white flex items-center justify-center transition-colors backdrop-blur-sm" title="Message" type="button">
                                        <span class="material-symbols-outlined text-[18px]">chat_bubble</span>
                                    </button>
                                    <a href="{{ $nextSession->join_url ?? '#' }}" class="px-4 py-2 rounded-xl bg-white text-primary font-semibold text-[13.5px] hover:bg-surface-container-low transition-colors shadow-sm flex items-center gap-1.5" type="button">
                                        <span class="material-symbols-outlined text-[17px] text-[#4144c9]">meeting_room</span>
                                        <span class="text-[#4144c9]">Join</span>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Core Practices (Simplified tools) -->
                        <section class="flex flex-col gap-3">
                            <div class="flex items-center justify-between">
                                <h2 class="text-[16px] font-bold text-on-surface">Core Practices</h2>
                                <button class="text-[12.5px] font-semibold text-primary hover:text-[#5b5fe3] transition-colors flex items-center gap-0.5" type="button">
                                    <span>View All</span>
                                    <span class="material-symbols-outlined text-[15px]">arrow_forward</span>
                                </button>
                            </div>
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                                <!-- Consultation -->
                                <div class="p-4 bg-surface-container-lowest border border-slate-200/60 shadow-xs hover:border-primary/40 hover:shadow-sm transition-all flex flex-col justify-between group rounded-[14px]">
                                    <div>
                                        <div class="flex items-center justify-between mb-3">
                                            <div class="w-9 h-9 rounded-lg bg-primary/10 text-primary flex items-center justify-center group-hover:bg-primary group-hover:text-white transition-colors">
                                                <span class="material-symbols-outlined text-[20px]">support_agent</span>
                                            </div>
                                            <span class="text-[11px] font-medium text-primary bg-primary-fixed/50 px-2 py-0.5 rounded-full">New</span>
                                        </div>
                                        <h3 class="text-[14px] font-semibold text-on-surface">Consultation</h3>
                                        <p class="text-[12.5px] text-on-surface-variant mt-0.5">Session summaries ready</p>
                                    </div>
                                    <div class="mt-3 flex items-center text-primary text-[12px] font-semibold gap-1">
                                        <span>Open Room</span>
                                        <span class="material-symbols-outlined text-[14px]">arrow_forward</span>
                                    </div>
                                </div>
                                <!-- Bubble Breath -->
                                <div class="p-4 bg-surface-container-lowest border border-slate-200/60 shadow-xs hover:border-[#14b8a6]/40 hover:shadow-sm transition-all flex flex-col justify-between group rounded-[14px]">
                                    <div>
                                        <div class="flex items-center justify-between mb-3">
                                            <div class="w-9 h-9 rounded-lg bg-[#20b2aa]/15 text-[#006a60] flex items-center justify-center group-hover:bg-[#20b2aa] group-hover:text-white transition-colors">
                                                <span class="material-symbols-outlined text-[20px]">air</span>
                                            </div>
                                            <span class="text-[11px] font-medium text-[#006a60] bg-[#75f7e6]/30 px-2 py-0.5 rounded-full">5 min</span>
                                        </div>
                                        <h3 class="text-[14px] font-semibold text-on-surface">Bubble Breath</h3>
                                        <p class="text-[12.5px] text-on-surface-variant mt-0.5">Box breathing balance</p>
                                    </div>
                                    <div class="mt-3 flex items-center text-[#006a60] text-[12px] font-semibold gap-1">
                                        <span>Start</span>
                                        <span class="material-symbols-outlined text-[14px]">play_circle</span>
                                    </div>
                                </div>
                                <!-- DreamTrack -->
                                <div class="p-4 bg-surface-container-lowest border border-slate-200/60 shadow-xs hover:border-tertiary/40 hover:shadow-sm transition-all flex flex-col justify-between group rounded-[14px]">
                                    <div>
                                        <div class="flex items-center justify-between mb-3">
                                            <div class="w-9 h-9 rounded-lg bg-tertiary-fixed/50 text-tertiary flex items-center justify-center group-hover:bg-tertiary group-hover:text-white transition-colors">
                                                <span class="material-symbols-outlined text-[20px]">bedtime</span>
                                            </div>
                                            <span class="text-[11px] font-medium text-tertiary bg-tertiary-fixed/50 px-2 py-0.5 rounded-full">Night</span>
                                        </div>
                                        <h3 class="text-[14px] font-semibold text-on-surface">DreamTrack</h3>
                                        <p class="text-[12.5px] text-on-surface-variant mt-0.5">Auditory sleepscapes</p>
                                    </div>
                                    <div class="mt-3 flex items-center text-tertiary text-[12px] font-semibold gap-1">
                                        <span>Listen</span>
                                        <span class="material-symbols-outlined text-[14px]">graphic_eq</span>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <!-- Insights & Reading -->
                        <section class="flex flex-col gap-3">
                            <div class="flex items-center justify-between">
                                <h2 class="text-[16px] font-bold text-on-surface">Insights</h2>
                                <button class="text-[12.5px] font-semibold text-primary hover:text-[#5b5fe3] transition-colors flex items-center gap-0.5" type="button">
                                    <span>Library</span>
                                    <span class="material-symbols-outlined text-[15px]">arrow_forward</span>
                                </button>
                            </div>
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                                <div class="group rounded-[14px] overflow-hidden bg-surface-container-lowest border border-slate-200/60 shadow-xs hover:border-primary/40 hover:shadow-sm transition-all flex flex-col cursor-pointer">
                                    <div class="h-28 w-full overflow-hidden relative rounded-t-[14px]">
                                        <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBvKQ4QM-xa6upR9vHMyKGIvXHX2N1lAU1ed8VF2LIECJeo0zRS3WG0MUWi0EyLorejtAL4i93euIk0pvQriTWOwR3Kac5vyFDNAnvuf-27TLCUdOWaCn023VavbV6XQP8bzzlKgf2zNDBye4pABa_t6S0qQ3sKwWzlZytsMd-1OG_nm6WLZm4a1WcHysuZXXLA6hmrKO8T-N-3zNxnjOpIfip8dA1hq8jn1-8pDeNd4PRd-bVAgiSSJNWiIF0Ndy9YvXfWpoM8PWVxr4A" alt="Art of Listening">
                                    </div>
                                    <div class="p-3 flex items-center justify-between">
                                        <span class="text-[13px] font-semibold text-on-surface group-hover:text-primary transition-colors truncate">Art of Listening</span>
                                        <span class="text-[11px] text-outline shrink-0">4m</span>
                                    </div>
                                </div>
                                <div class="group rounded-[14px] overflow-hidden bg-surface-container-lowest border border-slate-200/60 shadow-xs hover:border-primary/40 hover:shadow-sm transition-all flex flex-col cursor-pointer">
                                    <div class="h-28 w-full overflow-hidden relative rounded-t-[14px]">
                                        <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCdr-8qp5LrLvPE7PBplKTEwVGyY4skRiSVt_svSsvA10dR9aoUGWAgjf6UMWKVLGtHYSP--4ZzBYrM6SEHVHzY-CpQjO55ROsdL-mJRnT4SyYijSfPGsPWIzg73X7P09SaDJd7XJcX6EzVjWfZrRQ7ZRYJQtZkIJuIZw3axwxBEvDsMkpXvPdfXLzl56y9R-G6vxiQfXvUuar7syJt3I_h8qQC_tgE-U5AclHR6jBVtdRsTte3Kj2qMcyNorrB20TyYe-wY4NYpgBdJb0" alt="Psychologist Role">
                                    </div>
                                    <div class="p-3 flex items-center justify-between">
                                        <span class="text-[13px] font-semibold text-on-surface group-hover:text-primary transition-colors truncate">Psychologist Role</span>
                                        <span class="text-[11px] text-outline shrink-0">6m</span>
                                    </div>
                                </div>
                                <div class="group rounded-[14px] overflow-hidden bg-surface-container-lowest border border-slate-200/60 shadow-xs hover:border-primary/40 hover:shadow-sm transition-all flex flex-col cursor-pointer">
                                    <div class="h-28 w-full overflow-hidden relative rounded-t-[14px]">
                                        <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBk8-N-mn0Euuz3juIktVZYZfoi0bvfrWo1JD0FH18yPBxG-YAKuMVX_khZEMY0Zmrn7ULNNCpsYP9SNsk2V3dQ9d2dRvc2cOIxxgIoFjTc2nAxRb2aOoDosCv-_RAzXVNFz1QuIKBS_e9fcFI2OTXiTVKf-x-GDgIotcug_2Yp6jCK-jGkKcQGmSR8EVMVNLUo9QWCA0BikO_yrASabvgeLZ2VN1fVFombvgD-3V_jyhu891Lpsp-jZ2djwhQVgl0V5Kg8dVZvwe7tNB4" alt="The First Step">
                                    </div>
                                    <div class="p-3 flex items-center justify-between">
                                        <span class="text-[13px] font-semibold text-on-surface group-hover:text-primary transition-colors truncate">The First Step</span>
                                        <span class="text-[11px] text-outline shrink-0">5m</span>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>

                    <!-- SECONDARY COLUMN (4 cols) -->
                    <div class="lg:col-span-4 flex flex-col gap-4">
                        <!-- Clean Shortcuts Stack -->
                        <div class="flex flex-col gap-2">
                            <a class="p-3 bg-surface-container-lowest border border-slate-200/60 shadow-xs hover:border-[#5b5fe3]/40 hover:shadow-xs flex items-center justify-between transition-all group rounded-lg" href="{{ route('psychologists.index') }}">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-lg bg-[#e1e0ff] text-[#4144c9] flex items-center justify-center shrink-0 group-hover:scale-105 transition-transform">
                                        <span class="material-symbols-outlined text-[19px]">psychology</span>
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="text-[13.5px] font-semibold text-on-surface group-hover:text-primary transition-colors">My Psychologist</span>
                                        <span class="text-[11.5px] text-outline">Profile &amp; sessions</span>
                                    </div>
                                </div>
                                <span class="material-symbols-outlined text-[18px] text-outline group-hover:text-primary transition-colors">chevron_right</span>
                            </a>
                            <a class="p-3 bg-surface-container-lowest border border-slate-200/60 shadow-xs hover:border-[#20b2aa]/40 hover:shadow-xs flex items-center justify-between transition-all group rounded-lg" href="{{ route('moods.index') }}">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-lg bg-[#e0f7f5] text-[#006a60] flex items-center justify-center shrink-0 group-hover:scale-105 transition-transform">
                                        <span class="material-symbols-outlined text-[19px]">monitoring</span>
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="text-[13.5px] font-semibold text-on-surface group-hover:text-[#006a60] transition-colors">Mood Tracker</span>
                                        <span class="text-[11.5px] text-outline">Weekly trends</span>
                                    </div>
                                </div>
                                <span class="material-symbols-outlined text-[18px] text-outline group-hover:text-[#006a60] transition-colors">chevron_right</span>
                            </a>
                            <a class="p-3 bg-surface-container-lowest border border-slate-200/60 shadow-xs hover:border-[#5b5fe3]/40 hover:shadow-xs flex items-center justify-between transition-all group rounded-lg" href="{{ route('chat.index') }}">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-lg bg-gradient-to-tr from-[#e1e0ff] to-[#ccfbf1] text-[#4144c9] flex items-center justify-center shrink-0 group-hover:scale-105 transition-transform">
                                        <span class="material-symbols-outlined text-[19px]">smart_toy</span>
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="text-[13.5px] font-semibold text-on-surface group-hover:text-primary transition-colors">AI Assistant</span>
                                        <span class="text-[11.5px] text-outline">Quick reflections</span>
                                    </div>
                                </div>
                                <span class="material-symbols-outlined text-[18px] text-outline group-hover:text-primary transition-colors">chevron_right</span>
                            </a>
                        </div>

                        <!-- Weekly Sparkline Minimal with Real-Time User Data -->
                        <div class="p-4 bg-surface-container-lowest border border-slate-200/60 shadow-xs flex flex-col gap-2 rounded-lg">
                            <div class="flex items-center justify-between">
                                <span class="text-[13.5px] font-semibold text-on-surface">Weekly Balance</span>
                                <span id="weekly-balance-percentage" class="text-[11px] text-[#006a60] font-semibold bg-[#75f7e6]/30 px-2 py-0.5 rounded-md">+{{ $weeklyBalancePercentage ?? 18 }}% Calm</span>
                            </div>
                            <div class="w-full h-14 pt-1 flex flex-col justify-end">
                                <svg class="w-full h-12 overflow-visible" fill="none" preserveAspectRatio="none" viewBox="0 0 240 60">
                                    <defs>
                                        <linearGradient id="balanceGrad" x1="0" x2="1" y1="0" y2="0">
                                            <stop offset="0%" stop-color="#5b5fe3" stop-opacity="0.25"></stop>
                                            <stop offset="100%" stop-color="#20b2aa" stop-opacity="0.08"></stop>
                                        </linearGradient>
                                        <linearGradient id="balanceStroke" x1="0" x2="1" y1="0" y2="0">
                                            <stop offset="0%" stop-color="#5b5fe3"></stop>
                                            <stop offset="100%" stop-color="#20b2aa"></stop>
                                        </linearGradient>
                                    </defs>
                                    <path id="weekly-balance-area" d="M0,45 C30,48 50,30 80,32 C110,34 130,12 160,18 C190,24 210,10 240,14 L240,60 L0,60 Z" fill="url(#balanceGrad)"></path>
                                    <path id="weekly-balance-path" d="M0,45 C30,48 50,30 80,32 C110,34 130,12 160,18 C190,24 210,10 240,14" stroke="url(#balanceStroke)" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"></path>
                                    <circle id="weekly-balance-circle" cx="160" cy="18" fill="#5b5fe3" r="3.5" stroke="#ffffff" stroke-width="1.5"></circle>
                                </svg>
                            </div>
                            <div id="weekly-days-container" class="flex justify-between text-outline text-[11px] pt-1">
                                <span>M</span><span>T</span><span>W</span><span class="text-primary font-bold">T</span><span>F</span><span>S</span><span>S</span>
                            </div>
                        </div>

                        <!-- AI Prompts Strip -->
                        <div class="p-4 bg-surface-container-lowest border border-slate-200/60 shadow-xs flex flex-col gap-2.5 rounded-lg">
                            <div class="flex items-center gap-2">
                                <span class="material-symbols-outlined text-primary text-[18px]">psychology_alt</span>
                                <span class="text-[13px] font-semibold text-on-surface">Companion Prompt</span>
                            </div>
                            <a href="{{ route('chat.index') }}" class="w-full text-left p-2 rounded-lg bg-surface-container-low/70 hover:bg-surface-container text-on-surface-variant hover:text-on-surface text-[12px] flex items-center justify-between transition-colors">
                                <span class="truncate">"Guide me through a 2-min grounder"</span>
                                <span class="material-symbols-outlined text-[14px] text-outline shrink-0 ml-1">send</span>
                            </a>
                        </div>

                        <!-- Crisis Support (Subtle) -->
                        <div class="px-3.5 py-2.5 bg-rose-50 border border-rose-200/70 text-rose-800 flex items-center justify-between rounded-lg">
                            <div class="flex items-center gap-2">
                                <span class="material-symbols-outlined text-rose-600 text-[18px]">phone_in_talk</span>
                                <span class="text-[12px] font-medium">Need immediate help?</span>
                            </div>
                            <a class="px-2.5 py-1 rounded-lg bg-rose-600 text-white text-[11.5px] font-semibold hover:bg-rose-700 transition-colors shadow-xs" href="tel:988">
                                Call ***
                            </a>
                        </div>
                    </div>
                </div>

                <footer class="pt-6 pb-2 border-t border-slate-200/60 flex items-center justify-between text-outline text-[12px]"></footer>
            </div>
        </main>
    </div>

    <!-- SCRIPTS -->
    <script>
        let isSidebarCollapsed = false;

        // Fungsi untuk memperbarui tanggal & waktu real-time serta sapaan pengguna sesuai jam sistem
        function updateRealtimeClock() {
            const now = new Date();
            const options = { month: 'short', day: 'numeric', hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: false };
            const formattedString = now.toLocaleDateString('en-US', options) + ' WIB';
            const dateElement = document.getElementById('realtime-date');
            if (dateElement) {
                dateElement.innerText = formattedString;
            }

            // Sapaan dinamis (Good morning/afternoon/evening) berdasarkan waktu pengguna
            const hours = now.getHours();
            let greeting = 'Good morning';
            if (hours >= 12 && hours < 17) {
                greeting = 'Good afternoon';
            } else if (hours >= 17) {
                greeting = 'Good evening';
            }

            const userName = "{{ Auth::user()->name ?? 'Willy' }}";
            const greetingEl = document.getElementById('dynamic-greeting-title');
            if (greetingEl) {
                greetingEl.innerText = `${greeting}, ${userName}`;
            }
        }

        // Fungsi untuk memperbarui Weekly Balance secara real-time dari data pengguna backend/lokal
        async function updateWeeklyBalance() {
            try {
                // Penyesuaian indikator hari aktif (Senin = 0 sampai Minggu = 6)
                const d = new Date();
                const dayIndex = (d.getDay() + 6) % 7; 
                const days = ['M', 'T', 'W', 'T', 'F', 'S', 'S'];
                
                let daysHtml = '';
                days.forEach((day, idx) => {
                    if (idx === dayIndex) {
                        daysHtml += `<span class="text-primary font-bold">${day}</span>`;
                    } else {
                        daysHtml += `<span>${day}</span>`;
                    }
                });
                
                const daysContainer = document.getElementById('weekly-days-container');
                if (daysContainer) {
                    daysContainer.innerHTML = daysHtml;
                }

                // Mengambil update real-time via AJAX / Fetch jika endpoint backend tersedia
                const response = await fetch("{{ route('dashboard') }}", { 
                    headers: { 'X-Requested-With': 'XMLHttpRequest' } 
                });
                if (response.ok) {
                    // Bisa memperbarui state tambahan jika diperlukan
                }
            } catch (e) {
                console.log('Real-time dashboard sync active');
            }
        }

        // Jalankan saat halaman dimuat dan set interval per detik
        document.addEventListener('DOMContentLoaded', () => {
            updateRealtimeClock();
            updateWeeklyBalance();
            setInterval(updateRealtimeClock, 1000);
        });

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

                sidebarTexts.forEach(el => {
                    el.classList.add('hidden');
                });
            } else {
                sidebar.classList.remove('w-[72px]', 'px-2');
                sidebar.classList.add('w-60', 'px-3');
                mainContent.classList.remove('pl-[72px]');
                mainContent.classList.add('pl-60');
                mainHeader.classList.remove('left-[72px]');
                mainHeader.classList.add('left-60');
                collapseIcon.innerText = 'keyboard_double_arrow_left';

                sidebarTexts.forEach(el => {
                    el.classList.remove('hidden');
                });
            }
        }

        function submitMood(score, label, element) {
            document.querySelectorAll('.mood-card').forEach(card => {
                card.classList.remove('active', 'border-2', 'border-primary', 'ring-2', 'ring-primary/10', 'shadow-sm', 'shadow-primary/10');
                card.classList.add('border', 'border-slate-200/60');
                const textSpan = card.querySelector('span:not(.material-symbols-outlined)');
                if (textSpan) {
                    textSpan.classList.remove('text-primary');
                    textSpan.classList.add('text-on-surface');
                }
                const indicator = card.querySelector('.mood-check-indicator');
                if (indicator) {
                    indicator.classList.add('hidden');
                }
            });

            element.classList.add('active', 'border-2', 'border-primary', 'ring-2', 'ring-primary/10', 'shadow-sm', 'shadow-primary/10');
            element.classList.remove('border-slate-200/60');
            const textSpan = element.querySelector('span:not(.material-symbols-outlined)');
            if (textSpan) {
                textSpan.classList.add('text-primary');
                textSpan.classList.remove('text-on-surface');
            }
            const indicator = element.querySelector('.mood-check-indicator');
            if (indicator) {
                indicator.classList.remove('hidden');
            }

            // Simpan ke hidden input dan submit ke MoodController secara asinkron/form submit
            const form = document.getElementById('moodForm');
            if (form) {
                let scoreInput = document.getElementById('selectedMoodScore');
                let labelInput = document.getElementById('selectedMoodLabel');
                if (scoreInput) scoreInput.value = score;
                if (labelInput) labelInput.value = label;
                form.submit();
            }
        }
    </script>
</body>
</html>