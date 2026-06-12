<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sistem Manajemen Blog (CMS)</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            navy: {
              900: '#0f172a',
              800: '#1e293b',
              700: '#334155',
              600: '#475569',
            }
          },
          fontFamily: {
            sans: ['Inter', 'ui-sans-serif', 'system-ui'],
          }
        }
      }
    }
  </script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'Inter', sans-serif; }
    .nav-item.active {
      background-color: #3b82f6;
      color: #ffffff;
    }
    .nav-item.active svg { color: #fff; }
    .nav-item:not(.active):hover {
      background-color: #1e3a5f;
      color: #93c5fd;
    }
    .nav-item:not(.active):hover svg { color: #93c5fd; }
    /* Smooth sidebar transition on mobile */
    #sidebar { transition: transform 0.25s ease; }
  </style>
</head>
<body class="bg-slate-100 min-h-screen">

  <!-- ===== TOP HEADER ===== -->
  <header class="fixed top-0 left-0 right-0 z-30 bg-navy-900 shadow-lg h-16 flex items-center px-6 gap-4">
    <!-- Mobile hamburger -->
    <button id="hamburgerBtn" class="lg:hidden text-slate-300 hover:text-white mr-1">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
      </svg>
    </button>

    <!-- Logo + App Name -->
    <div class="flex items-center gap-3">
      <div class="bg-blue-500 rounded-lg p-1.5">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 12h6m0 0H9" />
        </svg>
      </div>
      <h1 class="text-white font-semibold text-base sm:text-lg tracking-tight leading-tight">
        Sistem Manajemen Blog
        <span class="hidden sm:inline text-blue-400 font-normal">(CMS)</span>
      </h1>
    </div>

    <div class="ml-auto flex items-center gap-3">
      <!-- Notification bell -->
      <button class="relative text-slate-400 hover:text-white transition-colors">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 10-12 0v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
        </svg>
        <span class="absolute -top-1 -right-1 bg-red-500 text-white text-[10px] rounded-full w-4 h-4 flex items-center justify-center font-bold">3</span>
      </button>
      <!-- User avatar -->
      <div class="flex items-center gap-2 cursor-pointer group">
        <img src="https://ui-avatars.com/api/?name=Admin+CMS&background=3b82f6&color=fff&size=36"
             alt="Admin" class="w-8 h-8 rounded-full ring-2 ring-blue-500/40 group-hover:ring-blue-400 transition-all" />
        <span class="hidden sm:block text-slate-300 text-sm font-medium group-hover:text-white transition-colors">Admin</span>
      </div>
    </div>
  </header>

  <!-- ===== LAYOUT WRAPPER ===== -->
  <div class="flex pt-16 min-h-screen">

    <!-- ===== SIDEBAR ===== -->
    <aside id="sidebar"
      class="fixed left-0 top-16 bottom-0 z-20 w-64 bg-navy-800 flex flex-col
             -translate-x-full lg:translate-x-0">

      <div class="px-4 pt-6 pb-3">
        <p class="text-xs font-semibold text-slate-500 uppercase tracking-widest mb-3 px-3">Menu Utama</p>
        <nav class="space-y-1">

          <!-- Kelola Penulis -->
          <button onclick="setActive(this, 'penulis')"
            class="nav-item active w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-150 text-white">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
            Kelola Penulis
          </button>

          <!-- Kelola Artikel -->
          <button onclick="setActive(this, 'artikel')"
            class="nav-item w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-150 text-slate-300">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
            Kelola Artikel
          </button>

          <!-- Kelola Kategori -->
          <button onclick="setActive(this, 'kategori')"
            class="nav-item w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-150 text-slate-300">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
            </svg>
            Kelola Kategori Artikel
          </button>

        </nav>
      </div>

      <!-- Sidebar footer -->
      <div class="mt-auto px-4 py-4 border-t border-slate-700/50">
        <button class="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-slate-400 hover:text-red-400 hover:bg-red-500/10 transition-all duration-150">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
          </svg>
          Keluar
        </button>
      </div>
    </aside>

    <!-- Sidebar overlay (mobile) -->
    <div id="sidebarOverlay"
      class="fixed inset-0 z-10 bg-black/50 hidden lg:hidden"
      onclick="closeSidebar()">
    </div>

    <!-- ===== MAIN CONTENT ===== -->
    <main class="flex-1 lg:ml-64 p-6">

      <!-- ===== CONTENT AREA ===== -->
      <div id="contentArea">

        <!-- Page title row -->
        <div class="flex items-center justify-between mb-6">
          <div>
            <h2 id="pageTitle" class="text-xl font-bold text-navy-900">Kelola Penulis</h2>
            <p id="pageSubtitle" class="text-sm text-slate-500 mt-0.5">Manajemen data penulis blog</p>
          </div>
          <button onclick="openModal('tambah')"
            class="flex items-center gap-2 bg-emerald-500 hover:bg-emerald-600 active:bg-emerald-700
                   text-white text-sm font-semibold px-4 py-2.5 rounded-lg shadow-sm
                   transition-all duration-150 hover:shadow-emerald-200 hover:shadow-md">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Data
          </button>
        </div>

        <!-- Stats cards (optional, adds polish) -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
          <div class="bg-white rounded-xl shadow-sm border border-slate-200/80 px-5 py-4 flex items-center gap-4">
            <div class="bg-blue-50 rounded-lg p-2.5">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
              </svg>
            </div>
            <div>
              <p class="text-2xl font-bold text-navy-900">4</p>
              <p class="text-xs text-slate-500">Total Penulis</p>
            </div>
          </div>
          <div class="bg-white rounded-xl shadow-sm border border-slate-200/80 px-5 py-4 flex items-center gap-4">
            <div class="bg-emerald-50 rounded-lg p-2.5">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
              </svg>
            </div>
            <div>
              <p class="text-2xl font-bold text-navy-900">12</p>
              <p class="text-xs text-slate-500">Total Artikel</p>
            </div>
          </div>
          <div class="bg-white rounded-xl shadow-sm border border-slate-200/80 px-5 py-4 flex items-center gap-4">
            <div class="bg-violet-50 rounded-lg p-2.5">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-violet-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
              </svg>
            </div>
            <div>
              <p class="text-2xl font-bold text-navy-900">5</p>
              <p class="text-xs text-slate-500">Total Kategori</p>
            </div>
          </div>
        </div>

        <!-- Table card -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200/80 overflow-hidden">

          <!-- Card header with search -->
          <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 px-6 py-4 border-b border-slate-100">
            <h3 class="font-semibold text-navy-800 text-sm">Daftar Penulis</h3>
            <div class="relative">
              <svg xmlns="http://www.w3.org/2000/svg" class="absolute left-3 top-1/2 -translate-y-1/2 h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
              </svg>
              <input type="text" placeholder="Cari penulis..."
                class="pl-9 pr-4 py-2 text-sm bg-slate-50 border border-slate-200 rounded-lg
                       focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-blue-400
                       placeholder-slate-400 w-full sm:w-52 transition" />
            </div>
          </div>

          <!-- Table scroll wrapper -->
          <div class="overflow-x-auto">
            <table class="w-full text-sm">
              <thead>
                <tr class="bg-slate-50 border-b border-slate-100">
                  <th class="text-left text-xs font-semibold text-slate-500 uppercase tracking-wider px-6 py-3 w-16">Foto</th>
                  <th class="text-left text-xs font-semibold text-slate-500 uppercase tracking-wider px-4 py-3">Nama</th>
                  <th class="text-left text-xs font-semibold text-slate-500 uppercase tracking-wider px-4 py-3">Username</th>
                  <th class="text-left text-xs font-semibold text-slate-500 uppercase tracking-wider px-4 py-3">Password</th>
                  <th class="text-center text-xs font-semibold text-slate-500 uppercase tracking-wider px-4 py-3">Aksi</th>
                </tr>
              </thead>
              <tbody class="divide-y divide-slate-100">

                <!-- Row 1 -->
                <tr class="hover:bg-slate-50/70 transition-colors">
                  <td class="px-6 py-3.5">
                    <img src="https://ui-avatars.com/api/?name=Andi+Saputra&background=3b82f6&color=fff&size=36"
                         alt="Foto" class="w-9 h-9 rounded-full object-cover ring-2 ring-slate-200" />
                  </td>
                  <td class="px-4 py-3.5 font-medium text-navy-800">Andi Saputra</td>
                  <td class="px-4 py-3.5 text-slate-600">@andisaputra</td>
                  <td class="px-4 py-3.5">
                    <span class="inline-flex items-center gap-1.5 text-slate-400 text-xs font-mono bg-slate-100 px-2.5 py-1 rounded">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                      </svg>
                      ••••••••
                    </span>
                  </td>
                  <td class="px-4 py-3.5 text-center">
                    <div class="flex items-center justify-center gap-2">
                      <button onclick="openModal('edit')"
                        class="flex items-center gap-1.5 bg-blue-500 hover:bg-blue-600 text-white text-xs font-semibold px-3 py-1.5 rounded-lg transition-all shadow-sm hover:shadow-blue-200 hover:shadow">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        Edit
                      </button>
                      <button onclick="confirmDelete('Andi Saputra')"
                        class="flex items-center gap-1.5 bg-red-500 hover:bg-red-600 text-white text-xs font-semibold px-3 py-1.5 rounded-lg transition-all shadow-sm hover:shadow-red-200 hover:shadow">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                        Hapus
                      </button>
                    </div>
                  </td>
                </tr>

                <!-- Row 2 -->
                <tr class="hover:bg-slate-50/70 transition-colors">
                  <td class="px-6 py-3.5">
                    <img src="https://ui-avatars.com/api/?name=Rina+Fitriani&background=8b5cf6&color=fff&size=36"
                         alt="Foto" class="w-9 h-9 rounded-full object-cover ring-2 ring-slate-200" />
                  </td>
                  <td class="px-4 py-3.5 font-medium text-navy-800">Rina Fitriani</td>
                  <td class="px-4 py-3.5 text-slate-600">@rinafit</td>
                  <td class="px-4 py-3.5">
                    <span class="inline-flex items-center gap-1.5 text-slate-400 text-xs font-mono bg-slate-100 px-2.5 py-1 rounded">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                      </svg>
                      ••••••••
                    </span>
                  </td>
                  <td class="px-4 py-3.5 text-center">
                    <div class="flex items-center justify-center gap-2">
                      <button onclick="openModal('edit')"
                        class="flex items-center gap-1.5 bg-blue-500 hover:bg-blue-600 text-white text-xs font-semibold px-3 py-1.5 rounded-lg transition-all shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        Edit
                      </button>
                      <button onclick="confirmDelete('Rina Fitriani')"
                        class="flex items-center gap-1.5 bg-red-500 hover:bg-red-600 text-white text-xs font-semibold px-3 py-1.5 rounded-lg transition-all shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                        Hapus
                      </button>
                    </div>
                  </td>
                </tr>

                <!-- Row 3 -->
                <tr class="hover:bg-slate-50/70 transition-colors">
                  <td class="px-6 py-3.5">
                    <img src="https://ui-avatars.com/api/?name=Budi+Santoso&background=059669&color=fff&size=36"
                         alt="Foto" class="w-9 h-9 rounded-full object-cover ring-2 ring-slate-200" />
                  </td>
                  <td class="px-4 py-3.5 font-medium text-navy-800">Budi Santoso</td>
                  <td class="px-4 py-3.5 text-slate-600">@budisant</td>
                  <td class="px-4 py-3.5">
                    <span class="inline-flex items-center gap-1.5 text-slate-400 text-xs font-mono bg-slate-100 px-2.5 py-1 rounded">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                      </svg>
                      ••••••••
                    </span>
                  </td>
                  <td class="px-4 py-3.5 text-center">
                    <div class="flex items-center justify-center gap-2">
                      <button onclick="openModal('edit')"
                        class="flex items-center gap-1.5 bg-blue-500 hover:bg-blue-600 text-white text-xs font-semibold px-3 py-1.5 rounded-lg transition-all shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        Edit
                      </button>
                      <button onclick="confirmDelete('Budi Santoso')"
                        class="flex items-center gap-1.5 bg-red-500 hover:bg-red-600 text-white text-xs font-semibold px-3 py-1.5 rounded-lg transition-all shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                        Hapus
                      </button>
                    </div>
                  </td>
                </tr>

                <!-- Row 4 -->
                <tr class="hover:bg-slate-50/70 transition-colors">
                  <td class="px-6 py-3.5">
                    <img src="https://ui-avatars.com/api/?name=Dewi+Lestari&background=f59e0b&color=fff&size=36"
                         alt="Foto" class="w-9 h-9 rounded-full object-cover ring-2 ring-slate-200" />
                  </td>
                  <td class="px-4 py-3.5 font-medium text-navy-800">Dewi Lestari</td>
                  <td class="px-4 py-3.5 text-slate-600">@dewilestari</td>
                  <td class="px-4 py-3.5">
                    <span class="inline-flex items-center gap-1.5 text-slate-400 text-xs font-mono bg-slate-100 px-2.5 py-1 rounded">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                      </svg>
                      ••••••••
                    </span>
                  </td>
                  <td class="px-4 py-3.5 text-center">
                    <div class="flex items-center justify-center gap-2">
                      <button onclick="openModal('edit')"
                        class="flex items-center gap-1.5 bg-blue-500 hover:bg-blue-600 text-white text-xs font-semibold px-3 py-1.5 rounded-lg transition-all shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        Edit
                      </button>
                      <button onclick="confirmDelete('Dewi Lestari')"
                        class="flex items-center gap-1.5 bg-red-500 hover:bg-red-600 text-white text-xs font-semibold px-3 py-1.5 rounded-lg transition-all shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                        Hapus
                      </button>
                    </div>
                  </td>
                </tr>

              </tbody>
            </table>
          </div>

          <!-- Table footer / pagination -->
          <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 px-6 py-3.5 border-t border-slate-100 bg-slate-50/50">
            <p class="text-xs text-slate-500">Menampilkan <span class="font-semibold text-slate-700">4</span> dari <span class="font-semibold text-slate-700">4</span> data</p>
            <div class="flex items-center gap-1">
              <button disabled class="px-3 py-1.5 text-xs rounded border border-slate-200 text-slate-400 bg-white disabled:cursor-not-allowed">&#8592; Prev</button>
              <button class="px-3 py-1.5 text-xs rounded border border-blue-500 bg-blue-500 text-white font-semibold">1</button>
              <button disabled class="px-3 py-1.5 text-xs rounded border border-slate-200 text-slate-400 bg-white disabled:cursor-not-allowed">Next &#8594;</button>
            </div>
          </div>

        </div><!-- /table card -->
      </div><!-- /contentArea -->
    </main>
  </div><!-- /layout wrapper -->


  <!-- ===== MODAL: TAMBAH / EDIT ===== -->
  <div id="modal" class="fixed inset-0 z-50 hidden items-center justify-center p-4">
    <!-- Backdrop -->
    <div class="absolute inset-0 bg-black/40 backdrop-blur-sm" onclick="closeModal()"></div>

    <!-- Modal card -->
    <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-md mx-auto z-10 overflow-hidden">
      <!-- Modal header -->
      <div class="flex items-center justify-between px-6 py-4 border-b border-slate-100">
        <h3 id="modalTitle" class="font-bold text-navy-900 text-base">Tambah Penulis</h3>
        <button onclick="closeModal()" class="text-slate-400 hover:text-slate-600 transition-colors">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
          </svg>
        </button>
      </div>

      <!-- Modal body -->
      <div class="px-6 py-5 space-y-4">
        <!-- Foto upload -->
        <div class="flex flex-col items-center gap-3 pb-4 border-b border-slate-100">
          <div id="photoPreview"
            class="w-20 h-20 rounded-full bg-slate-100 border-2 border-dashed border-slate-300
                   flex items-center justify-center overflow-hidden cursor-pointer hover:border-blue-400 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
            </svg>
          </div>
          <label class="text-xs font-medium text-blue-500 hover:text-blue-700 cursor-pointer transition-colors">
            Unggah Foto
            <input type="file" accept="image/*" class="hidden" onchange="previewPhoto(this)" />
          </label>
        </div>

        <!-- Nama -->
        <div>
          <label class="block text-xs font-semibold text-slate-700 mb-1.5">Nama Lengkap</label>
          <input type="text" placeholder="Masukkan nama lengkap"
            class="w-full px-3.5 py-2.5 text-sm border border-slate-200 rounded-lg
                   focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-blue-400
                   placeholder-slate-400 transition" />
        </div>

        <!-- Username -->
        <div>
          <label class="block text-xs font-semibold text-slate-700 mb-1.5">Username</label>
          <div class="relative">
            <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-sm">@</span>
            <input type="text" placeholder="username"
              class="w-full pl-8 pr-3.5 py-2.5 text-sm border border-slate-200 rounded-lg
                     focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-blue-400
                     placeholder-slate-400 transition" />
          </div>
        </div>

        <!-- Password -->
        <div>
          <label class="block text-xs font-semibold text-slate-700 mb-1.5">Password</label>
          <div class="relative">
            <input id="passwordInput" type="password" placeholder="Masukkan password"
              class="w-full px-3.5 pr-10 py-2.5 text-sm border border-slate-200 rounded-lg
                     focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-blue-400
                     placeholder-slate-400 transition" />
            <button type="button" onclick="togglePassword()"
              class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 transition-colors">
              <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
              </svg>
            </button>
          </div>
        </div>
      </div>

      <!-- Modal footer -->
      <div class="flex items-center justify-end gap-3 px-6 py-4 bg-slate-50 border-t border-slate-100">
        <button onclick="closeModal()"
          class="px-4 py-2 text-sm font-medium text-slate-600 bg-white border border-slate-200 rounded-lg hover:bg-slate-50 transition-all">
          Batal
        </button>
        <button
          class="px-5 py-2 text-sm font-semibold text-white bg-blue-500 hover:bg-blue-600 rounded-lg shadow-sm transition-all hover:shadow-blue-200 hover:shadow">
          Simpan
        </button>
      </div>
    </div>
  </div>


  <!-- ===== MODAL: KONFIRMASI HAPUS ===== -->
  <div id="deleteModal" class="fixed inset-0 z-50 hidden items-center justify-center p-4">
    <div class="absolute inset-0 bg-black/40 backdrop-blur-sm" onclick="closeDeleteModal()"></div>
    <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-sm mx-auto z-10 p-6 text-center">
      <div class="bg-red-50 w-14 h-14 rounded-full flex items-center justify-center mx-auto mb-4">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
        </svg>
      </div>
      <h3 class="font-bold text-navy-900 text-base mb-1">Hapus Data?</h3>
      <p class="text-sm text-slate-500 mb-6">Apakah Anda yakin ingin menghapus data <span id="deleteTargetName" class="font-semibold text-navy-800"></span>? Tindakan ini tidak dapat dibatalkan.</p>
      <div class="flex gap-3">
        <button onclick="closeDeleteModal()"
          class="flex-1 px-4 py-2.5 text-sm font-medium text-slate-600 bg-white border border-slate-200 rounded-xl hover:bg-slate-50 transition-all">
          Batal
        </button>
        <button
          class="flex-1 px-4 py-2.5 text-sm font-semibold text-white bg-red-500 hover:bg-red-600 rounded-xl shadow-sm transition-all">
          Ya, Hapus
        </button>
      </div>
    </div>
  </div>


  <!-- ===== JAVASCRIPT ===== -->
  <script>
    // ----- Sidebar toggle (mobile) -----
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebarOverlay');

    document.getElementById('hamburgerBtn').addEventListener('click', () => {
      sidebar.classList.toggle('-translate-x-full');
      overlay.classList.toggle('hidden');
    });

    function closeSidebar() {
      sidebar.classList.add('-translate-x-full');
      overlay.classList.add('hidden');
    }

    // ----- Nav active state -----
    const pageTitles = {
      penulis:  { title: 'Kelola Penulis',           subtitle: 'Manajemen data penulis blog' },
      artikel:  { title: 'Kelola Artikel',            subtitle: 'Manajemen konten artikel blog' },
      kategori: { title: 'Kelola Kategori Artikel',   subtitle: 'Manajemen kategori untuk artikel' },
    };

    function setActive(btn, key) {
      document.querySelectorAll('.nav-item').forEach(el => {
        el.classList.remove('active');
        el.classList.add('text-slate-300');
        el.querySelector('svg').classList.add('text-slate-500');
        el.querySelector('svg').classList.remove('text-white');
      });
      btn.classList.add('active');
      btn.classList.remove('text-slate-300');
      // Update page title
      document.getElementById('pageTitle').textContent    = pageTitles[key].title;
      document.getElementById('pageSubtitle').textContent = pageTitles[key].subtitle;
      // Close sidebar on mobile
      closeSidebar();
    }

    // ----- Modal helpers -----
    function openModal(mode) {
      document.getElementById('modalTitle').textContent =
        mode === 'tambah' ? 'Tambah Penulis' : 'Edit Penulis';
      const m = document.getElementById('modal');
      m.classList.remove('hidden');
      m.classList.add('flex');
    }

    function closeModal() {
      const m = document.getElementById('modal');
      m.classList.add('hidden');
      m.classList.remove('flex');
    }

    function confirmDelete(name) {
      document.getElementById('deleteTargetName').textContent = name;
      const m = document.getElementById('deleteModal');
      m.classList.remove('hidden');
      m.classList.add('flex');
    }

    function closeDeleteModal() {
      const m = document.getElementById('deleteModal');
      m.classList.add('hidden');
      m.classList.remove('flex');
    }

    // ----- Password toggle -----
    function togglePassword() {
      const inp = document.getElementById('passwordInput');
      inp.type = inp.type === 'password' ? 'text' : 'password';
    }

    // ----- Photo preview -----
    function previewPhoto(input) {
      if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
          const preview = document.getElementById('photoPreview');
          preview.innerHTML = `<img src="${e.target.result}" class="w-full h-full object-cover" alt="Preview" />`;
        };
        reader.readAsDataURL(input.files[0]);
      }
    }
  </script>

</body>
</html>