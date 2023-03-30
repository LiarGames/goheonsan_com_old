<div class="notice">
	<h4>공지게시판</h4>
	<?php
		include "function/db_connect.php";
	
		$sql = "select * from board where type=1 and blind=1 order by num desc limit 5";
		$result = mysqli_query($con,$sql);
		$time =  date("Y.m.d H:i:s");
		
	
		while($row = mysqli_fetch_assoc($result))
		{
			$num = $row["num"];
			$name = $row["name"];
			$date = $row["regist_day"];
			$views = $row["views"];
			$id = $row["id"];
			if(strncmp($date,$time,10)==0)
				$date = substr($date,11,20);
			else
				$date = substr($date,0,10);
			$subject = $row["subject"];
			$subject = htmlspecialchars_decode($subject,ENT_QUOTES);
	?>
	<div class="item">
		<?php
			$sql = "select * from reply where board=$num and blind=1";
			$result2 = mysqli_query($con,$sql);
			$num_reply = mysqli_num_rows($result2);
			if($num_reply)
				$num_reply = "[$num_reply]";
			else
				$num_reply="";
		?>
		<span class="col1"><a href="board/board.php?type=view&num=<?php echo $num;?>&page=1&table=_notice"><?php echo $subject.$num_reply;?></a></span>
		<span class="col2"><a href="member/member.php?type=view_form&id=<?php echo $id; ?>"><?php echo $name; ?></a></span>
		<div class="col_mob_enter"></div>
		<span class="col3"><?php echo $date; ?></span>
		<span class="col4"><?php echo $views; ?></span>
	</div>
	<?php } ?>
</div>

<div class="free">
	<h4>자유게시판</h4>
	<?php
		include "function/db_connect.php";
	
		$sql = "select * from board where type=2 and blind=1 order by num desc limit 5";
		$result = mysqli_query($con,$sql);
		$time =  date("Y.m.d H:i:s");
		
	
		while($row = mysqli_fetch_assoc($result))
		{
			$num = $row["num"];
			$name = $row["name"];
			$date = $row["regist_day"];
			$views = $row["views"];
			$id = $row["id"];
			
			if(strncmp($date,$time,10)==0)
				$date = substr($date,11,20);
			else
				$date = substr($date,0,10);
			$subject = $row["subject"];
			$subject = htmlspecialchars_decode($subject,ENT_QUOTES);
	?>
	<div class="item">
		<?php
			$sql = "select * from reply where board=$num and blind=1";
			$result2 = mysqli_query($con,$sql);
			$num_reply = mysqli_num_rows($result2);
		
			if($num_reply)
				$num_reply = "[$num_reply]";
			else
				$num_reply="";
		?>
		<span class="col1"><a href="board/board.php?type=view&num=<?php echo $num;?>&page=1&table=_free"><?php echo $subject.$num_reply;?></a></span>
		<span class="col2"><a href="member/member.php?type=view_form&id=<?php echo $id; ?>"><?php echo $name; ?></a></span>
		<div class="col_mob_enter"></div>
		<span class="col3"><?php echo $date; ?></span>
		<span class="col4"><?php echo $views; ?></span>
	</div>
	<?php } ?>
</div>

<div class="all">
	<h4>전체게시판</h4>
	<?php
		include "function/db_connect.php";
	
		$sql = "select * from board where blind=1 order by num desc limit 10";
		$result = mysqli_query($con,$sql);
		$time =  date("Y.m.d H:i:s");
		
	
		while($row = mysqli_fetch_assoc($result))
		{
			$num = $row["num"];
			$name = $row["name"];
			$date = $row["regist_day"];
			$views = $row["views"];
			$type = $row["type"];
			$id = $row["id"];
			
			switch($type)
			{
				case 1: $nn = "공지|"; break;
				case 2: $nn = "자유|"; break;
				case 3: $nn = "익명|"; break;
				case 4: $nn = "재학|"; break;
				case 5: $nn = "졸업|"; break;
				case 6: $nn = "정보|"; break;
				case 7: $nn = "건의|"; break;
				case 109: $nn = "9기|"; break;
				case 110: $nn = "10기|"; break;
				case 111: $nn = "11기|"; break;
				case 112: $nn = "12기|"; break;
				case 113: $nn = "13기|"; break;
				case 114: $nn = "14기|"; break;
				case 115: $nn = "15기|"; break;
				case 116: $nn = "16기|"; break;
				case 117: $nn = "17기|"; break;
			}
			if(strncmp($date,$time,10)==0)
				$date = substr($date,11,20);
			else
				$date = substr($date,0,10);
			$subject = $row["subject"];
			$subject = htmlspecialchars_decode($subject,ENT_QUOTES);
	?>
	<div class="item">
		<?php
			$sql = "select * from reply where board=$num and blind=1";
			$result2 = mysqli_query($con,$sql);
			$num_reply = mysqli_num_rows($result2);
			
			$sql = "select * from board where num=$num";
			$result2 = mysqli_query($con,$sql);
			$board_type = mysqli_fetch_assoc($result2);
			$board_type = $board_type["type"];
			if($num_reply)
				$num_reply = "[$num_reply]";
			else
				$num_reply="";
		?>
		<span class="col1"><a href="board/board.php?type=view&num=<?php echo $num;?>&page=1&table=_all"><?php echo $nn;?><?php echo $subject.$num_reply;?></a></span>
		<?php if($board_type != 3) { ?>
		<span class="col2"><a href="member/member.php?type=view_form&id=<?php echo $id; ?>"><?php echo $name; ?></a></span>
		<?php
			}
			else
			{
		?>
		<span class="col2">익명</span>
		<?php } ?>
		<div class="col_mob_enter"></div>
		<span class="col3"><?php echo $date; ?></span>
		<span class="col4"><?php echo $views; ?></span>
	</div>
	<?php } ?>
</div>



<?php mysqli_close(); ?>