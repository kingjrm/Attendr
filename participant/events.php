<?php
include '../includes/header.php';
require_once '../config/db.php';

// Fetch all public events
$events = $pdo->query('SELECT * FROM events ORDER BY event_date DESC, event_time DESC')->fetchAll();
?>
<div class="min-h-screen w-full flex flex-col items-center justify-start bg-gray-50 py-10">
    <div class="w-full max-w-3xl bg-white rounded-2xl shadow-xl p-8">
        <h2 class="text-2xl font-bold text-indigo-700 mb-6">Upcoming Events</h2>
        <?php if (empty($events)): ?>
            <div class="text-gray-400 text-center py-12">No events available at the moment.</div>
        <?php else: ?>
            <div class="overflow-x-auto">
                <table class="w-full text-sm whitespace-nowrap bg-white border border-gray-100 rounded-xl">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="py-3 px-4 font-semibold text-center">Title</th>
                            <th class="py-3 px-4 font-semibold text-center">Date</th>
                            <th class="py-3 px-4 font-semibold text-center">Time</th>
                            <th class="py-3 px-4 font-semibold text-center">Venue</th>
                            <th class="py-3 px-4 font-semibold text-center">Max</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($events as $event): ?>
                        <tr class="border-b last:border-0 hover:bg-yellow-50 transition">
                            <td class="py-3 px-4 text-center"><?php echo htmlspecialchars($event['title']); ?></td>
                            <td class="py-3 px-4 text-center"><?php echo htmlspecialchars($event['event_date']); ?></td>
                            <td class="py-3 px-4 text-center"><?php echo htmlspecialchars(substr($event['event_time'],0,5)); ?></td>
                            <td class="py-3 px-4 text-center"><?php echo htmlspecialchars($event['venue']); ?></td>
                            <td class="py-3 px-4 text-center"><?php echo (int)$event['max_participants']; ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php
include '../includes/footer.php';
?>
