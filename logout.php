<?php
  session_start();
  unset($_SESSION["userid"]); //세션을 지워라 (로그인정보를 지워라)
  unset($_SESSION["username"]);
  unset($_SESSION["userlevel"]);
  unset($_SESSION["userpoint"]);
  
  echo("
       <script>
          location.href = 'index.php';
         </script>
       ");
?>
