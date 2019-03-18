
<? @session_start(); ?>

<!--header-->
<?
include "./header.php";
?>

<?
include "./lib/dbconn_admin.php";
?>

<script>
function reg_submit_func()
{
	 if(!document.reg_form.reg_id.value)
     {
         alert("아이디를 입력하세요!");
         document.reg_form.reg_id.focus();
         return;
     }

	 if(!document.reg_form.reg_pass.value)
     {
         alert("비밀번호 입력하세요!");
         document.reg_form.reg_pass.focus();
         return;
     }

	 if(document.reg_form.reg_pass_con.value != document.reg_form.reg_pass.value)
     {
         alert("비밀번호 확인이 일치하지 않습니다!");
         document.reg_form.reg_pass_con.focus();
         return;
     }

	 if(!document.reg_form.reg_name.value)
     {
         alert("이름을 입력하세요!");
         document.reg_form.reg_name.focus();
         return;
     }

	 
	 if(!document.reg_form.reg_hp.value)
     {
         alert("핸드폰 번호를 입력하세요!");
         document.reg_form.reg_hp.focus();
         return;
     }

	 if(!document.reg_form.reg_addr.value)
     {
         alert("주소를 입력하세요!");
         document.reg_form.reg_addr.focus();
         return;
     }
      document.reg_form.submit();
}

function check_id()
{
     window.open("log_reg/check_id.php?id="+document.reg_form.reg_id.value,
         "IDcheck",
          "left=200,top=200,width=250,height=100,scrollbars=no,resizable=yes");
}

</script>

			<section>
			<img class="pageBanner" src="themes/images/pageBanner_login.jpg" alt="New products" >
				<h4><span>Login or Regsiter</span></h4>
			</section>			
			<section class="main-content">				
				<div class="row">
					<!--로그인 폼-->
					<div class="span5">	
						<h4 class="title"><span class="text"><strong>Login</strong> Form</span></h4>
						<form name = "login_form" method="post" method = "post" action="./log_reg/log_insert.php"  >
							<input type="hidden" name="next" value="/">
							<fieldset>

								<div class="control-group">
									<label class="control-label">ID</label>
									<div class="controls">
										<input type="text" placeholder="Enter your id" id="id" class="input-xlarge" name="log_id">
									</div>
								</div>

								<div class="control-group">
									<label class="control-label">Password</label>
									<div class="controls">
										<input type="password" placeholder="Enter your password" id="pass" class="input-xlarge" name="log_pass">
									</div>
								</div>

								<div class="control-group">
									<input tabindex="3" class="btn btn-inverse large" type="submit" value="로그인">
									<hr>
								</div>
								
							</fieldset>
						</form>				
					</div>


					<!--회원가입폼-->
					<div class="span7">					

						<h4 class="title"><span class="text"><strong>Register</strong> Form</span></h4>
						<!--        <form  name="member_form" method="post" action="insert.php"> 액션은 내가 추가한것  -->
						<form name = "reg_form" method="post" class="form-stacked" action="./log_reg/reg_insert.php" > 
							<fieldset>
								<div class="control-group">
									<label class="control-label">ID</label>
									<div id ="inline">
										<input type="text"  placeholder="Enter your id" class="input-xlarge"  id="id" name="reg_id">
									</div>
									<div id="inline"><input class="btn btn-inverse large" type="button" value="아이디 중복 확인" onClick = "check_id()"></div>
								</div>
								

								<div class="control-group">
									<label class="control-label">Password</label>
									<div class="controls">
										<input type="password" placeholder="Enter your Password" class="input-xlarge"  id="pass" name="reg_pass">
									</div>
								</div>

								<div class="control-group">
									<label class="control-label">Password Confirm</label>
									<div class="controls">
										<input type="password" placeholder="ReEnter your Password" class="input-xlarge"  id="pass" name="reg_pass_con">
									</div>
								</div>									

								<div class="control-group">
									<label class="control-label">Name</label>
									<div class="controls">
										<input type="text" placeholder="Enter your Name" class="input-xlarge"  id="name" name="reg_name">
									</div>
								</div>

								<div class="control-group">
									<label class="control-label">HP</label>
									<div class="controls">
										<input type="text" placeholder="Enter your hp" class="input-xlarge" id="hp" name="reg_hp">
									</div>
								</div>

								<div class="control-group">
									<label class="control-label">Address</label>
									<div class="controls">
										<input type="text" placeholder="Enter your address" class="input-xlarge" id="addr" name="reg_addr">
									</div>
								</div>
												

								<div class="control-group">
									<p>저희는 신발 메거진 사이트입니다. 앞으로 고객님을 위해 최선을 다하겠습니다. 반갑습니다.</p>
								</div>

								<hr>
								<div class="actions"><input tabindex="9" class="btn btn-inverse large" type="button" value="계정 생성하기" onClick = "reg_submit_func()"></div>

							</fieldset>
						</form>					
					</div>				
				</div>
			</section>			
<!--footer-->
<?php
include "./footer.php";
?>