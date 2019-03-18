<? @session_start(); ?>

<meta charset="utf-8">
<?

	if(!$s_id) {
		echo("
		<script>
	     window.alert('로그인 후 이용해 주세요.')
	     history.go(-1)
	   </script>
		");
		exit;
	}

	$regist_day = date("Y-m-d (H:i)");  // 현재의 '년-월-일-시-분'을 저장
	include "../lib/dbconn_admin.php";       // dconn_admin.php 파일을 불러옴

    //수정이라면

	if ($mode=="modify")
	{
		$sql = "update $table set subject='$in_subj', content='$in_text' where num=$num";
		mysql_query($sql, $connect);  // $sql 에 저장된 명령 실행
	}
	else // 수정이아니라 새등록아니라면
	{
        // 답변글 이라면
		if ($mode=="response")
		{
			// 부모 글 가져오기
			$sql = "select * from $table where num = $num";
			$result = mysql_query($sql, $connect);
			$row = mysql_fetch_array($result);

			// 부모 글로 부터 group_num, depth, ord 값 설정
			$group_num = $row[group_num];
			$depth = $row[depth] + 1;
			$ord = $row[ord] + 1;

			// 해당 그룹에서 ord 가 부모글의 ord($row[ord]) 보다 큰 경우엔
			// ord 값 1 증가 시킴
			$sql = "update $table set ord = ord + 1 where group_num = $row[group_num] and ord > $row[ord]";
			mysql_query($sql, $connect);  

			// 레코드 삽입
			$sql = "insert into $table (group_num, depth, ord, id, name, subject,";
			$sql .= "content, regist_day, hit) ";
			$sql .= "values($group_num, $depth, $ord, '$s_id', '$s_name', '$in_subj',";
			$sql .= "'$in_text', '$regist_day', 0)";    

			mysql_query($sql, $connect);  // $sql 에 저장된 명령 실행
		}
		else // 새등록 글이라면
		{
			$depth = 0;   // depth, ord 를 0으로 초기화
			$ord = 0;

			// 레코드 삽입(group_num 제외)
			$sql = "insert into $table (depth, ord, id, name, subject,";
			$sql .= "content, regist_day, hit) ";
			$sql .= "values($depth, $ord, '$s_id', '$s_name', '$in_subj',";
			$sql .= "'$in_text', '$regist_day', 0)";    
			mysql_query($sql, $connect);  // $sql 에 저장된 명령 실행

			// 최근 auto_increment 필드(num) 값 가져오기
			$sql = "select last_insert_id()"; 
			$result = mysql_query($sql, $connect);
			$row = mysql_fetch_array($result);
			$auto_num = $row[0]; 

			// group_num 값 업데이트 
			$sql = "update $table set group_num = $auto_num where num=$auto_num";
			mysql_query($sql, $connect);
		}
	}

	mysql_close();                // DB 연결 끊기

	echo "
	   <script>
	    location.href = '../qna.php?table=$table&page=$page';
	   </script>
	";
?>