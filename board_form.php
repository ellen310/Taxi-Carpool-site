<!DOCTYPE html>
<html>
<head> 
<meta charset="utf-8">
<title>PHP 프로그래밍 입문</title>
<link rel="stylesheet" type="text/css" href="./css/common.css?after">
<link rel="stylesheet" type="text/css" href="./css/board.css?after">
    
<?php
    $mode=$_GET["mode"];
?>    
    
<script>
  function check_input() {
      if (!document.board_form.destination.value)
      {
          alert("목적지를 입력하세요!");
          document.board_form.destination.focus();
          return;
      }
      if (!document.board_form.time.value)
      {
          alert("탑승시간을 입력하세요!");
          document.board_form.time.focus();
          return;
      }
      if (!document.board_form.content.value)
      {
          alert("내용을 입력하세요!");    
          document.board_form.content.focus();
          return;
      }
      document.board_form.submit();
   }
</script>
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
            if($mode=="ca"){
                echo "<h3>천안역 > 글 쓰기</h3>";
            }
            else if($mode=="dj"){
                echo "<h3>두정역 > 글 쓰기</h3>";
            }
            else if($mode=="ter"){
                echo "<h3>터미널 > 글 쓰기</h3>";
            }
            else if($mode=="etc"){
                echo "<h3>기타 > 글 쓰기</h3>";
            }
        ?>
	    
	    <form  name="board_form" method="post" action="board_insert.php?mode=<?=$mode?>"> 
            
	    	 <ul id="board_form">
				<li>
					<span class="col1">이름 : </span>
					<span class="col2"><?=$username?></span> <!--header부분의 세션에서 이미 username을 가져왔기때문에 그대로 갖다씀-->
				</li>		
	    		<li>
	    			<span class="col1">목적지 : </span>
	    			<span class="col2"><input name="destination" type="text"></span>
	    		</li>	    
                 <li>
	    			<span class="col1">탑승시간 : </span>
	    			<span class="col2"><input name="time" type="text"></span>
	    		</li>	
	    		<li id="text_area">	
	    			<span class="col1">내용 : </span>
	    			<span class="col2">
	    				<textarea name="content"></textarea>
	    			</span>
	    		</li>
	    	    </ul>
	       <ul class="buttons">
				<li><button type="button" onclick="check_input()">완료</button></li>
				<li><button type="button" onclick="location.href='board_list_<?=$mode?>.php'">목록</button></li>
			</ul>
	    </form>
	</div> <!-- board_box -->
</section> 
<footer>
    <?php include "footer.php";?>
</footer>
</body>
</html>
