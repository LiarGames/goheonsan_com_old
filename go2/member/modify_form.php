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

	include "../function/db_connect.php";
	$sql = "select intro from member where id='$userid'";
	$result = mysqli_query($con,$sql);
	$intro = mysqli_fetch_row($result);
	$intro = $intro[0];
	mysqli_close();
	
	if(!$userid)
	{
		echo "<script>
			window.alert('다시 로그인 해주세요')
			location.href = '/go2/member/member.php?type=login_form';
		</script>";
	}
?>

<script>
	function check_input()
	{
		if(!document.member.pw.value)
		{
			alert("비밀번호를 입력해 주세요");
			document.member.pw.focus();
			return;
		}
		if(!document.member.repw.value)
		{
			alert("비밀번호 확인을 입력해 주세요");
			document.member.repw.focus();
			return;
		}
		if(document.member.pw.value != document.member.repw.value)
		{
			alert("비밀번호가 일치하지 않습니다.\n다시 입력해 주세요");
			document.member.pw.focus();
			document.member.pw.select();
			return;
		}
		document.member.submit();
	}
</script>

<form name="member" action="modify.php" method="post">
	<div class="member_modify">
		<h2>정보 수정</h2>
		<ul>
			<li>
				<span>이메일</span>
				<span><input type="text" name="id" value=<?php echo $userid; ?> readonly></span>
				<span>@ushs.hs.kr</span>
			</li>
			<li>
				<span>비밀번호</span>
				<span><input type="password" name="pw"></span>
			</li>
			<li>
				<span>비밀번호 확인</span>
				<span><input type="password" name="repw"></span>
			</li>
			<li>
				<span>자기소개</span>
				<span><textarea name="intro" rows="5" cols="50"><?php echo $intro; ?></textarea></span>
			</li>
		</ul>
		<ul class="buttons">
			<li><button type="button" onclick="check_input()">저장하기</button></li>
		</ul>
	</div>
</form>