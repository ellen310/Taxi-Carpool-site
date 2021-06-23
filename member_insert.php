<?php
    $id   = $_POST["id"];
    $pass = $_POST["pass"];
    $name = $_POST["name"];
    $regist_day = date("Y-m-d (H:i)");  // 현재의 '년-월-일-시-분'을 저장
    $dri_check = $_POST["dri_check"];
              
    $con = mysqli_connect("localhost", "root", "12345", "taxi");

	$sql = "insert into user(id, pass, name, regist_day, level, point) ";

    if($dri_check=="yes"){ //택시기사 체크박스 o ==> level을 2로 설정
        $sql .= "values('$id', '$pass', '$name', '$regist_day', 2, 0)";
    }
    else{ //일반인은 level이 1
      $sql .= "values('$id', '$pass', '$name', '$regist_day', 1, 0)";   
    }

	mysqli_query($con, $sql);  // $sql 에 저장된 명령 실행
    mysqli_close($con);     

    echo "
	      <script>
	          location.href = 'index.php';
	      </script>
	  ";
?>

   
