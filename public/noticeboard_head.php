<?php
echo "
	<div class=\"col-md-5 \">
	<a href='?page=noticeboard'><h5><span style=\"color:gray;\">알림게시판 &raquo;</span></h5></a><hr/>
";
$sql = $mysqli->query("select * from noticeboard order by id desc limit 0,3");
	while($board = $sql->fetch_array())
	{
		$title=$board["title"];
		$writer = $mysqli->query("select * from accounts where id = ".$board['aid']."")->fetch_assoc();
		mb_strimwidth($title, '0', '10', '...', 'utf-8');
		$comment_cnt = $mysqli->query("select * from noticeboard_comment where nbid = ".$board['id']."")->num_rows;
	echo "
	  <a href=\"?page=noticeboard_info&amp;id=".$board['id']."\">
	";
	echo $title."<span style=\"color:black;\"> [".$comment_cnt."]</span>";
	echo "<span class=\"badge badge badge-secondary float-right\">".$board['view']."</span></a><br/>";
}

echo "<hr/></div>";
?>
