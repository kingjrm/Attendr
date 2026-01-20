<?php
include '../includes/header.php';
require_once '../config/db.php';

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    if ($username && $password) {
        $stmt = $pdo->prepare('SELECT * FROM users WHERE username = ?');
        $stmt->execute([$username]);
        $user = $stmt->fetch();
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['admin_id'] = $user['id'];
            $_SESSION['admin_name'] = $user['name'];
            header('Location: ../admin/dashboard.php');
            exit;
        } else {
            $error = 'Invalid username or password.';
        }
    } else {
        $error = 'Please enter both username and password.';
    }
}
?>
<div class="min-h-screen w-full flex items-center justify-center overflow-hidden" style="background:none;">
    <div class="w-full max-w-4xl h-[540px] bg-white rounded-2xl shadow-2xl flex overflow-hidden" style="margin-top:-80px;">
        <!-- Left: Login Form -->
        <div class="w-full md:w-1/2 flex flex-col justify-center px-6 py-6 bg-gradient-to-br from-yellow-50 to-white">
            <div class="mb-8">
                <span class="inline-block bg-white/70 px-4 py-1 rounded-full text-xs font-semibold text-gray-500 mb-2">Attendr</span>
                <h2 class="text-2xl font-bold text-gray-800 mb-2">Sign in to Attendr</h2>
                <p class="text-gray-500 text-sm mb-4">Welcome back! Please login to your account.</p>
            </div>
            <?php if ($error): ?>
                <div class="mb-4 text-red-500 text-sm"><?php echo $error; ?></div>
            <?php endif; ?>
            <form method="post" class="flex flex-col gap-4">
                <div>
                    <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                    <input type="text" name="username" id="username" class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-yellow-200 focus:outline-none bg-white" required autofocus>
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input type="password" name="password" id="password" class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-yellow-200 focus:outline-none bg-white" required>
                </div>
                <button type="submit" class="w-full py-2 mt-2 rounded-lg bg-yellow-400 hover:bg-yellow-500 text-white font-semibold shadow transition">Sign In</button>
            </form>
            <div class="mt-4 text-center">
                <a href="../participant/register.php" class="text-xs text-yellow-600 hover:underline font-semibold">Register as User</a>
            </div>
            <div class="mt-6 flex items-center justify-between text-xs text-gray-400">
                <span>© Attendr 2026</span>
                <a href="#" class="hover:underline">Terms & Conditions</a>
            </div>
        </div>
        <!-- Right: Image & Overlays -->
        <div class="hidden md:block w-1/2 relative bg-gray-100">
            <img src="https://images.unsplash.com/photo-1515378791036-0648a3ef77b2?auto=format&fit=crop&w=600&q=80" alt="Team" class="absolute inset-0 w-full h-full object-cover" />
            <!-- Overlay: Meeting bubble -->
            <div class="absolute top-6 left-6 bg-white/90 rounded-xl px-4 py-2 shadow flex items-center gap-2">
                <span class="inline-block w-2 h-2 bg-yellow-400 rounded-full"></span>
                <span class="text-xs font-semibold text-gray-700">Staff Review With Team</span>
            </div>
            <!-- Overlay: Avatars -->
            <div class="absolute top-28 left-8 flex -space-x-3">
                <img src="https://randomuser.me/api/portraits/men/32.jpg" class="w-8 h-8 rounded-full border-2 border-white" />
                <img src="https://randomuser.me/api/portraits/women/44.jpg" class="w-8 h-8 rounded-full border-2 border-white" />
                <img src="https://randomuser.me/api/portraits/men/65.jpg" class="w-8 h-8 rounded-full border-2 border-white" />
            </div>
            <!-- Overlay: Calendar -->
            <div class="absolute bottom-24 left-8 bg-white/90 rounded-xl px-4 py-2 shadow flex flex-col items-start">
                <span class="text-xs text-gray-400 mb-1">Daily Meeting</span>
                <span class="font-bold text-gray-700">Attendr</span>
                <div class="flex gap-1 mt-2">
                    <span class="w-6 h-6 flex items-center justify-center rounded bg-yellow-100 text-yellow-600 font-semibold text-xs">22</span>
                    <span class="w-6 h-6 flex items-center justify-center rounded bg-gray-100 text-gray-400 font-semibold text-xs">23</span>
                    <span class="w-6 h-6 flex items-center justify-center rounded bg-gray-100 text-gray-400 font-semibold text-xs">24</span>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include '../includes/footer.php';
?>
