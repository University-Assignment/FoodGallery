<?php

if (isset($_POST['food_submit'])) {

	$path = $_SERVER['DOCUMENT_ROOT'].'/foodboard_image/';
	$ext = array_pop(explode(".", strtolower($_FILES['imageform']['name'])));
	$filename = date("YmdHis").".".$ext;

	if ($ext != 'jpg' && $ext != 'jpeg' && $ext != 'png') {
		?>
		<script type="text/javascript">alert("사진파일이 아닙니다.");history.go(-1);</script>
		<?php
	} else {
		$sql = $mysqli->query("insert into foodboard(aid, title, content, view, date, good) values(".$_SESSION['id'].",'".$_POST['title']."','".$_POST['content']."',0,'".date('Y-m-d')."',0)");

		$fbid = $mysqli->insert_id;

		move_uploaded_file($_FILES['imageform']['tmp_name'], $path.$filename);

		$query = "insert into foodboard_image (fbid,path,filename) values (".$fbid.", '".$path."','".$filename."')";

		$mysqli->query($query);
		if ($sql) {
		?>
		<script type="text/javascript">alert("글쓰기 완료되었습니다.");</script>
		<?php
		} else {
		?>
		  <script type="text/javascript">alert("글쓰기 실패하였습니다.");</script>
		<?php
		}
	}
	echo "<meta http-equiv='refresh' content='0; url=?page=foodboard'>";
}
?>
<h2 class="text-left">게시글작성</h2><hr/>
<div id="foodboard_write">
	<form enctype="multipart/form-data" name="form" method="post" action="?page=foodboard_write">
		<div>
				<textarea style = "resize:none;" name="title" rows="1" cols="99" placeholder="제목" maxlength="100" required></textarea>
		</div>
		<div>
				<textarea style = "resize:none;" name="content" rows="20" cols="99" placeholder="내용" required></textarea>
		</div>
		<div>
				<input type="file" name="imageform" />
		</div>
		</br>
		<div>
				<button type="submit" name="food_submit" class="btn-lg btn-dark btn-block" style=" font-size: 13px; WIDTH: 85px; HEIGHT: 35px;">글 작성</button>
		</div>
	</form>
</div>
