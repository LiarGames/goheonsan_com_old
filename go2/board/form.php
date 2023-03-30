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

<h2><?php echo $board_title; ?> > 글쓰기</h2>
<div class="board_insert">
<form name="board" method="post" action="insert.php?id=<?php echo $userid; ?>&name=<?php echo $username; ?>&table=<?php echo $table; ?>" enctype="multipart/form-data">
	<ul class="board_form">
		<li>
			<span class = "col1">이름 : </span>
			<span class = "col2"><?php if($table==='_anonym') echo "익명"; else echo $username; ?></span>
		</li>
		<li>
			<span class = "col1">제목 : </span>
			<span class = "col2"><input name="subject" type=text></span>
		</li>
		<li>
			<span class = "col1">내용 : </span>
			<span class = "col2"><textarea name="content" rows="20" style="width:100%;"></textarea></span>
		</li>
		<li>
			<span class = "col1">사진 : </span>
			<span class = "col2"><input type="file" name="img[]" id="img" multiple="multiple"></span>

		</li>
	</ul>
	<br>
	<ul class="buttons">
		<li><button type="button" onclick="check_input()">등록하기</button></li>
		<li><button type="button" onclick="location.href='board.php?type=list&table=<?php echo $table; ?>&page=<?php echo $page; ?>'">취소</button></li>
	</ul>
</form>
	</div>
<?php

?>