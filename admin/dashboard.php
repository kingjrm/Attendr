<?php
include '../includes/header.php';
require_once '../config/db.php';
if (!isset($_SESSION['admin_id'])) {
    header('Location: ../auth/login.php');
    exit;
}
$events = $pdo->query('SELECT * FROM events ORDER BY event_date DESC, event_time DESC')->fetchAll();
?>
<div class="flex justify-between items-center mb-6">
    <h2 class="text-xl font-semibold text-indigo-700">Event Dashboard</h2>
    <a href="create-event.php" class="py-2 px-4 bg-indigo-600 text-white rounded-soft shadow-soft hover:bg-indigo-700 transition">Create Event</a>
</div>
<div class="overflow-x-auto">
    <table class="min-w-full table-compact bg-white shadow-soft rounded-soft">
        <thead>
            <tr class="bg-indigo-50">
                <th>Title</th>
                <th>Date</th>
                <th>Time</th>
                <th>Venue</th>
                <th>Max</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($events as $event): ?>
            <tr>
                <td><?php echo htmlspecialchars($event['title']); ?></td>
                <td><?php echo htmlspecialchars($event['event_date']); ?></td>
                <td><?php echo htmlspecialchars(substr($event['event_time'],0,5)); ?></td>
                <td><?php echo htmlspecialchars($event['venue']); ?></td>
                <td><?php echo (int)$event['max_participants']; ?></td>
                <td class="flex gap-2">
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
<?php
include '../includes/footer.php';
?>
