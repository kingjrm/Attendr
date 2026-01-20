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
        <h2 class="text-2xl font-bold mb-6 text-indigo-700">Reports</h2>
        <div class="bg-white rounded-xl shadow p-6 border border-gray-100">
            <p class="text-gray-600">Report features coming soon.</p>
        </div>
    </main>
</div>
<?php
include '../includes/footer.php';
