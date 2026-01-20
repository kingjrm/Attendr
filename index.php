
<?php include 'includes/header.php'; ?>

<!-- HERO SECTION -->
<?php include 'includes/header.php'; ?>

<!-- HERO: Event Registration -->
<section class="w-full bg-white py-16 px-4 border-b border-gray-100">
    <div class="max-w-4xl mx-auto flex flex-col md:flex-row items-center gap-10">
        <div class="flex-1 flex flex-col items-start">
            <div class="flex items-center gap-3 mb-4">
                <span class="inline-flex items-center justify-center w-14 h-14 rounded-full bg-indigo-100 text-indigo-600 text-4xl shadow-soft">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-8 h-8"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                </span>
                <span class="text-3xl font-bold text-indigo-700 tracking-tight">Attendr</span>
            </div>
            <h1 class="text-4xl md:text-5xl font-extrabold mb-3 text-gray-900 leading-tight">Modern Event Registration</h1>
            <p class="mb-6 text-gray-600 text-lg">Register for events, manage attendance, and check in with ease. Attendr is your all-in-one event platform for organizations, schools, and communities.</p>
            <div class="flex gap-4">
                <a href="/Attendr/participant/events.php" class="py-3 px-8 bg-indigo-600 text-white rounded-full shadow-soft hover:bg-indigo-700 transition font-semibold text-lg">View Events & Register</a>
                <a href="/Attendr/auth/login.php" class="py-3 px-8 bg-white border border-indigo-200 text-indigo-700 rounded-full shadow-soft hover:bg-indigo-50 transition font-semibold text-lg">Admin Login</a>
            </div>
        </div>
        <div class="flex-1 flex justify-center">
            <img src="https://images.unsplash.com/photo-1464983953574-0892a716854b?auto=format&fit=crop&w=400&q=80" alt="Event" class="rounded-2xl shadow-lg border border-indigo-50 max-w-xs">
        </div>
    </div>
</section>

<!-- UPCOMING EVENTS (Sample Static) -->
<section class="w-full bg-gray-50 py-14 px-4 border-b border-gray-100">
    <div class="max-w-5xl mx-auto">
        <h2 class="text-2xl font-bold mb-8 text-indigo-700 flex items-center gap-2"><svg class="w-6 h-6 text-indigo-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg> Upcoming Events</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white rounded-xl shadow-soft p-6 flex flex-col gap-2 border border-gray-100">
                <span class="text-xs text-gray-400 mb-1">Feb 10, 2026</span>
                <h3 class="text-lg font-bold text-gray-900">Tech Innovators Meetup</h3>
                <span class="text-sm text-indigo-600">Main Hall, City Center</span>
                <a href="/Attendr/participant/register.php?event=1" class="mt-3 py-2 px-4 bg-indigo-600 text-white rounded-full text-sm font-semibold text-center hover:bg-indigo-700 transition">Register</a>
            </div>
            <div class="bg-white rounded-xl shadow-soft p-6 flex flex-col gap-2 border border-gray-100">
                <span class="text-xs text-gray-400 mb-1">Feb 18, 2026</span>
                <h3 class="text-lg font-bold text-gray-900">Community Volunteer Day</h3>
                <span class="text-sm text-indigo-600">Green Park</span>
                <a href="/Attendr/participant/register.php?event=2" class="mt-3 py-2 px-4 bg-indigo-600 text-white rounded-full text-sm font-semibold text-center hover:bg-indigo-700 transition">Register</a>
            </div>
            <div class="bg-white rounded-xl shadow-soft p-6 flex flex-col gap-2 border border-gray-100">
                <span class="text-xs text-gray-400 mb-1">Mar 2, 2026</span>
                <h3 class="text-lg font-bold text-gray-900">Startup Pitch Night</h3>
                <span class="text-sm text-indigo-600">Innovation Hub</span>
                <a href="/Attendr/participant/register.php?event=3" class="mt-3 py-2 px-4 bg-indigo-600 text-white rounded-full text-sm font-semibold text-center hover:bg-indigo-700 transition">Register</a>
            </div>
        </div>
    </div>
</section>

<!-- HOW IT WORKS -->
<section class="w-full bg-white py-14 px-4">
    <div class="max-w-4xl mx-auto">
        <h2 class="text-2xl font-bold mb-8 text-indigo-700 flex items-center gap-2"><svg class="w-6 h-6 text-indigo-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 1.343-3 3s1.343 3 3 3 3-1.343 3-3-1.343-3-3-3zm0 0V4m0 10v6"/></svg> How It Works</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="flex flex-col items-center text-center">
                <div class="w-14 h-14 rounded-full bg-indigo-50 flex items-center justify-center mb-3">
                    <svg class="w-7 h-7 text-indigo-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                </div>
                <h3 class="font-bold text-lg mb-1">Browse Events</h3>
                <p class="text-gray-500 text-sm">See all upcoming events and details in one place.</p>
            </div>
            <div class="flex flex-col items-center text-center">
                <div class="w-14 h-14 rounded-full bg-indigo-50 flex items-center justify-center mb-3">
                    <svg class="w-7 h-7 text-indigo-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                </div>
                <h3 class="font-bold text-lg mb-1">Register Online</h3>
                <p class="text-gray-500 text-sm">Sign up for events quickly and securely with your details.</p>
            </div>
            <div class="flex flex-col items-center text-center">
                <div class="w-14 h-14 rounded-full bg-indigo-50 flex items-center justify-center mb-3">
                    <svg class="w-7 h-7 text-indigo-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 17v-2a4 4 0 018 0v2M12 11a4 4 0 100-8 4 4 0 000 8z"/></svg>
                </div>
                <h3 class="font-bold text-lg mb-1">Check In & Attend</h3>
                <p class="text-gray-500 text-sm">Get a unique code or QR and check in at the event easily.</p>
            </div>
        </div>
    </div>
</section>

<!-- FOOTER -->
<footer class="w-full bg-white border-t border-gray-100 py-8 mt-0 text-center text-xs text-gray-400">
    <div class="flex flex-col md:flex-row justify-center items-center gap-4">
        <span>&copy; <?php echo date('Y'); ?> Attendr. All rights reserved.</span>
        <a href="#" class="text-indigo-400 hover:underline">Privacy Policy</a>
        <a href="#" class="text-indigo-400 hover:underline">Contact</a>
    </div>
</footer>
