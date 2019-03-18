<? @session_start(); ?>
<? include "./header.php"; ?>

<?
	$table = "qna";
?>


<?
	include "./lib/dbconn_admin.php";
	$scale=10;			// 한 화면에 표시되는 글 수

	//$mode에 따른 분기실행
    if ($mode=="search")
	{
		if(!$search)
		{
			echo("
				<script>
				 window.alert('검색할 단어를 입력해 주세요!');
			     history.go(-1);
				</script>
			");
			exit;
		}

		$sql = "select * from $table where $find like '%$search%' order by num desc";
	}
	else
	{
		$sql = "select * from $table order by group_num desc, ord asc";
	}

	$result = mysql_query($sql, $connect);

	$total_record = mysql_num_rows($result); // 전체 글 수

	// 전체 페이지 수($total_page) 계산 
	if ($total_record % $scale == 0)     
		$total_page = floor($total_record/$scale);      
	else
		$total_page = floor($total_record/$scale) + 1; 
 
	if (!$page)                 // 페이지번호($page)가 0 일 때
		$page = 1;              // 페이지 번호를 1로 초기화
 
	// 표시할 페이지($page)에 따라 $start 계산  
	$start = ($page - 1) * $scale;      
	$number = $total_record - $start;
?>

	<section>
			<img class="pageBanner" src="themes/images/pageBanner_cus.jpg" alt="New products" >
				<h4><span>고객문의</span></h4>
	</section>	
	<section class="main-content">

<div id="content">
  <form name = "board_form" method="post" action="qna.php?table=<?=$table?>&mode=search">

	<div>
		<h5>총 <?= $total_record?> 개의 게시물</h5> 

	</div>

	<div>
		<div id = "inline">
			<select name = "find">
				<option value='subject'>제목</option>
				<option value='content'>내용</option>
			</select>
		</div>

		<div id = "inline">		

		<input type="text" name = "search" class="form-control" placeholder="검색할 내용 입력">
		</div>

		<div id = "inline" >

		<input class="btn btn-default" type="submit" value="검색" style="margin-bottom: 10px;">
		</div>
	</div>

  <table class = "table table-striped">	
		<tr align = "center">
			<td>번호 </td>
			<td width = "50%">제목 </td>
			<td>글쓴이 </td>
			<td>등록일 </td>
			<td>조회 </td>
		</tr> 
<?		
   for ( $i = $start; $i < $start+$scale && $i < $total_record; $i++)                    
   {
      mysql_data_seek($result, $i);       
      // 가져올 레코드로 위치(포인터) 이동  
      $row = mysql_fetch_array($result);       
      // 하나의 레코드 가져오기
	
	  $item_num         = $row[num];
      $item_ord         = $row[ord];
	  $item_id      = $row[id];
	  $item_name    = $row[name];
    //   $item_content = 내용은 보여줄 필요없음


	  $item_hit     = $row[hit];
      $item_date    = $row[regist_day];
	  $item_date    = substr($item_date, 0, 10);  
	  $item_subject = str_replace(" ", "&nbsp;", $row[subject]);
      $item_depth       = $row[depth];

      $space = "";
      for($j = 0; $j < $item_depth; $j++)
      { $space = "&nbsp;&nbsp;".$space;}
?>			
		<tr align = "center">
			<td><?=$number?> </td>
			<td><?=$space?><a href="qna_view.php?table=<?=$table?>&num=<?=$item_num?>&page=<?=$page?>"><?= $item_subject ?></a>
			</td>
			<td><?= $item_id ?> </td>					
			<td><?= $item_date ?> </td>
			<td><?= $item_hit ?> </td>
		</tr> 
<?
   	   $number--;
   }
?>

	</table>
	</form>
</div>

    <div class="pagination pagination-small pagination-centered">
        <ul>
        <li><a href="qna.php?table=<?=$table?>&page=<?=($page-1 < 0 ? $page = 1 : $page-1);?>">Prev</a></li>
<?
   // 게시판 목록 하단에 페이지 링크 번호 출력
   for ($i=1; $i<=$total_page; $i++)
   {
		if ($page == $i)     // 현재 페이지 번호 링크 안함
		{
			echo "<li class='active'><a href='#'>$i</a></li>";
		}
		else
		{ 			
			echo "<li><a href='qna.php?table=$table&page=$i'> $i </a></li>";
		}      
   }
?>			
        <li><a href="qna.php?table=<?=$table?>&page=<?=($page+1 > $total_page ? $page = $total_page : $page+1); ?>">Next</a></li>
        </ul>
    </div>

<div align = "right">
	<input  class="btn" type="button" value="목록" onclick="location.href='./qna.php'">	
	<input  class="btn btn-info" type="submit" value="글쓰기" name = "write" onclick="location.href='./qna_write.php?table=<?=$table?>'">  
</div>

<? include "./footer.php"; ?>