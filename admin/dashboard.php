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
        <!-- Graphs Section -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="bg-white rounded-xl shadow p-6 border border-gray-100">
                <h3 class="text-lg font-semibold mb-4 text-indigo-700">Events Over Time</h3>
                <canvas id="eventsChart" height="180"></canvas>
            </div>
            <div class="bg-white rounded-xl shadow p-6 border border-gray-100">
                <h3 class="text-lg font-semibold mb-4 text-indigo-700">Participants Per Event</h3>
                <canvas id="participantsChart" height="180"></canvas>
            </div>
        </div>
        <!-- Chart.js CDN -->
        <?php include '../assets/chartjs-cdn.html'; ?>
        <script>
        // Example data for Events Over Time
        const eventsLabels = [
            <?php foreach ($events as $event) {
                echo "'" . date('M d', strtotime($event['event_date'])) . "',";
            } ?>
        ];
        const eventsData = [
            <?php foreach ($events as $event) {
                echo "1,"; // Each event counts as 1 for demo
            } ?>
        ];
        // Example data for Participants Per Event
        const participantsLabels = [
            <?php foreach ($events as $event) {
                echo "'" . addslashes($event['event_name']) . "',";
            } ?>
        ];
        const participantsData = [
            <?php foreach ($events as $event) {
                $count = $pdo->query("SELECT COUNT(*) FROM registrations WHERE event_id = " . $event['id'])->fetchColumn();
                echo $count . ",";
            } ?>
        ];
        // Events Over Time Chart
        new Chart(document.getElementById('eventsChart').getContext('2d'), {
            type: 'line',
            data: {
                labels: eventsLabels,
                datasets: [{
                    label: 'Events',
                    data: eventsData,
                    borderColor: '#6366f1',
                    backgroundColor: 'rgba(99,102,241,0.1)',
                    fill: true,
                    tension: 0.3
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { display: false } }
            }
        });
        // Participants Per Event Chart
        new Chart(document.getElementById('participantsChart').getContext('2d'), {
            type: 'bar',
            data: {
                labels: participantsLabels,
                datasets: [{
                    label: 'Participants',
                    data: participantsData,
                    backgroundColor: '#6366f1',
                    borderRadius: 6
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { display: false } },
                scales: { y: { beginAtZero: true } }
            }
        });
        </script>
    </main>
</div>
<?php
include '../includes/footer.php';
?>
