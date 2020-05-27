<?php


if (!isset($_SESSION['username'])) {
  ?>
  <script type="text/javascript">alert("회원만 이용가능합니다!");history.go(-1);</script>
  <?php
    exit;
}

  $id = isset($_GET['id']) ? $_GET['id'] : "";
  $board = $mysqli->query("select * from foodboard where id = ".$id."")->fetch_assoc();
  if ($board['aid'] >= 0) {
      $writer_id = $board['aid'];
      $writer = $mysqli->query("select * from accounts where id = ".$writer_id."")->fetch_assoc();
      $image = $mysqli->query("select * from foodboard_image where fbid = ".$id."");
      $good_check = $mysqli->query("SELECT * FROM foodboard_good WHERE fbid = ".$id." AND aid = ".$_SESSION['id']."")->num_rows;
      $good_cnt = $mysqli->query("SELECT * FROM foodboard_good WHERE fbid = ".$id."")->num_rows;
      if ($image->num_rows > 0) {
        $image = $image->fetch_assoc();
        $filename = $image['filename'];
      }
      if (isset($_SESSION['id']) && $writer_id != $_SESSION['id']) {
        $board['view']++;
        $mysqli->query("UPDATE foodboard SET view = ".$board['view']." WHERE id = ".$id."");
      }
  }
?>

<form>
 <div class="container">
</div>
<table class="jua" style="padding-top:50" align = center border=0 cellpadding=2 >
     <tr>
     <td height=1 align= left>
    </td>
     </tr>
     <tr>
     <td height=1 style="border-radius: 8px;" align= left bgcolor=#ccc><font color=white><?php echo $board['date']?></font></td>
     </tr>
     <tr>
     <td bgcolor=white>
     <table class="table2">
         <tr>
             <td valign="middle">작성자</td>
             <td><input style="background-color:transparent" class="form-control"type = text name = "id" size=60 disabled placeholder='<?php echo $writer['nickname']?>'></td>
             <tr>
             <td valign="middle">제목</td>
             <td><input style="background-color:transparent" class="form-control"type = text name = "title" size=60 disabled placeholder='<?php echo $board['title']?>'></td>
             </tr>
             <tr>
             <td valign="middle">내용</td>
             <td><textarea style=" resize:none; background-color:transparent;" class="form-control"  name = "content" cols=85 rows=15 placeholder='<?php echo $board['content']?>' disabled></textarea></td>
             </tr>
             <tr>
             <td valign="middle">이미지</td>
             <td><img width = "300" height = "250" src="http://221.160.185.63/foodboard_image/<?php echo $filename ?>"></td>
             </tr>
    </table>
             <center>
                 <div align="right">
            <a href='?page=foodboard_good&amp;id=<?php echo $id ?>'
              <?php
              if ($good_check > 0) {
                echo "style=\"color:red;\"";
              }
              ?>
              >좋아요[<?php echo $good_cnt?>]</a>
              |
             <a href='?page=foodboard_rewrite&amp;id=<?php echo $id?>'>수정</a>
             |
             <a href='?page=foodboard_remove&amp;id=<?php echo $id?>'>삭제</a>
         </div>
          </ul>
             </center>
     </td>
     </tr>

</table>
</form>

<br/>
<?php
    $sql_cmt = "select id, aid, content, DATE_FORMAT(date,'%Y-%m-%d') as date1 from foodboard_comment where fbid = $id";
    $result_cmt = $mysqli->query($sql_cmt);

    while($row_cmt = $result_cmt->fetch_array()) {
        $str = $row_cmt['content'];
        $comment = $str;
        $writer = $mysqli->query("select * from accounts where id = ".$row_cmt['aid']."")->fetch_assoc();
        $str = $writer['nickname'];
        $name = $str;

?>
<table width=100% border=0 align=center cellpadding=0 cellspacing=1 style="border-width:1; border-color:rgb(204,204,204); border-style:dotted;">
<tr bgcolor=F0F0F0 >
    <td >
        <table width=100%>
        <col width=10></col>
        <col width=60 align=left></col>
        <col width=5></col>
        <col width=2></col>
        <col width=4></col>
        <col width=''></col>
        <col width=99></col>
        <col width=10></col>
        <tr >
            <td></td>
            <td valign=top style='word-break:break-all;'><?php echo $name ?></td>
            <td></td>
            <td bgcolor=#aabbcc></td>
            <td></td>
            <td valign=top style='word-break:break-all; text-align:justify; line-height:150% ; border-radius: 8px;'><?php echo $comment ?></td>
            <td valign=top style=' border-radius: 8px;'align=right>
              <?php echo $row_cmt['date1'] ?>
              <a href="?page=fb_comment_remove&amp;id=<?php echo $row_cmt['id']?>"> x</a>
            </td>
            <td></td>
        </tr>
        </table>
    </td>
</tr>
</table>
<?php

    }
?>


<form name="bWriteForm" method="post" action="?page=foodboard_comment_write" style="margin:0px;">
<input type="hidden" name="fbid" value="<?php echo $id?>">

<table class="table2">
    <tr>
        <td valign="middle">내용</td>
        <td align="left" valign="middle" style="width:400px;height:100px;">
        <textarea name="b_contents" style="resize:none; width:400px;height:100px;"></textarea>
        </td>
    </tr>
    <!-- 4. 글쓰기 버튼 클릭시 입력필드 검사 함수 write_save 실행 -->
    <tr>
      <td align="center" valign="middle" colspan="2">
        <input type="button" value=" 댓글쓰기 " onClick="write_save();" class="btn-lg btn-dark btn-block" style=" font-size: 13px; WIDTH: 85px; HEIGHT: 35px;">
      </td>
    </tr>
</table>
</form>
<script>
// 5.입력필드 검사함수
function write_save()
{
    var f = document.bWriteForm;

    if(f.b_contents.value == ""){
        alert("글내용을 입력해 주세요.");
        return false;
    }

    f.submit();

}
</script>
