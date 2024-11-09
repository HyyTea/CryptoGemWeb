<header>
    <nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark ">
        <div class="d-flex justify-content-between align-items-center px-4 py-2" style="width: 100%;">
            <a class="navbar-brand" href="index.php">
                <img src="images/Logo.png" alt="Logo" height="100">
            </a>
            <div class="mx-auto">
                <div class="border rounded-pill d-flex align-items-center" style="padding: 10px;">
                    <ul class="navbar-nav mb-0">
                        <li class="nav-item" style="margin-right: 20px;">
                            <a class="nav-link text-dark <?= ($_SERVER['SCRIPT_NAME'] === '/index.php' || $_SERVER['SCRIPT_NAME'] === '/tên-thư-mục/index.php') ? 'font-weight-bold' : ''; ?>" href="index.php">Home</a>
                        </li>
                        <li class="nav-item" style="margin-right: 20px;">
                            <a class="nav-link text-dark <?= ($_SERVER['SCRIPT_NAME'] === '/about-us.php' || $_SERVER['SCRIPT_NAME'] === '/tên-thư-mục/about-us.php') ? 'font-weight-bold' : ''; ?>" href="about-us.php">Airdrop</a>
                        </li>
                        <li class="nav-item" style="margin-right: 20px;">
                            <a class="nav-link text-dark <?= ($_SERVER['SCRIPT_NAME'] === '/blockchain.php' || $_SERVER['SCRIPT_NAME'] === '/tên-thư-mục/blockchain.php') ? 'font-weight-bold' : ''; ?>" href="#">Blockchain</a>
                        </li>
                        <li class="nav-item" style="margin-right: 20px;">
                            <a class="nav-link text-dark <?= ($_SERVER['SCRIPT_NAME'] === '/markets.php' || $_SERVER['SCRIPT_NAME'] === '/tên-thư-mục/markets.php') ? 'font-weight-bold' : ''; ?>" href="#">Markets</a>
                        </li>
                        <li class="nav-item" style="margin-right: 20px;">
                            <a class="nav-link text-dark <?= ($_SERVER['SCRIPT_NAME'] === '/research.php' || $_SERVER['SCRIPT_NAME'] === '/tên-thư-mục/research.php') ? 'font-weight-bold' : ''; ?>" href="#">Research</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark <?= ($_SERVER['SCRIPT_NAME'] === '/news.php' || $_SERVER['SCRIPT_NAME'] === '/tên-thư-mục/news.php') ? 'font-weight-bold' : ''; ?>" href="#">News</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="ml-3 position-relative">
                <button class="btn btn-outline-secondary rounded-circle" type="button" id="search-button" onclick="toggleSearchInput()">
                    <i class="fas fa-search"></i>
                </button>
                <input type="text" id="search-input" class="form-control border rounded-pill position-absolute" placeholder="Search" style="display: none; right: 0; top: 50%; transform: translateY(-50%); width: 200px;" onblur="toggleSearchInput()">
            </div>
        </div>
    </nav>

    <script>
        function toggleSearchInput() {
            const input = document.getElementById('search-input');
            input.style.display = input.style.display === 'block' ? 'none' : 'block';
            if (input.style.display === 'block') {
                input.focus();
            }
        }
    </script>
    <?php
echo $_SERVER['SCRIPT_NAME'];
?>
</header>
