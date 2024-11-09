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

        /* Điều chỉnh cho giao diện mobile */
        @media (max-width: 768px) {
            #header {
                position: relative;
            }

            .navbar-toggler {
                border: none;
            }

            .navbar-nav {
                text-align: center;
                width: 100%;
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
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <img src="images/logo.png" height="50" alt="Logo">
            </a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="about-us.php">Airdrop</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
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
</script>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
