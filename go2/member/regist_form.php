<script>
	function check_input()
	{
		if(!document.member.id.value)
		{
			alert("이메일 주소를 입력해 주세요");
			document.member.id.focus();
			return;
		}
		if(!document.member.check.value)
		{
			alert("이메일 인증번호를 입력해 주세요");
			document.member.check.focus();
			return;
		}
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
	
	function reset_form()
	{
		document.member.id.value = "";
		document.member.check.value = "";
		document.member.pw.value = "";
		document.member.repw.value = "";
		document.member.id.focus();
		return;
	}
	
	function check_id()
	{
		window.open("check_id.php?id="+document.member.id.value,"이메일 확인","width=600,height=300,left=100,top=100,scrollbars=no,resizable=yes");
	}
</script>
<form name="member" action="insert.php" method="post">
	<div>
		<h2>회원가입</h2>
		<ul>
			<li>
				<span>이메일</span>
				<span><input type="text" name="id"></span>
				<span>@ushs.hs.kr</span>
				<span><button type="button" onclick="check_id()">이메일 인증</button></span>
			</li>
			<li>
				<span>이메일 인증번호</span>
				<span><input type="text" name="check"></span>
			</li>
			<li>
				<span>비밀번호</span>
				<span><input type="password" name="pw"></span>
			</li>
			<li>
				<span>비밀번호 확인</span>
				<span><input type="password" name="repw"></span>
			</li>
		</ul>
		<ul class="buttons">
			<li><button type="button" onclick="check_input()">저장하기</button></li>
			<li><button type="button" onclick="reset_form()">취소하기</button></li>
		</ul>
	</div>
</form>
<?php

?>