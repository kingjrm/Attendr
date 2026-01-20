<?php
include '../includes/header.php';
require_once '../config/db.php';
if (!isset($_SESSION['admin_id'])) {
    header('Location: ../auth/login.php');
    exit;
}
$participants = $pdo->query('SELECT r.*, e.title AS event_title FROM registrations r JOIN events e ON r.event_id = e.id ORDER BY r.registered_at DESC')->fetchAll();
?>
<div class="flex min-h-[80vh]">
    <?php include 'sidebar.php'; ?>
    <main class="flex-1 px-8 py-10 ml-60">
        <h2 class="text-2xl font-bold mb-6 text-indigo-700">Participants</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full table-compact bg-white shadow rounded-xl border border-gray-100">
                <thead>
                    <tr class="bg-indigo-50">
                        <th>Name</th>
                        <th>Email</th>
                        <th>Event</th>
                        <th>Registered At</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($participants as $p): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($p['name']); ?></td>
                        <td><?php echo htmlspecialchars($p['email']); ?></td>
                        <td><?php echo htmlspecialchars($p['event_title']); ?></td>
                        <td><?php echo htmlspecialchars($p['registered_at']); ?></td>
                        <td>
                            <?php if ($p['checked_in']): ?>
                                <span class="badge bg-green-100 text-green-700">Checked-in</span>
                            <?php else: ?>
                                <span class="badge bg-gray-100 text-gray-700">Not checked-in</span>
                            <?php endif; ?>
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
