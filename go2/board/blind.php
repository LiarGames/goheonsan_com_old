<?php
	$table = $_GET["table"];
	$num = $_GET["num"];
	$page = $_GET["page"];

	if($userid==1234)
		$blind=3;
	else
		$blind=2;

	include "../function/db_connect.php";
	$sql = "SELECT id FROM board WHERE num=$num";
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

	$sql = "UPDATE board SET blind=$blind WHERE num=$num";
	$result = mysqli_query($con, $sql);

	mysqli_close();

	echo "<script>
		alert('게시글 삭제가 완료되었습니다!');
		location.href = 'board.php?type=list&table=$table&page=$page';	
	</script>";
?>