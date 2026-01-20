<?php
// Global header include
if (session_status() === PHP_SESSION_NONE) session_start();
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
    <header class="bg-white shadow-lg rounded-b-2xl" style="margin-bottom:0!important;">
        <div class="max-w-7xl mx-auto px-6 py-3 flex justify-between items-center">
            <a href="/Attendr/index.php" class="flex items-center gap-2 group">
                <span class="text-2xl font-extrabold text-indigo-600 group-hover:text-yellow-500 transition">Attendr</span>
                <span class="hidden sm:inline text-xs font-semibold text-gray-400 tracking-widest ml-2 group-hover:text-yellow-600 transition">Event Platform</span>
            </a>
            <nav class="flex gap-3">
                <?php if (!isset($_SESSION['admin_id']) && !isset($_SESSION['user_id'])): ?>
                    <a href="/Attendr/participant/register.php" class="py-2 px-6 bg-white border-2 border-yellow-400 text-yellow-600 rounded-full shadow-md hover:bg-yellow-50 hover:border-yellow-500 transition font-semibold text-base">Register</a>
                    <a href="/Attendr/auth/login.php" class="py-2 px-6 bg-gradient-to-r from-yellow-400 to-yellow-500 text-white rounded-full shadow-md hover:from-yellow-500 hover:to-yellow-600 transition font-semibold text-base">Login</a>
                <?php endif; ?>
            </nav>
        </div>
        <div class="w-full h-2 bg-gradient-to-r from-yellow-100 via-white to-yellow-100 rounded-b-2xl"></div>
    </header>
    <main class="w-full px-0 pt-0 pb-0" style="margin-top:0!important;padding-top:0!important;padding-bottom:0!important;border-top:0!important;">