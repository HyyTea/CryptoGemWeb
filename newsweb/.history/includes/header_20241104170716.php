<header>
    <nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark ">
        <div class="d-flex justify-content-between align-items-center px-2 py-2">
            <a class="navbar-brand" href="index.php">
                <img src="images/Logo.png" alt="Logo" height="100">
            </a>
            <div class="mx-auto">
                <div class="border rounded-pill d-flex align-items-center" style="padding: 10px;">
                    <ul class="navbar-nav mb-0">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="about-us.php">Airdrop</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Blockchain</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Markets</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Research</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">News</a>
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
</header>
