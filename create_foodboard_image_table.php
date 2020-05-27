<?php
$servername = "localhost";
$username = "root";
$password = "cjswo0630";
$dbname = "mypage";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "CREATE TABLE foodboard_image (
id int(11) NOT NULL AUTO_INCREMENT,
fbid int(11),
path varchar(255),
filename varchar(50),
PRIMARY KEY(id)
)";

$result = mysqli_query($conn, $sql);

if($result)
	echo "foodboard_image created";
else
	echo "create failed";

mysqli_close($conn);
?>
