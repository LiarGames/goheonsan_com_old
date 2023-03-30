<?php
	$id = $_POST["id"];
	$check = $_POST["check"];
	$pw = $_POST["pw"];
	$regist_day = date("Y.m.d H:i:s");

	include "../function/db_connect.php";
	$sql = "select point from member where id='$id'";
	$result = mysqli_query($con,$sql);
	$num = mysqli_fetch_row($result);
	$num = $num[0];
	$num = intval($num);
	#echo 'num : '.$num." / id : ".$id." / check : ".$check;

	if($check == $num)
	{
		$sql = "update member set pw='$pw' where id='$id'";
		mysqli_query($con,$sql);
		$sql = "update member set point=0 where id='$id'";
		mysqli_query($con,$sql);	
		$sql = "update member set regist_day='$regist_day' where id='$id'";
		mysqli_query($con,$sql);
	}
	else
	{
		echo "<script>
			alert('이메일 인증 번호가 틀렸습니다. 다시 시도해주세요.');
			history.go(-1)
		</script>";
		exit;
	}

	

	mysqli_close($con);
	echo "<script>
		alert('회원가입이 완료되었습니다!');
		location.href = 'member.php?type=login_form';
	</script>"
?>