    </main>
    <?php $is_admin = strpos($_SERVER['REQUEST_URI'], '/admin/') !== false; ?>
    <?php if (!$is_admin): ?>
    <footer class="mt-10 py-6 text-center text-xs text-gray-400">
        &copy; <?php echo date('Y'); ?> Attendr. All rights reserved.
    </footer>
    <?php endif; ?>
</body>
</html>
