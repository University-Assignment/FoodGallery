
<?php
echo "
	<div class=\"col-md-9 \">
	<h5><span style=\"color:gray;\">음식 순위&raquo;</span></h5><hr/>
";
?>
<div class="swiper-container">
	<div class="swiper-wrapper">

<?php
$sql = $mysqli->query("select * from foodboard order by good desc limit 0,5");
while($board = $sql->fetch_array()) {
	if ($board['good'] > 0) {
		$fbid = $board['id'];
		$image = $mysqli->query("select * from foodboard_image where fbid = ".$fbid."");
		if ($image->num_rows > 0) {
			$image = $image->fetch_assoc();
			$filename = $image['filename'];
			echo "<div class=\"swiper-slide\"><a href='?page=foodboard_info&amp;id=$fbid'><img width = \"300\" height = \"250\" src=\"http://221.160.185.63/foodboard_image/".$filename."\"></a></div>";
		}
	}
}
echo "</div>";
?>
<!-- 네비게이션 버튼 -->
<div class="swiper-button-next"></div>
<div class="swiper-button-prev"></div>

<!-- 페이징 -->
<div class="swiper-pagination"></div>
</div>
<hr/></div>
