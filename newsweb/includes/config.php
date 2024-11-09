<?php
define('DB_SERVER','localhost');
define('DB_USER','root');
define('DB_PASS','');
define('DB_NAME','newsweb');
$con = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
// Check Connection
if (mysqli_connect_errno())
{
    echo "Failed to Connect to MySQL: " . mysqli_connect_error();
}
?>