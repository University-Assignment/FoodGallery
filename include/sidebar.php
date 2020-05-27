<div class="card">

<?php
	if ($login_result == 0) {
			 echo '<div class="alert alert-danger"><b>로그인 실패!</b> 정보를 다시 입력해주세요!</div>';
	} else if ($login_result == 1) {
			 echo '<div class="alert alert-danger"><b>로그인중인 아이디입니다!</b> 나중에 다시 시도해주세요!</div>';
	}

$links = "";
if ($_SESSION['admin'] == 1) {
	$links .= "<li class=\"list-group-item\"><a href=\"?base=admin\">관리</a></li>";
}

if(isset($_SESSION['username'])) {
?>
	<div class="card-header"><?php echo $_SESSION['nickname'];?> 님</div>
	<ul class="list-group list-group-flush">
		<?php echo $links;?>
		<li class="list-group-item"><a href="?page=myinfo">내 정보</a></li>
		<li class="list-group-item"><a href="?page=logout">로그아웃</a></li>
	</ul>
<?php
} else {
?>
	<div class="card-body">
		<form action="?page=home" method="POST" id="loginform" autocomplete="off">
			<div class="form-group">
				<input type="text" name="username" maxlength="12" class="form-control" placeholder="아이디" id="username" required/>
			</div>
			<div class="form-group">
				<input type="password" name="password" maxlength="12" class="form-control" placeholder="비밀번호" id="password" required/>
			</div>
			<input id="login" name="login_submit" type="submit" class="btn btn-dark btn-sm btn-block" value="로그인"/>
		</form>
		<div id="message"></div>
	</div>
<?php
}
?>
</div>
<div class="card mt-4 mb-4">
	<div class="card-header">사이트 정보</div>
	<div class="card-body">
		회원수: <b>
			<?php
				$accounts_cnt = $mysqli->query("SELECT * FROM accounts")->num_rows;
				echo $accounts_cnt;
			?></b><br/>
		<hr/>
		접속자수: <b>
			<?php
				$login_cnt = $mysqli->query("SELECT * FROM accounts WHERE login = 1")->num_rows;
				echo $login_cnt;
			?></b><br/>
		<hr/>
		음식수: <b>
			<?php
				$food_cnt = $mysqli->query("SELECT * FROM foodboard")->num_rows;
				echo $food_cnt;
			?></b><br/>
		<hr/>
	</div>
</div>
