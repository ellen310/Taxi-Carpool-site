<?php

    $mode=$_GET["mode"];
    $name=$_POST["username"];
    $num=$_POST["num"];

    $con = mysqli_connect("localhost", "root", "12345", "taxi");
    $sql = "update check_$mode set completeCheck='1' where bNname=$name"; //동승완료 누른사람은 check_mode의 completeCheck를 1로 update. 
    $result = mysqli_query($con, $sql);


//completeCheck가 1인 레코드의 개수를 셈. ==> if (completeCheck테이블 전체 레코드수 == 1인레코드수) 이면 complete의 name에 있는사람들 모두 포인트 1씩 적립.

    $sql = "select * from check_$mode where num=$num";
    $result = mysqli_query($con, $sql);
	$table_record = mysqli_num_rows($result);      //complete테이블 전체 레코드 수

    $sql = "select * from check_$mode where num=$num and completeCheck='1'"; //해당게시글에서 동승완료가 클릭된 레코드
    $result = mysqli_query($con, $sql);
	$checked_record = mysqli_num_rows($result);      //동승완료 클릭된 횟수

    
    if($table_record == $checked_record){
         $sql = "update user set point=point+1 where check_$mode.num=$num";   // 게시글에서 예약자 모두 탑승완료를 눌렀다면, 모든 user의 point를 1 증가시킴
         $result = mysqli_query($con, $sql);
    }

  echo "<script>
                alert('체크되었습니다.  모든 예약자가 동승완료 클릭하면 1포인트 적립!')
                location.href='index.php'
              </script>";

?>

