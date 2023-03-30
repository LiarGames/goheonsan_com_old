<?php
	$subject = $_POST["subject"];
	$content = $_POST["content"];
	$userid = $_GET["id"];
	$num = $_GET["num"];
	$table = $_GET["table"];
	$page = $_GET["page"];
	switch($table)
	{

		case "_notice" : $type = 1; break;
		case "_free" : $type = 2; break;
		case "_anonym" : $type = 3; break;
		case "_under" : $type = 4; break;
		case "_graduate" : $type = 5; break;
		case "_info" : $type = 6; break;
		case "_suggest" : $type = 7; break;
		case "_th9" : $type=109; break;
		case "_th10" : $type=110; break;
		case "_th11" : $type=111; break;
		case "_th12" : $type=112; break;
		case "_th13" : $type=113; break;
		case "_th14" : $type=114; break;
		case "_th15" : $type=115; break;
		case "_th16" : $type=116; break;
		case "_th17" : $type=117; break;
	}
	$subject = htmlspecialchars($subject, ENT_QUOTES);
	$content = htmlspecialchars($content, ENT_QUOTES);
	$regist_day = date("Y.m.d H:i:s");

	include "../function/db_connect.php";
	$sql = "UPDATE board SET content='$content', subject='$subject' where num=$num";
	$result = mysqli_query($con, $sql);

	$sql = "select * from board where num=$num";
	$result = mysqli_query($con, $sql);
	$row = mysqli_fetch_assoc($result);
	$views = $row["views"];
	$name = $row["name"];
	$blind = $row["blind"];
	
	if($type!=3)
		$sql = "INSERT INTO board_old (old_num, id, name, subject, content, regist_day, type, views, blind) VALUES ($num, '$userid', '$name', '$subject', '$content', '$regist_day', $type, $views, $blind)";
	else
		$sql = "INSERT INTO board_old (old_num, id, name, subject, content, regist_day, type, views, blind) VALUES ($num, '$userid', '익명', '$subject', '$content', '$regist_day', 3, $views, $blind)";
	$result = mysqli_query($con, $sql);
	echo mysqli_error($con);
	mysqli_close();
	echo "<script>
		alert('게시글 수정이 완료되었습니다!');
		location.href = 'board.php?type=view&table=$table&page=$page&num=$num';	
	</script>"
		
?>