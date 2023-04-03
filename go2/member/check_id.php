<?php
		use PHPMailer\PHPMailer\PHPMailer;
		use PHPMailer\PHPMailer\Exception;
		use PHPMailer\PHPMailer\SMTP;
	include "../function/db_connect.php";

	$id = $_GET["id"];
	$sql = "select regist_day from member where id = '$id'";
	$result = mysqli_query($con,$sql);
	$num = mysqli_num_rows($result);
	$regist = mysqli_fetch_row($result);
	$regist = $regist[0];
	if($num==0)
	{
		echo "존재하지 않는 이메일 주소입니다.";
	}
	else if(!is_null($regist))
	{
		echo "이미 회원가입한 이메일입니다.<br>비밀번호 찾기 등 계정 관련된 문제 해결을 원하신다면<br>2018000032@ushs.hs.kr 으로 직접 문의 바랍니다.";
	}
	else
	{
		echo "인증번호가 담긴 이메일을 발송했습니다.<br>이메일이 오지 않는다면 스펨 메일함도 확인해보세요.<br>";
		$rand = rand(100000,999999);
		$sql = "update member set point='$rand' where id='$id'";
		mysqli_query($con,$sql);
		require '../PHPMailer/src/Exception.php';
		require '../PHPMailer/src/PHPMailer.php';
		require '../PHPMailer/src/SMTP.php';

		$mail = new PHPMailer(true); // the true param means it will throw exceptions on errors, which we need to catch $mail->IsSMTP(); // telling the class to use SMTP
		$mail->IsSMTP(); // telling the class to use SMTP
		try {
		$mail->CharSet = "utf-8";   //한글이 안깨지게 CharSet 설정
		$mail->Encoding = "base64";
		$mail->Host = "smtp.gmail.com"; // email 보낼때 사용할 서버를 지정
		$mail->SMTPAuth = true; // SMTP 인증을 사용함
		$mail->Port = 465; // email 보낼때 사용할 포트를 지정
		$mail->SMTPSecure = "ssl"; // SSL을 사용함
		$mail->Username = "liargames2002@gmail.com"; // Gmail 계정
		$mail->Password = "###########################################"; // 패스워드
		$mail->SetFrom('liargames2002@gmail.com'); // 보내는 사람 email 주소와 표시될 이름 (표시될 이름은 생략가능)
		$mail->AddAddress($id.'@ushs.hs.kr'); // 받을 사람 email 주소와 표시될 이름 (표시될 이름은 생략가능)
		$mail->Subject = '고헌산닷컴 인증번호'; // 메일 제목
		$mail->Body =
		"고헌산닷컴 인증번호는 ".$rand." 입니다!"; // 내용
		$mail->Send(); // 발송
		
		 }
		catch (phpmailerException $e) {
								echo $e->errorMessage(); //Pretty error messages from PHPMailer
		} catch (Exception $e) {
								echo $e->getMessage(); //Boring error messages from anything else!
		}

	}
	mysqli_close($con);
?>
   <div class="close">
      <button type="button" onclick="javascript:self.close()">창 닫기</button>
   </div>
