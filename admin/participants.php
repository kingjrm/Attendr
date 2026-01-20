<?php
include '../includes/header.php';
require_once '../config/db.php';
if (!isset($_SESSION['admin_id'])) {
    header('Location: ../auth/login.php');
    exit;
}
$event_id = $_GET['event_id'] ?? '';
$status = $_GET['status'] ?? '';
$search = trim($_GET['search'] ?? '');
$query = 'SELECT r.*, e.title AS event_title FROM registrations r JOIN events e ON r.event_id = e.id WHERE 1';
$params = [];
if ($event_id) {
    $query .= ' AND r.event_id = ?';
    $params[] = $event_id;
}
if ($status !== '') {
    $query .= ' AND r.checked_in = ?';
    $params[] = $status === '1' ? 1 : 0;
}
if ($search) {
    $query .= ' AND (r.name LIKE ? OR r.email LIKE ?)';
    $params[] = "%$search%";
    $params[] = "%$search%";
}
$query .= ' ORDER BY r.registered_at DESC';
$stmt = $pdo->prepare($query);
$stmt->execute($params);
$participants = $stmt->fetchAll();
$events = $pdo->query('SELECT id, title FROM events ORDER BY title')->fetchAll();
?>
<div class="flex min-h-[80vh]">
    <?php include 'sidebar.php'; ?>
    <main class="flex-1 px-8 py-10 ml-60">
        <h2 class="text-2xl font-bold mb-6 text-indigo-700">Participants</h2>
        <div class="bg-white rounded-xl shadow p-6 border border-gray-100">
            <form method="get" class="flex flex-wrap gap-2 mb-4 items-center">
                <input type="text" name="search" placeholder="Search name or email..." value="<?php echo htmlspecialchars($search); ?>" class="rounded-full border border-gray-200 px-4 py-2 text-sm focus:ring-2 focus:ring-indigo-200 w-48" />
                <select name="event_id" class="rounded-full border border-gray-200 px-4 py-2 text-sm">
                    <option value="">All Events</option>
                    <?php foreach ($events as $e): ?>
                        <option value="<?php echo $e['id']; ?>" <?php if($event_id==$e['id']) echo 'selected'; ?>><?php echo htmlspecialchars($e['title']); ?></option>
                    <?php endforeach; ?>
                </select>
                <select name="status" class="rounded-full border border-gray-200 px-4 py-2 text-sm">
                    <option value="">All Status</option>
                    <option value="1" <?php if($status==='1') echo 'selected'; ?>>Checked-in</option>
                    <option value="0" <?php if($status==='0') echo 'selected'; ?>>Not checked-in</option>
                </select>
                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-full text-sm font-medium hover:bg-indigo-700 transition">Filter</button>
            </form>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white shadow rounded-xl border border-gray-100 text-sm text-left">
                    <thead>
                        <tr class="bg-indigo-50">
                            <th class="py-3 px-4 font-semibold">Name</th>
                            <th class="py-3 px-4 font-semibold">Email</th>
                            <th class="py-3 px-4 font-semibold">Event</th>
                            <th class="py-3 px-4 font-semibold">Registered At</th>
                            <th class="py-3 px-4 font-semibold">Status</th>
                            <th class="py-3 px-4 font-semibold">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($participants as $p): ?>
                        <tr class="border-b last:border-0 hover:bg-neutral-50 transition">
                            <td class="py-2 px-4"><?php echo htmlspecialchars($p['name']); ?></td>
                            <td class="py-2 px-4"><?php echo htmlspecialchars($p['email']); ?></td>
                            <td class="py-2 px-4"><?php echo htmlspecialchars($p['event_title']); ?></td>
                            <td class="py-2 px-4 text-xs text-gray-500"><?php echo htmlspecialchars($p['registered_at']); ?></td>
                            <td class="py-2 px-4">
                                <?php if ($p['checked_in']): ?>
                                    <span class="inline-block px-2 py-1 rounded text-xs font-medium bg-green-100 text-green-700">Checked-in</span>
                                <?php else: ?>
                                    <span class="inline-block px-2 py-1 rounded text-xs font-medium bg-gray-100 text-gray-700">Not checked-in</span>
                                <?php endif; ?>
                            </td>
                            <td class="py-2 px-4">
                                <a href="checkin.php?registration_id=<?php echo $p['id']; ?>" class="text-blue-600 hover:underline text-xs">Check-in</a>
                                <a href="delete-registration.php?id=<?php echo $p['id']; ?>" class="text-red-500 hover:underline text-xs ml-2" onclick="return confirm('Delete this registration?')">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>
<?php
include '../includes/footer.php';
?>
