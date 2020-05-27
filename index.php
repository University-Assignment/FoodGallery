
<?php
  session_start();

	require_once("config/database.php");
  require_once("config/config.php");

  include("public/function.php");

  $page = isset($_GET['page']) ? $_GET['page'] : "";

  if ($page == 'noticeboard_remove') {
      include("public/noticeboard_remove.php");
  } else if ($page == 'foodboard_remove') {
      include("public/foodboard_remove.php");
  } else if ($page == 'logout') {
      include("public/logout.php");
  } else if ($page == 'noticeboard_comment_write') {
      include("public/noticeboard_comment_write.php");
  } else if ($page == 'nb_comment_remove') {
      include("public/noticeboard_comment_remove.php");
  } else if ($page == 'foodboard_good') {
      include("public/foodboard_good.php");
  } else if ($page == 'foodboard_comment_write') {
      include("public/foodboard_comment_write.php");
  } else if ($page == 'fb_comment_remove') {
      include("public/foodboard_comment_remove.php");
  } else {
    include("include/header.php");
    switch ($page) {
      case 'home':
      case '':
        echo "<div class=\"row\">";
        include ("public/noticeboard_head.php");
        echo "</div>";
        echo "<br/><div class=\"row\">";
        include ("public/foodboard_head.php");
        echo "</div><br/>";
        break;
      case 'register':
        include("public/register.php");
        break;
      case 'myinfo':
        include("public/myinfo.php");
        break;
      case 'noticeboard':
        include("public/noticeboard.php");
        break;
      case 'logout':
        include("public/logout.php");
        break;
      case 'noticeboard_write':
        include("public/noticeboard_write.php");
        break;
      case 'noticeboard_rewrite':
        include("public/noticeboard_rewrite.php");
        break;
      case 'intro':
        include("public/intro.php");
        break;
      case 'chat':
        include("public/chat.php");
        break;
      case 'noticeboard_info':
        include("public/noticeboard_info.php");
        break;
      case 'foodboard_info':
        include("public/foodboard_info.php");
        break;
      case 'foodboard':
        include("public/foodboard.php");
        break;
      case 'foodboard_write':
        include("public/foodboard_write.php");
        break;
      case 'foodboard_rewrite':
        include("public/foodboard_rewrite.php");
        break;
      case 'foodboard_recommend':
        include("public/foodboard_recommend.php");
        break;
      case 'member_info':
        include("public/member_info.php");
        break;
      default:
        break;
      }
      include("include/footer.php");
  }

  $mysqli->close();
?>
