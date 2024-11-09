<footer class="bg-gray-900 text-white py-8"> 
    <div class="container mx-auto px-4">
        <div class="flex flex-wrap justify-between items-center">
            <div class="w-full lg:w-1/2 mb-6 lg:mb-0">
                <h4 class="font-bold">SIGN UP FOR</h4>
                <p class="ml-4">OUR NEWSLETTER</p>
                <div class="mt-4">
                    <input type="email" placeholder="YOUR EMAIL"
                           class="p-2 rounded-l bg-gray-800 text-white focus:outline-none" id="newsletter-email">
                    <button class="bg-teal-500 p-2 rounded-r" onclick="subscribeNewsletter()">
                        <i class="fas fa-arrow-right"></i>
                    </button>
                </div>
                <div class="mt-4">
                    <img src="img/LogoW.png" width="50" alt="Logo" class="mt-4">
                </div>
            </div>

            <div class="w-full lg:w-1/2">
                <div>
                    <h4 class="font-bold mb-4">Company</h4>
                    <ul>
                        <li><a href="#" class="hover:underline">About Us</a></li>
                        <li><a href="#" class="hover:underline">CyETH Explorer</a></li>
                        <li><a href="#" class="hover:underline">CyberEx Docs</a></li>
                        <li><a href="#" class="hover:underline">CyberEx Whitepaper</a></li>
                        <li><a href="#" class="hover:underline">Risk Disclosure Policy</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-bold mb-4">Community</h4>
                    <ul>
                        <li><a href="#" class="hover:underline">X</a></li>
                        <li><a href="#" class="hover:underline">Discord</a></li>
                        <li><a href="#" class="hover:underline">Telegram</a></li>
                        <li><a href="#" class="hover:underline">Mail</a></li>
                        <li><a href="#" class="hover:underline">Phone</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-bold mb-4">Help</h4>
                    <ul>
                        <li><a href="#" class="hover:underline">News</a></li>
                        <li><a href="#" class="hover:underline">FAQ</a></li>
                        <li><a href="#" class="hover:underline">Help Center</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="border-t border-gray-700 text-center py-8 mt-8 flex flex-wrap items-center justify-between">
            <a href="admin.php" class="text-blue-600 hover:text-blue-700 text-sm font-semibold uppercase tracking-wide">
                <p class="text-left">© 2024 CryptoGem. All rights reserved</p>
            </a>
            <div class="text-right">
                <a href="#" class="hover:underline text-sm mx-2">Terms and Conditions</a>
                <a href="#" class="hover:underline text-sm mx-2">Policy Service</a>
                <a href="#" class="hover:underline text-sm mx-2">Cookie Policy</a>
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
