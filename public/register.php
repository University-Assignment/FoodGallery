<?php
  if ($reg_result >= 0) {
    if ($reg_result == 0)
        	echo '<div class="alert alert-success"><b>회원가입 성공!</b> 로그인 해주세요!</div>';
    else if ($reg_result == 1)
          echo '<div class="alert alert-danger"><b>회원가입 실패!</b> 정보를 다시 입력해주세요!</div>';
    else if ($reg_result == 2)
          echo '<div class="alert alert-danger"><b>회원가입 실패!</b> 아이디 중복!</div>';
  	else if ($reg_result == 3)
  			  echo '<div class="alert alert-danger"><b>별명 중복!</b> 별명을 다시 입력해주세요!</div>';
  	else if ($reg_result == 4)
  			 echo '<div class="alert alert-danger"><b>이메일 중복!</b> 이메일을 다시 입력해주세요!</div>';
  }

?>


<h2 class="text-left">회원가입</h2><hr/>
<form action="?page=register" method="POST" id="register">
	<div class="form-group">
		<label for="inputUsername">별명</label>
		<input type="text" name="nickname" maxlength="12" class="form-control" id="inputNickname" autocomplete="off" placeholder="닉네임" value="<?php echo isset($_POST['nickname']) ? $_POST['nickname'] : '' ?>" required>
	</div>
	<div class="form-group">
		<label for="inputUsername">아이디</label>
		<input type="text" name="username" maxlength="12" class="form-control" id="inputUsername" autocomplete="off" placeholder="아이디" pattern="[a-zA-Z0-9!@#]{4,12}" value="<?php echo isset($_POST['username']) ? $_POST['username'] : '' ?>" required>
	</div>
	<div class="form-group">
		<label for="inputPassword">비밀번호</label>
		<input type="password" name="password" maxlength="12" class="form-control" id="inputPassword" autocomplete="off" placeholder="비밀번호" pattern="[a-zA-Z0-9!@#]{4,12}" value="<?php echo isset($_POST['password']) ? $_POST['password'] : '' ?>" required>
	</div>
	<div class="form-group">
		<label for="inputEmail">이메일</label>
		<input type="email" name="email" class="form-control" id="inputEmail" autocomplete="off" placeholder="이메일" value="<?php echo isset($_POST['email']) ? $_POST['email'] : '' ?>" required>
	</div>
	<br/>
	<input type="submit" class="btn btn-primary" name="reg_submit" value="회원가입 &raquo;">
</form>
