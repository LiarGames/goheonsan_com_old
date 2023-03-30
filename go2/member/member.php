<?php
	$type = $_GET["type"];
	include "../main/main_header.php";

	if(isset($_GET["id"]))
		$id = $_GET["id"]; 

	include "../member/".$type.".php";	

	include "../main/main_footer.php";

	if($type=='view_form' && !$userid)
		echo "<script>
			window.alert('로그인 후 이용해주세요!')
			location.href = '/go2/member/member.php?type=login_form';
		</script>";	
?>