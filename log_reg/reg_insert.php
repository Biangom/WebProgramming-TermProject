<meta charset="utf-8">
<?
   include "../lib/dbconn_admin.php";       // dconn.php 파일을 불러옴

   $sql = "select * from mem where id='$reg_id'";
   $result = mysql_query($sql, $connect);
   $exist_id = mysql_num_rows($result);

   echo "아이디 비밀번호 이름 핸드폰번호 주소<br>";
   echo "$reg_id, $reg_pass, $reg_name, $reg_hp, $reg_addr<br>";
   echo "$result<br>";
   echo "$exist_id<br>";

//수정모드라면
if($mode == "modify")
{
  // $m_hp = $m_hp;
  $sql = "update mem set pass='$m_pass', hp='$m_hp', addr='$m_addr' where id='$m_id'";
  mysql_query($sql, $connect);

  mysql_close();     
  echo "
    <script>
          window.alert('회원 정보 수정완료!')
          location.href = '../index.php';
    </script>
  ";
}
else
{   
  // $exist_id == 1 : 해당아디가 존재한다.
   if($exist_id) {
     echo("
           <script>
             window.alert('해당 아이디가 존재합니다.')
             history.go(-1)
           </script>
         ");
         exit;
   }
   else
   {            // 레코드 삽입 명령을 $sql에 입력

      $sql = "insert into mem(id, pass, name, hp, addr) ";
      $sql .= "values('$reg_id', '$reg_pass', '$reg_name', '$reg_hp','$reg_addr')";

    
      mysql_query($sql, $connect);  // $sql 에 저장된 명령 실행

   }    



   mysql_close();                // DB 연결 끊기
   echo "
	   <script>
	         window.alert('회원가입을 진심으로 축하합니다!')
           location.href = '../index.php';
	   </script>
	";

}
?>

   
