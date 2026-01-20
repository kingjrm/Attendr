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
<div class="max-w-sm mx-auto mt-20 p-8 bg-white shadow-soft rounded-soft">
    <h2 class="text-xl font-semibold mb-4 text-indigo-700">Admin Login</h2>
    <?php if ($error): ?>
        <div class="mb-4 text-red-500 text-sm"><?php echo $error; ?></div>
    <?php endif; ?>
    <form method="post" class="flex flex-col gap-4">
        <div>
            <label for="username">Username</label>
            <input type="text" name="username" id="username" class="w-full" required autofocus>
        </div>
        <div>
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="w-full" required>
        </div>
        <button type="submit" class="w-full py-2 px-4 bg-indigo-600 text-white rounded-soft shadow-soft hover:bg-indigo-700 transition">Login</button>
    </form>
</div>
<?php
include '../includes/footer.php';
?>
