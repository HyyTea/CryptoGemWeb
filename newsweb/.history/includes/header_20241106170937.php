<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            height: 2000px; /* Để tạo không gian cuộn */
        }

        #header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background-color: #343a40; /* Màu nền của navbar */
            transition: opacity 0.3s ease; /* Hiệu ứng chuyển động cho độ mờ */
            z-index: 1000; /* Đảm bảo header nằm trên các phần tử khác */
            opacity: 1; /* Mặc định là hoàn toàn nhìn thấy */
        }

        .navbar-brand img {
            height: 50px; /* Điều chỉnh chiều cao của logo trên mọi màn hình */
            max-width: 100%; /* Đảm bảo logo không bị kéo dài hoặc bị cắt khi thu nhỏ */
        }

        @media (max-width: 768px) {
    #header {
        position: relative;
        background-color: #343a40;
    }

    .navbar-toggler {
        border: none;
    }

    .navbar-collapse {
        background-color: #343a40;
    }

    .navbar-nav {
        text-align: center;
    }

    .navbar-nav .nav-link {
        color: white; /* Thêm màu chữ trắng cho các mục menu trong navbar khi trên mobile */
    }

    #search-input {
        width: 100%;
        right: 0;
        top: 50%;
        transform: translateY(-50%);
    }
}


    </style>
    <title>Header Fade Effect</title>
</head>
<body>

<header id="header">
    <nav class="navbar navbar-expand-lg fixed-top navbar-dark">
        <div class="d-flex justify-content-between align-items-center px-4 py-2" style="width: 100%;">
            <a class="navbar-brand" href="index.php">
                <img src="images/Logo.png" alt="Logo" height="100">
            </a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="mx-auto">
                <div class="rounded-pill py-2 d-flex align-items-center" style="border: none; padding: 10px; background-color: #F2F2F2;">
                    <div class="collapse navbar-collapse" id="navbarResponsive">
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
        
        // Điều chỉnh độ mờ của header
        if (scrollTop > lastScrollTop) {
            // Cuộn xuống
            header.style.opacity = '0.3'; // Đặt độ mờ khi cuộn xuống
        } else {
            // Cuộn lên
            header.style.opacity = '1'; // Đặt độ mờ trở lại hoàn toàn
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

</body>
</html>
