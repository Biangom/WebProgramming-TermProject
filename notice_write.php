<? @session_start(); ?>
<meta charset = "utf-8">

<? include "./header.php"; ?>
<? include "lib/dbconn_admin.php"; ?>
<?
// 수정모드라면 전에 것을 불러온다
	if ($mode=="modify")
	{
		$sql = "select * from $table where num=$num";
		$result = mysql_query($sql, $connect);
		$row = mysql_fetch_array($result);       
	
		$item_subject     = $row[subject];
		$item_content     = $row[content];
		$item_file_0 = $row[file_name_0];
		$item_file_1 = $row[file_name_1];
		$item_file_2 = $row[file_name_2];

		$copied_file_0 = $row[file_copied_0];
		$copied_file_1 = $row[file_copied_1];
		$copied_file_2 = $row[file_copied_2];
	}
?>

<!--자바스크립트-->

<script>
//글자수 제한 체크 

function len_textarea_chk(){  
  var frm = document.insert_ntfm.nttext; 
    
  if(frm.value.length > 1000){  
       alert("글자수는 1000자로 제한됩니다.!");  
       frm.value = frm.value.substring(0,1000);  
       frm.focus();  
  } 

}


// name : insert_ntfm이 제대로 값이 있는지 체크
function len_subject_chk(){  
  var frm = document.insert_ntfm.ntsubj; 
    
  if(frm.value.length > 30){  
       alert("제목은 30자로 제한됩니다.!");  
       frm.value = frm.value.substring(0,30);  
       frm.focus();  
  } 

}  

 function check_nt_input()
 {

	 if(!document.insert_ntfm.ntsubj.value)
     {
         alert("제목을 입력하세요!");
         document.insert_ntfm.ntsubj.focus();
         return;
     }

     //nttext
	 if(!document.insert_ntfm.nttext.value)
     {
         alert("내용을 입력하세요!");
         document.insert_ntfm.nttext.focus();
         return;
     }
      document.insert_ntfm.submit();
     
 }
</script>

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

<?
    if($mode=="modify")
    {
?>
        <form id = "ntfm" name = "insert_ntfm" method="post" action = "notice/insert_notice.php?mode=modify&num=<?=$num?>&page=<?=$page?>&table=<?=$table?>"  enctype="multipart/form-data">
<?
    }
    else
    {
?>
        <form id = "ntfm" name = "insert_ntfm" method="post" action = "notice/insert_notice.php?table=<?=$table?>" enctype="multipart/form-data">
<?
    }
?>
    <table class="table">
        <tr><td colspan = 2 style = "text-align: center"> 공지사항 글쓰기</td>       </tr>
        <tr><td style ="text-align: center">아이디</td> <td width = "80%"> <?=$s_id?> </td></tr>
        
        <tr><td style ="text-align: center">제목</td> <td> <input  name = "ntsubj" type="text" placeholder="제목" style="
        height: 30px;
        width: 600px;
    " onKeyup="len_subject_chk()" value="<?=$item_subject?>"> </td></tr>
        <tr><td style ="text-align: center">내용</td> <td> <textarea name = "nttext"  placeholder="공지할 내용" style="
        height: 300px;
        width: 600px;
        resize:none;
    "  onKeyup="len_textarea_chk()"><?=$item_content?></textarea></td></tr>
        <tr><td style ="text-align: center">파일1</td> <td> <input type="file" name="upfile[]">
<? 	if ($mode=="modify" && $item_file_0)
	{
?>
       <?=$item_file_0?> 파일이 등록되어 있습니다. <input type="checkbox" name="del_file[]" value="0"> 삭제</td>
<?
	}
    else echo "</td>";
?>
        
        </td></tr>
        <tr><td style ="text-align: center">파일2</td> <td> <input type="file" name="upfile[]">

<? 	if ($mode=="modify" && $item_file_1)
	{
?>
       <?=$item_file_1?> 파일이 등록되어 있습니다. <input type="checkbox" name="del_file[]" value="1"> 삭제</td>
<?
	}
    else echo "</td>";
?>
        </td></tr>


        <tr><td style ="text-align: center">파일3</td> <td> <input type="file" name="upfile[]">
<? 	if ($mode=="modify" && $item_file_2)
	{
?>
       <?=$item_file_2?> 파일이 등록되어 있습니다. <input type="checkbox" name="del_file[]" value="2"> 삭제</td>
<?
	}
    else echo "</td>";?>
        
        </td></tr>
    </table>

    <div align = "right">
        <input  class="btn"  type = "button" value="목록" name = "notice_btn" onClick = "location.href='./notice.php?table=<?=$table?>'" >  
        <input  class="btn btn-info"  type = "button" value="등록" name = "nt_write" onClick = "check_nt_input()" > 
    </div>    
</form>


<?
include "./footer.php";
?>

