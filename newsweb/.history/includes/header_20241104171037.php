<div class="border rounded-pill d-flex align-items-center" style="padding: 10px;">
    <ul class="navbar-nav mb-0">
        <li class="nav-item" style="margin-right: 20px;"> <!-- Thay đổi margin ở đây -->
            <a class="nav-link text-dark <?= ($_SERVER['SCRIPT_NAME'] == '/index.php') ? 'font-weight-bold' : ''; ?>" href="index.php">Home</a>
        </li>
        <li class="nav-item" style="margin-right: 20px;">
            <a class="nav-link text-dark <?= ($_SERVER['SCRIPT_NAME'] == '/about-us.php') ? 'font-weight-bold' : ''; ?>" href="about-us.php">Airdrop</a>
        </li>
        <li class="nav-item" style="margin-right: 20px;">
            <a class="nav-link text-dark <?= ($_SERVER['SCRIPT_NAME'] == '/blockchain.php') ? 'font-weight-bold' : ''; ?>" href="#">Blockchain</a>
        </li>
        <li class="nav-item" style="margin-right: 20px;">
            <a class="nav-link text-dark <?= ($_SERVER['SCRIPT_NAME'] == '/markets.php') ? 'font-weight-bold' : ''; ?>" href="#">Markets</a>
        </li>
        <li class="nav-item" style="margin-right: 20px;">
            <a class="nav-link text-dark <?= ($_SERVER['SCRIPT_NAME'] == '/research.php') ? 'font-weight-bold' : ''; ?>" href="#">Research</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-dark <?= ($_SERVER['SCRIPT_NAME'] == '/news.php') ? 'font-weight-bold' : ''; ?>" href="#">News</a>
        </li>
    </ul>
</div>
