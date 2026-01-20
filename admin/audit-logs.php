<?php
include '../includes/header.php';
require_once '../config/db.php';
if (!isset($_SESSION['admin_id'])) {
    header('Location: ../auth/login.php');
    exit;
}
// Filtering
$search = trim($_GET['search'] ?? '');
$user_id = $_GET['user_id'] ?? '';
$query = 'SELECT l.*, u.name, u.email FROM audit_logs l LEFT JOIN users u ON l.user_id = u.id WHERE 1';
$params = [];
if ($search) {
    $query .= ' AND (l.action LIKE ? OR u.name LIKE ? OR u.email LIKE ?)';
    $params[] = "%$search%";
    $params[] = "%$search%";
    $params[] = "%$search%";
}
if ($user_id) {
    $query .= ' AND l.user_id = ?';
    $params[] = $user_id;
}
$query .= ' ORDER BY l.created_at DESC';
$stmt = $pdo->prepare($query);
$stmt->execute($params);
$logs = $stmt->fetchAll();
$users = $pdo->query('SELECT id, name FROM users ORDER BY name')->fetchAll();
?>
<div class="flex min-h-[80vh]">
    <?php include 'sidebar.php'; ?>
    <main class="flex-1 px-8 py-10 ml-60">
        <h2 class="text-2xl font-bold mb-6 text-indigo-700">Audit Logs</h2>
        <div class="bg-white rounded-xl shadow p-6 border border-gray-100">
            <form method="get" class="flex flex-wrap gap-2 mb-4 items-center">
                <input type="text" name="search" placeholder="Search action, user..." value="<?php echo htmlspecialchars($search); ?>" class="rounded-full border border-gray-200 px-4 py-2 text-sm focus:ring-2 focus:ring-indigo-200 w-48" />
                <select name="user_id" class="rounded-full border border-gray-200 px-4 py-2 text-sm">
                    <option value="">All Users</option>
                    <?php foreach ($users as $u): ?>
                        <option value="<?php echo $u['id']; ?>" <?php if($user_id==$u['id']) echo 'selected'; ?>><?php echo htmlspecialchars($u['name']); ?></option>
                    <?php endforeach; ?>
                </select>
                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-full text-sm font-medium hover:bg-indigo-700 transition">Filter</button>
            </form>
            <table class="min-w-full text-left text-sm">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="py-2 px-4 font-semibold text-gray-600">Date</th>
                        <th class="py-2 px-4 font-semibold text-gray-600">User</th>
                        <th class="py-2 px-4 font-semibold text-gray-600">Action</th>
                        <th class="py-2 px-4 font-semibold text-gray-600">IP</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($logs as $log): ?>
                    <tr class="border-b hover:bg-gray-50">
                        <td class="py-2 px-4 text-xs text-gray-500"><?php echo htmlspecialchars($log['created_at']); ?></td>
                        <td class="py-2 px-4"><?php echo htmlspecialchars($log['name'] ?? 'Unknown'); ?> <span class="text-xs text-gray-400"><?php echo htmlspecialchars($log['email'] ?? ''); ?></span></td>
                        <td class="py-2 px-4"><?php echo htmlspecialchars($log['action']); ?></td>
                        <td class="py-2 px-4 text-xs text-gray-500"><?php echo htmlspecialchars($log['ip_address']); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>
</div>
<?php
include '../includes/footer.php';
