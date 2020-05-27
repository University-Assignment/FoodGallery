<?php

if ($save_result == 0)
			echo '<div class="alert alert-success"><b>수정 성공!</b> 수정을 완료하였습니다!</div>';
else if ($save_result == 1)
			echo '<div class="alert alert-danger"><b>수정 실패1!</b> 정보를 다시 입력해주세요!</div>';
else if ($save_result == 2)
			echo '<div class="alert alert-danger"><b>수정 실패2!</b> 정보를 다시 입력해주세요!</div>';
else if ($save_result == 3)
			echo '<div class="alert alert-danger"><b>별명 중복!</b> 별명을 다시 입력해주세요!</div>';
else if ($save_result == 4)
		 echo '<div class="alert alert-danger"><b>이메일 중복!</b> 이메일을 다시 입력해주세요!</div>';

?>


<h2 class="text-left">내 정보</h2><hr/>
<form action="?page=myinfo" method="POST" id="save">
	<div class="form-group">
		<label for="inputUsername">별명</label>
		<input type="text" name="nickname" maxlength="12" class="form-control" id="inputNickname" autocomplete="off" placeholder="별명" value="<?php echo isset($_POST['nickname']) ? $_POST['nickname'] : isset($_SESSION['nickname']) ? $_SESSION['nickname'] : '' ?>" required>
	</div>
	<div class="form-group">
		<label for="inputUsername">아이디</label>
		<input type="text" name="username" maxlength="12" class="form-control" id="Username" autocomplete="off" placeholder="아이디" value="<?php echo isset($_SESSION['username']) ? $_SESSION['username'] : '' ?>" readonly>
	</div>
	<div class="form-group">
		<label for="inputPassword">비밀번호</label>
		<input type="password" name="password" maxlength="12" class="form-control" id="inputPassword" autocomplete="off" placeholder="비밀번호" pattern="[a-zA-Z0-9!@#]{4,12}" value="<?php echo isset($_POST['password']) ? $_POST['password'] : isset($_SESSION['password']) ? $_SESSION['password'] : '' ?>" required>
	</div>
	<div class="form-group">
		<label for="inputEmail">이메일</label>
		<input type="email" name="email" class="form-control" id="inputEmail" autocomplete="off" placeholder="이메일" value="<?php echo isset($_POST['email']) ? $_POST['email'] : isset($_SESSION['email']) ? $_SESSION['email'] : '' ?>" required>
	</div>
	<br/>
	<input type="submit" class="btn btn-primary" name="save_submit" value="수정하기 &raquo;">
</form>
