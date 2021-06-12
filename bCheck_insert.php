<?php
      $mode = $_GET["mode"];
      $num  = $_POST["num"];  
      $username=$_POST["username"];

        $con = mysqli_connect("localhost", "root", "12345", "taxi");
        $sql = "insert into reservation select * from board_$mode where num=$num"; //게시글에 있던 글을 복사해서 예약완료db로 넣겠다.
        mysqli_query($con, $sql);      

      $sql = "select * from check_$mode where num=$num";   //해당 게시글과 연관된 boardingcheck데이터만 가져옴
      $result = mysqli_query($con, $sql);
      $total_record = mysqli_num_rows($result); //해당 게시글과 연관된 check_$mode의 개수 셈
    
    if($total_record>=3){ // 메시지를 보냄 : 택시동승하겠다 : boardingcheck에 추가됨. boardingcheck개수==게시글 작성자제외한 탑승자수
        echo "<script> alert('탑승 가능한 인원이 이미 다 모였습니다.')
                history.back();
        </script>";
    }
    else{
        $con = mysqli_connect("localhost", "root", "12345", "taxi");
        $sql = "insert into check_$mode (num, bName, completeCheck)";
        $sql .= "values('$num', '$username', '0')";
        mysqli_query($con, $sql);       

        echo  "<script> location.href='message_form.php' </script>"; //메시지 작성폼으로 이동
    }

?>

