<?
   @session_start();
   include "../lib/dbconn_admin.php";
?>
<meta charset = "utf-8">
<?

   $sql = "delete from mem where id='$s_id'";
   unset($_SESSION['s_id']);  
   unset($_SESSION['s_pass']);   
   unset($_SESSION['s_name']);   
   unset($_SESSION['s_hp']);   
   unset($_SESSION['s_addr']);   

   mysql_query($sql, $connect);   
   mysql_close();

   echo "
	   <script>
        window.alert('회원탈퇴 완료!')
	    location.href = '../index.php?table=$table'
	   </script>
	";
?>

