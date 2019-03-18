<? @session_start();  ?>
<? include "./header.php"; ?>
<? 	
	include "./lib/dbconn_admin.php";

	$sql = "select * from $table where num=$num";
	$result = mysql_query($sql, $connect);

    $row = mysql_fetch_array($result);       
      // 하나의 레코드 가져오기

    $item_num     = $row[num];
    $item_sh_name   = $row[sh_name];
    $item_sh_color   = $row[sh_color];
    $item_sh_type    = $row[sh_type];
    $item_sh_lev     = $row[sh_lev];
	$item_sh_money = $row[sh_money];
    $item_content     = $row[content];

	$image_name[0]   = $row[file_name_0];
	$image_name[1]   = $row[file_name_1];
	$image_name[2]   = $row[file_name_2];

	$image_copied[0] = $row[file_copied_0];
	$image_copied[1] = $row[file_copied_1];
	$image_copied[2] = $row[file_copied_2];

    $item_date    = $row[regist_day];
	$item_sh_name = str_replace(" ", "&nbsp;", $row[sh_name]);

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

	mysql_query($sql, $connect);
?>
<!--자바스크립트-->
<script>
    function delete_func(href) 
    {
        if(confirm("한번 삭제한 자료는 복구할 방법이 없습니다.\n\n정말 삭제하시겠습니까?")) {
                document.location.href = "products_reg/delete_products_reg.php?table=<?=$table?>&num=<?=$num?>";
        }
    }
</script>


 <table class="table">
        <tr><td colspan = 2 style = "text-align: center"> 상품 등록 보기 </td>       </tr>
        <tr><td style ="text-align: center">신발명</td> <td width = "80%"> <?=$item_sh_name?> </td></tr>        
        <tr><td style ="text-align: center">대표색깔</td> <td><?=$item_sh_color?></td></tr>       
        <tr><td style ="text-align: center">신발유형</td> <td><?=$item_sh_type?></td></tr>
        <tr><td style ="text-align: center">인기도</td> <td><?=$item_sh_lev?></td></tr>
		<tr><td style ="text-align: center">금액</td> <td><?=$item_sh_money?></td></tr>

         </td></tr>
        <tr><td style ="text-align: center">날짜</td><td> <?=$item_date?></td></tr>
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
        <?=  nl2br($item_content) ?>
        
        </td></tr>
</table>

<div name = "btn_group" align = "right">
		<input  class="btn"  type = "button" value="목록" name = "list_btn" onClick = "location.href='./products_reg.php?table=<?=$table?>'" >  
<? 
	if($s_id=="admin")
	{
?>

    <a href="products_reg_write.php?table=<?=$table?>&mode=modify&num=<?=$num?>&page=<?=$page?>">
    <input  class="btn btn-info"  type = "button" value="수정" name = "modify_btn" >
    </a>

    <input  class="btn"  type = "button" value="삭제" name = "delete_btn" onClick = "delete_func()" >  

    <p> </p><p> </p>

<?
	}
?>
</div>
<? include "./footer.php"; ?>

