<?php
	$id = $_POST["id"];
	$pass = $_POST["pass"];
	if(isset($_POST["autologin"]))
		$autologin = $_POST["autologin"];
	else
		$autologin = "n";

	include "../function/db_connect.php";
	$sql = "select * from member where id='$id'";
	$result = mysqli_query($con,$sql);

	$num_match = mysqli_num_rows($result);
	$row = mysqli_fetch_assoc($result);
	mysqli_close($con);
	$pw = $row["pw"];

	if(!$num_match)
	{
		echo "<script>
			window.alert('등록되지 않은 아이디입니다!')
			history.go(-1)
		</script>";
	}
	else if($pw!=$pass)
	{
		echo "<script>
			window.alert('비밀번호가 틀립니다!')
			history.go(-1)
		</script>";
	}
	else
	{
		session_start();
		$_SESSION["userid"] = $row["id"];
		$_SESSION["username"] = $row["name"];
		
		if($autologin==="y")
		{
			$user_id=$row["id"];
			$user_pw=$row["pw"];
			setcookie("user_id",$user_id,(time()+3600*24*30),"/");
			setcookie("user_pw",$user_pw,(time()+3600*24*30),"/");
		}	
		echo "<script>
			location.href = '../index.php';
		</script>";
	}
?>