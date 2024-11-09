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
                    <img src="images/CryptoGem_Logo.png" width="500" alt="Logo" class="mt-4">
                </div>
            </div>

            <div class="col-lg-6 d-flex justify-content-between">
    <div class="col">
        <h4 class="font-weight-bold mb-3" style="font-size: 1.5rem;">Company</h4>
        <ul class="list-unstyled">
            <li><a href="#" class="text-dark hover:underline" style="font-size: 1.2rem;">About Us</a></li>
            <li><a href="#" class="text-dark hover:underline" style="font-size: 1.2rem;">CyETH Explorer</a></li>
            <li><a href="#" class="text-dark hover:underline" style="font-size: 1.2rem;">CyberEx Docs</a></li>
            <li><a href="#" class="text-dark hover:underline" style="font-size: 1.2rem;">CyberEx Whitepaper</a></li>
            <li><a href="#" class="text-dark hover:underline" style="font-size: 1.2rem;">Risk Disclosure Policy</a></li>
        </ul>
    </div>

    <div class="col">
        <h4 class="font-weight-bold mb-3" style="font-size: 1.5rem;">Community</h4>
        <ul class="list-unstyled">
            <li><a href="#" class="text-dark hover:underline" style="font-size: 1.2rem;">X</a></li>
            <li><a href="#" class="text-dark hover:underline" style="font-size: 1.2rem;">Discord</a></li>
            <li><a href="#" class="text-dark hover:underline" style="font-size: 1.2rem;">Telegram</a></li>
            <li><a href="#" class="text-dark hover:underline" style="font-size: 1.2rem;">Mail</a></li>
            <li><a href="#" class="text-dark hover:underline" style="font-size: 1.2rem;">Phone</a></li>
        </ul>
    </div>

    <div class="col">
        <h4 class="font-weight-bold mb-3" style="font-size: 1.5rem;">Help</h4>
        <ul class="list-unstyled">
            <li><a href="#" class="text-dark hover:underline" style="font-size: 1.2rem;">News</a></li>
            <li><a href="#" class="text-dark hover:underline" style="font-size: 1.2rem;">FAQ</a></li>
            <li><a href="#" class="text-dark hover:underline" style="font-size: 1.2rem;">Help Center</a></li>
        </ul>
    </div>
</div>

        </div>

        <div class="border-top border-dark text-center py-4 mt-4">
            <p class="mb-1">&copy; 2024 CryptoGem. All rights reserved</p>
            <div>
                <a href="#" class="text-dark hover:underline mx-2">Terms and Conditions</a>
                <a href="#" class="text-dark hover:underline mx-2">Policy Service</a>
                <a href="#" class="text-dark hover:underline mx-2">Cookie Policy</a>
            </div>
        </div>
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
