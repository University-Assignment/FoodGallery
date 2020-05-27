<?php
  $reg_result = -1;
  if (isset($_POST['reg_submit'])) {
    $accounts = mysqli_fetch_assoc($mysqli->query("SELECT COUNT(*) AS size FROM accounts WHERE username = '".$_POST['username']."'"));
    $nick = mysqli_fetch_assoc($mysqli->query("SELECT COUNT(*) AS size FROM accounts WHERE nickname = '".$_POST['nickname']."'"));
    $email = mysqli_fetch_assoc($mysqli->query("SELECT COUNT(*) AS size FROM accounts WHERE email = '".$_POST['email']."'"));

    if ($nick['size'] > 0)
      $reg_result = 3;
    else if ($email['size'] > 0)
      $reg_result = 4;
    else if ($accounts['size'] == 0) {
      $insert_user_query = "INSERT INTO accounts(nickname, username, password, email, admin, login) VALUES ('{$_POST['nickname']}','{$_POST['username']}', '{$_POST['password']}', '{$_POST['email']}', 0, 0)";
      $result = $mysqli->query($insert_user_query); 
      if ($result)
      	$reg_result = 0;
      else
        $reg_result = 1;
    } else
        $reg_result = 2;
  }

  $save_result = -1;
  if (isset($_POST['save_submit'])) {
    $accounts = mysqli_fetch_assoc($mysqli->query("SELECT COUNT(*) AS size FROM accounts WHERE username = '".$_POST['username']."'"));
    $nick = mysqli_fetch_assoc($mysqli->query("SELECT COUNT(*) AS size FROM accounts WHERE nickname = '".$_POST['nickname']."'"));
    $email = mysqli_fetch_assoc($mysqli->query("SELECT COUNT(*) AS size FROM accounts WHERE email = '".$_POST['email']."'"));

    if ($nick['size'] > 0 && $_POST['nickname'] != $_SESSION['nickname'])
      $save_result = 3;
    else if ($email['size'] > 0 && $_POST['email'] != $_SESSION['email'])
      $save_result = 4;
    else if ($accounts['size'] == 1) {
      $update_user_query = "UPDATE accounts SET nickname =  '".$_POST['nickname']."', password = '".$_POST['password']."', email = '".$_POST['email']."' WHERE id = ".$_SESSION['id']."";
      $result = $mysqli->query($update_user_query);
      if ($result) {
        $_SESSION['nickname'] = $_POST['nickname'];
        $_SESSION['password'] = $_POST['password'];
        $_SESSION['email'] = $_POST['email'];
      	$save_result = 0;
      } else
        $save_result = 1;
    } else
        $save_result = 2;
  }

  $login_result = -1;
  if (isset($_POST['login_submit'])) {
		$u = $mysqli->real_escape_string($_POST['username']);
		$s = $mysqli->query("SELECT * FROM `accounts` WHERE `username`='".$u."'") or die();
		$i = $s->fetch_assoc();
    if ($i['login'] == 1) {
      $login_result = 1;
    } else if($_POST['password'] == $i['password']) {
			$_SESSION['id'] = $i['id'];
			$_SESSION['nickname'] = $i['nickname'];
			$_SESSION['username'] = $i['username'];
			$_SESSION['password'] = $i['password'];
			$_SESSION['email'] = $i['email'];
			$_SESSION['admin'] = $i['admin'];

      $update_user_query = "UPDATE accounts SET login = 1 WHERE id = ".$_SESSION['id']."";
      $result = $mysqli->query($update_user_query);
		}
		else {
      $login_result = 0;
     }
	 }
?>
