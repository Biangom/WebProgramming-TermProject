<?

   include "../lib/dbconn_admin.php";
 
   $sql = "update survey set $composer = $composer + 1";
   mysql_query($sql, $connect);

   mysql_close();

  echo("<script>
    location.href = 'result.php';  
  </script>");
?>

