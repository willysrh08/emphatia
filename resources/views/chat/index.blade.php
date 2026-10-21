<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>AI Companion - Emphatia</title>

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

        /* Animasi halus untuk gelembung pesan & indikator mengetik */
        @keyframes message-in {
            from { opacity: 0; transform: translateY(8px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .message-bubble { animation: message-in 0.25s ease-out; }

        @keyframes typing-dot {
            0%, 60%, 100% { transform: translateY(0); opacity: 0.4; }
            30% { transform: translateY(-4px); opacity: 1; }
        }
        .typing-dot { animation: typing-dot 1.2s infinite; }
        .typing-dot:nth-child(2) { animation-delay: 0.15s; }
        .typing-dot:nth-child(3) { animation-delay: 0.3s; }
    </style>

    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script id="tailwind-config">
        tailwind.config={darkMode:"class",theme:{extend:{colors:{"secondary-fixed-dim":"#55dbca","on-surface-variant":"#464554","tertiary":"#444eaa","tertiary-fixed-dim":"#bdc2ff","secondary-fixed":"#75f7e6","on-error":"#ffffff","on-secondary-fixed":"#00201c","on-background":"#0b1c30","surface-container":"#e5eeff","on-tertiary-fixed":"#000766","secondary":"#006a60","error-container":"#ffdad6","outline":"#767586","on-secondary":"#ffffff","inverse-primary":"#c0c1ff","outline-variant":"#c6c5d6","tertiary-fixed":"#dfe0ff","surface-container-highest":"#d3e4fe","surface-container-high":"#dce9ff","on-error-container":"#93000a","on-tertiary":"#ffffff","surface-container-lowest":"#ffffff","on-primary":"#ffffff","tertiary-container":"#5d67c4","on-primary-fixed-variant":"#2f30b8","error":"#ba1a1a","inverse-surface":"#213145","on-primary-container":"#f5f2ff","on-secondary-container":"#006f65","surface-variant":"#d3e4fe","primary-fixed":"#e1e0ff","on-surface":"#0b1c30","primary-container":"#5b5fe3","surface-container-low":"#eff4ff","secondary-container":"#72f5e3","on-tertiary-fixed-variant":"#333c98","primary-fixed-dim":"#c0c1ff","surface-tint":"#494cd1","surface-bright":"#f8f9ff","surface":"#f8f9ff","inverse-on-surface":"#eaf1ff","on-primary-fixed":"#05006c","primary":"#4144c9","on-secondary-fixed-variant":"#005048","background":"#f8f9ff","on-tertiary-container":"#f5f3ff","surface-dim":"#cbdbf5"},borderRadius:{"DEFAULT":"1rem","lg":"2rem","xl":"3rem","full":"9999px"},spacing:{"space-xs":"0.375rem","space-xl":"2.5rem","space-sm":"0.75rem","space-md":"1.25rem","margin":"2rem","gutter":"1.5rem","gutter-mobile":"1rem","space-lg":"1.75rem","margin-mobile":"1.25rem"},fontFamily:{"body-lg":["Plus Jakarta Sans"],"headline-sm":["Plus Jakarta Sans"],"label-md":["Plus Jakarta Sans"],"headline-lg-mobile":["Plus Jakarta Sans"],"display-lg-mobile":["Plus Jakarta Sans"],"title-md":["Plus Jakarta Sans"],"headline-lg":["Plus Jakarta Sans"],"caption":["Plus Jakarta Sans"],"display-lg":["Plus Jakarta Sans"],"body-sm":["Plus Jakarta Sans"]}}}
    </script>
</head>
<body class="bg-background font-body-md text-on-surface min-h-screen selection:bg-secondary-fixed selection:text-on-secondary-fixed antialiased">
    <svg aria-hidden="true" class="inline-defs-container" style="position:absolute;width:0;height:0;overflow:hidden"></svg>

    <!-- SIDEBAR (100% identik dengan Dashboard) -->
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
                    <span class="material-symbols-outlined text-[19px] text-outline group-hover:text-primary transition-colors shrink-0">grid_view</span>
                    <span class="sidebar-text truncate">Dashboard</span>
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
                <a aria-current="page" class="group relative flex items-center gap-3 px-3 py-2 rounded-xl transition-all bg-gradient-to-r from-[#5b5fe3] to-[#20b2aa] text-white font-medium text-[13.5px] shadow-sm shadow-[#5b5fe3]/25" href="{{ route('chat.index') }}" title="AI Companion">
                    <span class="material-symbols-outlined text-[19px] shrink-0 text-white">psychology_alt</span>
                    <span class="sidebar-text truncate font-semibold">AI Companion</span>
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
        <!-- Minimal Header (100% identik dengan Dashboard) -->
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
                    </button>
                </div>
            </div>
        </header>

        <!-- AI Companion Chat Body -->
        <main class="relative pt-14 w-full bg-surface h-screen">
            <div class="w-full h-[calc(100vh-3.5rem)] px-6 lg:px-8 py-6">
                <div class="flex w-full h-full gap-6 max-w-7xl mx-auto">

                    <!-- HISTORY PANEL (Riwayat Percakapan) -->
                    <aside class="hidden md:flex w-72 shrink-0 flex-col rounded-2xl bg-surface-container-lowest border border-slate-200/60 shadow-xs overflow-hidden">
                        <div class="p-4 border-b border-slate-200/60 flex flex-col gap-3">
                            <div class="flex items-center gap-2">
                                <span class="material-symbols-outlined text-primary text-[20px]">history</span>
                                <h2 class="text-[15px] font-bold text-on-surface">Conversation History</h2>
                            </div>
                            <button id="new-chat-btn" class="w-full flex items-center justify-center gap-1.5 px-3 py-2 rounded-xl bg-gradient-to-r from-[#5b5fe3] to-[#20b2aa] text-white font-semibold text-[13px] hover:opacity-90 transition-opacity shadow-sm shadow-[#5b5fe3]/25" type="button">
                                <span class="material-symbols-outlined text-[17px]">add_comment</span>
                                <span>New Conversation</span>
                            </button>
                        </div>

                        <div class="flex-1 overflow-y-auto p-2 flex flex-col gap-1" id="history-list">
                            @forelse($histories as $history)
                                <button class="history-item group w-full text-left p-2.5 rounded-xl hover:bg-surface-container-low transition-colors flex items-start gap-2.5 border border-transparent" type="button"
                                    data-message="{{ $history->message }}"
                                    data-response="{{ $history->response }}"
                                    data-created-at="{{ $history->created_at?->format('d M Y, H:i') }}">
                                    <span class="material-symbols-outlined text-[17px] text-outline group-hover:text-primary transition-colors mt-0.5 shrink-0">chat_bubble</span>
                                    <span class="flex flex-col min-w-0">
                                        <span class="text-[13px] font-medium text-on-surface truncate">{{ \Illuminate\Support\Str::limit($history->message, 40) }}</span>
                                        <span class="text-[11px] text-outline truncate">{{ $history->created_at?->diffForHumans() ?? '' }}</span>
                                    </span>
                                </button>
                            @empty
                                <div class="flex flex-col items-center justify-center text-center py-8 px-4 gap-2" id="empty-history-hint">
                                    <span class="material-symbols-outlined text-outline text-[28px]">forum</span>
                                    <p class="text-[12.5px] text-on-surface-variant leading-relaxed">Belum ada riwayat percakapan. Mulai obrolan baru dengan Emphatia AI.</p>
                                </div>
                            @endforelse
                        </div>
                    </aside>

                    <!-- CHAT PANEL -->
                    <section class="flex-1 min-w-0 flex flex-col rounded-2xl bg-surface-container-lowest border border-slate-200/60 shadow-xs overflow-hidden">
                        <!-- Chat Header -->
                        <div class="px-5 py-3.5 border-b border-slate-200/60 flex items-center justify-between gap-3 bg-surface-container-lowest">
                            <div class="flex items-center gap-3">
                                <div class="relative w-10 h-10 rounded-full bg-gradient-to-tr from-[#5b5fe3] to-[#20b2aa] flex items-center justify-center text-white shadow-sm shrink-0">
                                    <span class="material-symbols-outlined text-[22px]">psychology_alt</span>
                                    <span class="absolute bottom-0 right-0 w-2.5 h-2.5 rounded-full bg-[#20b2aa] ring-2 ring-white"></span>
                                </div>
                                <div class="flex flex-col">
                                    <div class="flex items-center gap-1">
                                        <span class="text-[15px] font-bold text-on-surface">Emphatia AI</span>
                                        <span class="material-symbols-outlined text-[#14b8a6] text-[15px]">verified</span>
                                    </div>
                                    <span class="text-[11.5px] text-[#006a60] font-medium">Digital Mental Health Companion</span>
                                </div>
                            </div>
                            <div class="hidden sm:flex items-center gap-1.5 px-2.5 py-1 rounded-md bg-surface-container-low text-[11.5px] text-on-surface-variant">
                                <span class="material-symbols-outlined text-[14px] text-primary">lock</span>
                                <span>Private &amp; encrypted</span>
                            </div>
                        </div>

                        <!-- Chat Messages (auto-scroll) -->
                        <div class="flex-1 overflow-y-auto px-5 py-5 flex flex-col gap-4 bg-surface-container-lowest/50" id="chat-box">
                            <!-- Pesan sambutan awal -->
                            <div class="message-bubble flex items-start gap-3 max-w-[85%]">
                                <div class="w-8 h-8 rounded-full bg-gradient-to-tr from-[#5b5fe3] to-[#20b2aa] flex items-center justify-center text-white shrink-0 shadow-xs">
                                    <span class="material-symbols-outlined text-[17px]">smart_toy</span>
                                </div>
                                <div class="flex flex-col gap-1">
                                    <div class="px-4 py-3 rounded-2xl rounded-tl-md bg-surface-container-low border border-slate-200/60 text-on-surface-variant text-[13.5px] leading-relaxed">
                                        Hai, {{ Auth::user()->name ?? 'Willy' }} 👋 Aku <span class="font-semibold text-on-surface">Emphatia AI</span>, teman pendamping kesehatan mentalmu. Ada yang ingin kamu ceritakan atau bagaimana perasaanmu saat ini?
                                    </div>
                                    <span class="text-[10.5px] text-outline px-1">Sekarang</span>
                                </div>
                            </div>

                            <!-- Placeholder pesan riwayat terpilih -->
                            @if($histories->isNotEmpty())
                                @php $latest = $histories->last(); @endphp
                                <div class="message-bubble flex items-start justify-end gap-3 max-w-[85%] ml-auto">
                                    <div class="flex flex-col gap-1 items-end">
                                        <div class="px-4 py-3 rounded-2xl rounded-tr-md bg-gradient-to-r from-[#5b5fe3] to-[#4f5bd5] text-white text-[13.5px] leading-relaxed shadow-sm shadow-[#5b5fe3]/20">
                                            {{ $latest->message }}
                                        </div>
                                        <span class="text-[10.5px] text-outline px-1">{{ $latest->created_at?->format('H:i') ?? '' }}</span>
                                    </div>
                                </div>
                                <div class="message-bubble flex items-start gap-3 max-w-[85%]">
                                    <div class="w-8 h-8 rounded-full bg-gradient-to-tr from-[#5b5fe3] to-[#20b2aa] flex items-center justify-center text-white shrink-0 shadow-xs">
                                        <span class="material-symbols-outlined text-[17px]">smart_toy</span>
                                    </div>
                                    <div class="flex flex-col gap-1">
                                        <div class="px-4 py-3 rounded-2xl rounded-tl-md bg-surface-container-low border border-slate-200/60 text-on-surface-variant text-[13.5px] leading-relaxed">
                                            {{ $latest->response }}
                                        </div>
                                        <span class="text-[10.5px] text-outline px-1">{{ $latest->created_at?->format('H:i') ?? '' }}</span>
                                    </div>
                                </div>
                            @endif

                            <!-- Indikator mengetik (tersembunyi secara default) -->
                            <div class="message-bubble hidden items-start gap-3 max-w-[85%]" id="typing-indicator">
                                <div class="w-8 h-8 rounded-full bg-gradient-to-tr from-[#5b5fe3] to-[#20b2aa] flex items-center justify-center text-white shrink-0 shadow-xs">
                                    <span class="material-symbols-outlined text-[17px]">smart_toy</span>
                                </div>
                                <div class="px-4 py-3.5 rounded-2xl rounded-tl-md bg-surface-container-low border border-slate-200/60 flex items-center gap-1.5">
                                    <span class="typing-dot w-1.5 h-1.5 rounded-full bg-primary"></span>
                                    <span class="typing-dot w-1.5 h-1.5 rounded-full bg-primary"></span>
                                    <span class="typing-dot w-1.5 h-1.5 rounded-full bg-primary"></span>
                                </div>
                            </div>

                            <!-- Banner Krisis (tersembunyi secara default) -->
                            <div class="hidden items-stretch gap-3 p-4 rounded-2xl bg-rose-50 border border-rose-200/70 text-rose-800" id="crisis-banner" role="alert">
                                <span class="material-symbols-outlined text-rose-600 text-[24px] shrink-0">emergency_home</span>
                                <div class="flex flex-col gap-2 text-[13px] leading-relaxed">
                                    <span class="font-bold text-rose-900">Kami sangat khawatir dengan keadaanmu.</span>
                                    <span>Kamu tidak sendirian. Jika kamu sedang berada dalam bahaya atau berpikir untuk menyakiti diri sendiri, silakan hubungi layanan bantuan darurat atau psikolog mitra Emphatia sekarang juga.</span>
                                    <div class="flex flex-wrap gap-2 mt-1">
                                        <a class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-rose-600 text-white text-[12px] font-semibold hover:bg-rose-700 transition-colors shadow-xs" href="tel:119">
                                            <span class="material-symbols-outlined text-[15px]">phone_in_talk</span>
                                            <span>Call Hotline 119</span>
                                        </a>
                                        <a class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-white text-rose-700 border border-rose-300 text-[12px] font-semibold hover:bg-rose-100 transition-colors" href="{{ route('psychologists.index') }}">
                                            <span class="material-symbols-outlined text-[15px]">clinical_notes</span>
                                            <span>Hubungi Psikolog</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Chat Input -->
                        <div class="border-t border-slate-200/60 p-4 bg-surface-container-lowest">
                            <form id="chat-form" class="flex items-end gap-2.5" autocomplete="off">
                                @csrf
                                <div class="flex-1 relative">
                                    <textarea id="chat-input" name="message" rows="1" maxlength="1000" placeholder="Tuliskan perasaanmu di sini..." class="w-full resize-none rounded-xl border border-slate-200/80 bg-surface-container-low py-3 pl-4 pr-12 text-[13.5px] text-on-surface placeholder:text-outline/70 focus:outline-none focus:ring-1 focus:ring-primary focus:border-primary transition-all max-h-32 leading-relaxed"></textarea>
                                    <span class="material-symbols-outlined absolute right-3.5 bottom-3 text-outline/60 text-[18px] pointer-events-none">mood</span>
                                </div>
                                <button id="send-btn" type="submit" class="shrink-0 w-11 h-11 rounded-xl bg-gradient-to-r from-[#5b5fe3] to-[#20b2aa] text-white flex items-center justify-center hover:opacity-90 transition-opacity shadow-sm shadow-[#5b5fe3]/25 disabled:opacity-50 disabled:cursor-not-allowed">
                                    <span class="material-symbols-outlined text-[20px]">send</span>
                                </button>
                            </form>
                            <p class="text-[11px] text-outline mt-2 text-center">Emphatia AI bukan pengganti profesional. Dalam keadaan darurat, hubungi layanan darurat setempat.</p>
                        </div>
                    </section>

                </div>
            </div>
        </main>
    </div>

    <!-- SCRIPTS -->
    <script>
        let isSidebarCollapsed = false;

        // Fungsi untuk memperbarui tanggal & waktu real-time di header
        function updateRealtimeClock() {
            const now = new Date();
            const options = { month: 'short', day: 'numeric', hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: false };
            const dateElement = document.getElementById('realtime-date');
            if (dateElement) {
                dateElement.innerText = now.toLocaleDateString('en-US', options) + ' WIB';
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            updateRealtimeClock();
            setInterval(updateRealtimeClock, 1000);
            initChat();
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

        /* =========================================================
           CHAT ENGINE (Vanilla JS + Fetch API, tanpa page reload)
           ========================================================= */
        const CHAT_SEND_URL = @json(route('chat.send'));
        const CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        let isSendingMessage = false;

        function initChat() {
            const chatForm = document.getElementById('chat-form');
            const chatInput = document.getElementById('chat-input');
            const sendBtn = document.getElementById('send-btn');
            const newChatBtn = document.getElementById('new-chat-btn');

            // Auto-resize textarea sesuai isi pesan
            chatInput.addEventListener('input', () => {
                chatInput.style.height = 'auto';
                chatInput.style.height = Math.min(chatInput.scrollHeight, 128) + 'px';
            });

            // Kirim pesan dengan tombol Enter, Shift+Enter untuk baris baru
            chatInput.addEventListener('keydown', (event) => {
                if (event.key === 'Enter' && !event.shiftKey) {
                    event.preventDefault();
                    chatForm.dispatchEvent(new Event('submit', { cancelable: true }));
                }
            });

            chatForm.addEventListener('submit', (event) => {
                event.preventDefault();
                sendMessage();
            });

            newChatBtn.addEventListener('click', () => {
                resetConversation();
            });

            // Muat ulang percakapan saat memilih salah satu riwayat
            document.querySelectorAll('.history-item').forEach((item) => {
                item.addEventListener('click', () => {
                    loadConversationFromHistory(item);
                });
            });

            scrollToBottom();
        }

        function scrollToBottom() {
            const chatBox = document.getElementById('chat-box');
            chatBox.scrollTop = chatBox.scrollHeight;
        }

        function getCurrentTimeLabel() {
            return new Date().toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit', hour12: false });
        }

        function appendUserBubble(messageText) {
            const chatBox = document.getElementById('chat-box');
            const emptyHint = document.getElementById('empty-history-hint');
            if (emptyHint) {
                emptyHint.remove();
            }

            const bubble = document.createElement('div');
            bubble.className = 'message-bubble flex items-start justify-end gap-3 max-w-[85%] ml-auto';

            const bubbleContent = document.createElement('div');
            bubbleContent.className = 'flex flex-col gap-1 items-end';

            const messageBody = document.createElement('div');
            messageBody.className = 'px-4 py-3 rounded-2xl rounded-tr-md bg-gradient-to-r from-[#5b5fe3] to-[#4f5bd5] text-white text-[13.5px] leading-relaxed shadow-sm shadow-[#5b5fe3]/20 whitespace-pre-wrap break-words';
            messageBody.textContent = messageText;

            const timestamp = document.createElement('span');
            timestamp.className = 'text-[10.5px] text-outline px-1';
            timestamp.textContent = getCurrentTimeLabel();

            bubbleContent.appendChild(messageBody);
            bubbleContent.appendChild(timestamp);
            bubble.appendChild(bubbleContent);
            chatBox.appendChild(bubble);
            scrollToBottom();
        }

        function appendAiBubble(replyText, isCrisis) {
            const chatBox = document.getElementById('chat-box');

            const bubble = document.createElement('div');
            bubble.className = 'message-bubble flex items-start gap-3 max-w-[85%]';

            const avatar = document.createElement('div');
            avatar.className = 'w-8 h-8 rounded-full bg-gradient-to-tr from-[#5b5fe3] to-[#20b2aa] flex items-center justify-center text-white shrink-0 shadow-xs';
            avatar.innerHTML = '<span class="material-symbols-outlined text-[17px]">smart_toy</span>';

            const bubbleContent = document.createElement('div');
            bubbleContent.className = 'flex flex-col gap-1';

            const messageBody = document.createElement('div');
            messageBody.className = isCrisis
                ? 'px-4 py-3 rounded-2xl rounded-tl-md bg-rose-50 border border-rose-200/70 text-rose-900 text-[13.5px] leading-relaxed whitespace-pre-wrap break-words'
                : 'px-4 py-3 rounded-2xl rounded-tl-md bg-surface-container-low border border-slate-200/60 text-on-surface-variant text-[13.5px] leading-relaxed whitespace-pre-wrap break-words';
            messageBody.textContent = replyText;

            const timestamp = document.createElement('span');
            timestamp.className = 'text-[10.5px] text-outline px-1';
            timestamp.textContent = getCurrentTimeLabel();

            bubbleContent.appendChild(messageBody);
            bubbleContent.appendChild(timestamp);
            bubble.appendChild(avatar);
            bubble.appendChild(bubbleContent);
            chatBox.appendChild(bubble);
            scrollToBottom();
        }

        function setTypingIndicator(isVisible) {
            const typingIndicator = document.getElementById('typing-indicator');
            if (isVisible) {
                typingIndicator.classList.remove('hidden');
                typingIndicator.classList.add('flex');
                scrollToBottom();
            } else {
                typingIndicator.classList.add('hidden');
                typingIndicator.classList.remove('flex');
            }
        }

        function setCrisisBanner(isVisible) {
            const crisisBanner = document.getElementById('crisis-banner');
            if (isVisible) {
                crisisBanner.classList.remove('hidden');
                crisisBanner.classList.add('flex');
                scrollToBottom();
            }
        }

        function setSendButtonState(isDisabled) {
            isSendingMessage = isDisabled;
            document.getElementById('send-btn').disabled = isDisabled;
        }

        function prependHistoryItem(messageText, replyText) {
            const historyList = document.getElementById('history-list');
            const emptyHint = document.getElementById('empty-history-hint');
            if (emptyHint) {
                emptyHint.remove();
            }

            const historyItem = document.createElement('button');
            historyItem.type = 'button';
            historyItem.className = 'history-item group w-full text-left p-2.5 rounded-xl hover:bg-surface-container-low transition-colors flex items-start gap-2.5 border border-transparent';

            const icon = document.createElement('span');
            icon.className = 'material-symbols-outlined text-[17px] text-outline group-hover:text-primary transition-colors mt-0.5 shrink-0';
            icon.textContent = 'chat_bubble';

            const textWrapper = document.createElement('span');
            textWrapper.className = 'flex flex-col min-w-0';

            const title = document.createElement('span');
            title.className = 'text-[13px] font-medium text-on-surface truncate';
            title.textContent = messageText.length > 40 ? messageText.slice(0, 40) + '…' : messageText;

            const subtitle = document.createElement('span');
            subtitle.className = 'text-[11px] text-outline truncate';
            subtitle.textContent = 'Baru saja';

            textWrapper.appendChild(title);
            textWrapper.appendChild(subtitle);
            historyItem.appendChild(icon);
            historyItem.appendChild(textWrapper);

            historyItem.dataset.message = messageText;
            historyItem.dataset.response = replyText;
            historyItem.dataset.createdAt = 'Baru saja';

            historyItem.addEventListener('click', () => {
                loadConversationFromHistory(historyItem);
            });

            historyList.prepend(historyItem);
        }

        function loadConversationFromHistory(historyItem) {
            const chatBox = document.getElementById('chat-box');
            const typingIndicator = document.getElementById('typing-indicator');
            const crisisBanner = document.getElementById('crisis-banner');

            // Sembunyikan indikator mengetik & banner krisis saat berpindah riwayat
            typingIndicator.classList.add('hidden');
            typingIndicator.classList.remove('flex');
            crisisBanner.classList.add('hidden');
            crisisBanner.classList.remove('flex');

            // Kosongkan area chat dari pesan sebelumnya (kecuali indikator & banner)
            chatBox.querySelectorAll('.message-bubble').forEach((bubble) => {
                if (bubble.id !== 'typing-indicator' && bubble.id !== 'crisis-banner') {
                    bubble.remove();
                }
            });

            appendUserBubble(historyItem.dataset.message);
            appendAiBubble(historyItem.dataset.response, false);
        }

        function resetConversation() {
            const chatBox = document.getElementById('chat-box');
            const typingIndicator = document.getElementById('typing-indicator');
            const crisisBanner = document.getElementById('crisis-banner');

            typingIndicator.classList.add('hidden');
            typingIndicator.classList.remove('flex');
            crisisBanner.classList.add('hidden');
            crisisBanner.classList.remove('flex');

            chatBox.querySelectorAll('.message-bubble').forEach((bubble) => {
                if (bubble.id !== 'typing-indicator' && bubble.id !== 'crisis-banner') {
                    bubble.remove();
                }
            });

            const userName = @json(Auth::user()->name ?? 'Willy');
            appendAiBubble(`Hai, ${userName} 👋 Aku Emphatia AI, teman pendamping kesehatan mentalmu. Ada yang ingin kamu ceritakan atau bagaimana perasaanmu saat ini?`, false);

            document.getElementById('chat-input').focus();
        }

        // Kirim pesan user ke AiChatController via Fetch API (asinkron / tanpa reload)
        async function sendMessage() {
            const chatInput = document.getElementById('chat-input');
            const messageText = chatInput.value.trim();

            if (messageText === '' || isSendingMessage) {
                return;
            }

            appendUserBubble(messageText);
            chatInput.value = '';
            chatInput.style.height = 'auto';
            setSendButtonState(true);
            setTypingIndicator(true);

            try {
                const response = await fetch(CHAT_SEND_URL, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': CSRF_TOKEN,
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({ message: messageText })
                });

                setTypingIndicator(false);

                if (!response.ok) {
                    throw new Error('Permintaan gagal diproses oleh server.');
                }

                const data = await response.json();
                const replyText = data.reply ?? 'Aku mendengarkanmu. Ceritakan lebih banyak jika kamu merasa nyaman.';
                const isCrisis = Boolean(data.is_crisis);

                appendAiBubble(replyText, isCrisis);
                prependHistoryItem(messageText, replyText);

                // Tampilkan panel bantuan darurat jika status krisis terdeteksi
                if (isCrisis) {
                    setCrisisBanner(true);
                }
            } catch (error) {
                setTypingIndicator(false);
                appendAiBubble('Maaf, terjadi kendala saat menghubungku. Tarik napas perlahan, lalu coba tulis lagi ya.', false);
            } finally {
                setSendButtonState(false);
                chatInput.focus();
            }
        }
    </script>
</body>
</html>
