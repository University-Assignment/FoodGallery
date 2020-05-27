<?php

if ($_SESSION['admin'] != 1) {
  ?>
  <script type="text/javascript">alert("운영자만 알림게시판 글작성이 가능합니다!");history.go(-1);</script>
  <?php
  exit;
}

if (isset($_POST['write_submit'])) {
$date = date('Y-m-d');
$sql = $mysqli->query("insert into noticeboard(aid, title,content,view,date) values(".$_SESSION['id'].",'".$_POST['title']."','".$_POST['content']."',0,'".$date."')");
if ($sql) {
?>
<script type="text/javascript">alert("글쓰기 완료되었습니다.");</script>
<?php
} else {
?>
  <script type="text/javascript">alert("글쓰기 실패하였습니다.");</script>
<?php
}
echo "<meta http-equiv='refresh' content='0; url=?page=noticeboard'>";
}
?>


<h2 class="text-left">게시글작성</h2><hr/>
<div id="noticeboard_write">
            <div id="write_area">
                <form action="?page=noticeboard_write" method="post">
                    <div id="in_title">
                        <textarea style = "resize:none;" name="title" id="utitle" rows="1" cols="99" placeholder="제목" maxlength="100" required></textarea>
                    </div>
                    <div class="wi_line"></div>
                    <div id="in_content">
                        <textarea style = "resize:none;" name="content" id="ucontent" rows="20" cols="99" placeholder="내용" required></textarea>
                    </div>
                    <div class="bt_se">
                        <button type="submit" name="write_submit" class="btn-lg btn-dark btn-block" style=" font-size: 13px; WIDTH: 85px; HEIGHT: 35px;">글 작성</button>
                    </div>
                </form>
            </div>
        </div>
