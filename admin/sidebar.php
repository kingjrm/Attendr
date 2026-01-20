<?php
// Admin sidebar navigation
$active = basename($_SERVER['PHP_SELF']);
?>
<aside class="w-60 min-h-screen bg-white border-r border-gray-200 shadow flex flex-col py-8 px-4 fixed left-0 top-0 z-30">
    <div class="mb-10 flex items-center gap-3 px-2">
        <span class="inline-flex items-center justify-center w-11 h-11 rounded-full bg-indigo-100 text-indigo-700 text-2xl font-bold shadow">A</span>
        <span class="text-xl font-bold tracking-wide text-gray-800">Admin</span>
    </div>
    <nav class="flex-1 flex flex-col gap-1">
        <a href="dashboard.php" class="flex items-center gap-3 py-2.5 px-4 rounded-lg transition font-medium <?php echo $active=='dashboard.php'?'bg-indigo-50 text-indigo-700':'text-gray-700 hover:bg-gray-50'; ?>">
            <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0h6"/></svg>
            Dashboard
        </a>
        <a href="create-event.php" class="flex items-center gap-3 py-2.5 px-4 rounded-lg transition font-medium <?php echo $active=='create-event.php'?'bg-indigo-50 text-indigo-700':'text-gray-700 hover:bg-gray-50'; ?>">
            <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
            Create Event
        </a>
        <a href="events.php" class="flex items-center gap-3 py-2.5 px-4 rounded-lg transition font-medium <?php echo $active=='events.php'?'bg-indigo-50 text-indigo-700':'text-gray-700 hover:bg-gray-50'; ?>">
            <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 17v-2a4 4 0 018 0v2M12 11a4 4 0 100-8 4 4 0 000 8z"/></svg>
            Events List
        </a>
        <a href="participants.php" class="flex items-center gap-3 py-2.5 px-4 rounded-lg transition font-medium <?php echo $active=='participants.php'?'bg-indigo-50 text-indigo-700':'text-gray-700 hover:bg-gray-50'; ?>">
            <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m9-5a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
            Participants
        </a>
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
