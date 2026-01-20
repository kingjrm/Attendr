<?php
include '../includes/header.php';
require_once '../config/db.php';
if (!isset($_SESSION['admin_id'])) {
    header('Location: ../auth/login.php');
    exit;
}
$events = $pdo->query('SELECT * FROM events ORDER BY event_date DESC, event_time DESC')->fetchAll();
// Stats
$total_events = count($events);
$total_participants = $pdo->query('SELECT COUNT(*) FROM registrations')->fetchColumn();
$upcoming_events = $pdo->query('SELECT COUNT(*) FROM events WHERE event_date >= CURDATE()')->fetchColumn();
?>
<div class="flex min-h-[80vh]">
    <?php include 'sidebar.php'; ?>
    <main class="flex-1 px-8 py-10 ml-60">
        <h2 class="text-2xl font-bold mb-6 text-indigo-700">Admin Dashboard</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
            <div class="bg-white rounded-xl shadow p-6 flex flex-col items-center border border-gray-100">
                <span class="text-3xl font-bold text-indigo-600"><?php echo $total_events; ?></span>
                <span class="text-gray-500 mt-1">Total Events</span>
            </div>
            <div class="bg-white rounded-xl shadow p-6 flex flex-col items-center border border-gray-100">
                <span class="text-3xl font-bold text-indigo-600"><?php echo $total_participants; ?></span>
                <span class="text-gray-500 mt-1">Total Participants</span>
            </div>
            <div class="bg-white rounded-xl shadow p-6 flex flex-col items-center border border-gray-100">
                <span class="text-3xl font-bold text-indigo-600"><?php echo $upcoming_events; ?></span>
                <span class="text-gray-500 mt-1">Upcoming Events</span>
            </div>
        </div>
    </main>
</div>
<?php
include '../includes/footer.php';
?>
