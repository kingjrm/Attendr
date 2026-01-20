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
$query = 'SELECT l.*, u.name FROM audit_logs l LEFT JOIN users u ON l.user_id = u.id WHERE 1';
$params = [];
if ($search) {
    $query .= ' AND (l.action LIKE ? OR u.name LIKE ?)';
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

        <div class="w-full max-w-[1200px] mx-auto">
            <form method="get" id="auditLogFilterForm" class="flex flex-row flex-wrap gap-3 mb-3 items-center justify-between w-full">
                <div class="flex flex-row gap-2 items-center">
                    <input type="text" name="search" placeholder="Search action, user..." value="<?php echo htmlspecialchars($search); ?>" class="border border-gray-200 px-3 py-2 text-sm rounded focus:ring-2 focus:ring-indigo-200 w-56" oninput="this.form.submit()" autocomplete="off" />
                    <select name="user_id" class="border border-gray-200 px-3 py-2 text-sm rounded pr-10 appearance-none" onchange="this.form.submit()">
                        <option value="">All Users</option>
                        <?php foreach ($users as $u): ?>
                            <option value="<?php echo $u['id']; ?>" <?php if($user_id==$u['id']) echo 'selected'; ?>><?php echo htmlspecialchars($u['name']); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="flex flex-row gap-2 items-center">
                    <button type="button" onclick="window.location.href='audit-logs.php'" class="px-4 py-2 bg-gray-100 text-gray-700 rounded font-medium text-sm hover:bg-gray-200 transition">Clear Filter</button>
                </div>
            </form>
            <div class="overflow-x-auto rounded-xl">
                <table class="w-full text-sm whitespace-nowrap bg-white shadow border border-gray-100">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="py-3 px-4 font-semibold text-gray-600 text-center">Date</th>
                        <th class="py-3 px-4 font-semibold text-gray-600 text-center">User</th>
                        <th class="py-3 px-4 font-semibold text-gray-600 text-center">Action</th>
                        <th class="py-3 px-4 font-semibold text-gray-600 text-center">IP</th>
                        <th class="py-3 px-4 font-semibold text-gray-600 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($logs)): ?>
                        <tr>
                            <td colspan="4" class="py-6 px-5 text-center text-gray-400 text-sm">No logs found.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($logs as $log): ?>
                        <tr class="border-b hover:bg-gray-50">
                            <td class="py-3 px-4 text-xs text-gray-500 text-center"><?php echo htmlspecialchars($log['created_at']); ?></td>
                            <td class="py-3 px-4 text-center"><?php echo htmlspecialchars($log['name'] ?? 'Unknown'); ?></td>
                            <td class="py-3 px-4 text-center"><?php echo htmlspecialchars($log['action']); ?></td>
                            <td class="py-3 px-4 text-xs text-gray-500 text-center"><?php echo htmlspecialchars($log['ip_address']); ?></td>
                            <td class="py-3 px-4 flex gap-2 justify-center">
                                <span class="p-2 rounded bg-gray-50 text-gray-400 cursor-not-allowed" title="View (coming soon)">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0zm-9 0a9 9 0 0118 0a9 9 0 01-18 0z" /></svg>
                                </span>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </main>
</div>
<?php
include '../includes/footer.php';
