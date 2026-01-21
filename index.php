
<?php include 'includes/header.php'; ?>


<!-- HERO: Event Registration -->
<section class="w-full bg-gradient-to-br from-indigo-50 via-white to-indigo-100 py-20 px-4 border-b border-gray-100">
    <div class="max-w-5xl mx-auto flex flex-col md:flex-row items-center gap-12">
        <div class="flex-1 flex flex-col items-start">
            <div class="flex items-center gap-3 mb-4">
                <span class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-indigo-100 text-indigo-600 text-4xl shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-9 h-9"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                </span>
                <span class="text-4xl font-extrabold text-indigo-700 tracking-tight">Attendr</span>
            </div>
            <h1 class="text-3xl md:text-4xl font-extrabold mb-3 text-gray-900 leading-tight drop-shadow-sm">Effortless Event Registration</h1>
            <p class="mb-6 text-gray-600 text-base md:text-lg">A beautiful, seamless platform for your guests to register, check in, and enjoy your events. Designed for organizations, schools, and communities.</p>
            <div class="flex gap-3 mt-2">
                <a href="/Attendr/participant/events.php" class="py-2 px-6 bg-indigo-600 text-white rounded-full shadow hover:bg-indigo-700 transition font-medium text-sm">View Events & Register</a>
                <a href="/Attendr/auth/login.php" class="py-2 px-6 bg-white border border-indigo-200 text-indigo-700 rounded-full shadow hover:bg-indigo-50 transition font-medium text-sm">Admin Login</a>
            </div>
        </div>
        <div class="flex-1 flex justify-center">
            <div class="relative">
                <img src="https://images.unsplash.com/photo-1464983953574-0892a716854b?auto=format&fit=crop&w=400&q=80" alt="Event" class="rounded-3xl shadow-2xl border-4 border-white max-w-xs">
                <div class="absolute -bottom-6 left-1/2 -translate-x-1/2 bg-white rounded-xl px-6 py-3 shadow-lg flex items-center gap-3 border border-indigo-100">
                    <svg class="w-7 h-7 text-indigo-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 1.343-3 3s1.343 3 3 3 3-1.343 3-3-1.343-3-3-3zm0 0V4m0 10v6"/></svg>
                    <span class="font-semibold text-indigo-700">Easy Check-in</span>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
require_once 'config/db.php';
$events = $pdo->query('SELECT * FROM events ORDER BY event_date DESC, event_time DESC')->fetchAll();
?>
<!-- UPCOMING EVENTS (Dynamic) -->
<section class="w-full bg-gray-50 py-14 px-4 border-b border-gray-100">
    <div class="max-w-5xl mx-auto">
        <h2 class="text-2xl font-bold mb-8 text-indigo-700 flex items-center gap-2">
            <svg class="w-6 h-6 text-indigo-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg> Upcoming Events
        </h2>
        <div class="overflow-x-auto">
            <table class="w-full text-sm whitespace-nowrap bg-white border border-gray-100 rounded-xl">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="py-3 px-4 font-semibold text-center">Title</th>
                        <th class="py-3 px-4 font-semibold text-center">Date</th>
                        <th class="py-3 px-4 font-semibold text-center">Time</th>
                        <th class="py-3 px-4 font-semibold text-center">Venue</th>
                        <th class="py-3 px-4 font-semibold text-center">Max</th>
                        <th class="py-3 px-4 font-semibold text-center">Register</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($events)): ?>
                        <tr><td colspan="6" class="text-gray-400 text-center py-8">No events available at the moment.</td></tr>
                    <?php else: ?>
                        <?php foreach ($events as $event): ?>
                        <tr class="border-b last:border-0 hover:bg-yellow-50 transition">
                            <td class="py-3 px-4 text-center"><?php echo htmlspecialchars($event['title']); ?></td>
                            <td class="py-3 px-4 text-center"><?php echo htmlspecialchars($event['event_date']); ?></td>
                            <td class="py-3 px-4 text-center"><?php echo htmlspecialchars(substr($event['event_time'],0,5)); ?></td>
                            <td class="py-3 px-4 text-center"><?php echo htmlspecialchars($event['venue']); ?></td>
                            <td class="py-3 px-4 text-center"><?php echo (int)$event['max_participants']; ?></td>
                            <td class="py-3 px-4 text-center">
                                <a href="/Attendr/participant/register.php?event=<?php echo (int)$event['id']; ?>" class="py-2 px-4 bg-indigo-600 text-white rounded-full text-sm font-semibold text-center hover:bg-indigo-700 transition">Register</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
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
<?php include 'includes/footer.php'; ?>
