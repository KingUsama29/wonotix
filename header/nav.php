<section class="header">
    <a href="index.php" class="logo"><img src="images/logo.png" alt="Logo"></a>
    <nav class="navbar">
    <?php $current = basename($_SERVER['PHP_SELF']); ?>
    <a href="index.php" class="btr text-decoration-none <?= $current == 'index.php' ? 'active' : '' ?>">Beranda</a>
    <a href="about.php" class="btr text-decoration-none <?= $current == 'about.php' ? 'active' : '' ?>">Tentang</a>
    <a href="package.php" class="btr text-decoration-none <?= $current == 'package.php' ? 'active' : '' ?>">Galeri</a>
    <a href="book.php" class="btr text-decoration-none <?= $current == 'book.php' ? 'active' : '' ?>">Pesan</a>

        <?php if (isset($_SESSION['username'])) { ?>
            <a href="logout.php" class="btr text-decoration-none">Logout</a>
        <?php } else { ?>
            <a href="login.php" class="btr text-decoration-none">Login</a>
        <?php } ?>
    </nav>
    <div id="menu-btn" class="fas fa-bars" syle=""></div>
    <?php if (isset($_SESSION['username'])) { ?>
        <h1 class="display-hp">Halo, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
    <?php } ?>

</section>
</body>
</html>
