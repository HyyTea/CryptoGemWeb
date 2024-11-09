<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>News Portal | Home Page</title>
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/modern-business.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
</head>

<body>
    <?php include('includes/header.php'); ?>

    <!-- Page Content -->
    <div class="container" style="margin-top: 4%">

        <!-- Phần 1 -->
        <div class="row mb-4 align-items-center">
            <!-- Phần bên trái chiếm 3/4 diện tích -->
            <div class="col-md-9">
                <h1 style="font-weight: bold; font-size: 36px;">We bring amazing news for your daily life.</h1>
                <p style="font-size: 16px; color: #555;">Condé Nast is one of the world's most renowned media companies creating and distributing every type of media today — print, video and film, digital, audio and social – widening our influence through technological innovation and by fully leveraging the global infrastructure we've built for over a century.</p>
            </div>
            <!-- Phần bên phải là Logo -->
            <div class="col-md-3 d-flex justify-content-center">
                <img src="path_to_logo/logo.png" alt="Logo" style="max-width: 100%; height: auto;">
            </div>
        </div>

        <!-- Phần 2 -->
        <div class="row mt-5">
            <div class="col-12 position-relative">
                <!-- Logo nằm gần hết chiều ngang của web -->
                <img src="path_to_logo/large_logo.png" alt="Large Logo" style="width: 100%; height: auto; opacity: 0.8;">
                
                <!-- Dòng chữ nằm đè lên Logo ở góc trên bên trái -->
                <div class="position-absolute" style="top: 10%; left: 5%; color: #333; max-width: 70%;">
                    <p style="font-size: 18px; font-weight: bold;">Our team of experienced journalists, researchers, and analysts is committed to providing high-quality, objective, and informative content that helps our readers make informed decisions about their investments, trading, and other crypto-related activities. We cover a wide range of topics, including the latest trends, market analysis, expert opinions, regulatory developments, and industry events.</p>
                </div>
            </div>
        </div>
    </div>

    <?php include('includes/footer.php'); ?>
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
