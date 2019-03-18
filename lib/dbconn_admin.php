<?
    $connect=mysql_connect( "localhost", "shadmin", "1234") or  
        die( "SQL server에 연결할 수 없습니다."); 
   // mysql_query($connect, "set names utf8");

    mysql_select_db("shoes_db",$connect);
?>
