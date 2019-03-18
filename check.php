<? @session_start(); ?>
<meta charset="utf-8">
<?
include "./lib/dbconn_admin.php";
?>

<?
   $sql = "select * from mem";
   $result = mysql_query($sql, $connect);
?>


<table width = "800" border="1" >
    <tr>
        <td> 일련번호 </td>
        <td> 아이디 </td>
        <td> 비밀번호 </td>              
        <td> 이름 </td>
        <td> 핸드폰번호 </td> 
        <td> 주소 </td>
    </tr>



<?
$number = 1;
while($row = mysql_fetch_array($result))
{
    echo ("
    <tr>
    <td>$number</td>
    <td>$row[id]</td>
    <td>$row[pass]</td>
    <td>$row[name]</td>
    <td>$row[hp]</td>
    <td>$row[addr]</td>
    </tr>
    ");
    $number++;
}
?>

</table>