<!DOCTYPE html>
<html>
<head> 
<meta charset="utf-8">
<title>PHP 프로그래밍 입문</title>
<link rel="stylesheet" type="text/css" href="./css/common.css?after">
<link rel="stylesheet" type="text/css" href="./css/message.css?after">
</head>
<body> 
<header>
    <?php include "header.php";?>
</header>  
<section>
	<div id="main_img_bar">
        <img src="./img/mymain_img.png">
    </div>
   	<div id="message_box">
	    <h3 class="title">
<?php
	$mode = $_GET["mode"];
	$num  = $_GET["num"];

	$con = mysqli_connect("localhost", "root", "12345", "taxi");
	$sql = "select * from message where num=$num";
	$result = mysqli_query($con, $sql);

	$row = mysqli_fetch_array($result);
	$send_id    = $row["send_id"];
	$rv_id      = $row["rv_id"];
	$regist_day = $row["regist_day"];
	$subject    = $row["subject"];
	$content    = $row["content"];

	$content = str_replace(" ", "&nbsp;", $content); //띄어쓰기가 있으면 공백키(nbsp)로 바꿔줘라
	$content = str_replace("\n", "<br>", $content); //문장상에 엔터가 있으면 <br>로 바꿔줘라  --  html에서 \n은 엔터가 아님. 공백 하나임. 그래서 그걸<br>로바꾼거

	if ($mode=="send") //내가 보낸 메시지: 받은사람이 누군지 알아야함.-멤버테이블에서 rv_id를 받아옴
		$result2 = mysqli_query($con, "select name from user where id='$rv_id'");
	else //내가 받은 메시지: 보낸사람이 누군지 알아야함.-멤버테이블에서 send_id 받아옴
		$result2 = mysqli_query($con, "select name from user where id='$send_id'");

	$record = mysqli_fetch_array($result2);
	$msg_name = $record["name"];

	if ($mode=="send")	    	
	    echo "송신 쪽지함 > 내용보기";
	else
		echo "수신 쪽지함 > 내용보기";
?>
		</h3>
	    <ul id="view_content">
			<li>
				<span class="col1"><b>제목 :</b> <?=$subject?></span>
				<span class="col2"><?=$msg_name?> | <?=$regist_day?></span>
			</li>
			<li>
				<?=$content?> <!--원본그대로출력-->
			</li>		
	    </ul>
	    <ul class="buttons">
				<li><button onclick="location.href='message_delete.php?num=<?=$num?>&mode=<?=$mode?>'">삭제</button></li>
		</ul>
	</div> 
</section> 
<footer>
    <?php include "footer.php";?>
</footer>
</body>
</html>
