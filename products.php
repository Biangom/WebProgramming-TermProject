<? @session_start(); ?>
<? include "./header.php"; ?>


<?
	$table = "shoes";
?>

<!--
	GET cate_type = 

 sneakers 운동화
 shoes 	구두
 sandal 	샌들
 -->

<?
	include "./lib/dbconn_admin.php";
	$scale=6;			// 한 화면에 표시되는 글 수


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

		$sql = "select * from $table where sh_name like '%$search%' order by num desc";
		$result = mysql_query($sql, $connect);

		$total_record = mysql_num_rows($result); // 전체 글 수
	}
	else if($cate_type == 'New10')
	{
		$sql = "select * from $table order by regist_day desc";
		$result = mysql_query($sql, $connect);
		$total_record = 10; // 전체 글 수


	}
	else if($cate_type == 'Top5')
	{
		$sql = "select * from $table order by sh_lev desc";
		$result = mysql_query($sql, $connect);
		$total_record = 5; // 전체 글 수
	}
	else
	{
		$sql = "select * from $table where sh_type = '$cate_type' order by num desc";
		$result = mysql_query($sql, $connect);

		$total_record = mysql_num_rows($result); // 전체 글 수
	}








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

<form name = "board_form" method="post" action="products.php?table=<?=$table?>&mode=search">

			<section>
			<img class="pageBanner" 

			<?
				if($mode == "search")
				{
					echo "src='themes/images/pageBanner_select.jpg'";
				}
				else 
				{
					if($cate_type == "운동화")
					{
						echo "src='themes/images/pageBanner_sneakers.jpg'";
					}
					else if($cate_type == "구두")
					{
						echo "src='themes/images/pageBanner_shoes.jpg'";
					}
					else if($cate_type == "New10")
					{
						echo "src='themes/images/pageBanner_new.jpg'";
					}
					else if($cate_type == "Top5")
					{
						echo "src='themes/images/pageBanner_top5.jpg'";
					}
					else
						echo "src='themes/images/pageBanner_sandle.jpg'";
				}
			?>

			</section>
			
			<section class="main-content">
				
				<div class="row">						
					<div class="span9">								
						<ul class="thumbnails listing-products">

						<?
						for ( $i = $start; $i < $start+$scale && $i < $total_record; $i++)                    
						{
							mysql_data_seek($result, $i);       
							// 가져올 레코드로 위치(포인터) 이동  
							$row = mysql_fetch_array($result);       
							// 하나의 레코드 가져오기
							
							$item_num         = $row[num];
							$item_sh_name     = $row[sh_name];
							$item_sh_color    = $row[sh_color];
							$item_sh_type     = $row[sh_type];
							$item_sh_lev      = $row[sh_lev];
							$item_sh_money    = $row[sh_money];
							$item_content     = $row[content];
		
							$item_regist_day    = $row[regist_day];
							$item_size230     = $row[size230];
							$item_size240     = $row[size240];
							$item_size250     = $row[size250];
							$item_size260     = $row[size260];
							$item_size270     = $row[size270];
							$item_size280     = $row[size280];
							$item_size290     = $row[size290];

							$image_name[0]   = $row[file_name_0];
							$image_name[1]   = $row[file_name_1];
							$image_name[2]   = $row[file_name_2];

							$image_copied[0] = $row[file_copied_0];
							$image_copied[1] = $row[file_copied_1];
							$image_copied[2] = $row[file_copied_2];

								
							if ($image_copied[0]) 
							{
								$imageinfo = GetImageSize("./data/".$image_copied[0]);

								$image_width[0] = $imageinfo[0];
								$image_height[0] = $imageinfo[1];
								$image_type[0]  = $imageinfo[2];

								// if ($image_width[0] > 785)
								// 화면상에 이미지를 깨끗이 나타나기 위함
								$image_width[0] = 785;
								$image_height[0] = 300;
							}
							else
							{
								$image_width[0] = "";
								$image_height[0] = "";
								$image_type[0]  = "";
							}
							


						?>
							<li class="span3">
								<div class="product-box">
									<span class="sale_tag"></span>												
									<a href="product_detail.php?get_num=<?=$item_num?>&table=<?=$table?>">
									<?
									if ($image_copied[0])
									{
										$img_name = $image_copied[0];
										$img_name = "./data/".$img_name;
										$img_width = $image_width[0];
										$img_height = $image_height[0];
										
										echo "<img src='$img_name' width='$img_width' height='$img_height'>"."<br><br>";
									}
									?>
									
									</a><br/>
									<a href="product_detail.php?get_num=<?=$item_num?>&table=<?=$table?>" class="title"><?=$item_sh_name?></a><br/>
									<p class="price"><?=$item_sh_money?>￦</p>
								</div>
							</li>    

						<?

						}
						
						?>   
						</ul>								
						<hr>
						<div class="pagination pagination-small pagination-centered">
							<ul>
							<?

							   for ($i=1; $i<=$total_page; $i++)
								{
										if ($page == $i)     // 현재 페이지 번호 링크 안함
										{
											echo "<li class='active'><a href='#'>$i</a></li>";
										}
										else
										{ 
											
											echo "<li><a href='products.php?cate_type=$cate_type&table=$table&page=$i'> $i </a></li>";
										}      
								}
 							?>

							</ul>
						</div>
					</div>
					<div class="span3 col">
						<div class="block">	
							<ul class="nav nav-list">
								<h4 class="title"><strong>카테고리</strong> </h4>
								<li style = "text-align:center;"<?if($cate_type == "운동화") { ?>class="active <?}?>"><a href="products.php?cate_type=운동화">운동화</a></li>
								<li style = "text-align:center;"<?if($cate_type == "구두") { ?>class="active <?}?>"><a href="products.php?cate_type=구두">구두</a></li>
								<li style = "text-align:center;"<?if($cate_type == "샌들") { ?>class="active <?}?>"><a href="products.php?cate_type=샌들">샌들</a></li>

							</ul>
						</div>

						<div class="block">								
							<h4 class="title"><strong>Top</strong> 3</h4>								
							<ul class="small-product" >

							<?

								$sql = "select * from $table order by sh_lev desc";
								$result = mysql_query($sql, $connect);
								$total_record = 3;

								for ( $i = 0; $i < $total_record; $i++)                    
								{
									mysql_data_seek($result, $i);       
									// 가져올 레코드로 위치(포인터) 이동  
									$row = mysql_fetch_array($result);       
									// 하나의 레코드 가져오기
									
									$item_num         = $row[num];
									$item_sh_name     = $row[sh_name];
									$item_sh_color    = $row[sh_color];
									$item_sh_type     = $row[sh_type];
									$item_sh_lev      = $row[sh_lev];
									$item_sh_money    = $row[sh_money];
									$item_content     = $row[content];
				
									$item_regist_day    = $row[regist_day];
									$item_size230     = $row[size230];
									$item_size240     = $row[size240];
									$item_size250     = $row[size250];
									$item_size260     = $row[size260];
									$item_size270     = $row[size270];
									$item_size280     = $row[size280];
									$item_size290     = $row[size290];

									$image_name[0]   = $row[file_name_0];
									$image_copied[0] = $row[file_copied_0];
										
									if ($image_copied[0]) 
									{
										$imageinfo = GetImageSize("./data/".$image_copied[0]);

										$image_width[0] = $imageinfo[0];
										$image_height[0] = $imageinfo[1];
										$image_type[0]  = $imageinfo[2];

										// if ($image_width[0] > 785)
										// 화면상에 이미지를 깨끗이 나타나기 위함
										$image_width[0] = 785;
										$image_height[0] = 300;
									}
									else
									{
										$image_width[0] = "";
										$image_height[0] = "";
										$image_type[0]  = "";
									}
								?>


								<li>
									<a href="product_detail.php?get_num=<?=$item_num?>&table=<?=$table?>">
										<?
										if ($image_copied[0])
										{
											$img_name = $image_copied[0];
											$img_name = "./data/".$img_name;
											
											echo "<img src='$img_name'> $item_sh_name";
										}
										?>
									</a>
									
								</li>

								<?
								}
								?>							
							</ul>
						</div>


						<div class="block">								
							<h4 class="title"><strong>Search</strong> </h4>								
							
							<input type="text" class="input-block-level search-query" 
							action="products.php?mode=search&table=<?=$table?>"
							placeholder="신발명을 입력하세요" name ="search">
						</div>
					</div>
				</div>
			</section>

</form>

<!--footer-->
<?
include "./footer.php";
?>
