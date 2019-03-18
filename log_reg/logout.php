<?
    @session_start();
    unset($_SESSION['s_id']);
    unset($_SESSION['s_pass']);
    unset($_SESSION['s_name']);
    unset($_SESSION['s_hp']);
    unset($_SESSION['s_addr']);
    echo("
        <script>
        location.href = '../index.php'; 
        </script>
    ");
?>
