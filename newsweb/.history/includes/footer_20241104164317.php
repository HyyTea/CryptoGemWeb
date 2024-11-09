<footer style="background-color: #FCF7F1;" class="text-dark py-4">
    <div class="px-5">
        <div class="row">
            <div class="col-lg-6 mb-4">
                <h4 style="font-family: 'Playfair Display', serif; font-size: 3rem;">SIGN UP FOR</h4>
                <p class="ml-4" style="font-family: 'Playfair Display', serif; font-size: 3rem;">OUR NEWSLETTER</p>
                <div class="input-group mt-3">
                    <input type="email" placeholder="YOUR EMAIL"
                           class="form-control bg-light text-dark border-0" id="newsletter-email" style="border: none; box-shadow: none;">
                    <div class="input-group-append">
                        <button class="btn btn-success" onclick="subscribeNewsletter()">
                            <i class="fas fa-arrow-right"></i>
                        </button>
                    </div>
                </div>
                <div class="mt-3">
                    <img src="img/LogoW.png" width="50" alt="Logo" class="mt-4">
                </div>
            </div>

            <div class="col-lg-6 d-flex justify-content-between">
                <div class="col">
                    <h4 class="font-weight-bold mb-3">Company</h4>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-dark hover:underline">About Us</a></li>
                        <li><a href="#" class="text-dark hover:underline">CyETH Explorer</a></li>
                        <li><a href="#" class="text-dark hover:underline">CyberEx Docs</a></li>
                        <li><a href="#" class="text-dark hover:underline">CyberEx Whitepaper</a></li>
                        <li><a href="#" class="text-dark hover:underline">Risk Disclosure Policy</a></li>
                    </ul>
                </div>

                <div class="col">
                    <h4 class="font-weight-bold mb-3">Community</h4>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-dark hover:underline">X</a></li>
                        <li><a href="#" class="text-dark hover:underline">Discord</a></li>
                        <li><a href="#" class="text-dark hover:underline">Telegram</a></li>
                        <li><a href="#" class="text-dark hover:underline">Mail</a></li>
                        <li><a href="#" class="text-dark hover:underline">Phone</a></li>
                    </ul>
                </div>

                <div class="col">
                    <h4 class="font-weight-bold mb-3">Help</h4>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-dark hover:underline">News</a></li>
                        <li><a href="#" class="text-dark hover:underline">FAQ</a></li>
                        <li><a href="#" class="text-dark hover:underline">Help Center</a></li>
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
