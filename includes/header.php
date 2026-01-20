<?php
// Global header include
if (session_status() === PHP_SESSION_NONE) session_start();
$is_admin = strpos($_SERVER['REQUEST_URI'], '/admin/') !== false;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendr</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&family=Oswald:wght@700&display=swap" rel="stylesheet">
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>
    <link href="/Attendr/assets/css/global.css" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; }
        .font-condensed { font-family: 'Oswald', 'Poppins', Arial, sans-serif; letter-spacing: 0.02em; }
    </style>
</head>
<body class="bg-gray-50 text-gray-900">
    <?php if ($is_admin): ?>
        <header class="bg-white border-b border-gray-200 shadow-sm relative z-10" style="margin-bottom:0;">
            <div class="max-w-full px-8 py-2 flex items-center justify-between mx-auto">
                <a href="/Attendr/admin/dashboard.php" class="flex items-center gap-2 select-none">
                    <span class="text-xl font-extrabold text-indigo-700">Attendr Admin</span>
                </a>
                <span class="text-xs text-gray-400 font-medium tracking-widest">Admin Panel</span>
            </div>
        </header>
    <?php else: ?>
        <header class="bg-white/90 shadow-xl rounded-b-3xl border-b border-yellow-100" style="margin-bottom:0!important;backdrop-filter:saturate(180%) blur(8px);">
            <div class="max-w-7xl mx-auto px-8 py-4 flex items-center justify-between">
                <a href="/Attendr/index.php" class="flex items-center gap-3 group select-none">
                    <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-gradient-to-br from-yellow-400 to-yellow-200 shadow text-white text-2xl font-bold mr-1">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                    </span>
                    <span class="text-2xl font-extrabold text-indigo-700 group-hover:text-yellow-500 transition">Attendr</span>
                    <span class="hidden sm:inline text-xs font-semibold text-gray-400 tracking-widest ml-2 group-hover:text-yellow-600 transition">Event Platform</span>
                </a>
                <nav class="flex gap-4 items-center">
                    <?php if (!isset($_SESSION['admin_id']) && !isset($_SESSION['user_id'])): ?>
                        <a href="/Attendr/participant/register.php" class="py-2 px-6 bg-white border-2 border-yellow-400 text-yellow-600 rounded-full shadow hover:bg-yellow-50 hover:border-yellow-500 transition font-semibold text-base">Register</a>
                        <a href="/Attendr/auth/login.php" class="py-2 px-6 bg-gradient-to-r from-yellow-400 to-yellow-500 text-white rounded-full shadow hover:from-yellow-500 hover:to-yellow-600 transition font-semibold text-base">Login</a>
                    <?php endif; ?>
                </nav>
            </div>
            <div class="w-full h-1 bg-gradient-to-r from-yellow-100 via-white to-yellow-100 rounded-b-3xl"></div>
        </header>
    <?php endif; ?>
    <main class="w-full px-0 pt-0 pb-0" style="margin-top:0!important;padding-top:0!important;padding-bottom:0!important;border-top:0!important;">