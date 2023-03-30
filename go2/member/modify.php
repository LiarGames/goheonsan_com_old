<?php
	$id = $_POST["id"];
	$pw = $_POST["pw"];
	$intro = $_POST["intro"];

	session_start();
	if(mb_strlen($intro,"UTF-8")>255)
	{
		echo "<script>
			window.alert('자기소개가 너무 깁니다!')
			history.go(-1)
		</script>";
	}
	else if($_SESSION["userid"] != $id)
	{
		echo "<script>
			window.alert('아이디가 다릅니다!')
			history.go(-1)
		</script>";
	}
	else
	{
		include "../function/db_connect.php";
		$intro = htmlspecialchars($intro, ENT_QUOTES);
			$sql = "update member set pw='$pw' where id='$id'";
			mysqli_query($con,$sql);
			$sql = "update member set intro='$intro' where id='$id'";
			mysqli_query($con,$sql);


		mysqli_close($con);
		echo "<script>
			alert('정보 수정이 완료되었습니다!');
			location.href = '../index.php';
		</script>";
	}
?>