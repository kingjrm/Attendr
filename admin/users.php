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
    <main class="flex-1 px-8 py-10 lg:ml-72">

        <div class="w-full max-w-[1200px] mx-auto">
            <form method="get" id="userFilterForm" class="flex flex-row flex-wrap gap-3 mb-3 items-center justify-between w-full">
                <div class="flex flex-row gap-2 items-center">
                    <input type="text" name="search" placeholder="Search name or email..." value="<?php echo htmlspecialchars($search); ?>" class="border border-gray-200 px-3 py-2 text-sm rounded focus:ring-2 focus:ring-indigo-200 w-56" oninput="this.form.submit()" autocomplete="off" />
                    <select name="role" class="border border-gray-200 px-3 py-2 text-sm rounded pr-10 appearance-none" onchange="this.form.submit()">
                        <option value="">All Roles</option>
                        <option value="admin" <?php if($role=='admin') echo 'selected'; ?>>Admin</option>
                        <option value="user" <?php if($role=='user') echo 'selected'; ?>>User</option>
                    </select>
                </div>
                <div class="flex flex-row gap-2 items-center">
                    <button type="button" onclick="window.location.href='users.php'" class="px-4 py-2 bg-gray-100 text-gray-700 rounded font-medium text-sm hover:bg-gray-200 transition">Clear Filter</button>
                </div>
            </form>
            <div class="overflow-x-auto rounded-xl">
                <table class="w-full text-sm whitespace-nowrap bg-white shadow border border-gray-100">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="py-3 px-4 font-semibold text-gray-600 text-center">ID</th>
                            <th class="py-3 px-4 font-semibold text-gray-600 text-center">Name</th>
                            <th class="py-3 px-4 font-semibold text-gray-600 text-center">Email</th>
                            <th class="py-3 px-4 font-semibold text-gray-600 text-center">Role</th>
                            <th class="py-3 px-4 font-semibold text-gray-600 text-center">Created</th>
                            <th class="py-3 px-4 font-semibold text-gray-600 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($users)): ?>
                        <tr>
                            <td colspan="6" class="py-6 px-5 text-center text-gray-400 text-sm">No users found.</td>
                        </tr>
                        <?php else: ?>
                        <?php foreach ($users as $user): ?>
                        <tr class="border-b last:border-0 hover:bg-gray-50 transition">
                            <td class="py-3 px-4 font-mono text-xs text-gray-500 text-center">#<?php echo htmlspecialchars($user['id'] ?? ''); ?></td>
                            <td class="py-3 px-4 font-medium text-gray-800 text-center"><?php echo htmlspecialchars($user['name'] ?? ''); ?></td>
                            <td class="py-3 px-4 text-gray-700 text-center"><?php echo htmlspecialchars($user['email'] ?? ''); ?></td>
                            <td class="py-3 px-4 text-center">
                                <span class="inline-block px-2 py-1 rounded text-xs font-semibold <?php echo (isset($user['role']) && $user['role']=='admin')?'bg-indigo-100 text-indigo-700':'bg-gray-100 text-gray-700'; ?>">
                                    <?php echo isset($user['role']) ? ucfirst($user['role']) : '-'; ?>
                                </span>
                            </td>
                            <td class="py-3 px-4 text-xs text-gray-500 text-center"><?php echo isset($user['created_at']) ? date('Y-m-d', strtotime($user['created_at'])) : ''; ?></td>
                            <td class="py-3 px-4 flex gap-2 justify-center">
                                <button class="p-2 rounded bg-indigo-50 text-indigo-700 hover:bg-indigo-100 transition" title="Edit">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536M9 13h3l8-8a2.828 2.828 0 00-4-4l-8 8v3z" /></svg>
                                </button>
                                <button class="p-2 rounded bg-red-50 text-red-600 hover:bg-red-100 transition" title="Delete">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                                </button>
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
