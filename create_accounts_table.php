<?php
$servername = "localhost";
$username = "root";
$password = "cjswo0630";
$dbname = "mypage";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "CREATE TABLE accounts(
id INT NOT NULL AUTO_INCREMENT,
nickname varchar(12),
username varchar(12),
password varchar(12),
email varchar(30),
admin tinyint(1) NOT NULL DEFAULT 0,
PRIMARY KEY(id)
)";

$result = mysqli_query($conn, $sql);

if($result)
	echo "accounts created";
else
	echo "create failed";

mysqli_close($conn);
?>
