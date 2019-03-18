<? @session_start(); ?>
<? include "./header.php"; ?>
<? 	
	include "./lib/dbconn_admin.php";
	
	$sql = "select * from $table where num=$num";
	$result = mysql_query($sql, $connect);
    $row = mysql_fetch_array($result);       
	
	$item_num     = $row[num];
	$item_id      = $row[id];
	$item_name    = $row[name];
	$item_hit     = $row[hit];
    $item_date    = $row[regist_day];
	$item_subject = str_replace(" ", "&nbsp;", $row[subject]);
	$item_content = $row[content];


	$new_hit = $item_hit + 1;
	$sql = "update $table set hit=$new_hit where num=$num";   // 글 조회수 증가시킴
	mysql_query($sql, $connect);
?>




<!--자바스크립트-->
<script>
    function delete_func(href) 
    {
        if(confirm("한번 삭제한 자료는 복구할 방법이 없습니다.\n\n정말 삭제하시겠습니까?")) {
                document.location.href = "qna/delete_qna.php?table=<?=$table?>&num=<?=$num?>";
        }
    }

</script>

 <table class="table">
	<tr><td colspan = 2 style = "text-align: center"> 고객문의</td>       </tr>
	<tr><td style ="text-align: center">아이디</td> <td width = "80%"> <?=$item_id?> </td></tr>
	
	<tr><td style ="text-align: center">제목</td> <td>

	<?= $item_subject ?>       
	
	</td></tr>
	<tr><td style ="text-align: center">조회</td><td> <?=$item_hit?> </td> </tr>
	<tr><td style ="text-align: center">날짜</td><td> <?= $item_date ?> </td></tr>
	<tr><td style ="text-align: center">내용</td> <td><?= nl2br($item_content)?> </td></tr>      
</table>

<div name = "btn_group" align = "right">

		<input  class="btn"  type = "button" value="목록" name = "notice_btn" onClick = "location.href='./qna.php?table=<?=$table?>'" >
		<?
		if($s_id == "admin")
		{
		?>
			<input  class="btn btn-inverse large"  type = "button" value="답변" name = "response_btn"
			onClick = "location.href='qna_write.php?table=<?=$table?>&mode=response&num=<?=$num?>&page=<?=$page?>'">
		<?
		}
		?>  
	<? 
		// 수정 삭제
		if($s_id==$item_id || $s_id=="admin")
		{
	?>

	<a href="qna_write.php?table=<?=$table?>&mode=modify&num=<?=$num?>&page=<?=$page?>">
    <input  class="btn btn-info"  type = "button" value="수정" name = "modify_btn" >
    </a>
    <input  class="btn"  type = "button" value="삭제" name = "delete_btn" onClick = "delete_func()" > 

	<p> </p><p> </p>

	<?
		}
		// 수정 삭제 끝
	?>
</div>


<?
include "./footer.php";
?>

