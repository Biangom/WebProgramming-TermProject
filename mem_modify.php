<? @session_start(); ?>
<!--header-->
<?
include "./header.php";
?>

<script>
function submit_func()
{

	 if(!document.mod_form.m_pass.value)
     {
         alert("비밀번호 입력하세요!");
         document.mod_form.m_pass.focus();
         return;
     }

     if(document.mod_form.m_pass.value != document.mod_form.m_pass_con.value)
     {
         alert("비밀번호 확인이 일치하지 않습니다!");
         document.mod_form.m_pass_con.focus();
         return;
     }

    if(!document.mod_form.m_hp.value)
     {
         alert("핸드폰번호 입력하세요!");
         document.mod_form.m_hp.focus();
         return;
     }

    if(!document.mod_form.m_addr.value)
     {
         alert("주소를 입력하세요!");
         document.mod_form.m_addr.focus();
         return;
     }
      document.mod_form.submit();
}


function delete_func(href) 
{
    if(confirm("정말 회원 탈퇴 하시겠습니까?")) {
            document.location.href = "log_reg/mem_delete.php";
    }
}

</script>

<?

   if(!$s_id) {
     echo("
	   <script>
	     window.alert('로그인 후 이용하세요.')
	     history.go(-1)
	   </script>
	 ");
	 exit;
   }   

?>
			<section>
			<img class="pageBanner" src="themes/images/pageBanner_modify.jpg" alt="New products" >
				<h4><span>MODIFY</span></h4>
			</section>	
			<section class="main-content">
                <div class="accordion-inner">
                    <div class="row-fluid">
                    <div class = "span3">
                    </div>
                    <form name = "mod_form" method="post" class="form-stacked" action="./log_reg/reg_insert.php?mode=modify" > 
                        <div class="span6">
                            <h4>회원 정보 수정</h4>
                            <div >
                                <label class="control-label">ID</label>
                                <div>
                                <input type= "text" class="input-xlarge" value = "<?=$s_id?>" name = "m_id" readonly>
                                   
                                </div>
                            </div>

                            <div>
                                <label> Password </label>
                                <div>
                                    <input type="password" class="input-xlarge" name = "m_pass" >
                                </div>
                            </div>
                            <div>
                                <label>Password Confirm</label>
                                <div>
                                    <input type="password" class="input-xlarge" name = "m_pass_con">
                                </div>
                            </div>

                            <div>
                                <label>Name</label>
                                <div>
                                   <input type= "text" class="input-xlarge" value = "<?=$s_name?>" readonly>
                                </div>
                            </div>		


                            <div>
                                <label>HP</label>
                                <div>
                                   <input type= "text" class="input-xlarge" value = "<?=$s_hp?>" name = "m_hp">
                                </div>
                            </div>					  			  

                            <div>
                                <label>Address</label>
                                <div class="controls">
                                    <input type="text" class="input-xlarge" value = "<?=$s_addr?>" name = "m_addr">
                                </div>
                            </div>
                               <input  class="btn btn-info"  type = "button" value="수정" name = "modify_btn" onClick = "submit_func()">
                               <input  class="btn btn-danger"  type = "button" value="회원탈퇴" name = "delete_btn" onclick = "delete_func()">
                        </div>
                    </form>
                    </div>
                </div><!--accordion inner finish-->	
			</section>			
            
<!--footer-->
<?
include "./footer.php";
?>