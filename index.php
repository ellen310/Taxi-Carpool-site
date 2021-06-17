<!DOCTYPE html>
<html>
<head> 
<meta charset="utf-8">
<title>택시 동승 사이트</title>
<link rel="stylesheet" type="text/css" href="./css/common.css?after">
<link rel="stylesheet" type="text/css" href="./css/main.css?after">
</head>
<body> 
	<header>
    	<?php include "header.php";?>
    </header>
	<section>
        <?php
        
         if($userlevel == 2){
           echo "<script>location.href='board_list_dri.php'</script>";  //include "driver_main.php";  //level 2이면 택시운전자
        }
        else{
            include "normal_main.php";
        }
        
        ?>
        
       
	    
	</section> 
	<footer>
    	<?php include "footer.php";?>
    </footer>
</body>
</html>
