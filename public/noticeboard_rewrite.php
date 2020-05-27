
<?php

  if (isset($_POST['rewrite_submit'])) {

    $check = $mysqli->query("UPDATE noticeboard SET title = '{$_POST['title']}', content = '{$_POST['content']}' WHERE id = {$_POST['nbid']}");
    if ($check) {
      ?>
        <script type="text/javascript">alert("수정을 완료하였습니다!");</script>
    <?php
      echo "<meta http-equiv='refresh' content='0; url=?page=noticeboard_info&amp;id=".$_POST['nbid']."'>";
    } else {
      ?>
      <script type="text/javascript">alert("수정을 실패하였습니다!");history.go(-1);</script>
    <?php
    }
    exit;
  }

  $id = isset($_GET['id']) ? $_GET['id'] : "";
  $board = $mysqli->query("select * from noticeboard where id = ".$id."");

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
<div id="noticeboard_rewrite">
            <div id="rewrite_area">
                <form action="?page=noticeboard_rewrite" method="post">
                  <input type="hidden" name="nbid" value="<?php echo $id?>">
                    <div id="in_title">
                        <textarea style = "resize:none;" name="title" id="utitle" rows="1" cols="99" maxlength="100" required><?php echo $board['title']?></textarea>
                    </div>
                    <div class="wi_line"></div>
                    <div id="in_content">
                        <textarea style = "resize:none;" name="content" id="ucontent" rows="20" cols="99" required><?php echo $board['content']?></textarea>
                    </div>
                    <div class="bt_se">
                        <button type="submit" name="rewrite_submit" class="btn-lg btn-dark btn-block" style=" font-size: 13px; WIDTH: 85px; HEIGHT: 35px;">글 수정</button>
                    </div>
                </form>
            </div>
        </div>
