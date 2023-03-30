<h2 class="title">
	<?php echo $board_title; ?> > 목록 보기
</h2>
<div class="write_button">
<?php if($table!='_all' && $table!='_hot' && $table!='_notice') { ?>
	<button onclick="location.href='board.php?type=form&table=<?php echo $table ?>'">글쓰기</button>
<?php } ?>
<?php if($table==='_notice' && $userid==1234) { ?>
	<button onclick="location.href='board.php?type=form&table=<?php echo $table ?>'">글쓰기</button>
<?php } ?>
</div>
<ul class="board_list">
	<li class="head">
		<span class="col1">번호</span>
		<span class="col2">제목</span>
		<span class="col3">글쓴이</span>
		<span class="col4">작성시간</span>
		<span class="col5">조회수</span>
	</li>
<?php

	include "../function/db_connect.php";
	$sql = "select * from board where blind=1 ".$board_cond."order by num desc";
	$result = mysqli_query($con,$sql);
	$total_record = mysqli_num_rows($result);
	if($total_record % $scale == 0)
		$total_page = floor($total_record/$scale);
	else
		$total_page = floor($total_record/$scale)+1;
	$start = (intval($page)-1)*$scale;
	$number = $total_record - $start;
	for($i=$start; $i<$start+$scale && $i<$total_record; $i++)
	{
		mysqli_data_seek($result,$i);
		$row = mysqli_fetch_assoc($result);
		
		$num = $row["num"];
		$id = $row["id"];
		$name = $row["name"];
		$subject = $row["subject"];
		$regist_day = $row["regist_day"];
		$type = $row["type"];
		$views = $row["views"];
		
		$time =  date("Y.m.d H:i:s");
		if(strncmp($regist_day,$time,10)==0)
			$date = substr($regist_day,11,20);
		else
			$date = substr($regist_day,0,10);
		#var_dump($row);
		echo "<br>";
		
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
		else
			$nn="";

?>

<li class="tail">
	<span class="col1"><?php echo $num; ?></span>
	<?php
		$sql = "select * from reply where board=$num and blind=1";
		$result2 = mysqli_query($con,$sql);
		$num_reply = mysqli_num_rows($result2);
		
		if($num_reply)
			$num_reply= "[$num_reply]";
		else
			$num_reply="";
	?>
	<span class="col2"><a href="board.php?type=view&table=<?php echo $table; ?>&num=<?php echo $num; ?>&page=<?php echo $page; ?>"><?php echo $nn.$subject.$num_reply; ?></a></span>
	<?php if($type!=3) { ?>
		<span class="col3"><a href="../member/member.php?type=view_form&id=<?php echo $id; ?>"><?php echo $name; ?></a></span>
	<?php } else { ?>
		<span class="col3">익명</span>
	<?php } ?>
	<div class="col_mob_enter"></div>
	<span class="col4"><?php echo $date; ?></span>
	<span class="col5"><?php echo $views; ?></span>
</li>

<?php

	$number--;
	}
	mysqli_close();	

?>
	
</ul>

<ul class="page_num">
	<?php
		if($total_page >=2 && $page >=2)
		{
			$new_page = $page-1;
			echo "<li><a href='board.php?page=$new_page&table=$table&type=list'>◀</a></li>";
		}
		else
			echo "<li>&nbsp;<li>";
	
		for($i=1; $i<=$total_page; $i++)
		{
			if($page==$i)
				echo "<li><b> $i <b></li>";
			else
				echo "<li><a href='board.php?page=$i&table=$table&type=list'> $i </a><li>";
		}
		if($total_page >=2 && $page !=$total_page)
		{
			$new_page = $page+1;
			echo "<li><a href='board.php?page=$new_page&table=$table&type=list'>▶</a></li>";
		}
		else
			echo "<li>&nbsp;<li>";
	?>
</ul>
