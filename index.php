<?
include "header.php";
?>
<?
	$table = 'shoes';
	include "./lib/dbconn_admin.php";
?>


			<section  class="homepage-slider" id="home-slider">
				<div class="flexslider">
					<ul class="slides">
						<li>
							<img src="themes/images/carousel/banner-1.jpg" alt="" />
						</li>
						<li>
							<img src="themes/images/carousel/banner-21.jpg" alt="" />
							<div class="intro">
								<h1>Mid season sale</h1>
								<p><span>Up to 50% Off</span></p>
								<p><span>On selected items online and in stores</span></p>
							</div>
						</li>
					</ul>
				</div>
			</section>

			<section class="main-content">
				<div class="row">
					<div class="span12">
						<div class="row">
							<div class="span12">
								<h4 class="title">
									<span class="pull-left"><span class="text"><span class="line">New <strong>Arrival</strong></span></span></span>
									<span class="pull-right">
										<a class="left button" href="#myCarousel" data-slide="prev"></a><a class="right button" href="#myCarousel" data-slide="next"></a>
									</span>
								</h4>
								<div id="myCarousel" class="myCarousel carousel slide">
									<div class="carousel-inner">
										<div class="active item">
											<ul class="thumbnails">
											<?

												$sql = "select * from $table order by regist_day desc";
												$result = mysql_query($sql, $connect);
												$total_record = 8;

												for ( $i = 0; $i < $total_record / 2; $i++)                    
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
										</div>
										<div class="item">
											<ul class="thumbnails">
											<?

												$sql = "select * from $table order by regist_day desc";
												$result = mysql_query($sql, $connect);
												$total_record = 8;

												for ( $i = $total_record / 2 ; $i < $total_record ; $i++)                    
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
										</div>
									</div>
								</div>
							</div>
						</div>
						<br/>

						
						<div class="row">
							<div class="span12">
								<h4 class="title">
									<span class="pull-left"><span class="text"><span class="line">Top <strong>4</strong></span></span></span>
									<span class="pull-right">
										
									</span>
								</h4>
								<div>
									<div>


										<div class="active item">
											<ul class="thumbnails">
											<?

												$sql = "select * from $table order by sh_lev desc";
												$result = mysql_query($sql, $connect);
												$total_record = 4;

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
											
												</li>
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row feature_box">
							<div class="span4">
								<div class="service">
									<div class="responsive">
										<img src="themes/images/feature_img_2.png" alt="" />
										<h4><strong>DIVERSITY</strong></h4>
										<p>저희 Shoes M사이트는 신발 잡지 사이트로 다양성을 추구합니다.</p>
									</div>
									</div>
								</div>
								<div class="span4">
									<div class="service">
									<div class="customize">
										<img src="themes/images/feature_img_1.png" alt="" />
										<h4><strong>TREND</strong></h4>
										<p>저희 사이트는 최신 유행을 반영합니다.</p>
									</div>
									</div>
								</div>
								<div class="span4">
									<div class="service">
									<div class="support">
										<img src="themes/images/feature_img_3.png" alt="" />
										<h4><strong>Quick</strong></h4>
										<p>고객에게 빠른 서비스를 보답하겠습니다.</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>


<!--footer-->
<?php
include "footer.php";
?>
