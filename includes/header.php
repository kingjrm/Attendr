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
    <header class="shadow-sm bg-white mb-6">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <a href="/Attendr/index.php" class="text-xl font-semibold text-indigo-600">Attendr</a>
            <nav>
                <?php if (!isset($_SESSION['admin_id']) && !isset($_SESSION['user_id'])): ?>
                    <a href="/Attendr/auth/login.php" class="py-1.5 px-5 bg-indigo-600 text-white rounded-full shadow hover:bg-indigo-700 transition font-medium text-sm">Login</a>
                <?php endif; ?>
            </nav>
        </div>
    </header>
    <main class="container mx-auto px-4">