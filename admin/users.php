<?php
include '../includes/header.php';
require_once '../config/db.php';
if (!isset($_SESSION['admin_id'])) {
    header('Location: ../auth/login.php');
    exit;
}
// Filtering
$search = trim($_GET['search'] ?? '');
$role = $_GET['role'] ?? '';
$query = 'SELECT * FROM users WHERE 1';
$params = [];
if ($search) {
    $query .= ' AND (name LIKE ? OR email LIKE ?)';
    $params[] = "%$search%";
    $params[] = "%$search%";
}
if ($role) {
    $query .= ' AND role = ?';
    $params[] = $role;
}
$query .= ' ORDER BY created_at DESC';
$stmt = $pdo->prepare($query);
$stmt->execute($params);
$users = $stmt->fetchAll();
?>
<div class="flex min-h-[80vh]">
    <?php include 'sidebar.php'; ?>
    <main class="flex-1 px-8 py-10 ml-60">
        <h2 class="text-2xl font-bold mb-6 text-indigo-700">User Management</h2>
        <div class="bg-white rounded-xl shadow p-6 border border-gray-100">
            <form method="get" class="flex flex-wrap gap-2 mb-4 items-center">
                <input type="text" name="search" placeholder="Search name or email..." value="<?php echo htmlspecialchars($search); ?>" class="rounded-full border border-gray-200 px-4 py-2 text-sm focus:ring-2 focus:ring-indigo-200 w-48" />
                <select name="role" class="rounded-full border border-gray-200 px-4 py-2 text-sm">
                    <option value="">All Roles</option>
                    <option value="admin" <?php if($role=='admin') echo 'selected'; ?>>Admin</option>
                    <option value="user" <?php if($role=='user') echo 'selected'; ?>>User</option>
                </select>
                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-full text-sm font-medium hover:bg-indigo-700 transition">Filter</button>
            </form>
            <table class="min-w-full text-left text-sm">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="py-2 px-4 font-semibold text-gray-600">ID</th>
                        <th class="py-2 px-4 font-semibold text-gray-600">Name</th>
                        <th class="py-2 px-4 font-semibold text-gray-600">Email</th>
                        <th class="py-2 px-4 font-semibold text-gray-600">Role</th>
                        <th class="py-2 px-4 font-semibold text-gray-600">Created</th>
                        <th class="py-2 px-4 font-semibold text-gray-600">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                    <tr class="border-b hover:bg-gray-50">
                        <td class="py-2 px-4">#<?php echo htmlspecialchars($user['id'] ?? ''); ?></td>
                        <td class="py-2 px-4"><?php echo htmlspecialchars($user['name'] ?? ''); ?></td>
                        <td class="py-2 px-4"><?php echo htmlspecialchars($user['email'] ?? ''); ?></td>
                        <td class="py-2 px-4">
                            <span class="inline-block px-2 py-1 rounded text-xs font-medium <?php echo (isset($user['role']) && $user['role']=='admin')?'bg-indigo-100 text-indigo-700':'bg-gray-100 text-gray-700'; ?>">
                                <?php echo isset($user['role']) ? ucfirst($user['role']) : ''; ?>
                            </span>
                        </td>
                        <td class="py-2 px-4 text-xs text-gray-500"><?php echo isset($user['created_at']) ? date('Y-m-d', strtotime($user['created_at'])) : ''; ?></td>
                        <td class="py-2 px-4">
                            <button class="text-indigo-600 hover:underline text-xs">Edit</button>
                            <button class="text-red-500 hover:underline text-xs ml-2">Delete</button>
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
