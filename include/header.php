<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title><?php echo $title ?></title>
		<link rel="icon" href="Icon.ico" type="image/x-icon" />
		<link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="assets/css/swiper.min.css">
		<link href="assets/css/addon.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript" src="chat.js"></script>
		<link href="https://cdn.rawgit.com/YJSoft/Webfonts/0.1/BM_JUA.css" rel="stylesheet" type="text/css" />
  	<style type="text/css">
        .container {font-family:'BM JUA', sans-serif; }
				.navbar {border-radius: 8px; }
				.blackk { color:black; }
    </style>
		<script type="text/javascript" src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
		<script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyBFVOQpUzC9gFqLOaBVlw7d2pVQoCNlf7c"></script>
		<script type="text/javascript">
				$(document).ready(function() {
					var myLatlng = new google.maps.LatLng(36.626771,127.45818); // 위치값 위도 경도
			var Y_point			= 36.626771;		// Y 좌표
			var X_point			= 127.45818;		// X 좌표
			var zoomLevel		= 18;				// 지도의 확대 레벨 : 숫자가 클수록 확대정도가 큼
			var markerTitle		= "충북대학교";		// 현재 위치 마커에 마우스를 오버을때 나타나는 정보
			var markerMaxWidth	= 300;				// 마커를 클릭했을때 나타나는 말풍선의 최대 크기

			var contentString	= '<div>' +
			'<h2>충북대학교</h2>'+
			'<p>공대건물.</p>' +

			'</div>';
			var myLatlng = new google.maps.LatLng(Y_point, X_point);
			var mapOptions = {
								zoom: zoomLevel,
								center: myLatlng,
								mapTypeId: google.maps.MapTypeId.ROADMAP
							}
			var map = new google.maps.Map(document.getElementById('map_ma'), mapOptions);
			var marker = new google.maps.Marker({
													position: myLatlng,
													map: map,
													title: markerTitle
			});
			var infowindow = new google.maps.InfoWindow(
														{
															content: contentString,
															maxWizzzdth: markerMaxWidth
														}
					);
			google.maps.event.addListener(marker, 'click', function() {
				infowindow.open(map, marker);
			});
		});
				</script>

		<style>
		#map_ma {width:100%; height:400px; clear:both; border:solid 1px red;}

		ul li{list-style-type:none;float:left;}
		body {
		    line-height: 1.7;
		}
		table.table2{
						width: 100;
						border-collapse: separate;
						text-align: left;
						line-height: 1.5;
						border-top: 1px solid #ccc;
						margin : 20px 10px;
						border-right:none;
						border-left:none;
						border-top:none;
						border-bottom:none;
		}
		table.table2 tr {
						 width: 50px;
						 padding: 10px;
						font-weight: 80px;
						vertical-align: top;
						border-right:none;
						border-left:none;
						border-top:none;
						border-bottom:none;
		}
		.disabled {
		pointer-events: none;
		background-color: #eee;
		color: #555;
		opacity: 1;
		}

		.view_table {
		border: 1px solid #444444;
		margin-top: 30px;
		}
		.view_title {
		height: 30px;
		text-align: center;
		background-color: #cccccc;
		color: white;
		width: 1000px;
		}
		.view_id {
		text-align: center;
		background-color: #EEEEEE;
		width: 30px;
		}
		.view_id2 {
		background-color: white;
		width: 60px;
		}
		.view_hit {
		background-color: #EEEEEE;
		width: 30px;
		text-align: center;
		}
		.view_hit2 {
		background-color: white;
		width: 60px;
		}
		.view_content {
		padding-top: 20px;
		border-top: 1px solid #444444;
		height: 500px;
		}
		.view_btn {
		width: 700px;
		height: 200px;
		text-align: center;
		margin: auto;
		margin-top: 50px;
		}
		.view_btn1 {
		height: 50px;
		width: 100px;
		font-size: 20px;
		text-align: center;
		background-color: white;
		border: 2px solid black;
		border-radius: 10px;
		}
		.view_comment_input {
		width: 700px;
		height: 500px;
		text-align: center;
		margin: auto;
		}
		.view_text3 {
		font-weight: bold;
		float: left;
		margin-left: 20px;
		}
		.view_com_id {
		width: 100px;
		}
		.view_comment {
		width: 500px;
		}
		.center {
			text-align:center;
			display:flex; /* 내용을 중앙정렬 하기위해 flex 사용 */
			align-items:center; /* 위아래 기준 중앙정렬 */
			justify-content:center; /* 좌우 기준 중앙정렬 */
		}
		.swiper-container {
			width:100%;
			height:100%;
		}
		.swiper-slide {
			text-align:center;
			display:flex; /* 내용을 중앙정렬 하기위해 flex 사용 */
			align-items:center; /* 위아래 기준 중앙정렬 */
			justify-content:center; /* 좌우 기준 중앙정렬 */
		}
		.swiper-pagination-bullet {
      width: 20px;
      height: 20px;
      text-align: center;
      line-height: 20px;
      font-size: 12px;
      color:#000;
      opacity: 1;
      background: rgba(0,0,0,0.2);
    }
		.swiper-pagination-bullet-active {
      color:#fff;
      background: #007aff;
    }
		.swiper-slide img {
			box-shadow:0 0 5px #555;
		}
	  </style>
	</head>
	<body onload="initialize()">
		<div class="container">
			<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
				<a class="navbar-brand" href="#"><?php echo $name ?></a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
				  <span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarContent">
					<ul class="navbar-nav mr-auto">
						<li class="nav-item"><a class="nav-link" href="?page=home">메인</a></li>
						<li class="nav-item"><a class="nav-link" href="?page=noticeboard">알림게시판</a></li>
						<li class="nav-item"><a class="nav-link" href="?page=foodboard">음식게시판</a></li>
						<li class="nav-item"><a class="nav-link" href="?page=foodboard_recommend">음식추천</a></li>
						<li class="nav-item"><a class="nav-link" href="?page=chat">채팅</a></li>
					</ul>
					<ul class="navbar-nav navbar-right">
						<?php
						if(!isset($_SESSION['username'])) {
							echo "<li><a class=\"nav-link\" href=\"?page=register\">회원가입</a></li>";
						}
						?>
					</ul>
				</div>
			</nav>
			<div class="card card-body">
				<div class="row">
					<div class="col-md-3">
						<?php include("include/sidebar.php"); ?>
					</div>
					<div class="col-md-9">
