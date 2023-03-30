
<script>
	function reply_check_input()
	{
		if(!document.reply_form.reply_content.value)
		{
			alert("내용을 입력하세요!");
			document.reply_form.reply_content.focus();
			return;
		}
		document.reply_form.submit();
	}
	
</script>
<?php
	include "../function/db_connect.php";
	$sql = "select * from board where num=$num";
	$result = mysqli_query($con,$sql);
	$row = mysqli_fetch_assoc($result);

	$id = $row["id"];
	$name = $row["name"];
	$subject = $row["subject"];
	$regist_day = $row["regist_day"];
	$content = $row["content"];
	$views = $row["views"];
	$views++;
	$type = $row["type"];
	$image = $row["image"];

	$content = str_replace(" ","&nbsp;",$content);
	$content = str_replace("\n","<br>",$content);

	$sql = "update board SET views=$views where num=$num";
	$result = mysqli_query($con,$sql);

	$sql = "select * from good where board=$num";
	$result = mysqli_query($con,$sql);
	$goodmem = mysqli_fetch_assoc($result);
	$goodnum = mysqli_num_rows($result);

	$sql = "select * from good where board=$num and id=$userid";
	$result = mysqli_query($con,$sql);
	$good = mysqli_num_rows($result);

	mysqli_close();
		if($table==='_all')
			switch($type)
			{
				case 1: $nn = "공지|"; break;
				case 2: $nn = "자유|"; break;
				case 3: $nn = "익명|"; break;
				case 4: $nn = "재학|"; break;
				case 5: $nn = "졸업|"; break;
				case 6: $nn = "정보|"; break;
				case 7: $nn = "건의|"; break;
				case 109: $nn = "9기"; break;
				case 109: $nn = "10기"; break;
				case 109: $nn = "11기"; break;
				case 109: $nn = "12기"; break;
				case 109: $nn = "13기"; break;
				case 109: $nn = "14기"; break;
				case 109: $nn = "15기"; break;
				case 109: $nn = "16기"; break;
				case 109: $nn = "17기"; break;
			}
		else
			$nn="";
?>

<h2> <?php echo $board_title ?> > 내용 보기 </h2>
<ul class = "board_view">
	<li class="row1">
		<span class="col1"><b><?php echo $nn.$subject ?></b></span>
		<span class="mobile"><br></span>
		<?php if($type!=3) { ?>
		<span class="col2"><a href="../member/member.php?type=view_form&id=<?php echo $id; ?>"><?php echo $name; ?></a> | <?php echo $regist_day ?> | 조회수 <?php echo $views ?></span>
		<?php } else { ?>
			<span class="col2">익명 | <?php echo $regist_day ?> | 조회수 <?php echo $views ?></span>
		<?php } ?>
	</li>
	<?php if($image>0){ ?>
		<li id="rowimg">
			<div id="img_cont">
			<?php for($i=0; $i<$image; $i++)
			{
				$img_dir = "images/".$num."_".$i;
				echo "<img src='{$img_dir}' id='img'>";
			} ?>
			</div>
		</li>
	<?php } ?>
	<li class="row2"><?php echo $content ?></li>
	
	<?php 
		if($good==0)
			$goodlink="bad";
		else
			$goodlink="good";
	
	?>
	<li class="row3">
		<br>
		<form method="post">
			<input type="submit" name="good" id="good">
		</form>
	<?php			   
		if(array_key_exists('good',$_POST)){
			include "../function/db_connect.php";
			if($good==0)
			{
				$sql = "INSERT INTO good(id,board) VALUES('$userid',$num)";
				mysqli_query($con,$sql);
				$goodlink="good";
				$goodnum+=1;
			}
			else
			{
				$sql = "DELETE FROM good WHERE id='$userid' and board=$num";
				mysqli_query($con,$sql);
				$goodlink="bad";
				$goodnum-=1;
			}
			//var_dump($_POST);
			unset($_POST["good"]);
			//var_dump($_POST);
			mysqli_close();
		}
	?>
		<label for="good"><img src="<?php echo $goodlink.".png" ?>" class="goodimg"></label>
	</li>
	<li class="row4"><span class="goodnum">GOOD : <?php echo $goodnum ?></span></li>
</ul>
<p></p>

<ul class="buttons">
	<li><button onclick="location.href='board.php?type=list&table=<?php echo $table ?>&page=<?php echo $page ?>'">목록보기</button></li>
	<?php if($id == $userid && $type!=3) { ?>
		<li><button onclick="location.href='board.php?type=edit&num=<?php echo $num ?>&table=<?php echo $table ?>&page=<?php echo $page ?>'">수정하기</button></li>
	<?php } ?>
	<?php if(($id == $userid &&$type!=3)|| $userid == 1234) { ?>
		<li><button onclick="location.href='board.php?type=blind&num=<?php echo $num ?>&table=<?php echo $table ?>&page=<?php echo $page ?>'">삭제하기</button></li>
	<?php } ?>
</ul>
<p></p>

<?php 
	$sql = "select * from reply where board=$num order by num";
	$reply_result = mysqli_query($con,$sql);
	$count=0;
	while($row_reply = mysqli_fetch_assoc($reply_result))
	{
		$reply_blind = $row_reply["blind"];
		if($reply_blind!=1)
			continue;
		
		$reply_num = $row_reply["num"];
		$reply_id = $row_reply["id"];
		$reply_name = $row_reply["name"];
		$reply_content = $row_reply["content"];
		$reply_date = $row_reply["regist_day"];
		$reply_board_type = $row_reply["board_type"];
		
		$reply_content = str_replace("\n", "<br>", $reply_content);
		$reply_content = str_replace(" ", "&nbsp", $reply_content);
	
?>

<div class="reply_title">
	<?php if($reply_board_type!=3) { ?>
	<span class="col1"><a href="../member/member.php?type=view_form&id=<?php echo $reply_id; ?>"><?php echo $reply_name; ?></a></span>
	<?php } else { ?>
	<span class="col1"><?php echo $reply_name; ?></span>
	<?php } ?>
	
	<span class="col2"><?php echo $reply_date; ?></span>
	<span class="col3"><?php 
		if(($userid == 1234 || $userid == $reply_id) && $reply_board_type!=3)
			echo "<a href = reply_blind.php?reply_num=$reply_num&page=$page&table=$table&num=$num&userid=$userid>삭제</a>";
	?></span>
</div>
<div class="reply_content">
	<?php echo $reply_content; ?>
</div>
<p></p>
<?php $count++; } mysqli_close(); ?>


<div class="reply_box">
	<form name="reply_form" method="post" action="insert_reply.php?type=<?php echo $type; ?>&num=<?php echo $num; ?>&page=<?php echo $page; ?>&table=<?php echo $table; ?>&userid=<?php echo $userid; ?>&username=<?php echo $username; ?>" enctype="multipart/form-data">
		<span class="box1"><textarea name="reply_content" rows="3" style="width:100%;"></textarea></span>
		<span calss="box2">
			<button type ="button" onclick="reply_check_input()">댓글쓰기</button>
		</span>
	</form>
</div>