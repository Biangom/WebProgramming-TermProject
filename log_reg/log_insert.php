<? @session_start(); ?>
<meta charset="utf-8" />

<?

include "../lib/dbconn_admin.php";       // dconn.php 파일을 불러옴


$sql = "select * from mem where id = '$log_id'";
$result = mysql_query($sql, $connect);
$num_match = mysql_num_rows($result);

// num_match != 1 <- 아이디가 이미 존재하지 않을때.
if(!$num_match)
{
    echo("
    <script>
     window.alert('등록되지 않은 아이디입니다.')
     history.go(-1)
    </script>
    ");
    exit;
}
else // 아이디가 있다면
{
    $row = mysql_fetch_array($result);
    $db_pass = $row[pass];

    echo "$log_pass $row[pass]";

    if($log_pass != $db_pass)
    {
        echo("
        <script>
        window.alert('비밀번호가 틀립니다.')
        history.go(-1)
        </script>
        ");
        exit;
    }
    else
    {
        $t_id = $row[id];
        $t_pass = $row[pass];
        $t_name = $row[name];
        $t_hp = $row[hp];
        $t_addr = $row[addr];

        $_SESSION['s_id'] = $t_id;
        $_SESSION['s_pass'] = $t_pass;
        $_SESSION['s_name'] = $t_name;
        $_SESSION['s_hp'] = $t_hp;
        $_SESSION['s_addr'] = $t_addr;

        echo("
        <script>
        location.href = '../index.php';
        </script>
        ");
    }
}
?>