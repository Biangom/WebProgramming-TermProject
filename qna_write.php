<? @session_start(); ?>
<meta charset = "utf-8">

<? include "./header.php"; ?>
<? include "lib/dbconn_admin.php"; ?>
<?
// 수정모드라면 전에 것을 불러온다
// 
	if ($mode=="modify" || $mode == "response")
	{
		$sql = "select * from $table where num=$num";
		$result = mysql_query($sql, $connect);
		$row = mysql_fetch_array($result);       
	
		$item_subject     = $row[subject];
		$item_content     = $row[content];


        if ($mode=="response")
		{
			$item_subject = "[re]".$item_subject;
			$item_content = ">".$item_content;
			$item_content = str_replace("\n", "\n>", $item_content);
			$item_content = "\n\n".$item_content."\n";
		}
		mysql_close();
	}
?>
 
<script>

//글자수 제한 체크 
function len_textarea_chk(){  
  var frm = document.board_form.in_text; 
    
  if(frm.value.length > 1000){  
       alert("글자수는 1000자로 제한됩니다.!");  
       frm.value = frm.value.substring(0,1000);  
       frm.focus();  
  } 
}


// name : board_form이 제대로 값이 있는지 체크
function len_subject_chk(){  
  var frm = document.board_form.in_subj; 
    
  if(frm.value.length > 30){  
       alert("제목은 30자로 제한됩니다.!");  
       frm.value = frm.value.substring(0,30);  
       frm.focus();  
  } 

}  

 function check_input()
 {

	 if(!document.board_form.in_subj.value)
     {
         alert("제목을 입력하세요!");
         document.board_form.in_subj.focus();
         return;
     }

     //nttext
	 if(!document.board_form.in_text.value)
     {
         alert("내용을 입력하세요!");
         document.board_form.in_text.focus();
         return;
     }
      document.board_form.submit();
     
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
		<form  name="board_form" method="post" action="./qna/insert_qna.php?mode=modify&num=<?=$num?>&page=<?=$page?>&table=<?=$table?>"> 
<?
	}
	elseif ($mode=="response")
	{
?>
		<form  name="board_form" method="post" action="./qna/insert_qna.php?mode=response&num=<?=$num?>&page=<?=$page?>&table=<?=$table?>"> 
<?
	}
	else
	{
?>
		<form  name="board_form" method="post" action="./qna/insert_qna.php?table=<?=$table?>"> 
<?
	}
?>


<table class="table">
    <tr><td colspan = 2 style = "text-align: center"> 고객문의 글쓰기</td>       </tr>
    <tr><td style ="text-align: center">아이디</td> <td width = "80%"> <?=$s_id?> </td></tr>
    
    <tr><td style ="text-align: center">제목</td> <td> <input  name = "in_subj" type="text" placeholder="제목" style="
    height: 30px;
    width: 600px;
" onKeyup="len_subject_chk()" value="<?=$item_subject?>"> </td></tr>
    <tr><td style ="text-align: center">내용</td> <td> <textarea name = "in_text"  placeholder="문의할 내용" style="
    height: 300px;
    width: 600px;
    resize:none;
"  onKeyup="len_textarea_chk()"><?=$item_content;?></textarea></td></tr>  
</table>

<div align = "right">
    <input  class="btn"  type = "button" value="목록" name = "btn" onClick = "location.href='./qna.php?table=<?=$table?>'" >  
    <input  class="btn btn-info"  type = "button" value="등록" name = "write" onClick = "check_input()" > 
</div>
    
</form>

<? include "./footer.php"; ?>

