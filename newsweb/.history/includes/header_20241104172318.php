<header id="header">
    <nav class="navbar navbar-expand-lg fixed-top navbar-dark">
        <div class="d-flex justify-content-between align-items-center px-4 py-2" style="width: 100%;">
            <a class="navbar-brand" href="index.php">
                <img src="images/Logo.png" alt="Logo" height="100">
            </a>
            <div class="mx-auto">
                <div class="rounded-pill py-2 d-flex align-items-center" style="border: none; padding: 10px; background-color: #F2F2F2">
                    <ul class="navbar-nav mb-0">
                        <li class="nav-item" style="margin-right: 20px;">
                            <a class="nav-link text-dark" href="index.php">Home</a>
                        </li>
                        <li class="nav-item" style="margin-right: 20px;">
                            <a class="nav-link text-dark" href="about-us.php">Airdrop</a>
                        </li>
                        <li class="nav-item" style="margin-right: 20px;">
                            <a class="nav-link text-dark" href="#">Blockchain</a>
                        </li>
                        <li class="nav-item" style="margin-right: 20px;">
                            <a class="nav-link text-dark" href="#">Markets</a>
                        </li>
                        <li class="nav-item" style="margin-right: 20px;">
                            <a class="nav-link text-dark" href="#">Research</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="#">News</a>
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
</header>

<script>
    let lastScrollTop = 0; // Vị trí cuộn cuối cùng
    const header = document.getElementById('header');

    window.addEventListener('scroll', function() {
        const scrollTop = window.pageYOffset || document.documentElement.scrollTop; // Vị trí cuộn hiện tại
        
        if (scrollTop > lastScrollTop) {
            // Cuộn xuống
            header.style.top = '-100px'; // Ẩn header
        } else {
            // Cuộn lên
            header.style.top = '0'; // Hiện header
        }
        lastScrollTop = scrollTop; // Cập nhật vị trí cuộn cuối cùng
    });

    function toggleSearchInput() {
        const input = document.getElementById('search-input');
        input.style.display = input.style.display === 'block' ? 'none' : 'block';
        if (input.style.display === 'block') {
            input.focus();
        }
    }
</script>
