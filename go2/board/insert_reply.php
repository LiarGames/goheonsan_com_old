<?php
	$content = $_POST["reply_content"];
	$type = $_GET["type"];
	$num = $_GET["num"];
	$page = $_GET["page"];
	$table = $_GET["table"];
	$userid = $_GET["userid"];
	$username = $_GET["username"];

	$content = htmlspecialchars($content, ENT_QUOTES);
	$regist_day = date("Y.m.d H:i:s");

	include "../function/db_connect.php";
	if($type!=3)
		$sql = "INSERT INTO reply (board, id, name, regist_day, content, board_type, blind) VALUES ($num, '$userid', '$username', '$regist_day', '$content', $type, 1)";
	else
		$sql = "INSERT INTO reply (board, id, name, regist_day, content, board_type, blind) VALUES ($num, '$userid', '익명', '$regist_day', '$content', $type, 1)";
	$result = mysqli_query($con, $sql);
	mysqli_close();
	echo "<script>
		alert('댓글 등록이 완료되었습니다!');
		location.href = 'board.php?type=view&table=$table&page=$page&num=$num';
	</script>"
		
?>