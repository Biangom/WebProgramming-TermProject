<? @session_start(); ?>
<? include "./header.php"; ?>

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

	$image_name[0]   = $row[file_name_0];
	$image_name[1]   = $row[file_name_1];
	$image_name[2]   = $row[file_name_2];

	$image_copied[0] = $row[file_copied_0];
	$image_copied[1] = $row[file_copied_1];
	$image_copied[2] = $row[file_copied_2];

    $item_date    = $row[regist_day];
	$item_subject = str_replace(" ", "&nbsp;", $row[subject]);

	$item_content = $row[content];
	
	for ($i=0; $i<3; $i++)
	{
		if ($image_copied[$i]) 
		{
			$imageinfo = GetImageSize("./data/".$image_copied[$i]);

			$image_width[$i] = $imageinfo[0];
			$image_height[$i] = $imageinfo[1];
			$image_type[$i]  = $imageinfo[2];

			if ($image_width[$i] > 785)
				$image_width[$i] = 785;
		}
		else
		{
			$image_width[$i] = "";
			$image_height[$i] = "";
			$image_type[$i]  = "";
		}
	}
	$new_hit = $item_hit + 1;

	$sql = "update $table set hit=$new_hit where num=$num";   // 글 조회수 증가시킴
	mysql_query($sql, $connect);
?>

<!--자바스크립트-->
<script>
    function delete_func(href) 
    {
        if(confirm("한번 삭제한 자료는 복구할 방법이 없습니다.\n\n정말 삭제하시겠습니까?")) {
                document.location.href = "review/delete_review.php?table=<?=$table?>&num=<?=$num?>";
        }
    }

    function ripple_insert()
    {   
        // ripple_text
        if(!document.ripple_form.ripple_text.value)
        {
            alert("덧글을 입력하세요!");
            document.ripple_form.ripple_text.focus();
            return;
        }

        document.ripple_form.submit();
    }
</script>

<!--덧글 배경색을 지정해주기 위함-->
<style type="text/css">

#td_back td { background-color:#f0f0f0; padding:10px; border:1px ; }

</style>

<body>

 <table class="table">
        <tr><td colspan = 2 style = "text-align: center"> 후기게시판 글내용</td>       </tr>
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
			if ($image_copied[$i])
			{
				$img_name = $image_copied[$i];
				$img_name = "./data/".$img_name;
				$img_width = $image_width[$i];
				
				echo "<img src='$img_name' width='$img_width'>"."<br><br>";
			}
		} 
        ?>
        <?=nl2br($item_content)?>        
        </td></tr>      
</table>
	<div name = "btn_group" align = "right">
		<input  class="btn"  type = "button" value="목록" name = "review_btn" onClick = "location.href='./review.php?table=<?=$table?>'" >  
	<? 
		if($s_id==$item_id || $s_id=="admin")
		{
	?>

    <a href="review_write.php?table=<?=$table?>&mode=modify&num=<?=$num?>&page=<?=$page?>">
    <input  class="btn btn-info"  type = "button" value="수정" name = "modify_btn" >
    </a>
    
    <input  class="btn"  type = "button" value="삭제" name = "delete_btn" onClick = "delete_func()" >  

    <p> </p><p> </p>
<?
	}
?>
	</div>
	<div id="ripple">
		<?
			$sql = "select * from view_ripple where parent='$item_num'";
			$ripple_result = mysql_query($sql);

			while ($row_ripple = mysql_fetch_array($ripple_result))
			{
				$ripple_num     = $row_ripple[num];
				$ripple_id      = $row_ripple[id];
				$ripple_content = str_replace("\n", "<br>", $row_ripple[content]);
				$ripple_content = str_replace(" ", "&nbsp;", $ripple_content);
				$ripple_date    = $row_ripple[regist_day];
		?>
		<div id="ripple_writer_title">
			<table id = "td_back" class="table" width = "30" height = "40">
				<tr><td width = "20%"><span style="color:#80BFFF"><?=$ripple_id?></span></td> <td  width = "20%" ><?=$ripple_date?></td>
				<td  width = "20%">
					<? 
							if($s_id=="admin" || $s_id==$ripple_id)
							// 구현해야할것
							echo "<a href='./review_ripple/delete_ripple.php?table=$table&num=$item_num&ripple_num=$ripple_num'>[삭제]</a>"; 
					?>
				</td>

				</tr>

				<tr>
				<td colspan = 3>
					<?= nl2br($ripple_content)?>
				</td>
				</tr>
			

			</table>
		</div>

  
<?
		}
?>		
<!-- 댓글 등록 폼 -->
		<form  name="ripple_form" method="post" action="./review_ripple/insert_ripple.php?table=<?=$table?>&num=<?=$item_num?>">  
		<div align = "center" id="ripple_box">
			<div id="inline"> <textarea name = "ripple_text" style="
	height: 50px;
	width: 600px;
	resize:none;
"  onKeyup="len_textarea_chk()"></textarea>
			</div>
			<input  class="btn"  type = "button" value="덧글등록" name = "rv_write" onClick = "ripple_insert()" > 
		</div>
		</form>
	</div> <!-- end of ripple -->


<?
include "./footer.php";
?>

