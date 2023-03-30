<?php
	session_start();
	unset($_SESSION["userid"]);
	unset($_SESSION["username"]);
	setcookie('user_id', '', time()-3600, '/');
	setcookie('user_name', '', time()-3600, '/');
	echo "<script>
		location.href = '../index.php';
	</script>"
?>