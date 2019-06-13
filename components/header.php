<header>
    <nav>
        <ul>
            <?php echo (isset($_SESSION['user']) && isset($_SESSION['active'])) ? '<li><a href="logout.php">Logout</a></li>' : null; ?>
        </ul>
    </nav>
</header>