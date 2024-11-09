<footer style="background-color: #FCF7F1;" class="text-dark py-4">
    <div class="px-5 py-5">
        <div class="row">
            <div class="col-lg-6 mb-4">
                <h4 style="font-family: 'Playfair Display', serif; font-size: 3rem;">SIGN UP FOR</h4>
                <p class="ml-4" style="font-family: 'Playfair Display', serif; font-size: 3rem;">OUR NEWSLETTER</p>
                
                <div class="ml-5 mt-3 d-flex align-items-center">
                    <input type="email" placeholder="YOUR EMAIL"
                           class="form-control bg-white text-dark border-0" id="newsletter-email"
                           style="width: 220px; border: none; box-shadow: none; border-bottom: 2px solid #ccc; padding: 0.5rem 0;">
                    <button class="btn" style="border: 2px solid #28a745; border-radius: 5px; background-color: white; color: #28a745; padding: 10px 20px; margin-left: 10px;" onclick="subscribeNewsletter()">
                        <span style="font-weight: bold;">→</span>
                    </button>
                </div>

                <div class="mt-3">
                    <img src="images/CryptoGem_Logo.png" width="400" alt="Logo" class="mt-4">
                </div>
            </div>

            <div class="col-lg-6 d-flex justify-content-between">
    <div class="col">
        <ul class="list-unstyled">
            <li><a target="_blank" href="about-us.php" class="text-dark hover:underline" style="font-size: 1.2rem; text-decoration: none;">About Us</a></li>
            <li><a target="_blank" href="category.php?catid=8" class="text-dark hover:underline" style="font-size: 1.2rem; text-decoration: none;">Bitcoin</a></li>
            <li><a target="_blank" href="category.php?catid=15" class="text-dark hover:underline" style="font-size: 1.2rem; text-decoration: none;">Analysis</a></li>
            <li><a target="_blank" href="category.php?catid=11" class="text-dark hover:underline" style="font-size: 1.2rem; text-decoration: none;">Market</a></li>
            <li><a target="_blank" href="category.php?catid=13" class="text-dark hover:underline" style="font-size: 1.2rem; text-decoration: none;">Indicator</a></li>
            <li><a target="_blank" href="category.php?catid=9" class="text-dark hover:underline" style="font-size: 1.2rem; text-decoration: none;">Price Action</a></li>
        </ul>
    </div>

    <div class="col">
        <ul class="list-unstyled">
            <li><a target="_blank" href="category.php?catid=12" class="text-dark hover:underline" style="font-size: 1.2rem; text-decoration: none;">Terminology</a></li>
            <li><a target="_blank" href="category.php?catid=17" class="text-dark hover:underline" style="font-size: 1.2rem; text-decoration: none;">Knowledge</a></li>
            <li><a target="_blank" href="category.php?catid=16" class="text-dark hover:underline" style="font-size: 1.2rem; text-decoration: none;">Experience</a></li>
            <li><a target="_blank" href="category.php?catid=18" class="text-dark hover:underline" style="font-size: 1.2rem; text-decoration: none;">Platform</a></li>
            <li><a target="_blank" href="category.php?catid=16" class="text-dark hover:underline" style="font-size: 1.2rem; text-decoration: none;">Investment</a></li>
            <li><a target="_blank" href="category.php?catid=10" class="text-dark hover:underline" style="font-size: 1.2rem; text-decoration: none;">Price Chart</a></li>
        </ul>
    </div>

    <div class="col">
        <ul class="list-unstyled">
            <li><a target="_blank" href="https://x.com/hyyteahwang" class="text-dark hover:underline" style="font-size: 1.2rem; text-decoration: none;">Twitter</a></li>
            <li><a target="_blank" href="https://www.facebook.com/bom.xuu" class="text-dark hover:underline" style="font-size: 1.2rem; text-decoration: none;">Facebook</a></li>
            <li><a target="_blank" href="https://www.instagram.com/_huy.hoangnhat" class="text-dark hover:underline" style="font-size: 1.2rem; text-decoration: none;">Instagram</a></li>
            <li><a target="_blank" href="https://t.me/HyyHwang" class="text-dark hover:underline" style="font-size: 1.2rem; text-decoration: none;">Telegram</a></li>
            <li><a target="_blank" href="https://www.tiktok.com/@_huy.hoangnhat" class="text-dark hover:underline" style="font-size: 1.2rem; text-decoration: none;">Tiktok</a></li>
        </ul>
    </div>
</div>

        </div>

        <!-- <div class="border-top border-dark text-center py-4 mt-4">
            <p class="mb-1">&copy; 2024 CryptoGem. All rights reserved</p>
            <div>
                <a href="#" class="text-dark hover:underline mx-2">Terms and Conditions</a>
                <a href="#" class="text-dark hover:underline mx-2">Policy Service</a>
                <a href="#" class="text-dark hover:underline mx-2">Cookie Policy</a>
            </div>
        </div> -->
    </div>
</footer>

<!-- JavaScript để gửi email -->
<script>
    function subscribeNewsletter() {
        var email = document.getElementById('newsletter-email').value;

        if (email) {
            // Gửi email tới server thông qua AJAX
            fetch('subscribe.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ email: email })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Đăng ký thành công!');
                } else {
                    alert('Có lỗi xảy ra. Vui lòng thử lại.');
                }
            })
            .catch(error => console.error('Error:', error));
        } else {
            alert('Vui lòng nhập email của bạn.');
        }
    }
</script>
