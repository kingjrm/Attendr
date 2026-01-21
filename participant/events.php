<?php
include '../includes/header.php';
require_once '../config/db.php';

// Fetch all public events
$events = $pdo->query('SELECT * FROM events ORDER BY event_date DESC, event_time DESC')->fetchAll();
?>
<section class="w-full min-h-screen bg-gray-50 py-10 px-4 flex flex-col items-center justify-start">
    <div class="w-full max-w-5xl bg-white rounded-2xl shadow-xl p-8">
        <h2 class="text-2xl font-bold text-indigo-700 mb-6 flex items-center gap-2">
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
<?php
include '../includes/footer.php';
?>
