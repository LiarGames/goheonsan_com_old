<?php
	$table = $_GET["table"];
	$reply_num = $_GET["reply_num"];
	$num = $_GET["num"];
	$page = $_GET["page"];
	$userid = $_GET["userid"];

	if($userid==1234)
		$blind=3;
	else
		$blind=2;

	include "../function/db_connect.php";
	$sql = "SELECT id FROM reply WHERE num=$reply_num";
	$result = mysqli_query($con, $sql);
	$id = mysqli_fetch_row($result);
	if($userid!=$id[0] && $userid!=1234)
	{
		mysqli_close();
		echo "<script>
			window.alert('로그인 후 이용해주세요!')
			location.href = '/go2/member/member.php?type=login_form';
		</script>";	
	}

	$sql = "UPDATE reply SET blind=$blind WHERE num=$reply_num";
	$result = mysqli_query($con, $sql);

	mysqli_close();

	echo "<script>
		alert('댓글 삭제가 완료되었습니다!');
		location.href = 'board.php?type=view&table=$table&page=$page&num=$num';
	</script>";
?>