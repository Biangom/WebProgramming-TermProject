<?	@session_start();?>
<? include "header.php"; ?>

<?
	include "./lib/dbconn_admin.php";

	$sql = "select * from $table where num=$num";
	$result = mysql_query($sql, $connect);

    $row = mysql_fetch_array($result);       
      // 하나의 레코드 가져오기
	
	$item_num     = $row[num];
	$item_id      = $row[id];
	$item_name    = $row[name];
	$item_hit     = $row[hit];

	$file_name[0]   = $row[file_name_0];
	$file_name[1]   = $row[file_name_1];
	$file_name[2]   = $row[file_name_2];


	$file_copied[0] = $row[file_copied_0];
	$file_copied[1] = $row[file_copied_1];
	$file_copied[2] = $row[file_copied_2];

    $item_date    = $row[regist_day];
	$item_subject = str_replace(" ", "&nbsp;", $row[subject]);

	$item_content = str_replace(" ", "&nbsp;", $row[content]);
	$item_content = str_replace("\n", "<br>", $item_content);

	$new_hit = $item_hit + 1;

	$sql = "update $table set hit=$new_hit where num=$num";   // 글 조회수 증가시킴
	mysql_query($sql, $connect);
?>

<!--자바스크립트-->
<script>
    function delete_func(href) 
    {
        if(confirm("한번 삭제한 자료는 복구할 방법이 없습니다.\n\n정말 삭제하시겠습니까?")) {
                document.location.href = "notice/delete_notice.php?table=<?=$table?>&num=<?=$num?>";
        }
    }

</script>

<!--끝-->


 <table class="table">
        <tr><td colspan = 2 style = "text-align: center"> 공지사항</td>       </tr>
        <tr><td style ="text-align: center">아이디</td> <td width = "80%"> <?=$item_id?> </td></tr>
        
        <tr><td style ="text-align: center">제목</td> <td>

        <?= $item_subject ?>
        
        
         </td></tr>
        <tr><td style ="text-align: center">조회</td><td> <?=$item_hit?></td> </tr>
        <tr><td style ="text-align: center">날짜</td><td> <?= $item_date ?></td></tr>
        <tr><td style ="text-align: center">내용</td> <td>
        <?

		for ($i=0; $i<3; $i++)
		{
			// id가 존재하고, 파일이있다면
			if ($s_id && $file_copied[$i])
			{
				$show_name = $file_name[$i];
				$real_name = $file_copied[$i];
				$real_type = $file_type[$i];
				$file_path = "./data/".$real_name;
				$file_size = filesize($file_path);

				echo "▷ 첨부파일 : $show_name ($file_size Byte) &nbsp;&nbsp;&nbsp;&nbsp;
					<a href='notice/download_notice.php?table=$table&num=$num&real_name=$real_name&show_name=$show_name&file_type=$real_type'>[저장]</a><br><br>";
			}
		} 

        ?>
        <?=  nl2br($item_content) ?>        
        </td></tr>
</table>

<div name = "btn_group" align = "right">
<input  class="btn"  type = "button" value="목록" name = "notice_btn" onClick = "location.href='./notice.php?table=<?=$table?>'" >  
<? 
	if($s_id==$item_id || $s_id=="admin")
	{
?>

	<a href="notice_write.php?table=<?=$table?>&mode=modify&num=<?=$num?>&page=<?=$page?>">
    <input  class="btn btn-info"  type = "button" value="수정" name = "modify_btn" >
    </a>
    <input  class="btn"  type = "button" value="삭제" name = "delete_btn" onClick = "delete_func()" > 
	<p> </p><p> </p>
<?
	}
?>
</div>

<? include "footer.php"; ?>

