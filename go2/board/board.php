<?php
	$table = $_GET["table"];
	$type = $_GET["type"];
	$num = $_GET["num"];
	$page = 1;
	if(isset($_GET["page"]))
		$page = $_GET["page"];

	$scale = 10;
	if($table==='_all')
			$scale=20;
	switch($table)
	{
		case "_all" : $board_title = "전체게시판"; $board_cond = ""; break;
		case "_hot" : $board_title = "인기게시판"; $board_cond = "and views>10 "; break;
		case "_notice" : $board_title = "공지게시판"; $board_cond = "and type=1 "; break;
		case "_free" : $board_title = "자유게시판"; $board_cond = "and type=2 "; break;
		case "_anonym" : $board_title = "익명게시판"; $board_cond = "and type=3 "; break;
		case "_under" : $board_title = "재학생게시판"; $board_cond = "and type=4 "; break;
		case "_graduate" : $board_title = "졸업생게시판"; $board_cond = "and type=5 "; break;
		case "_info" : $board_title = "정보게시판"; $board_cond = "and type=6 "; break;
		case "_suggest" : $board_title = "건의게시판"; $board_cond = "and type=7 "; break;
		case "_th9" : $board_title = "9기게시판"; $board_cond = "and type=109 "; break;
		case "_th10" : $board_title = "10기게시판"; $board_cond = "and type=110 "; break;
		case "_th11" : $board_title = "11기게시판"; $board_cond = "and type=111 "; break;
		case "_th12" : $board_title = "12기게시판"; $board_cond = "and type=112 "; break;
		case "_th13" : $board_title = "13기게시판"; $board_cond = "and type=113 "; break;
		case "_th14" : $board_title = "14기게시판"; $board_cond = "and type=114 "; break;
		case "_th15" : $board_title = "15기게시판"; $board_cond = "and type=115 "; break;
		case "_th16" : $board_title = "16기게시판"; $board_cond = "and type=116 "; break;
		case "_th17" : $board_title = "17기게시판"; $board_cond = "and type=117 "; break;
	}
	include "../main/main_header.php";
	include "$type.php";
	include "../main/main_footer.php";

	if(!$userid)
	{
		echo "<script>
			window.alert('로그인 후 이용해주세요!')
			location.href = '/go2/member/member.php?type=login_form';
		</script>";	
	}
?>