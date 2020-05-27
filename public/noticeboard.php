<h2 class="text-left">알림게시판</h2><hr/>
<div id="noticeboard_area">
    <table class="list-table">
      <thead>
          <tr>
                <th width="350">제목</th>
                <th width="100">글쓴이</th>
                <th width="200">작성일</th>
                <th width="50">댓글수</th>
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

        if (isset($_POST['go_submit2'])) {
          $p = $_POST['p'];
        }

        $total = $mysqli->query("select * from noticeboard")->num_rows;
        $list = pageList( $total, $p);
        $limit = $list['limit'];


          $sql = $mysqli->query("select * from noticeboard order by id desc $limit");
            while($board = $sql->fetch_array())
            {
              $title=$board["title"];
              $writer = $mysqli->query("select * from accounts where id = ".$board['aid']."")->fetch_assoc();
              mb_strimwidth($title, '0', '10', '...', 'utf-8');
              $comment_cnt = $mysqli->query("select * from noticeboard_comment where nbid = ".$board['id']."")->num_rows;
        ?>
      <tbody>
        <tr>
          <td width="350"><a href="?page=noticeboard_info&amp;id=<?php echo $board['id'];?>"><?php echo $title;?></a></td>
          <td width="100"><?php echo $writer['nickname']?></td>
          <td width="200"><?php echo $board['date']?></td>
          <td width="50" align="center"><?php echo $comment_cnt; ?></td>
          <td width="50" align="center"><?php echo $board['view']; ?></td>
        </tr>
      </tbody>
      <?php } ?>
    </table>

    <hr/>

    <div class="center">
    <?php

     foreach($list['list'] as $w)
     {
        if ($w != 0) {
          if ($w == $p) {
            echo "<a href='?page=noticeboard&amp;p=".$w."' style=\"color:gray;\">[".$w."]</a> ";
          } else {
            echo "<a href='?page=noticeboard&amp;p=".$w."' style=\"color:black;\">[".$w."]</a> ";
          }
        }
     }
     ?>
    </div>
    <div class="center">
     <br/>
     <form action="?page=noticeboard" method="POST" >
     <a href="?page=noticeboard&amp;p=<?php echo $list['prev']; ?>" style="color:black;">prev</a>
     <input type='number' name='p' value="<?php echo $list['page'] ?>" size="3" onclick="this.select()"/>/
     <input value="<?php echo $list['total_page']; ?>" size="3" disabled/>
     <input type="submit" name="go_submit2" value="GO"/>
     <a href="?page=noticeboard&amp;p=<?php echo $list['next']; ?>" style="color:black;">next</a>
     </form>
    </div>
    <div align="right">
      <a href="?page=noticeboard_write"><button class="btn-lg btn-dark btn-block" style=" font-size: 13px; WIDTH: 80px; HEIGHT: 35px;">글쓰기</button></a>
    </div>
    </div>
