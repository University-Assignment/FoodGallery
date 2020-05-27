<?php

  $id = isset($_GET['id']) ? $_GET['id'] : "";
  $board = $mysqli->query("select * from noticeboard where id = {$id}");
  if ($board->num_rows > 0) {
      $board = $board->fetch_assoc();
      $writer_id = $board['aid'];
      $writer = $mysqli->query("select * from accounts where id = {$writer_id}")->fetch_assoc();

      if (isset($_SESSION['id']) && $writer_id != $_SESSION['id']) {
        $board['view']++;
        $mysqli->query("UPDATE noticeboard SET view = ".$board['view']." WHERE id = ".$id."");
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
    </table>
             <center>
                 <div align="right">
             <a href='?page=noticeboard_rewrite&amp;id=<?php echo $id?>'>수정</a>
             |
             <a href='?page=noticeboard_remove&amp;id=<?php echo $id?>'>삭제</a>
         </div>
          </ul>
             </center>
     </td>
     </tr>

</table>
</form>

<br/>
<?php
    $sql_cmt = "select id, aid, content, DATE_FORMAT(date,'%Y-%m-%d') as date1 from noticeboard_comment where nbid = $id";
    $result_cmt = $mysqli->query($sql_cmt);

    while($row_cmt = $result_cmt->fetch_array()) {
        $str = $row_cmt['content'];
        $comment = $str;
        $writer = $mysqli->query("select * from accounts where id = ".$row_cmt['aid']."")->fetch_assoc();
        $str = $writer['nickname'];
        $name = $str;

?>
<table width=100% border=0 align=center cellpadding=0 cellspacing=1 style="border-width:1; border-color:rgb(210,210,210); border-style:dotted;">
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
            <td valign=top style='word-break:break-all; text-align:justify; line-height:150% ;'><?php echo $comment ?></td>
            <td valign=top align=right>
              <?php echo $row_cmt['date1'] ?>
              <a href="?page=nb_comment_remove&amp;id=<?php echo $row_cmt['id']?>"> x</a>
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


<form name="bWriteForm" method="post" action="?page=noticeboard_comment_write" style="margin:0px;">
<input type="hidden" name="nbid" value="<?php echo $id?>">

<table class="table2">
    <tr>
        <td valign="middle">내용</td>
        <td align="left" valign="middle" style="width:300px;height:100px;">
        <textarea name="b_contents" style="resize:none; width:300px;height:100px;"></textarea>
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
