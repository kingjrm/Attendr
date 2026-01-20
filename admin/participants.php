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

        <div class="w-full max-w-[1200px] mx-auto">
            <form method="get" id="participantFilterForm" class="flex flex-row flex-wrap gap-3 mb-3 items-center justify-between w-full">
                <div class="flex flex-row gap-2 items-center">
                    <input type="text" name="search" placeholder="Search name or email..." value="<?php echo htmlspecialchars($search); ?>" class="border border-gray-200 px-3 py-2 text-sm rounded focus:ring-2 focus:ring-indigo-200 w-56" oninput="this.form.submit()" autocomplete="off" />
                    <select name="event_id" class="border border-gray-200 px-3 py-2 text-sm rounded pr-10 appearance-none" onchange="this.form.submit()">
                        <option value="">All Events</option>
                        <?php foreach ($events as $e): ?>
                            <option value="<?php echo $e['id']; ?>" <?php if($event_id==$e['id']) echo 'selected'; ?>><?php echo htmlspecialchars($e['title']); ?></option>
                        <?php endforeach; ?>
                    </select>
                    <select name="status" class="border border-gray-200 px-3 py-2 text-sm rounded pr-10 appearance-none" onchange="this.form.submit()">
                        <option value="">All Status</option>
                        <option value="1" <?php if($status==='1') echo 'selected'; ?>>Checked-in</option>
                        <option value="0" <?php if($status==='0') echo 'selected'; ?>>Not checked-in</option>
                    </select>
                </div>
                <div class="flex flex-row gap-2 items-center">
                    <button type="button" onclick="window.location.href='participants.php'" class="px-4 py-2 bg-gray-100 text-gray-700 rounded font-medium text-sm hover:bg-gray-200 transition">Clear Filter</button>
                </div>
            </form>
            <div class="overflow-x-auto rounded-xl">
                <table class="w-full text-sm whitespace-nowrap bg-white shadow border border-gray-100">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="py-3 px-4 font-semibold text-gray-600 text-center">Name</th>
                            <th class="py-3 px-4 font-semibold text-gray-600 text-center">Email</th>
                            <th class="py-3 px-4 font-semibold text-gray-600 text-center">Event</th>
                            <th class="py-3 px-4 font-semibold text-gray-600 text-center">Registered At</th>
                            <th class="py-3 px-4 font-semibold text-gray-600 text-center">Status</th>
                            <th class="py-3 px-4 font-semibold text-gray-600 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if (empty($participants)): ?>
                        <tr>
                            <td colspan="6" class="py-6 px-5 text-center text-gray-400 text-sm">No participants found.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($participants as $p): ?>
                        <tr class="border-b last:border-0 hover:bg-gray-50 transition">
                            <td class="py-3 px-4 font-medium text-gray-800 text-center"><?php echo htmlspecialchars($p['name']); ?></td>
                            <td class="py-3 px-4 text-gray-700 text-center"><?php echo htmlspecialchars($p['email']); ?></td>
                            <td class="py-3 px-4 text-center"><?php echo htmlspecialchars($p['event_title']); ?></td>
                            <td class="py-3 px-4 text-xs text-gray-500 text-center"><?php echo htmlspecialchars($p['registered_at']); ?></td>
                            <td class="py-3 px-4 text-center">
                                <?php if ($p['checked_in']): ?>
                                    <span class="inline-block px-2 py-1 rounded text-xs font-semibold bg-green-100 text-green-700">Checked-in</span>
                                <?php else: ?>
                                    <span class="inline-block px-2 py-1 rounded text-xs font-semibold bg-gray-100 text-gray-700">Not checked-in</span>
                                <?php endif; ?>
                            </td>
                            <td class="py-3 px-4 flex gap-2 justify-center">
                                <a href="checkin.php?registration_id=<?php echo $p['id']; ?>" class="p-2 rounded bg-blue-50 text-blue-700 hover:bg-blue-100 transition" title="Check-in">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                                </a>
                                <a href="delete-registration.php?id=<?php echo $p['id']; ?>" class="p-2 rounded bg-red-50 text-red-600 hover:bg-red-100 transition" title="Delete" onclick="return confirm('Delete this registration?')">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>
<?php
include '../includes/footer.php';
?>
