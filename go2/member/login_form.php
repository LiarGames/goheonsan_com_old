<script>
	function check_input()
	{
		if(!document.login.id.value)
		{
			alert('아이디를 입력하세요');
			document.login_form.id.focus();
			return;
		}
		if(!document.login.pass.value)
		{
			alert('비밀번호를 입력하세요');
			document.login_form.pass.focus();
			return;
		}
		document.login.submit();
	}
</script>
<form name="login" method="post" action="login.php">
	<div class="login_form">
		<h2 class="login_title">로그인</h2>
	<ul>
		<li>
			<span>이메일</span>
			<span><input type="text" name="id" placeholder="이메일"></span>
			<span>@ushs.hs.kr</span>
		</li>
		<li>
			<span>비밀번호</span>
			<span><input type="password" name="pass" placeholder="비밀번호"></span>
		</li>
		<li><button type="button" onclick="check_input()">로그인</button></li>
		<label>
		<li><input type="checkbox" name="autologin" value="y">자동로그인</li>
		</label>
	</ul>
	</div>
</form>
<?php
	
?>