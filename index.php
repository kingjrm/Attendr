<?php
include 'includes/header.php';
?>
<section class="relative min-h-[80vh] flex flex-col justify-center items-center bg-gradient-to-br from-indigo-50 via-white to-indigo-100 py-16 px-4">
    <div class="absolute inset-0 pointer-events-none select-none">
        <svg class="absolute top-0 left-0 w-64 h-64 opacity-20 text-indigo-200" fill="currentColor" viewBox="0 0 400 400"><circle cx="200" cy="200" r="200"/></svg>
        <svg class="absolute bottom-0 right-0 w-80 h-80 opacity-10 text-indigo-300" fill="currentColor" viewBox="0 0 400 400"><circle cx="200" cy="200" r="200"/></svg>
    </div>
    <div class="relative z-10 max-w-2xl w-full mx-auto text-center">
        <div class="flex flex-col items-center gap-2 mb-6">
            <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="Attendr Logo" class="w-16 h-16 rounded-full shadow-lg border-4 border-white bg-indigo-100">
            <span class="text-4xl font-extrabold text-indigo-700 tracking-tight drop-shadow">Attendr</span>
        </div>
        <h1 class="text-3xl md:text-5xl font-bold mb-4 text-gray-900 leading-tight drop-shadow">Effortless Event Registration & Attendance</h1>
        <p class="mb-8 text-gray-600 text-lg md:text-xl font-medium">A professional, secure, and modern platform for managing events, registrations, and attendance. Built for organizations, schools, and communities.</p>
        <div class="flex flex-col sm:flex-row justify-center gap-4 mb-8">
            <a href="/Attendr/auth/login.php" class="inline-block py-3 px-8 bg-indigo-600 text-white rounded-full shadow-lg hover:bg-indigo-700 transition font-semibold text-lg">Admin Login</a>
            <a href="/Attendr/participant/events.php" class="inline-block py-3 px-8 bg-white border-2 border-indigo-200 text-indigo-700 rounded-full shadow-lg hover:bg-indigo-50 transition font-semibold text-lg">View Events & Register</a>
        </div>
        <div class="flex flex-wrap justify-center gap-4 text-sm text-gray-500 mb-8">
            <span class="inline-flex items-center gap-1"><svg class="w-4 h-4 text-indigo-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg> Real-time Attendance</span>
            <span class="inline-flex items-center gap-1"><svg class="w-4 h-4 text-indigo-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6l4 2"/></svg> QR Code Check-in</span>
            <span class="inline-flex items-center gap-1"><svg class="w-4 h-4 text-indigo-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg> Secure & Reliable</span>
            <span class="inline-flex items-center gap-1"><svg class="w-4 h-4 text-indigo-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 7v4a1 1 0 001 1h3m10 0h3a1 1 0 001-1V7m-1-4H5a2 2 0 00-2 2v16a2 2 0 002 2h14a2 2 0 002-2V5a2 2 0 00-2-2z"/></svg> Mobile Friendly</span>
        </div>
        <div class="bg-white/80 rounded-xl shadow p-6 mt-6 max-w-xl mx-auto">
            <div class="flex flex-col md:flex-row gap-4 items-center justify-center">
                <div class="flex-1 text-left">
                    <p class="text-gray-700 font-semibold mb-1">“Attendr made our event check-in seamless and professional. Highly recommended!”</p>
                    <span class="text-xs text-gray-400">— Event Organizer, 2026</span>
                </div>
                <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Testimonial" class="w-12 h-12 rounded-full border-2 border-indigo-200 shadow">
            </div>
        </div>
    </div>
</section>
<footer class="w-full bg-white border-t border-indigo-50 py-6 mt-10 text-center text-xs text-gray-400">
    <div class="flex flex-col md:flex-row justify-center items-center gap-4">
        <span>&copy; <?php echo date('Y'); ?> Attendr. All rights reserved.</span>
        <a href="#" class="text-indigo-400 hover:underline">Privacy Policy</a>
        <a href="#" class="text-indigo-400 hover:underline">Contact</a>
    </div>
</footer>
<?php
// Remove duplicate footer include since custom footer is above
// include 'includes/footer.php';
?>
