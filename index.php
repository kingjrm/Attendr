<?php
include 'includes/header.php';
?>
<div class="max-w-xl mx-auto mt-16 p-8 bg-white shadow-soft rounded-soft">
    <h1 class="text-2xl font-semibold mb-2 text-indigo-700">Welcome to Attendr</h1>
    <p class="mb-6 text-gray-600">A modern event registration and attendance system for admins and participants.</p>
    <div class="flex flex-col gap-4">
        <a href="/Attendr/auth/login.php" class="block w-full text-center py-2 px-4 bg-indigo-600 text-white rounded-soft shadow-soft hover:bg-indigo-700 transition">Admin Login</a>
        <a href="/Attendr/participant/events.php" class="block w-full text-center py-2 px-4 bg-white border border-indigo-200 text-indigo-700 rounded-soft shadow-soft hover:bg-indigo-50 transition">View Events & Register</a>
    </div>
</div>
<?php
include 'includes/footer.php';
?>
