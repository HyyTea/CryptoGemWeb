<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>News Portal | Home Page</title>

    <!-- External CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/modern-business.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">

    <!-- Inline CSS -->
    <style>
        .section-one {
            background: linear-gradient(to right, #ffffff, #e0f7fa);
            padding: 40px;
            border-radius: 10px;
        }

        .gradient-text {
            background: linear-gradient(to right, #FFD700, #1a2E51);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-weight: bold;
            color: transparent; /* Fallback color */
        }

        .team-card img {
            width: 100%;
            height: auto;
            object-fit: cover;
        }

        .team-card {
            text-align: left;
        }

        .team-card .name {
            margin-top: 10px;
            font-weight: 500;
            font-size: 20px;
            color: black;
        }

        .team-card .role {
            font-size: 14px;
            color: gray;
        }

        .testimonial-card {
            background-color: #f0f0f0;
            border-radius: 20px;
            padding: 20px;
        }

        .testimonial-card p {
            font-size: 16px;
        }

        .testimonial-card .author {
            font-size: 14px;
            color: gray;
            font-style: italic;
        }

        .post-header img {
            max-height: 450px;
            object-fit: cover;
            border-radius: 25px;
        }

        .post-header h2 {
            text-align: center;
            font-size: 36px;
            font-weight: bold;
            color: white;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .post-header .btn {
            background-color: white;
            border-radius: 25px;
            padding: 10px 20px;
        }

        /* CSS cho tiêu đề và đoạn mô tả */
        .section-one h1 {
            font-size: 120px; /* Kích thước chữ trên desktop */
            font-weight: bold;
        }

        .section-one p {
            font-size: 18px; /* Kích thước chữ đoạn văn bản trên desktop */
            color: #555;
        }

        .row.position-relative img {
    opacity: 0.8;
}

.position-absolute p {
    font-size: 18px;
    font-weight: bold;
    color: #333;
    max-width: 70%;
}
        /* Điều chỉnh giao diện cho màn hình nhỏ hơn 768px (mobile) */
        @media (max-width: 768px) {
            .section-one .row {
                flex-direction: column-reverse; /* Đưa phần hình ảnh xuống dưới phần nội dung */
                padding: 20px; /* Giảm khoảng cách padding */
                text-align: center; /* Căn giữa nội dung */
            }

            .section-one h1 {
                font-size: 35px; /* Giảm kích thước tiêu đề cho mobile */
                line-height: 1.2; /* Điều chỉnh khoảng cách dòng */
            }

            .section-one p {
                font-size: 16px; /* Giảm kích thước chữ đoạn văn bản */
            }

            .section-one img {
                max-width: 60%; /* Giảm kích thước hình ảnh cho mobile */
            }
        }

        #about1 {
            text-align: center;
        }

        /* Điều chỉnh cho màn hình di động */
        @media (max-width: 768px) {
            .row.position-relative {
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .position-absolute {
                top: 20%; /* Điều chỉnh vị trí văn bản cho hợp lý trên mobile */
                left: 5%;
                right: 5%;
                text-align: center; /* Căn giữa đoạn văn */
                max-width: 90%; /* Giảm kích thước văn bản cho mobile */
            }

            .position-absolute p {
                font-size: 16px; /* Giảm kích thước font-size cho mobile */
                max-width: 100%; /* Giảm độ rộng tối đa */
            }

            .about {
                flex-direction: column; /* Xếp các cột thành hàng cho mobile */
            }

            .about {
                width: 100%; /* Mỗi cột chiếm 100% chiều rộng màn hình */
                margin-bottom: 20px; /* Thêm khoảng cách giữa các cột */
            }

            .about h3 {
                font-size: 20px; /* Giảm kích thước tiêu đề cho mobile */
            }

            .about p {
                font-size: 14px; /* Giảm kích thước văn bản cho mobile */
            }
        }
    </style>
</head>

<body>
    <?php include('includes/header.php'); ?>

    <!-- Main Content -->
    <div style="margin-top: 4%">

        <!-- Section 1: Intro -->
        <div class="section-one mb-5">
            <div class="row align-items-center px-5 py-5">
                <div class="col-md-7">
                    <h1 style="font-weight: bold;">
                        We bring <span class="gradient-text">amazing</span> news for your daily life<span class="gradient-text">.</span>
                    </h1>
                    <p class="mt-5" style="color: #555;">
                        Condé Nast is one of the world's most renowned media companies creating and distributing every type of media today — print, video and film, digital, audio and social – widening our influence through technological innovation and by fully leveraging the global infrastructure we've built for over a century. 
                    </p>
                </div>
                <div class="col-md-5 d-flex justify-content-center">
                    <img src="images/Logo.png" alt="News Portal Logo" class="img-fluid">
                </div>
            </div>
        </div>

        <!-- Section 2: About Us -->
        <div class="px-5 py-5">
            <div class="row position-relative">
                <img src="images/CryptoGem_Logo.png" alt="CryptoGem Logo" class="img-fluid" style="opacity: 0.8;">
                <div class="position-absolute" style="top: 5%; left: 35%; right: 5%; color: #333; max-width: 70%;">
                    <p style="font-size: 18px; font-weight: bold;">
                        Our team of experienced journalists, researchers, and analysts is committed to providing high-quality, objective, and informative content that helps our readers make informed decisions about their investments, trading, and other crypto-related activities. We cover a wide range of topics, including the latest trends, market analysis, expert opinions, regulatory developments, and industry events.
                    </p>
                </div>
            </div>

            <!-- Why Us Section -->
            <div id="about1" class="about mt-5 mb-5">
                <h3 style="font-weight: bold;">WHY US?</h3>
                <p class="mt-4" style="color: #555;">
                    We also believe in the importance of community building and education. We provide a platform for our readers to engage with each other, share ideas, and learn from experts in the field. Our community includes investors, traders, developers, entrepreneurs, and anyone else who is interested in the world of crypto.
                </p>
            </div>

            <!-- Our Vision and Mission -->
            <div class="about row mt-5">
                <div class="col-md-6">
                    <h3 style="font-weight: bold;">OUR VISION</h3>
                    <p class="mt-4" style="color: #555;">
                        Our goal is to be the most trusted and reliable source of crypto news and insights in the world. We are committed to maintaining the highest standards of journalistic integrity, transparency, and accuracy. We strive to deliver content that is not only informative but also engaging and easy to understand.
                    </p>
                </div>
                <div class="col-md-6">
                    <h3 style="font-weight: bold;">OUR MISSION</h3>
                    <p class="mt-4" style="color: #555;">
                        At CryptoGem, we are passionate about the potential of blockchain technology and cryptocurrencies to transform the world. We believe that this innovative technology has the power to disrupt traditional industries, create new opportunities for businesses and individuals, and promote financial inclusion and empowerment.
                    </p>
                </div>
            </div>
        </div>

        <!-- Meet the Teams -->
        <div class="px-5 py-5 text-center">
            <h2 style="font-weight: bold;">MEET THE TEAMS</h2>
            <p class="mt-4" style="color: #555;">
                Our team is a family dedicated to curating memorable experiences for our guests. With a passion for hospitality and community, we take pride in making your stay exceptional.
            </p>

            <div class="d-flex justify-content-between mt-5">
                <!-- Team Member Cards -->
                <div class="team-card">
                    <img src="admin/mainpostimages/Category1.jpg" alt="George Cr.">
                    <div class="name">George Cr.</div>
                    <div class="role">CEO</div>
                </div>

                <div class="team-card">
                    <img src="admin/mainpostimages/Category2.jpg" alt="Sarah Lee">
                    <div class="name">Sarah Lee</div>
                    <div class="role">Knowledge Manager</div>
                </div>

                <div class="team-card">
                    <img src="admin/mainpostimages/Category3.jpg" alt="John Doe">
                    <div class="name">John Doe</div>
                    <div class="role">Head of Experience</div>
                </div>

                <div class="team-card">
                    <img src="admin/mainpostimages/Category4.jpg" alt="Alex Smith">
                    <div class="name">Alex Smith</div>
                    <div class="role">Chief Analyst</div>
                </div>
                
                <div class="team-card">
                    <img src="admin/mainpostimages/Category4.jpg" alt="Alex Smith">
                    <div class="name">Alex Smith</div>
                    <div class="role">Chief Analyst</div>
                </div>

                <div class="team-card">
                    <img src="admin/mainpostimages/Category4.jpg" alt="Alex Smith">
                    <div class="name">Alex Smith</div>
                    <div class="role">Chief Analyst</div>
                </div>
            </div>

            <div class="d-flex justify-content-between mt-5">
                <!-- Team Member Cards -->
                <div class="team-card">
                    <img src="admin/mainpostimages/Category1.jpg" alt="George Cr.">
                    <div class="name">George Cr.</div>
                    <div class="role">CEO</div>
                </div>

                <div class="team-card">
                    <img src="admin/mainpostimages/Category2.jpg" alt="Sarah Lee">
                    <div class="name">Sarah Lee</div>
                    <div class="role">Knowledge Manager</div>
                </div>

                <div class="team-card">
                    <img src="admin/mainpostimages/Category3.jpg" alt="John Doe">
                    <div class="name">John Doe</div>
                    <div class="role">Head of Experience</div>
                </div>

                <div class="team-card">
                    <img src="admin/mainpostimages/Category4.jpg" alt="Alex Smith">
                    <div class="name">Alex Smith</div>
                    <div class="role">Chief Analyst</div>
                </div>
                
                <div class="team-card">
                    <img src="admin/mainpostimages/Category4.jpg" alt="Alex Smith">
                    <div class="name">Alex Smith</div>
                    <div class="role">Chief Analyst</div>
                </div>

                <div class="team-card">
                    <img src="admin/mainpostimages/Category4.jpg" alt="Alex Smith">
                    <div class="name">Alex Smith</div>
                    <div class="role">Chief Analyst</div>
                </div>
            </div>
        </div>

        <!-- Testimonials -->
        <div class="px-5 py-5">
            <h2 style="font-weight: bold;" class="text-center mb-4">WHAT OUR GUESTS ARE SAYING</h2>
            <p class="text-center mb-4" style="color: #555;">
                Curious about the experiences at CryptoGem? Discover firsthand what our guests are saying.
            </p>
            <div class="d-flex justify-content-between">
                <div class="col-md-4">
                    <div class="testimonial-card">
                        “Our stay at OakHill was magical. Cozy rooms, breathtaking views, and attentive staff. A hidden gem we'll definitely revisit. Thank you for an unforgettable escape.”
                        <div class="author text-right">- Chief Analyst</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="testimonial-card">
                        “Our stay at OakHill was magical. Cozy rooms, breathtaking views, and attentive staff. A hidden gem we'll definitely revisit. Thank you for an unforgettable escape.”
                        <div class="author text-right">- Chief Analyst</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="testimonial-card">
                        “Our stay at OakHill was magical. Cozy rooms, breathtaking views, and attentive staff. A hidden gem we'll definitely revisit. Thank you for an unforgettable escape.”
                        <div class="author text-right">- Chief Analyst</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Post Header -->
        <div class="px-5 py-5">
            <div class="post-header position-relative">
                <img src="admin/mainpostimages/Category5.jpg" alt="Memorable Moments" class="card-img-top">
                <h2>Let's Connect and Create Memorable Moments Together</h2>
                <div class="position-absolute" style="top: 70%; left: 50%; transform: translateX(-50%);">
                    <a href="https://facebook.com" target="_blank" class="btn rounded-pill">Contact Us</a>
                </div>
            </div>
        </div>

    </div>

    <?php include('includes/footer.php'); ?>

    <!-- External JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>
