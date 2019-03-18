<?
      include "../lib/dbconn_admin.php";

      $sql = "delete from view_ripple where num=$ripple_num";
      mysql_query($sql, $connect);
      mysql_close();

      echo "
	   <script>
	    location.href = '../review_view.php?table=$table&num=$num';
	   </script>
	  ";
?>
