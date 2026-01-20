<?php
include '../includes/header.php';
require_once '../config/db.php';

$error = '';
$success = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm = $_POST['confirm'] ?? '';
    if ($name && $email && $username && $password && $confirm) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = 'Invalid email address.';
        } elseif ($password !== $confirm) {
            $error = 'Passwords do not match.';
        } else {
            $stmt = $pdo->prepare('SELECT id FROM users WHERE username = ? OR email = ?');
            $stmt->execute([$username, $email]);
            if ($stmt->fetch()) {
                $error = 'Username or email already exists.';
            } else {
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $pdo->prepare('INSERT INTO users (name, email, username, password, role, created_at) VALUES (?, ?, ?, ?, ?, NOW())');
                $stmt->execute([$name, $email, $username, $hash, 'user']);
                $success = 'Registration successful! You can now <a href="/Attendr/auth/login.php" class="text-yellow-600 underline">login</a>.';
            }
        }
    } else {
        $error = 'Please fill in all fields.';
    }
}
?>
<div class="min-h-screen w-full flex items-center justify-center overflow-hidden" style="background:none;">
    <div class="w-full max-w-lg bg-white rounded-2xl shadow-2xl flex flex-col justify-center px-8 py-10 my-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-2">Register for Attendr</h2>
        <p class="text-gray-500 text-sm mb-4">Create your account to join events.</p>
        <?php if ($error): ?>
            <div class="mb-4 text-red-500 text-sm"><?php echo $error; ?></div>
        <?php elseif ($success): ?>
            <div class="mb-4 text-green-600 text-sm"><?php echo $success; ?></div>
        <?php endif; ?>
        <form method="post" class="flex flex-col gap-4">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                <input type="text" name="name" id="name" class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-yellow-200 focus:outline-none bg-white" required>
            </div>
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" name="email" id="email" class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-yellow-200 focus:outline-none bg-white" required>
            </div>
            <div>
                <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                <input type="text" name="username" id="username" class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-yellow-200 focus:outline-none bg-white" required>
            </div>
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input type="password" name="password" id="password" class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-yellow-200 focus:outline-none bg-white" required>
            </div>
            <div>
                <label for="confirm" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
                <input type="password" name="confirm" id="confirm" class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-yellow-200 focus:outline-none bg-white" required>
            </div>
            <button type="submit" class="w-full py-2 mt-2 rounded-lg bg-yellow-400 hover:bg-yellow-500 text-white font-semibold shadow transition">Register</button>
        </form>
        <div class="mt-4 text-center text-sm">
            Already have an account? <a href="/Attendr/auth/login.php" class="text-yellow-600 hover:underline font-semibold">Login</a>
        </div>
    </div>
</div>
<?php
include '../includes/footer.php';
?>
