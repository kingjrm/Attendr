<?php
include '../includes/header.php';
if (!isset($_SESSION['admin_id'])) {
    header('Location: ../auth/login.php');
    exit;
}
?>
<div class="flex min-h-[80vh]">
    <?php include 'sidebar.php'; ?>
    <main class="flex-1 px-8 py-10 ml-60">
        <h2 class="text-2xl font-bold mb-6 text-neutral-700">Settings</h2>
        <div class="bg-white rounded-xl shadow p-8 border border-gray-100 max-w-xl mx-auto">
            <h3 class="text-lg font-semibold mb-4 text-neutral-700">Profile Settings</h3>
            <form method="post" class="flex flex-col gap-4 mb-8">
                <div>
                    <label for="admin_name">Name</label>
                    <input type="text" name="admin_name" id="admin_name" class="w-full" value="<?php echo htmlspecialchars($_SESSION['admin_name'] ?? ''); ?>" required>
                </div>
                <div>
                    <label for="admin_username">Username</label>
                    <input type="text" name="admin_username" id="admin_username" class="w-full" value="<?php echo htmlspecialchars($_SESSION['admin_username'] ?? 'admin'); ?>" required>
                </div>
                <button type="submit" class="py-2 px-6 bg-indigo-600 text-white rounded-full shadow hover:bg-indigo-700 transition font-semibold">Update Profile</button>
            </form>
            <h3 class="text-lg font-semibold mb-4 text-neutral-700">Change Password</h3>
            <form method="post" class="flex flex-col gap-4">
                <div>
                    <label for="current_password">Current Password</label>
                    <input type="password" name="current_password" id="current_password" class="w-full" required>
                </div>
                <div>
                    <label for="new_password">New Password</label>
                    <input type="password" name="new_password" id="new_password" class="w-full" required>
                </div>
                <div>
                    <label for="confirm_password">Confirm New Password</label>
                    <input type="password" name="confirm_password" id="confirm_password" class="w-full" required>
                </div>
                <button type="submit" class="py-2 px-6 bg-indigo-600 text-white rounded-full shadow hover:bg-indigo-700 transition font-semibold">Change Password</button>
            </form>
        </div>
    </main>
</div>
<?php include '../includes/footer.php'; ?>