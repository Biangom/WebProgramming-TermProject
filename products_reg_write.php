<? @session_start(); ?>
<? include "./header.php"; ?>
<? include "./lib/dbconn_admin.php"; ?>

<?
// 수정모드라면 전에 것을 불러온다
	if ($mode=="modify")
	{
		$sql = "select * from $table where num=$num";
		$result = mysql_query($sql, $connect);
		$row = mysql_fetch_array($result);       
	
		$item_sh_name    = $row[sh_name];
        $item_sh_color   = $row[sh_color];
        $item_sh_type    = $row[sh_type];
        $item_sh_lev     = $row[sh_lev];
        $item_sh_money     = $row[sh_money];

		$item_content     = $row[content];

        $item_regist_day = $row[item_regist_day];
        
        $item_size230 = $row[size230];
        $item_size240 = $row[size240];
        $item_size250 = $row[size250];
        $item_size260 = $row[size260];
        $item_size270 = $row[size270];
        $item_size280 = $row[size280];
        $item_size290 = $row[size290];

		$item_file_0 = $row[file_name_0];
		$item_file_1 = $row[file_name_1];
		$item_file_2 = $row[file_name_2];

		$copied_file_0 = $row[file_copied_0];
		$copied_file_1 = $row[file_copied_1];
		$copied_file_2 = $row[file_copied_2];
	}
    else
    {
        // 기본값
        $item_size230 = 0;
        $item_size240 = 0;
        $item_size250 = 0;
        $item_size260 = 0;
        $item_size270 = 0;
        $item_size280 = 0;
        $item_size290 = 0;
    }
?> 
<script>

//insert_prfm이 제대로 값이 있는지 체크
function len_in_name_chk(){  
  var frm = document.insert_prfm.in_name; 
    
  if(frm.value.length > 30){  
       alert("신발명은 30자로 제한됩니다.!");  
       frm.value = frm.value.substring(0,30);  
       frm.focus();  
  } 
}  
function len_in_color_chk(){  
  var frm = document.insert_prfm.in_color; 
    
  if(frm.value.length > 15){  
       alert("대표색깔은 15자로 제한됩니다.!");  
       frm.value = frm.value.substring(0,15);  
       frm.focus();  
  } 
}  

function len_in_lev_chk(){  
  var frm = document.insert_prfm.in_lev; 
    
  if(frm.value.length > 3){  
       alert("인기도은 1~999수 제한됩니다.!");  
       frm.value = frm.value.substring(0,3);  
       frm.focus();  
  } 
}  

function len_content_chk(){  
  var frm = document.insert_prfm.content; 
    
  if(frm.value.length > 1000){  
       alert("내용은 1000자로 제한됩니다.!");  
       frm.value = frm.value.substring(0,1000);  
       frm.focus();  
  } 
}  
// insert_prfm : finished

function check_pr_input()
 {

	 if(!document.insert_prfm.in_name.value)
     {
         alert("신발명을 입력하세요!");
         document.insert_prfm.in_name.focus();
         return;
     }

     if(!document.insert_prfm.in_color.value)
     {
         alert("대표색깔 입력하세요!");
         document.insert_prfm.in_color.focus();
         return;
     }


	 if(!document.insert_prfm.in_type.value)
     {
         alert("신발유형 입력하세요!");
         document.insert_prfm.in_type.focus();
         return;
     }

	 if(!document.insert_prfm.in_lev.value)
     {
         alert("인기도를 입력하세요!, Default : 0");
         document.insert_prfm.in_lev.focus();
         return;
     }

	 if(!document.insert_prfm.content.value)
     {
         alert("내용을 입력하세요!");
         document.insert_prfm.content.focus();
         return;
     }
     document.insert_prfm.submit();     
 }
</script>

