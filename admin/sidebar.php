<?php
// Admin sidebar navigation
$active = basename($_SERVER['PHP_SELF']);
?>
<aside class="w-72 min-h-screen bg-white border-r border-gray-200 shadow flex flex-col py-8 px-6 fixed left-0 top-0 z-30 text-[13px]">
    <div class="mb-8 flex flex-col items-center gap-1 px-2">
        <div class="flex items-center gap-2">
            <img src="/Attendr/assets/logo.png" alt="Attendr Logo" class="w-10 h-10 rounded-lg shadow border border-indigo-100 bg-white" onerror="this.style.display='none'">
            <div class="flex flex-col">
                <span class="text-lg font-bold tracking-wide text-indigo-700 leading-tight">Attendr</span>
                <span class="text-[10px] text-gray-400 font-medium leading-none">Event Registration Simplified</span>
            </div>
        </div>
        <div class="mt-4 w-full flex justify-center">
            <div class="flex items-center gap-3 bg-white rounded-xl px-3 py-2 shadow-sm border border-gray-200 w-full">
                <div class="w-10 h-10 rounded-lg bg-gray-100 flex items-center justify-center overflow-hidden">
                    <img src="/Attendr/assets/admin-avatar.png" alt="Admin Avatar" class="w-10 h-10 object-cover" onerror="this.style.display='none'">
                </div>
                <div class="flex flex-col">
                    <span class="text-[13px] font-semibold text-gray-800 leading-tight">Administrator</span>
                    <span class="text-[10px] text-gray-400 font-medium leading-none">admin@attendr</span>
                </div>
            </div>
        </div>
    </div>
    <nav class="flex-1 flex flex-col gap-1">
        <a href="dashboard.php" class="flex items-center gap-3 py-2.5 px-4 rounded-lg transition font-medium <?php echo $active=='dashboard.php'?'bg-indigo-50 text-indigo-700':'text-gray-700 hover:bg-gray-50'; ?>">
            <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0h6"/></svg>
            Dashboard
        </a>
        <!-- Removed Create Event tab, add User Management and more -->
        <!-- Only one Events List and Participants link -->
        <a href="users.php" class="flex items-center gap-3 py-2.5 px-4 rounded-lg transition font-medium <?php echo $active=='users.php'?'bg-indigo-50 text-indigo-700':'text-gray-700 hover:bg-gray-50'; ?>">
            <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="7" r="4"/><path d="M5.5 21a7.5 7.5 0 0113 0"/></svg>
            User Management
        </a>
        <a href="audit-logs.php" class="flex items-center gap-3 py-2.5 px-4 rounded-lg transition font-medium <?php echo $active=='audit-logs.php'?'bg-indigo-50 text-indigo-700':'text-gray-700 hover:bg-gray-50'; ?>">
            <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
            Audit Logs
        </a>
        <a href="events.php" class="flex items-center gap-3 py-2.5 px-4 rounded-lg transition font-medium <?php echo $active=='events.php'?'bg-indigo-50 text-indigo-700':'text-gray-700 hover:bg-gray-50'; ?>">
            <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 17v-2a4 4 0 018 0v2M12 11a4 4 0 100-8 4 4 0 000 8z"/></svg>
            Events List
        </a>
        <a href="participants.php" class="flex items-center gap-3 py-2.5 px-4 rounded-lg transition font-medium <?php echo $active=='participants.php'?'bg-indigo-50 text-indigo-700':'text-gray-700 hover:bg-gray-50'; ?>">
            <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m9-5a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
            Participants
        </a>
        <div class="flex-1"></div>
        <a href="settings.php" class="flex items-center gap-3 py-2.5 px-4 rounded-lg transition font-medium <?php echo $active=='settings.php'?'bg-indigo-50 text-indigo-700':'text-gray-700 hover:bg-gray-50'; ?> mt-8">
            <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 1.343-3 3s1.343 3 3 3 3-1.343 3-3-1.343-3-3-3zm0 0V4m0 10v6"/></svg>
            Settings
        </a>
        <a href="../auth/logout.php" class="flex items-center gap-3 py-2.5 px-4 rounded-lg transition font-medium text-red-500 hover:bg-red-50">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H7a2 2 0 01-2-2V7a2 2 0 012-2h6a2 2 0 012 2v1"/></svg>
            Logout
        </a>
    </nav>
</aside>
