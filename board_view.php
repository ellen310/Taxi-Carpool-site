<!DOCTYPE html>
<html>
<head> 
<meta charset="utf-8">
<title>PHP 프로그래밍 입문</title>
<link rel="stylesheet" type="text/css" href="./css/common.css?after">
<link rel="stylesheet" type="text/css" href="./css/board.css?after">
    
    <style>
        table{
            width: 100%;
            text-align: center;
        }
        tr, td{
            width: 20%;
            border: 1px solid #444444;
            text-align: center
        }
    </style>
    
    
</head>
<body> 
<header>
    <?php include "header.php";?>
</header>  
        
    
<section>
	<div id="main_img_bar">
        <img src="./img/mymain_img.png">
    </div>
   	<div id="board_box">
        
        
        
<?php 
$num  = $_GET["num"];
$page = $_GET["page"];
$mode = $_GET["mode"];
        
            if($mode=="ca"){
                echo "<h3>천안역 > 내용보기</h3>";
            }
            else if($mode=="dj"){
                echo "<h3>두정역 > 내용보기</h3>";
            }
            else if($mode=="ter"){
                echo "<h3>터미널 > 내용보기</h3>";
            }
            else if($mode=="etc"){
                echo "<h3>기타 > 내용보기</h3>";
            }
        
	$con = mysqli_connect("localhost", "user1", "12345", "taxi");
	$sql = "select * from board_$mode where num=$num";
	$result = mysqli_query($con, $sql);

	$row = mysqli_fetch_array($result);
    $num         = $row["num"];
	$id = $row["id"];
	$name = $row["name"];
	$regist_day = $row["regist_day"];
	$destination = $row["destination"];
	$content = $row["content"];
    $time = $row["time"];
    $point = $row["point"];

	$content = str_replace(" ", "&nbsp;", $content);
	$content = str_replace("\n", "<br>", $content);

        
	mysqli_query($con, $sql);
?>		
        
        <table>
            <tr>
                <td><b>번호</b></td>
                <td><b>목적지</b></td>
                <td><b>탑승시간</b></td>
                <td><b>작성자</b></td>
                <td><b>등록일</b></td>
            </tr>
            <tr>
                <td><?=$num?></td>
                <td><?=$destination?></td>
                <td><?=$time?></td>
                <td><?=$name?>(<?=$point?>)</td>
                <td><?=$regist_day?></td>
            </tr>
            
            <tr>
                <td colspan="5" style="height: 70px;"><?=$content?></td>
            </tr>
        </table>
        
        
        
	    <ul class="buttons">
            
<?php
    if($name==$username){ //게시판 글 작성자와 세션의 name이 같을때 : 본인이 쓴 글일때.
        echo "<li><button onclick='location.href=";
        echo "'board_delete.php?num=$num&page=$page'>삭제</button></li>";
         echo "
        <form  name='member_form' method='post' action='completeCheck.php?&mode=<?=$mode?>'>
        <li><input type='submit' value='동승완료'></li>
        <input type='hidden' name='num' value='<?=$num?>'>
        <input type='hidden' name='username' value='<?=$username?>'>
        </form>
        ";
            
    }
                $sql = "select * from check_$mode where num=$num and bName='허민지'";    //모드별로 check 데이터베이스가 다르다. 이렇게 해야 게시글별 num이 겹치지 않는다.
	            $result = mysqli_query($con, $sql);
                $is_boarding = mysqli_num_rows($result);

    
    if($is_boarding){ //현재이용중인 사용자이름이 탑승자체크명단(check_$mode 데이터베이스)에 있다면 : 동승예약한 사용자는 동승완료버튼 활성화.
               echo "
        <form  name='member_form' method='post' action='completeCheck.php?&mode=<?=$mode?>'>
        <li><input type='submit' value='동승완료'></li>
        <input type='hidden' name='num' value='<?=$num?>'>
        <input type='hidden' name='username' value='<?=$username?>'>
        </form>
        ";
    }
                    
?>   
    <form  name="member_form" method="post" action="bCheck_insert.php?mode=<?=$mode?>">
        <li><input type="submit" value="메시지"></li>   <!--메시지는 기본으로 띄움, 탑승인원초과했는지 체크 후 메시지-->
        <input type="hidden" name="num" value="<?=$num?>">
        <input type="hidden" name="username" value="<?=$username?>">
     </form>
            
            
           
		</ul>
	</div> <!-- board_box -->
</section> 
<footer>
    <?php include "footer.php";?>
</footer>
</body>
</html>



