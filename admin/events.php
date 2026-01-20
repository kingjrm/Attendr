<?php
include '../includes/header.php';
require_once '../config/db.php';
if (!isset($_SESSION['admin_id'])) {
    header('Location: ../auth/login.php');
    exit;
}
$events = $pdo->query('SELECT * FROM events ORDER BY event_date DESC, event_time DESC')->fetchAll();
?>
<div class="flex min-h-[80vh]">
    <?php include 'sidebar.php'; ?>
    <main class="flex-1 px-8 py-10 ml-60">
        <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4 mb-4">
            <h3 class="text-lg font-semibold text-neutral-700">Events List</h3>
            <form method="get" class="flex gap-2 items-center w-full md:w-auto">
                <input type="text" name="search" placeholder="Search events..." value="<?php echo htmlspecialchars($_GET['search'] ?? ''); ?>" class="rounded-full border border-gray-200 px-4 py-2 text-sm focus:ring-2 focus:ring-indigo-200 w-full md:w-56" />
                <button type="submit" class="px-4 py-2 bg-neutral-700 text-white rounded-full text-sm font-medium hover:bg-neutral-800 transition">Filter</button>
            </form>
            <a href="create-event.php" class="py-2 px-5 bg-neutral-700 text-white rounded-full shadow hover:bg-neutral-800 transition font-medium text-sm flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                Create Event
            </a>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white shadow rounded-xl border border-gray-100 text-sm">
                <thead>
                    <tr class="bg-neutral-100 text-neutral-700">
                        <th class="py-3 px-4 text-left font-semibold">Title</th>
                        <th class="py-3 px-4 text-left font-semibold">Date</th>
                        <th class="py-3 px-4 text-left font-semibold">Time</th>
                        <th class="py-3 px-4 text-left font-semibold">Venue</th>
                        <th class="py-3 px-4 text-left font-semibold">Max</th>
                        <th class="py-3 px-4 text-left font-semibold">Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $search = trim($_GET['search'] ?? '');
                $filtered_events = $events;
                if ($search) {
                    $filtered_events = array_filter($events, function($e) use ($search) {
                        return stripos($e['title'], $search) !== false || stripos($e['venue'], $search) !== false;
                    });
                }
                foreach ($filtered_events as $event): ?>
                    <tr class="border-b last:border-0 hover:bg-neutral-50 transition">
                        <td class="py-2 px-4"><?php echo htmlspecialchars($event['title']); ?></td>
                        <td class="py-2 px-4"><?php echo htmlspecialchars($event['event_date']); ?></td>
                        <td class="py-2 px-4"><?php echo htmlspecialchars(substr($event['event_time'],0,5)); ?></td>
                        <td class="py-2 px-4"><?php echo htmlspecialchars($event['venue']); ?></td>
                        <td class="py-2 px-4"><?php echo (int)$event['max_participants']; ?></td>
                        <td class="py-2 px-4 flex gap-2">
                            <a href="edit-event.php?id=<?php echo $event['id']; ?>" class="badge">Edit</a>
                            <a href="participants.php?event_id=<?php echo $event['id']; ?>" class="badge bg-green-100 text-green-700">Participants</a>
                            <a href="checkin.php?event_id=<?php echo $event['id']; ?>" class="badge bg-blue-100 text-blue-700">Check-in</a>
                            <a href="delete-event.php?id=<?php echo $event['id']; ?>" class="badge bg-red-100 text-red-700" onclick="return confirm('Delete this event?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>
</div>
<?php
include '../includes/footer.php';
?>
