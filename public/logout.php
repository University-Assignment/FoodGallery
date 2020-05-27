<?php
$update_user_query = "UPDATE accounts SET login = 0 WHERE id = ".$_SESSION['id']."";
$result = $mysqli->query($update_user_query);

$_SESSION = array();
Header("Location:index.php");
?>
