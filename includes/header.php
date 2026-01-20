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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>
    <link href="/Attendr/assets/css/global.css" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800">
    <header class="shadow-sm bg-white mb-6">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <a href="/Attendr/index.php" class="text-xl font-semibold text-indigo-600">Attendr</a>
            <!-- Add navigation here if needed -->
        </div>
    </header>
    <main class="container mx-auto px-4">