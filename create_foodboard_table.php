<?php
$servername = "localhost";
$username = "root";
$password = "cjswo0630";
$dbname = "mypage";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "CREATE TABLE foodboard (
id int(11) NOT NULL AUTO_INCREMENT,
aid int(11),
title varchar(50),
content text,
view int(11),
date date,
PRIMARY KEY(id)
)";

$result = mysqli_query($conn, $sql);

if($result)
	echo "foodboard created";
else
	echo "create failed";

mysqli_close($conn);
?>
