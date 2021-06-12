<meta charset="utf-8">
<?php
    session_start();
    if (isset($_SESSION["userid"])) $userid = $_SESSION["userid"];
    else $userid = "";
    if (isset($_SESSION["username"])) $username = $_SESSION["username"];
    else $username = "";




    if ( !$userid )
    {
        echo("
                    <script>
                    alert('게시판 글쓰기는 로그인 후 이용해 주세요!');
                    history.go(-1)
                    </script>
        ");
                exit;
    }

    $mode=$_GET["mode"];
    $destination = $_POST["destination"];
    $time = $_POST["time"];
    $content = $_POST["content"];

    $destination = htmlspecialchars($destination, ENT_QUOTES);
	$time = htmlspecialchars($time, ENT_QUOTES);
	$content = htmlspecialchars($content, ENT_QUOTES);

	$regist_day = date("Y-m-d (H:i)");  // 현재의 '년-월-일-시-분'을 저장
    $point=$_SESSION["userpoint"];

	$con = mysqli_connect("localhost", "root", "12345", "taxi");

	$sql = "insert into board_$mode (id, name, content, destination, reservation, regist_day, time, point)";
	$sql .= "values('$userid', '$username', '$content', '$destination', '0', '$regist_day' ,'$time', '$point')";
	mysqli_query($con, $sql);  // $sql 에 저장된 명령 실행

          
    $sql = "select * from board_$mode order by id desc limit 1";          //방금 추가한 게시글에서 num을 가져온다
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);
    $num         = $row["num"];
          
          
        $sql = "insert into check_$mode (num, bName, completeCheck)";
        $sql .= "values('$num', '$username', '0')";
        mysqli_query($con, $sql);       


	mysqli_close($con);                // DB 연결 끊기

?>


	   <script>
	   location.href='board_list_<?=$mode?>.php';
	   </script>
	

