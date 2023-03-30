<?php
	session_start();

	if(isset($_SESSION["userid"]))
		$userid = $_SESSION["userid"];
	else
		$userid = "";

	if(isset($_SESSION["username"]))
		$username = $_SESSION["username"];
	else
		$username = "";

	if(isset($_COOKIE["user_id"]) && isset($_COOKIE["user_pw"]))
	{
		$user_id=$_COOKIE["user_id"];
		$user_pw=$_COOKIE["user_pw"];
		include "function/db_connect.php";
		$sql = "select * from member where id='$user_id' and pw='$user_pw'";
		$result = mysqli_query($con,$sql);

		$num_match = mysqli_num_rows($result);
		$row = mysqli_fetch_assoc($result);
		mysqli_close($con);
		
		if($num_match == 1)
		{
			$userid = $user_id;
			$username = $row["name"];
			$_SESSION["userid"] = $userid;
			$_SESSION["username"] = $username;
		}
	}
?>

<!DOCTYPE html>

<html lang="ko">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="/go2/style.css?ver=220611">
	<title>고헌산닷컴</title>
</head>
<body>
<header>
	<div class="header">
		<h1>
			<a href="/go2/">고헌산닷컴</a>
		</h1>
		<?php
			echo "울곽 재학생/졸업생 커뮤니티<br><br>";
			if($userid)
				echo $username."님 환영합니다!<br>"

		?>
	</div>
	<ul class="menu">
	<?php
		if(!$userid) {
	?>
		<li><a href="/go2/member/member.php?type=regist_form">회원가입</a></li>
		<li><a href="/go2/member/member.php?type=login_form">로그인</a></li>
	<?php
		} else {	
	?>
		<li><a href="/go2/member/member.php?type=modify_form">정보수정</a></li>
		<li><a href="/go2/member/logout.php">로그아웃</a></li>
	
	<?php
		}
	?>
		<li>|</li>
		<li><a href="/go2/board/board.php?type=list&table=_all">전체게시판</a></li>
		<li><a href="/go2/board/board.php?type=list&table=_hot">인기게시판</a></li>
		<li><a href="/go2/board/board.php?type=list&table=_notice">공지게시판</a></li>
		<!--<li><a href="/go2/board/chat.php">채팅방</a></li>-->
		<li class="nomob"><a href="/go2/board/board.php?type=list&table=_free">자유게시판</a></li>
		<li class="nomob"><a href="/go2/board/board.php?type=list&table=_info">정보게시판</a></li>
		<li class="nomob"><a href="/go2/board/board.php?type=list&table=_suggest">건의게시판</a></li>
		<li class="nomob"><a href="/go2/board/board.php?type=list&table=_anonym">익명게시판</a></li>
		<!--<li><a href="/go2/board/board.php?type=list&table=_under">재학생게시판</a></li>-->
		<!--<li><a href="/go2/board/board.php?type=list&table=_graduate">졸업생게시판</a></li>-->
	</ul>
	<p><br></p>
</header>
<div class="sidebar">
	<label for="expand-menu"><span class="sidebar_add">+</span><span>게시판</span></label>
	<input type="checkbox" id="expand-menu" name="expand-menu">
	<hr class="sidebar_important">
	<ul class="sidebar_important">
		<li><a href="/go2/board/board.php?type=list&table=_all">전체게시판</a></li>
		<li><a href="/go2/board/board.php?type=list&table=_hot">인기게시판</a></li>
		<li><a href="/go2/board/board.php?type=list&table=_notice">공지게시판</a></li>
		<!--<li><a href="/go2/board/chat.php">채팅방</a></li>-->
	</ul>
	<hr class="sidebar_contents1">
	<ul class="sidebar_contents1">
		<li><a href="/go2/board/board.php?type=list&table=_free">자유게시판</a></li>
		<li><a href="/go2/board/board.php?type=list&table=_info">정보게시판</a></li>
		<li><a href="/go2/board/board.php?type=list&table=_suggest">건의게시판</a></li>
		<li><a href="/go2/board/board.php?type=list&table=_anonym">익명게시판</a></li>
	</ul>
	<hr class="sidebar_contents2">
	<ul class="sidebar_contents2">
		<li><a href="/go2/board/board.php?type=list&table=_th9"> 9기 게시판</a></li>
		<li><a href="/go2/board/board.php?type=list&table=_th10">10기 게시판</a></li>
		<li><a href="/go2/board/board.php?type=list&table=_th11">11기 게시판</a></li>
		<li><a href="/go2/board/board.php?type=list&table=_th12">12기 게시판</a></li>
		<li><a href="/go2/board/board.php?type=list&table=_th13">13기 게시판</a></li>
		<li><a href="/go2/board/board.php?type=list&table=_th14">14기 게시판</a></li>
		<li><a href="/go2/board/board.php?type=list&table=_th15">15기 게시판</a></li>
		<li><a href="/go2/board/board.php?type=list&table=_th16">16기 게시판</a></li>
		<li><a href="/go2/board/board.php?type=list&table=_th17">17기 게시판</a></li>
	</ul>
</div>