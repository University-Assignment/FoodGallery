<?php
$id = isset($_GET['id']) ? $_GET['id'] : -1;
if ($id >= 0) {
  $check = $mysqli->query("SELECT * FROM noticeboard WHERE aid = ".$_SESSION['id']." AND id = ".$id."");
  if ($check->num_rows > 0) {
    $sql = $mysqli->query("DELETE FROM noticeboard WHERE aid = ".$_SESSION['id']." AND id = ".$id."");
    $mysqli->query("DELETE FROM noticeboard_comment WHERE nbid = {$id}");
    if ($sql) {
      ?>
        <script type="text/javascript">alert("삭제 완료되었습니다.");</script>
    <?php
      echo "<meta http-equiv='refresh' content='0; url=?page=noticeboard'>";
    } else {
      ?>
        <script type="text/javascript">alert("삭제중 오류가 발생했습니다!");</script>
    <?php

      echo "<meta http-equiv='refresh' content='0; url=?page=noticeboard_info&amp;id=".$id."'>";
    }
  } else {
    ?>
      <script type="text/javascript">alert("작성자만 삭제 가능합니다!");</script>
  <?php
      echo "<meta http-equiv='refresh' content='0; url=?page=noticeboard_info&amp;id=".$id."'>";
  }
}
?>
