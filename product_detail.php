<? @session_start(); ?>
<!--header-->
<?
include "./header.php";
?>

<?
	include "./lib/dbconn_admin.php";

	$sql = "select * from $table where num = '$get_num'";
	$result = mysql_query($sql, $connect);
	$row = mysql_fetch_array($result);    


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
?>

<?
        for ($i=0; $i<3; $i++)
		{
			if ($image_copied[$i])
			{
				$img_name[$i] = $image_copied[$i];
				$img_name[$i] = "./data/".$img_name[$i];
				$img_width[$i] = $image_width[$i];
				
				// echo "<img src='$img_name' width='$img_width'>"."<br><br>";
			}
		}
?> 

			<section class="header_text sub">
				<h4><span>Product Detail</span></h4>
			</section>
			<section class="main-content">				
				<div class="row">						
					<div class="span9">
						<div class="row">
							<div class="span4">
								<a href="<?=$img_name[0]?>" class="thumbnail" data-fancybox-group="group1" ><img alt="" src="<?=$img_name[0]?>"></a>												
								<ul class="thumbnails small">	
									<? if($img_name[1]) { ?>							
									<li class="span1">
										<a href="<?=$img_name[1]?>" class="thumbnail" data-fancybox-group="group1" ><img src="<?=$img_name[1]?>" alt=""></a>
									</li>
									<? } ?>

									
									<? if($img_name[2]) { ?>	
									<li class="span1">
										<a href="<?=$img_name[2]?>" class="thumbnail" data-fancybox-group="group1" ><img src="<?=$img_name[2]?>" alt=""></a>
									</li>
									<? } ?>

									<? if($img_name[3]) { ?>	
									<li class="span1">
										<a href="<?=$img_name[3]?>" class="thumbnail" data-fancybox-group="group1"><img src="<?=$img_name[3]?>" alt=""></a>
									</li>	
									<? } ?>

									
								</ul>
							</div>
							<div class="span5">
								<address>
									<strong>Name:</strong> <span><?=$item_sh_name?></span><br>
									<strong>Color:</strong> <span><?=$item_sh_color?></span><br>
									<strong>Type:</strong> <span><?=$item_sh_type?></span><br>
									<strong>Level:</strong> <span><?=$item_sh_lev?></span><br>
									<strong>Regist Day:</strong> <span><?=$item_regist_day?></span><br>									
								</address>									
								<h4><strong>Price: </strong><span><?=$item_sh_money?>￦</span></h4>
							</div>
							<div class="span5">
								<form class="form-inline">									
									<p>&nbsp;</p>

									<label>Size&nbsp;:&nbsp;&nbsp;</label>

									<select name = "in_size"  style="width:100px;" >
										<option value='230'>230</option>
										<option value='240'>240</option>
										<option value='250'>250</option>
										<option value='260'>260</option>
										<option value='270'>270</option>
										<option value='280'>280</option>
										<option value='290'>290</option>
       								</select>
							</div>
							<div class="span5">	
									<label>수량&nbsp;:&nbsp;&nbsp;<input type="number" name="in_amt" min="1" max="999" style="width:50px;" ></label>
 									
							</div>
							<div class="span5">	
									<button class="btn btn-inverse" type="button">Add to cart</button>
								</form>
							</div>							
						</div>


						<div class="row">
							<div class="span9">
								<ul class="nav nav-tabs" id="myTab">
									<li class="active"><a href="#home">Description</a></li>
								</ul>							 
								<div class="tab-content">
									<div class="tab-pane active" id="home">
									<?= nl2br($item_content)?>
									</div>
									<div class="tab-pane" id="profile">
										<table class="table table-striped shop_attributes">	
											<tbody>
												<tr class="">
													<th>Size</th>
													<td>Large, Medium, Small, X-Large</td>
												</tr>		
												<tr class="alt">
													<th>Colour</th>
													<td>Orange, Yellow</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>							
							</div>						
						</div>
					</div>

					<div class="span3 col">
						<div class="block">	
							<ul class="nav nav-list">
								<h4 class="title"><strong>카테고리</strong> </h4>
								<li style = "text-align:center;" <?if($cate_type == "운동화") { ?>class="active <?}?>"><a href="products.php?cate_type=운동화">운동화</a></li>
								<li style = "text-align:center;" <?if($cate_type == "구두") { ?>class="active <?}?>"><a href="products.php?cate_type=구두">구두</a></li>
								<li style = "text-align:center;" <?if($cate_type == "샌들") { ?>class="active <?}?>"><a href="products.php?cate_type=샌들">샌들</a></li>
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
					</div>
				</div>
			</section>			
			
<!--footer-->
<?php
include "./footer.php";
?>