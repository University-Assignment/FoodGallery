<?php

if (!isset($_SESSION['username'])) {
  ?>
  <script type="text/javascript">alert("회원만 댓글작성이 가능합니다!");history.go(-1);</script>
  <?php
} else {
  $fbid = $_POST['fbid'];
  $aid = $_SESSION['id'];
  $content = $_POST['b_contents'];

  $query = "INSERT into foodboard_comment (fbid, aid, content, date) values(".$fbid.", ".$aid.", '".$content."', now())";
  $mysqli->query($query);

  header("location:?page=foodboard_info&id=$fbid");
}
?>
