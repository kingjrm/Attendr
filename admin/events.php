<?php
include '../includes/header.php';
require_once '../config/db.php';
if (!isset($_SESSION['admin_id'])) {
    header('Location: ../auth/login.php');
    exit;
}
$events = $pdo->query('SELECT * FROM events ORDER BY event_date DESC, event_time DESC')->fetchAll();
?>
<div class="flex min-h-[80vh]">
    <?php include 'sidebar.php'; ?>
    <main class="flex-1 px-8 py-10 lg:ml-72">
        <div class="w-full max-w-[1200px] mx-auto">
            <div class="flex flex-row flex-wrap items-center justify-between mb-3">
                <form method="get" id="eventFilterForm" class="flex flex-row gap-2 items-center w-full max-w-[70%]">
                    <input type="text" name="search" placeholder="Search events..." value="<?php echo htmlspecialchars($_GET['search'] ?? ''); ?>" class="border border-gray-200 px-3 py-2 text-sm rounded focus:ring-2 focus:ring-indigo-200 w-56" oninput="this.form.submit()" autocomplete="off" />
                    <button type="button" onclick="window.location.href='events.php'" class="px-4 py-2 bg-gray-100 text-gray-700 rounded font-medium text-sm hover:bg-gray-200 transition ml-2">Clear Filter</button>
                </form>
                <button type="button" onclick="document.getElementById('createEventModal').classList.remove('hidden')" class="py-2 px-5 bg-indigo-600 text-white rounded shadow hover:bg-indigo-700 transition font-medium text-sm flex items-center gap-2 ml-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                    Create Event
                </button>
            </div>
        <!-- Table and modal remain unchanged below -->
            <div class="overflow-x-auto rounded-xl">
                <table class="w-full text-sm whitespace-nowrap bg-white shadow border border-gray-100">
                <thead>
                    <tr class="bg-neutral-100 text-neutral-700">
                        <th class="py-3 px-4 font-semibold text-center">Title</th>
                        <th class="py-3 px-4 font-semibold text-center">Date</th>
                        <th class="py-3 px-4 font-semibold text-center">Time</th>
                        <th class="py-3 px-4 font-semibold text-center">Venue</th>
                        <th class="py-3 px-4 font-semibold text-center">Max</th>
                        <th class="py-3 px-4 font-semibold text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $search = trim($_GET['search'] ?? '');
                $filtered_events = $events;
                if ($search) {
                    $filtered_events = array_filter($events, function($e) use ($search) {
                        return stripos($e['title'], $search) !== false || stripos($e['venue'], $search) !== false;
                    });
                }
                foreach ($filtered_events as $event): ?>
                    <tr class="border-b last:border-0 hover:bg-neutral-50 transition">
                        <td class="py-3 px-4 text-center"> <?php echo htmlspecialchars($event['title']); ?> </td>
                        <td class="py-3 px-4 text-center"> <?php echo htmlspecialchars($event['event_date']); ?> </td>
                        <td class="py-3 px-4 text-center"> <?php echo htmlspecialchars(substr($event['event_time'],0,5)); ?> </td>
                        <td class="py-3 px-4 text-center"> <?php echo htmlspecialchars($event['venue']); ?> </td>
                        <td class="py-3 px-4 text-center"> <?php echo (int)$event['max_participants']; ?> </td>
                        <td class="py-3 px-4 flex gap-2 justify-center">
                            <a href="edit-event.php?id=<?php echo $event['id']; ?>" class="p-2 rounded bg-indigo-50 text-indigo-700 hover:bg-indigo-100 transition" title="Edit">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536M9 13h3l8-8a2.828 2.828 0 00-4-4l-8 8v3z" /></svg>
                            </a>
                            <a href="participants.php?event_id=<?php echo $event['id']; ?>" class="p-2 rounded bg-green-50 text-green-700 hover:bg-green-100 transition" title="Participants">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m9-5a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                            </a>
                            <a href="checkin.php?event_id=<?php echo $event['id']; ?>" class="p-2 rounded bg-blue-50 text-blue-700 hover:bg-blue-100 transition" title="Check-in">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                            </a>
                            <a href="delete-event.php?id=<?php echo $event['id']; ?>" class="p-2 rounded bg-red-50 text-red-700 hover:bg-red-100 transition" title="Delete" onclick="return confirm('Delete this event?')">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            </div>
            <!-- Create Event Modal -->
            <div id="createEventModal" class="fixed inset-0 bg-black bg-opacity-30 flex items-center justify-center z-50 hidden">
                <div class="bg-white rounded-xl shadow-lg p-8 w-full max-w-lg relative">
                    <button onclick="document.getElementById('createEventModal').classList.add('hidden')" class="absolute top-3 right-3 text-gray-400 hover:text-gray-700 text-xl">&times;</button>
                    <h2 class="text-xl font-bold mb-4 text-neutral-700">Create Event</h2>
                    <form method="post" action="create-event.php" class="flex flex-col gap-4 text-left">
                        <div>
                            <label for="title">Title <span class="text-red-500">*</span></label>
                            <input type="text" name="title" id="title" class="w-full border rounded px-3 py-2" required>
                        </div>
                        <div>
                            <label for="description">Description</label>
                            <textarea name="description" id="description" class="w-full border rounded px-3 py-2" rows="3"></textarea>
                        </div>
                        <div class="flex gap-4">
                            <div class="flex-1">
                                <label for="event_date">Date <span class="text-red-500">*</span></label>
                                <input type="date" name="event_date" id="event_date" class="w-full border rounded px-3 py-2" required>
                            </div>
                            <div class="flex-1">
                                <label for="event_time">Time <span class="text-red-500">*</span></label>
                                <input type="time" name="event_time" id="event_time" class="w-full border rounded px-3 py-2" required>
                            </div>
                        </div>
                        <div>
                            <label for="venue">Venue <span class="text-red-500">*</span></label>
                            <input type="text" name="venue" id="venue" class="w-full border rounded px-3 py-2" required>
                        </div>
                        <div>
                            <label for="max_participants">Max Participants <span class="text-red-500">*</span></label>
                            <input type="number" name="max_participants" id="max_participants" class="w-full border rounded px-3 py-2" min="1" required>
                        </div>
                        <div class="flex justify-end">
                            <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded font-medium hover:bg-indigo-700">Create</button>
                        </div>
                    </form>
                </div>
            </div>
            </table>
        </div>
    </main>
</div>
<?php
include '../includes/footer.php';
?>
