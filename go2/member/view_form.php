<?php
	$id=$_GET["id"];
	include "../function/db_connect.php";
	$sql = "select * from member where id='$id'";
	$result = mysqli_query($con,$sql);
	$row = mysqli_fetch_assoc($result);
	$name = $row["name"];
	$regist_day = $row["regist_day"];
	$intro = $row["intro"];
	
	$intro = str_replace(" ","&nbsp;",$intro);
	$intro = str_replace("\n","<br>",$intro);
	mysqli_close();
?>
<h2>프로필</h2>
<ul class="member_view">
	<li><span>이름 : </span><?php echo $name; ?></li>
	<li><span>가입일 : </span><?php echo $regist_day; ?></li>
	<li><span><br>&lt;자기소개&gt;<br></span><?php echo $intro; ?></li>
</ul>
