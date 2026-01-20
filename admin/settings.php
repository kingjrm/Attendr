<?php
include '../includes/header.php';
if (!isset($_SESSION['admin_id'])) {
    header('Location: ../auth/login.php');
    exit;
}
?>
<div class="flex min-h-[80vh]">
    <?php include 'sidebar.php'; ?>
    <main class="flex-1 px-8 py-10 lg:ml-72">
        <h2 class="text-2xl font-bold mb-6 text-neutral-700">Settings</h2>
        <div class="bg-white rounded-xl shadow p-8 border border-gray-100 max-w-xl mx-auto">
            <h3 class="text-lg font-semibold mb-4 text-neutral-700">Profile Settings</h3>
            <form method="post" class="flex flex-col gap-4 mb-8">
                <div>
                    <label for="admin_name">Name</label>
                    <input type="text" name="admin_name" id="admin_name" class="w-full" value="<?php echo htmlspecialchars($_SESSION['admin_name'] ?? ''); ?>" required>
                <?php
                // ...existing code...
                ?>
                <div class="max-w-2xl mx-auto bg-white rounded-xl shadow p-8">
                    <h2 class="text-xl font-bold mb-6 text-indigo-700">Settings</h2>
                    <form>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Site Name</label>
                            <input type="text" class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-indigo-200 focus:outline-none bg-white" value="Attendr" />
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Change Password</label>
                            <input type="password" class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-indigo-200 focus:outline-none bg-white" placeholder="New Password" />
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Update Email</label>
                            <input type="email" class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-indigo-200 focus:outline-none bg-white" placeholder="admin@attendr" />
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Notification Preferences</label>
                            <select class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-indigo-200 focus:outline-none bg-white">
                                <option>Email Only</option>
                                <option>SMS Only</option>
                                <option>Email & SMS</option>
                                <option>None</option>
                            </select>
                        </div>
                        <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded font-medium hover:bg-indigo-700">Save Changes</button>
                    </form>
                </div>
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