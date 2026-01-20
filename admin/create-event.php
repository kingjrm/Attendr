<?php
include '../includes/header.php';
require_once '../config/db.php';
if (!isset($_SESSION['admin_id'])) {
    header('Location: ../auth/login.php');
    exit;
}
$error = '';
$success = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $event_date = $_POST['event_date'] ?? '';
    $event_time = $_POST['event_time'] ?? '';
    $venue = trim($_POST['venue'] ?? '');
    $max_participants = (int)($_POST['max_participants'] ?? 0);
    if ($title && $event_date && $event_time && $venue && $max_participants > 0) {
        $stmt = $pdo->prepare('INSERT INTO events (title, description, event_date, event_time, venue, max_participants, created_by) VALUES (?, ?, ?, ?, ?, ?, ?)');
        $stmt->execute([$title, $description, $event_date, $event_time, $venue, $max_participants, $_SESSION['admin_id']]);
        $success = 'Event created successfully!';
    } else {
        $error = 'Please fill in all required fields.';
    }
}
?>
<div class="flex min-h-[80vh]">
    <?php include 'sidebar.php'; ?>
    <main class="flex-1 px-8 py-10 ml-60">
        <div class="max-w-lg mx-auto p-8 bg-white shadow-soft rounded-soft border border-gray-100">
            <h2 class="text-2xl font-bold mb-6 text-neutral-700">Create Event</h2>
            <?php if ($error): ?>
                <div class="mb-4 text-red-500 text-sm"><?php echo $error; ?></div>
            <?php endif; ?>
            <?php if ($success): ?>
                <div class="mb-4 text-green-600 text-sm"><?php echo $success; ?></div>
            <?php endif; ?>
            <form method="post" class="flex flex-col gap-4">
                <div>
                    <label for="title">Title <span class="text-red-500">*</span></label>
                    <input type="text" name="title" id="title" class="w-full" required>
                </div>
                <div>
                    <label for="description">Description</label>
                    <textarea name="description" id="description" class="w-full" rows="3"></textarea>
                </div>
                <div class="flex gap-4">
                    <div class="flex-1">
                        <label for="event_date">Date <span class="text-red-500">*</span></label>
                        <input type="date" name="event_date" id="event_date" class="w-full" required>
                    </div>
                    <div class="flex-1">
                        <label for="event_time">Time <span class="text-red-500">*</span></label>
                        <input type="time" name="event_time" id="event_time" class="w-full" required>
                    </div>
                </div>
                <div>
                    <label for="venue">Venue <span class="text-red-500">*</span></label>
                    <input type="text" name="venue" id="venue" class="w-full" required>
                </div>
                <div>
                    <label for="max_participants">Max Participants <span class="text-red-500">*</span></label>
                    <input type="number" name="max_participants" id="max_participants" class="w-full" min="1" required>
                </div>
                <button type="submit" class="py-2 px-6 bg-neutral-700 text-white rounded-full shadow-soft hover:bg-neutral-800 transition font-semibold">Create Event</button>
            </form>
        </div>
    </main>
</div>
<?php
include '../includes/footer.php';
?>
