<?php
	$subject = $_POST["subject"];
	$content = $_POST["content"];
	$userid = $_GET["id"];
	$username = $_GET["name"];
	$table = $_GET["table"];

	include "../function/db_connect.php";

	$image = count($_FILES['img']['name']);
	$sql = 'SELECT MAX(num) FROM board';
	$result = mysqli_query($con, $sql);
	$row = mysqli_fetch_row($result);
	$row[0]++;
	//echo $image;
	//var_dump($_FILES['img']);
	$okay = 1;
	if($image>10)
	{
		echo"<script>
		alert('사진은 10개까지만 등록할 수 있습니다');
		history.back();
		</script>";	
		$okay = 0;
	}

		for($i=0; $i<$image; $i++)
		{
			$fileTypeExt = explode("/", $_FILES['img']['type'][$i]);
			$fileType = $fileTypeExt[0];
			$fileExt = $fileTypeExt[1];
			$file = 'images/'.$row[0].'_'.$i;
			$size = $_FILES['img']['size'][$i];

				if($fileExt=='jpeg'||$fileExt=='jpg'||$fileExt=='gif'||$fileExt=='bmp'||$fileExt=='png')
				{
					if($size<10485760)
					{
						if(!move_uploaded_file($_FILES['img']['tmp_name'][$i],$file))
						{
							echo"<script>
							alert('오류가 발생했습니다! 사진이 첨부되지 않았습니다');
							history.back();
							</script>";
							$okay = 0;
						}
					}
					else
					{
						echo"<script>
						alert('10MB 이하 사진만 첨부할 수 있습니다.');
						history.back();
						</script>";	
						$okay = 0;
					}
				}
				else if($_FILES['img']['size'][$i]!=0 || $image!=1)
				{
					echo"<script>
					alert('사진 파일만 등록할 수 있습니다!');
					history.back();
					</script>";
					$okay = 0;
				}
				else
					$image=0;
			/*
			else
			{
				echo "1. name : {$_FILES['img']['name'][$i]}<br>";
				echo "2. type : {$_FILES['img']['type'][$i]}<br>";
				echo "3. size : {$_FILES['img']['size'][$i]}<br>";
			}
			*/
			//$sql = "INSERT INTO image (board, ord, siz) VALUES ('$row[0]','$i','$size')";
			//$result = mysqli_query($con,$sql);

		}

	if($okay==1)
	{
		switch($table)
		{

			case "_notice" : $type = 1; break;
			case "_free" : $type = 2; break;
			case "_anonym" : $type = 3; break;
			case "_under" : $type = 4; break;
			case "_graduate" : $type = 5; break;
			case "_info" : $type = 6; break;
			case "_suggest" : $type = 7; break;
			case "_th9" : $type = 109; break;
			case "_th10" : $type = 110; break;
			case "_th11" : $type = 111; break;
			case "_th12" : $type = 112; break;
			case "_th13" : $type = 113; break;
			case "_th14" : $type = 114; break;
			case "_th15" : $type = 115; break;
			case "_th16" : $type = 116; break;
			case "_th17" : $type = 117; break;
		}

		$subject = htmlspecialchars($subject, ENT_QUOTES);
		$content = htmlspecialchars($content, ENT_QUOTES);
		$regist_day = date("Y.m.d H:i:s");

		if($type!=3)
			$sql = "INSERT INTO board (id, name, subject, content, regist_day, type, views, blind, image) VALUES ('$userid', '$username', '$subject', '$content', '$regist_day', '$type', 0, 1, '$image')";
		else
			$sql = "INSERT INTO board (id, name, subject, content, regist_day, type, views, blind, image) VALUES ('$userid', '익명', '$subject', '$content', '$regist_day', 3, 0, 1, '$image')";
		$result = mysqli_query($con, $sql);

	echo "<script>
		alert('게시글 등록이 완료되었습니다!');
		location.href = 'board.php?type=list&table=$table&page=$page';
	</script>";
	}//location.href = 'board.php?type=list&table=$table&page=$page';	
		mysqli_close();
?>