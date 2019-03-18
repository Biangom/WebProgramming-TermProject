<? @session_start(); ?>
<? include "./header.php"; ?>

<?
	$table = "shoes";
?>

<!--<link href="./css/concert.css" rel="stylesheet" type="text/css" media="all">-->

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
		$sql = "select * from $table order by num desc";
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
<body>

<div id="content">
  <form name = "board_form" method="post" action="product_reg.php?table=<?=$table?>&mode=search">

	<div>
		<h5>총 <?= $total_record?> 개의 신발</h5> 

	</div>

	<div>
		<div id = "inline">
			<select name = "find">
				<option value='sh_name'>신발명</option>
				<option value='sh_color'>대표색깔</option>
				<option value='sh_type'>신발유형</option>
			</select>
		</div>

		<div id = "inline">		

		<input type="text" name = "search" class="form-control" placeholder="검색할 내용 입력">
		</div>

		<div id = "inline" >

		<input class="btn btn-default" type="submit" value="검색" style="margin-bottom: 10px;">
		</div>


	</div>

 </table>



  <table class = "table table-striped">	
		<tr align = "center">
			<td>번호 </td>
			<td width = "30%">신발명</td>
			<td>대표색깔 </td>
			<td>신발유형 </td>
            <td>인기도 </td>
			<td>금액 </td>
        	<td>등록일 </td>
		</tr> 
		

<?		
   for ( $i = $start; $i < $start+$scale && $i < $total_record; $i++)                    
   {
      mysql_data_seek($result, $i);       
      // 가져올 레코드로 위치(포인터) 이동  
      $row = mysql_fetch_array($result);       
      // 하나의 레코드 가져오기
	
	  $item_num     = $row[num];
	  $item_sh_name = $row[sh_name];
	  $item_sh_color= $row[sh_color];
	  $item_sh_type = $row[sh_type];
	  $item_sh_lev  = $row[sh_lev];
	  $item_sh_money = $row[sh_money];
      $item_date    = $row[regist_day];

// 년/월/일 만 출력하지 않도록 주석처리
	//   $item_date = substr($item_date, 0, 10);  

?>
				
				<tr align = "center">

					<td><?=$number?> </td>
					<td><a href="products_reg_view.php?table=<?=$table?>&num=<?=$item_num?>&page=<?=$page?>"><?= $item_sh_name ?></a>
					</td>
					<td><?= $item_sh_color ?> </td>					
					<td><?= $item_sh_type ?> </td>
					<td><?= $item_sh_lev ?> </td>
					<td><?= $item_sh_money ?> </td>				
					<td><?= $item_date ?> </td>

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



	<li><a href="products_reg.php?table=<?=$table?>&page=<?=($page-1 < 0 ? $page = 1 : $page-1);?>">Prev</a></li>
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
			
			echo "<li><a href='products_reg.php?table=$table&page=$i'> $i </a></li>";
		}      
   }
?>			

	<li><a href="products_reg.php?table=<?=$table?>&page=<?=($page+1 > $total_page ? $page = $total_page : $page+1); ?>">Next</a></li>
	</ul>
</div>

<div align = "right">
	<input  class="btn" type="button" value="목록" onclick="location.href='./products_reg.php'">	
	<input  class="btn btn-info" type="submit" value="글쓰기" name = "write" onclick="location.href='./products_reg_write.php?table=<?=$table?>'">
</div>



</body>
</html>


<? include "./footer.php"; ?>