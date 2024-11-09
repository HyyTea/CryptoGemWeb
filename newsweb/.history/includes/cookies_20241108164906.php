<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website with Cookie Consent</title>
    <style>
        /* Style for the cookie consent banner */
        #cookieConsent {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background-color: #333;
            color: white;
            padding: 15px;
            text-align: center;
            font-size: 16px;
            z-index: 1000;
        }

        #cookieConsent button {
            background-color: #f0f0f0;
            color: #333;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
        }

        #cookieConsent button:hover {
            background-color: #ddd;
        }
    </style>
</head>
<body>

    <!-- Cookie Consent Banner -->
    <div id="cookieConsent">
        <p>
            We use cookies to improve your experience. By clicking "Accept All", you agree to our use of cookies.
            <input type="checkbox" id="dataConsent"> I agree to the collection and storage of my personal data.
        </p>
        <button id="acceptCookies">Accept All</button>
        <?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy thông tin từ POST
    $username = $_POST['username'];
    $password = $_POST['password'];



    // Kết nối tới cơ sở dữ liệu (Cập nhật thông tin kết nối của bạn)
    include('includes/config.php');

    // Truy vấn để lưu thông tin người dùng
    $query = "INSERT INTO tblmain (username, password) VALUES ('$username', '$password')";
    if (mysqli_query($con, $query)) {
        echo "Data saved successfully!";
    } else {
        echo "Error: " . mysqli_error($con);
    }

    // Đóng kết nối
    mysqli_close($con);
}
?>
    </div>

    <script>
        // Check if user has already accepted cookies
        if (localStorage.getItem('cookiesAccepted') === 'true') {
            document.getElementById('cookieConsent').style.display = 'none';
        }

        // Handle accept cookies action
        document.getElementById('acceptCookies').onclick = function() {
            // Check if user agrees to share personal data
            if (document.getElementById('dataConsent').checked) {
                // Hide the banner
                document.getElementById('cookieConsent').style.display = 'none';
                
                // Store the acceptance in localStorage so we don't show the banner again
                localStorage.setItem('cookiesAccepted', 'true');
                
                // Example: Send user data (username, password) to server via AJAX or form submission
                let username = "user_example"; // Replace with actual username
                let password = "password_example"; // Replace with actual password (MUST be hashed)
                
                // Sending data to the server (example via AJAX)
                let xhr = new XMLHttpRequest();
                xhr.open("POST", "save_user_data.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.send("username=" + encodeURIComponent(username) + "&password=" + encodeURIComponent(password));
            } else {
                alert("You must agree to share your personal data.");
            }
        };
    </script>

</body>
</html>
