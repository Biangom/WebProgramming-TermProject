<? @session_start(); ?>
<!DOCTYPE html>
<meta charset="utf-8">

<?
echo "result : $s_id, $s_pass";
?>

<html lang="en">
	<head>

		<!--추가한 스타일-->
		<style>
		#none{
			display:none;
		}
		#block{
			display:block;

		}
		#inline{
			display:inline;

		}
		#inline-btn{
			display:inline;
		}

		}
		#inline-blok{
			display:inline-block;
		}

		a:link {text-decoration: none; color: #333333;}
		a:visited {text-decoration: none; color: #333333;}
		a:active {text-decoration: none; color: #333333;}
		a:hover {text-decoration: underline; color: red;}

		</style>


		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">

		<!-- 부트스트랩 정의 -->
		<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">

		<link href="themes/css/bootstrappage.css" rel="stylesheet"/>

		<!-- 전역 스타일 -->
		<link href="themes/css/flexslider.css" rel="stylesheet"/>
		<link href="themes/css/main.css" rel="stylesheet"/>

		<!-- 자바스크립트 -->
		<script src="themes/js/jquery-1.7.2.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
		<script src="themes/js/superfish.js"></script>
		<script src="themes/js/jquery.scrolltotop.js"></script>

	</head>
<body>


	<div id="top-bar" class="container">
		<div class="row">
			<div class="span4">
				<a href="index.php" class="logo pull-left"><img src="themes/images/logo_pic.png" class="site_logo" alt=""></a>
			</div>

			<div class="span8">
				<div class="account pull-right">
					<ul class="user-menu">

						<li><a href="check.php">&nbsp;&nbsp;</a></li>	
						
						<?
						// 세션아이디가 존재하지 않는다면
							if(!$s_id)
							{
						?>
								<li><a href="mem_log_register.php">로그인/회원가입</a></li>
						<?
							}
							else
							{
						?>
								<?=$s_id?>님 반갑습니다!	
								<li><a href="./log_reg/logout.php">로그아웃</a></li>
						<?
							}
						?>

						<?
						if($s_id)
						{
						?>
						<li><a href="mem_modify.php">회원정보수정</a></li>
						<?
						}
						?>
						<li><a href="qna.php">고객문의</a></li>
						<li><a href="#" onclick="window.open('./survey/survey.php', '','scrollbars=no, toolbars=no,width=400,height=300')" >설문조사</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div id="wrapper" class="container">
		<section class="navbar main-menu">
			<div class="navbar-inner main-menu">
				<nav id="menu" class="pull-right">
					<ul>
						<?
						if($s_id == 'admin')
						{
						?>
						<li><a href="./products_reg.php">상품등록:관리자</a>
						<?
						}
						?>

						<li><a href="#">카테고리</a>
							<ul>
								<li><a href="./products.php?cate_type=운동화">운동화</a></li>
								<li><a href="./products.php?cate_type=구두">구두</a></li>
								<li><a href="./products.php?cate_type=샌들">샌들</a></li>
							</ul>
						</li>

						<li><a href="./products.php?cate_type=New10">New Arrival 10</a></li>
						<li><a href="./products.php?cate_type=Top5">Top 5</a></li>
						<li><a href="./notice.php">Notice</a></li>
						<li><a href="./review.php">후기게시판</a></li>
					</ul>
				</nav>
			</div>
		</section>
