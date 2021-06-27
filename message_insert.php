<meta charset='utf-8'> <!--받은 메시지를 처리하는 페이지-->
<?php
    $send_id = $_GET["send_id"];
    $rv_id = $_POST['rv_id'];
    $subject = $_POST['subject'];
    $content = $_POST['content'];
	$subject = htmlspecialchars($subject, ENT_QUOTES); //html에서 쓰이는 기호들을 태그로 인식하지 않도록 하는작업. <,> 이런거를 태그로 안보도록
	$content = htmlspecialchars($content, ENT_QUOTES);
	$regist_day = date("Y-m-d (H:i)");  // 현재의 '년-월-일-시-분'을 저장

	if(!$send_id) {
		echo("
			<script>
			alert('로그인 후 이용해 주세요! ');
			history.go(-1)
			</script>
			");
		exit;
	}

	$con = mysqli_connect("localhost", "root", "12345", "taxi");
	$sql = "select * from user where id='$rv_id'";
	$result = mysqli_query($con, $sql);
	$num_record = mysqli_num_rows($result);

	if($num_record)
	{
		$sql = "insert into message (send_id, rv_id, subject, content,  regist_day) ";
		$sql .= "values('$send_id', '$rv_id', '$subject', '$content', '$regist_day')";
		mysqli_query($con, $sql);  // $sql 에 저장된 명령 실행
        
        echo "<script>
                alert('메시지가 전송되었습니다.  Tip)동승 후 동승완료 버튼을 누르면 포인트 적립!')
                location.href='index.php'
              </script>";
        
	} else {
		echo("
			<script>
			alert('수신 아이디가 잘못 되었습니다!');
			history.go(-1)
			</script>
			");
		exit;
	}

	mysqli_close($con);                // DB 연결 끊기

	
?>

  
