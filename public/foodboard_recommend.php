<?php

if (!isset($_SESSION['username'])) {
  ?>
  <script type="text/javascript">alert("회원만 이용가능합니다!");history.go(-1);</script>
  <?php
    exit;
}

$foodlist = array();
$image = $mysqli->query("select * from foodboard_image");

if ($image->num_rows > 0) {
  while ($result = $image->fetch_assoc()) {
    array_push($foodlist, $result['filename']);
  }
}
$selected = -1;
if (isset($_POST['recommend_submit'])) {
  $selected = array_rand($foodlist);
}

?>

<h2 class="text-left">음식추천</h2><hr/>
<form method="post" action="?page=foodboard_recommend">
  <?php
  if ($selected >= 0) {
    $board = $mysqli->query("select * from foodboard_image where filename = '{$foodlist[$selected]}'")->fetch_assoc();
   ?>
   <a href='?page=foodboard_info&amp;id=<?php echo $board['fbid']?>'><img style="display: block; margin-left: auto; margin-right: auto;" width = "300" height = "250" src="http://221.160.185.63/foodboard_image/<?php echo $foodlist[$selected] ?>"></a>
  <?php
  }
  ?>
<br/>
  <div align="center">
      <button  type="submit" name="recommend_submit" class="btn-lg btn-dark btn-block" style=" font-size: 13px; WIDTH: 85px; HEIGHT: 35px;">음식 뽑기</button>
  </div>
</form>

<hr/>
