<?php
if (!isset($_SESSION['username'])) {
  ?>
  <script type="text/javascript">alert("회원만 댓글작성이 가능합니다!");history.go(-1);</script>
  <?php
} else {
  $nbid = $_POST['nbid'];
  $aid = $_SESSION['id'];
  $content = $_POST['b_contents'];

  $query = "INSERT into noticeboard_comment (nbid, aid, content, date) values(".$nbid.", ".$aid.", '".$content."', now())";
  $mysqli->query($query);

  header("location:?page=noticeboard_info&id=$nbid");
}
?>
