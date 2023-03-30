<script>
	function check_input()
	{
		if(!document.board.subject.value)
		{
			alert("제목을 입력하세요!");
			document.board.subject.focus();
			return;
		}
		if(!document.board.content.value)
		{
			alert("내용을 입력하세요!");
			document.board.content.focus();
			return;
		}
		document.board.submit();
	}
</script>

<?php
	$page = $_GET["page"];
	include "../function/db_connect.php";
	$sql = "select * from board where num=$num";
	$result = mysqli_query($con,$sql);
	$row = mysqli_fetch_assoc($result);
	$subject = $row["subject"];
	$content = $row["content"];
	$id = $row["id"];
	$type = $row["type"];
	if($userid!=$id)
	{
		echo "<script>
			window.alert('로그인 후 이용해주세요!')
			location.href = '/go2/member/member.php?type=login_form';
		</script>";	
	}
	if($type==3)
	{
		echo "<script>
			window.alert('익명게시글은 수정할수 없습니다.')
			location.href = '/go2/index.php';
		</script>";	
	}
?>

<h2><?php echo $board_title; ?> > 수정하기</h2>
<div>
<form name="board" method="post" action="editt.php?id=<?php echo $userid; ?>&num=<?php echo $num; ?>&table=<?php echo $table; ?>&page=<?php echo $page; ?>" enctype="multipart/form-data">
	<ul class="board_form">
		<li>
			<span class = "col1">이름 : </span>
			<span class = "col2"><?php echo $username; ?></span>
		</li>
		<li>
			<span class = "col1">제목 : </span>
			<span class = "col2"><input name="subject" type=text value="<?php echo $subject; ?>"></span>
		</li>
		<li>
			<span class = "col1">내용 : </span>
			<span class = "col2"><textarea name="content" rows="20" style="width:100%;"><?php echo $content; ?></textarea></span>
		</li>
	</ul>
	<ul class="buttons">
		<li><button type="button" onclick="check_input()">등록하기</button></li>
		<li><button type="button" onclick="location.href='board.php?type=list&table=<?php echo $table; ?>&page=<?php echo $page; ?>'">취소</button></li>
	</ul>
</form>
	</div>