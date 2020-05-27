<?php


if (!isset($_SESSION['username'])) {
  ?>
  <script type="text/javascript">alert("회원만 좋아요가 가능합니다!");history.go(-1);</script>
  <?php
} else {
  $id = isset($_GET['id']) ? $_GET['id'] : -1;
  if ($id >= 0) {
    $check = $mysqli->query("SELECT * FROM foodboard WHERE id = ".$id."");
    if ($check->num_rows > 0) {
      if ($check->fetch_assoc()['aid'] == $_SESSION['id']) {
        ?>
        <script type="text/javascript">alert("본인글은 좋아요가 불가능합니다!");history.go(-1);</script>
        <?php
      } else {
        $good = $mysqli->query("SELECT * FROM foodboard_good WHERE fbid = ".$id." AND aid = ".$_SESSION['id']."")->num_rows;
        if ($good > 0) {
          $mysqli->query("DELETE FROM foodboard_good WHERE fbid = {$id} AND aid = {$_SESSION['id']}");
          $mysqli->query("UPDATE foodboard SET good = good - 1 WHERE id = {$id}");
          ?>
          <script type="text/javascript">alert("좋아요가 취소 되었습니다!");history.go(-1);</script>
          <?php
        } else {
        	$mysqli->query("INSERT INTO foodboard_good(fbid, aid) VALUES({$id}, {$_SESSION['id']})");
          $mysqli->query("UPDATE foodboard SET good = good + 1 WHERE id = {$id}");
          ?>
          <script type="text/javascript">alert("좋아요가 되었습니다!");history.go(-1);</script>
          <?php
        }
      }
    }
  }
}
?>
