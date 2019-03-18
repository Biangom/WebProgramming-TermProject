<?
   @session_start();
   include "../lib/dbconn_admin.php";

   $sql = "select * from $table where num = $num";
   $result = mysql_query($sql, $connect);
   $row = mysql_fetch_array($result);


   $sql = "delete from $table where num = $num";
   mysql_query($sql, $connect);

   mysql_close();


   echo "
	   <script>
	    location.href = '../qna.php?table=$table';
	   </script>
	";
?>