<div>
<?
// 세션이 없다면
if(!$s_id)
{
        echo("
        <script>
        window.alert('로그인을 해주세요.')
        history.go(-1)
        </script>
        ");
}
?>

</div>

<?
    if($mode=="modify")
    {
?>
        <form id = "prfm" name = "insert_prfm" method="post" action="products_reg/insert_products_reg.php?mode=modify&num=<?=$num?>&page=<?=$page?>&table=<?=$table?>" enctype="multipart/form-data"> 
<?
    }
    else
    {
?>
        <form id = "prfm" name = "insert_prfm" method="post" action = "products_reg/insert_products_reg.php?table=<?=$table?>" enctype="multipart/form-data">
<?
    }
?>
    <table class="table">
        <tr><td colspan = 3 style = "text-align: center"> 상품 등록</td>       </tr>

        <tr><td style ="text-align: center">신발명</td> <td width = "80%">   
        <input  name = "in_name" type="text" placeholder="신발명" style="
        height: 30px;
        width: 600px;
    " onKeyup="len_in_name_chk()" value="<?=$item_sh_name?>">
        </td></tr>

        <tr><td style ="text-align: center">대표색깔</td> <td width = "80%">
        <input  name = "in_color" type="text" placeholder="대표색깔 ex)blue, red.." style="
        height: 30px;
        width: 600px;
    " onKeyup="len_in_color_chk()" value="<?=$item_sh_color?>">        
        </td></tr>

        <tr><td style ="text-align: center">신발유형</td> <td width = "80%"> 
        <select name = "in_type" >
            <option <? if($item_sh_type == '운동화') echo"selected"; ?> value='운동화'>운동화</option>
            <option <? if($item_sh_type == '구두') echo"selected"; ?> value='구두'>구두</option>
            <option <? if($item_sh_type == '샌들') echo"selected"; ?> value='샌들'>샌들</option>

        </select>      

        </td></tr>

        <tr><td style ="text-align: center">인기도</td> <td width = "80%"> 
        <input  name = "in_lev" type="text" placeholder="숫자 0~1000" style="
        height: 30px;
        width: 600px;
    " onKeyup="len_in_lev_chk()" value="<?=$item_sh_lev?>">        
        </td></tr>


        <tr><td style ="text-align: center">금액</td> <td width = "80%"> 
        <input  name = "in_money" type="text" style="
        height: 30px;
        width: 600px;
    "  value="<?=$item_sh_money?>">        
        </td></tr>

        <tr><td style ="text-align: center">내용</td> <td> <textarea name = "content"  placeholder="신발 설명 내용.  글자수는 1000자로 제한됩니다." style="
        height: 300px;
        width: 600px;
        resize:none;
    "  onKeyup="len_content_chk()"><?=$item_content?></textarea>
        </td></tr>
        
        <tr>
        <td style = "text-align: center">수량</td>
        <td>갯수<td>
        </tr>

        <tr>
        <td style = "text-align: center"> size230 </td>
        <td> 
        <input type="number" name="in_size230" min="1" max="999" value="<?=$item_size230?>">
        </td>

        </tr>
        
        <tr>
        <td style = "text-align: center"> size240 </td>
        <td>
        <input type="number" name="in_size240" min="1" max="999" value="<?=$item_size240?>">
        </td>
        </tr>

        <tr>
        <td style = "text-align: center"> size250 </td>
        <td>
        <input type="number" name="in_size250" min="1" max="999" value="<?=$item_size250?>">
        </td>
        </tr>

        <tr>
        <td style = "text-align: center"> size260 </td>
        <td>
        <input type="number" name="in_size260" min="1" max="999" value="<?=$item_size260?>">
        </td>
        </tr>

        <tr>
        <td style = "text-align: center"> size270 </td>
        <td>
        <input type="number" name="in_size270" min="1" max="999" value="<?=$item_size270?>">
        </td>
        </tr>

        <tr>
        <td style = "text-align: center"> size280 </td>
        <td>
        <input type="number" name="in_size280" min="1" max="999" value="<?=$item_size280?>">
        </td>
        </tr>

        <tr>
        <td style = "text-align: center"> size290 </td>
        <td>
        <input type="number" name="in_size290" min="1" max="999" value="<?=$item_size290?>">
        </td>
        </tr>

        <tr>
        <td style ="text-align: center">이미지파일1</td>
        <td> <input type="file" name="upfile[]">
<? 	if ($mode=="modify" && $item_file_0)
	{
?>
       <?=$item_file_0?> 파일이 등록되어 있습니다. <input type="checkbox" name="del_file[]" value="0"> 삭제</td>
<?
	}
    else echo "</td>";
?>
        </tr>
        
        <tr>
        <td style ="text-align: center">이미지파일2</td>
        <td> <input type="file" name="upfile[]">

<? 	if ($mode=="modify" && $item_file_1)
	{
?>
        <?=$item_file_1?> 파일이 등록되어 있습니다. <input type="checkbox" name="del_file[]" value="1"> 삭제</td>
<?
	}
    else echo "</td>";
?>
        </tr>
        
        <tr><td style ="text-align: center">이미지파일3</td>
        <td> <input type="file" name="upfile[]">

<? 	if ($mode=="modify" && $item_file_2)
	{
?>
        <?=$item_file_2?> 파일이 등록되어 있습니다. <input type="checkbox" name="del_file[]" value="2"> 삭제</td>
<?
	}
    else echo "</td>";
?>
        </tr>

    </table>

    <div align = "right">
        <input  class="btn"  type = "button" value="목록" name = "list_btn" onClick = "location.href='./products_reg.php?table=<?=$table?>'" >  
        <input  class="btn btn-info"  type = "button" value="등록" name = "pr_write" onClick = "check_pr_input()" > 
    </div>
    
</form>





<? include "./footer.php"; ?>

