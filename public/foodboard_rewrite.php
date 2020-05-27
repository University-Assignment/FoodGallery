
<?php

  if (isset($_POST['rewrite_submit'])) {


		if (isset($_FILES['imageform']['name'])) {
			$path = $_SERVER['DOCUMENT_ROOT'].'/foodboard_image/';
			$ext = array_pop(explode(".", strtolower($_FILES['imageform']['name'])));
			$filename = date("YmdHis").".".$ext;

			if ($ext != 'jpg' && $ext != 'jpeg' && $ext != 'png') {
				?>
				<script type="text/javascript">alert("사진파일이 아닙니다.");history.go(-1);</script>
				<?php
			} else {
				$fbid = $_POST['fbid'];
				move_uploaded_file($_FILES['imageform']['tmp_name'], $path.$filename);

				$query = "UPDATE foodboard_image SET filename = '{$filename}' WHERE fbid = {$fbid}";
				$mysqli->query($query);
			}
		}
		$check = $mysqli->query("UPDATE foodboard SET title = '{$_POST['title']}', content = '{$_POST['content']}' WHERE id = {$_POST['fbid']}");
		if ($check) {
      ?>
        <script type="text/javascript">alert("수정을 완료하였습니다!");</script>
    <?php
      echo "<meta http-equiv='refresh' content='0; url=?page=foodboard_info&amp;id=".$_POST['fbid']."'>";
    } else {
      ?>
      <script type="text/javascript">alert("수정을 실패하였습니다!");history.go(-1);</script>
    <?php
    }
    exit;
  }

  $id = isset($_GET['id']) ? $_GET['id'] : "";
  $board = $mysqli->query("select * from foodboard where id = ".$id."");

  if ($board->num_rows > 0) {
      $board = $board->fetch_assoc();
      if ($_SESSION['id'] != $board['aid']) {
        ?>
          <script type="text/javascript">alert("본인글만 수정가능합니다.");history.go(-1);</script>
        <?php
        exit;
      }
  } else {
    ?>
      <script type="text/javascript">alert("오류 발생.");history.go(-1);</script>
    <?php
    exit;
  }
?>


<h2 class="text-left">게시글수정</h2><hr/>
<div id="foodboard_rewrite">
	<form enctype="multipart/form-data" name="form" method="post" action="?page=foodboard_rewrite">
		<input type="hidden" name="fbid" value="<?php echo $id?>">
		<div>
				<textarea style = "resize:none;" name="title" rows="1" cols="99" maxlength="100" required><?php echo $board['title'] ?></textarea>
		</div>
		<div>
				<textarea style = "resize:none;" name="content" rows="20" cols="99" required><?php echo $board['content'] ?></textarea>
		</div>
		<div>
				<input type="file" name="imageform" />사진을 변경하실 경우 사진을 첨부 해주세요.
		</div>
		</br>
		<div>
				<button type="submit" name="rewrite_submit" class="btn-lg btn-dark btn-block" style=" font-size: 13px; WIDTH: 85px; HEIGHT: 35px;">글 수정</button>
		</div>
	</form>
</div>
