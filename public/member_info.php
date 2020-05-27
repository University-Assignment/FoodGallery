<?php
$id = isset($_GET['id']) ? $_GET['id'] : -1;
if ($id >= 0) {
  $info = $mysqli->query("select * from accounts where id = {$id}")->fetch_assoc();
}
?>

<h2 class="text-left">멤버정보</h2>
<form>
	<div class="form-group">
		<label for="inputUsername">별명</label>
		<input type="text" name="nickname" maxlength="12" class="form-control" id="inputNickname" autocomplete="off" placeholder="별명" value="<?php echo $info['nickname']; if ($info['admin'] == 1) echo "(운영자)"; ?>" readonly >
	</div>
	<div class="form-group">
		<label for="inputEmail">이메일</label>
		<input type="email" name="email" class="form-control" id="inputEmail" autocomplete="off" placeholder="이메일" value="<?php echo $info['email'] ?>" readonly >
	</div>
	<br/>
</form>


<hr/>
<div id="foodboard_area">
    <table class="list-table">
      <thead>
          <tr>
                <th width="350">제목</th>
                <th width="100">글쓴이</th>
                <th width="200">작성일</th>
                <th width="50">댓글수</th>
                <th width="50">좋아요</th>
                <th width="50">조회수</th>
            </tr>
        </thead>

        <?php
        function pageList($total_count=0, $page=1, $limit=10, $link=10)
        {
           $total_page = @ceil( $total_count / $limit );
           if($page <= 1)
           {
               $page = 1;
           }
           else if($total_page < $page)
           {
               $page = $total_page;
           }

           $start_limit = ($page-1) * $limit;

           if($total_count < $limit)
           {
               $end_limit = $total_count;
           }
           elseif($page === $total_page)
           {
               $end_limit = $total_count - ($limit * ($total_page - 1) );
           }
           else
           {
               $end_limit = $limit;
           }

           $prev = $page - 1;
           $next = $page + 1;

           if($total_count <= 0)
           {
               $prev = 0;
               $next = 0;
           }

           $start = ((@ceil($page/$link)-1) * $link) + 1;
           $end = $start + $link -1;
           if($end > $total_page)
           {
               $end = $total_page;
           }

           foreach(range($start, $end) as $val)
           {
               $row[] = $val;
           }
           return array(
               'total_page' => $total_page,
               'page' => $page,
               'prev' => $prev,
               'next' => $next,
               'list' => $row,
               'limit' => "limit $start_limit,$limit"
           );
        }
        $p = isset($_GET['p']) ? $_GET['p'] : "1";

        if (isset($_POST['go_submit'])) {
          $p = $_POST['p'];
        }

        $total = $mysqli->query("select * from foodboard where aid = {$id}")->num_rows;
        $list = pageList( $total, $p);
        $limit = $list['limit'];

          $sql = $mysqli->query("select * from foodboard where aid = {$id} order by id desc $limit");
            while($board = $sql->fetch_array())
            {
              $title=$board["title"];
              $writer = $mysqli->query("select * from accounts where id = ".$board['aid']."")->fetch_assoc();
              $good = $mysqli->query("select * from foodboard_good where fbid = ".$board['id']."")->num_rows;
              mb_strimwidth($title, '0', '10', '...', 'utf-8');
              $comment_cnt = $mysqli->query("select * from foodboard_comment where fbid = ".$board['id']."")->num_rows;
        ?>
      <tbody>
        <tr>
          <td width="350"><a href="?page=foodboard_info&amp;id=<?php echo $board['id'];?>"><?php echo $title;?></a></td>
          <td width="100"><?php echo $writer['nickname']?></td>
          <td width="200"><?php echo $board['date']?></td>
          <td width="50" align="center"><?php echo $comment_cnt; ?></td>
          <td width="50" align="center"><?php echo $good; ?></td>
          <td width="50" align="center"><?php echo $board['view']; ?></td>
        </tr>
      </tbody>
      <?php } ?>
    </table>
  </div>
  <hr/>
