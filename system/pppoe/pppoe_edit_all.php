<?php
		
			include_once('../config/routeros_api.class.php');			
			include_once('../include/conn.php');
			include_once('../include/account.php');
			include_once('../include/convert.php');
			$ARRAY = $API->comm("/ppp/profile/print");
			$group_code=$_GET[group_code];
			$profile=$_REQUEST['profile'];
			$comment=$_REQUEST['comment'];
			$total=$profile+$comment;
			if($_REQUEST['profile']!=""){

			if($total<"0"){
				echo "<script language='javascript'>swal('You Not Select!','กรุณาเลือกรายการ','error').then(function () {
    window.location.href = 'index.php?page=pppoe_edit_all&group_code=".$group_code."';}, function (dismiss) {
  if (dismiss === 'overlay') {
    window.location.href = 'index.php?page=pppoe_edit_all&group_code=".$group_code."';
   }})</script>";
		exit();
			
			}else{
				$num=0;
				$query=mysql_query("SELECT * FROM mt_edit WHERE group_code='".$group_code."'");
				while($result=mysql_fetch_array($query)){
					 if($comment=="1"){$comment_set = "";}
			         //if($limit_uptime=="1"){$limit_uptime_set = "00:00:00";}
				  
					               $num1=$num1+($num+1);
				                   $user= $result['user'];
				    if($profile !="-1"){$ARRAY = $API->comm("/ppp/secret/set", array(											
												"profile"	=> $profile,
												 "numbers"	=> $user,
									            
									));
									
					mysql_query("UPDATE pppoe_gen SET profile='".$profile."' WHERE user='".$user."'");				
									}
					if($comment !="0"){$ARRAY = $API->comm("/ppp/secret/set", array(											
												"comment"  => $comment_set ,
			                                    "numbers"	=> $user,
						
									            
									));
					mysql_query("UPDATE pppoe_gen SET comment='".$comment_set."' WHERE user='".$user."'");				
									}
					
            }
				echo "<script language='javascript'>swal('Save Done!','แก้ไข user ".$num1." จำนวนสำเร็จแล้ว!','success').then(function () {
    window.location.href = 'index.php?page=pppoe_mik_user&cancel=yes';}, function (dismiss) {if (dismiss === 'overlay') {
    window.location.href = 'index.php?page=pppoe_mik_user&cancel=yes';}})</script>";
							exit();
			}
			
			
			}
			
			
									   								
?>

<section class="content"> 
 
<style type="text/css">
<!--
.style1 {
	color: #0000FF;
	font-weight: bold;
}
.style2 {color: #0000FF}
.style3 {color: #990000}
-->
</style>
<form name="login" action="" method="post">
  <div class="row">
         <div class="col-lg-12" >
            <div class="<?php print panel_modify();?>">
                <div class="<?php print $panel_heading;?>" >
                   <i class="fa fa-user"></i>&nbsp;&nbsp;<strong>PPPOE Edit Group User</strong>
                   <?php print $date_time_show;?> </div>                    
            
                <div class="panel-body">
                    
					<div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                   <span class="style1">เปลี่ยน Package</span>
                                    <select name="profile"  id="profile" class="form-control" >
					      <option value="-1">NO.</option>
						   <?php
													$num =count($ARRAY);
													for($i=0; $i<$num; $i++){
														$seleceted = ($i == 0) ? 'selected="selected"' : '';
														echo '<option value="'.$ARRAY[$i]['name'].$selected.'">'.$ARRAY[$i]['name'].'</option>';
													}
											 	?>						 
							             </select>
                                        </div>
								      </div>
								    </div>
							
						 <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                   <span class="style1">Reset Comment</span>
                                    <select name="comment"  id="comment" class="form-control">
					                <option value="0" selected="selected">NO.</option>
									<option value="1">YES.</option>
									</select>
                                       
                                    </div>
									</div>
                                </div>
                           
							<br>
							<br>
						

							<div class="row">
						<div class="col-md-7 " > 
						<?php
		               
						 $bottonbtn_success="on";
				$text_success="<i class=\"fa fa-check\"></i>&nbsp;Confirm";
               echo button_btn_submit_account($account,$text_success,$bottonbtn_success);
				?>
				<button id="btnCancel" class="btn btn-danger" type="reset"  Onclick="window.location.href = 'index.php?page=pppoe_mik_user&cancel=yes'"><i class="fa fa-times"></i>&nbsp;Cancel</button>
			
				
				
				<span class="hidden-xs">&nbsp;&nbsp;<button type="button" class="btn btn-info" data-toggle="collapse" data-target="#manual"><span class="style2">ข้อแนะนำการใช้งาน </span></button></span>
				</div>
				</div>
				

				
				 </div>
				 </div>
				 </div>
				 </div>
				  </form>
					                    <!-- <?php
		                if($account!="read"){
							echo"<button id=\"btnSave\" class=\"btn btn-success\" type=\"submit\">&nbsp;&nbsp;&nbsp;<i class=\"fa fa-check\"></i>&nbsp;Save&nbsp;&nbsp;&nbsp;</button>&nbsp;&nbsp;&nbsp;<button id=\"btnCancel\" class=\"btn btn-danger\" type=\"reset\"  Onclick=\"window.location.href = 'index.php?page=pppoe_mik_user&cancel=yes'\">&nbsp;&nbsp;&nbsp;<i class=\"fa fa-times\"></i>&nbsp;Cancel&nbsp;&nbsp;&nbsp;</button>";
							}else{
							echo"<a id=\"btnSave\" class=\"btn btn-success\" type=\"submit\">&nbsp;&nbsp;&nbsp;<i class=\"fa fa-check\"></i>&nbsp;Save&nbsp;&nbsp;&nbsp;</a>&nbsp;&nbsp;&nbsp;<button id=\"btnCancel\" class=\"btn btn-danger\" type=\"reset\"  Onclick=\"window.location.href = 'index.php?page=pppoe_mik_user&cancel=yes'\">&nbsp;&nbsp;&nbsp;<i class=\"fa fa-times\"></i>&nbsp;Cancel&nbsp;&nbsp;&nbsp;</button>";
							}
				?> -->
                                     
                        
                            


 <div id="manual" class="collapse">
 <div  class="panel content" style="font-size: 12pt; line-height: 2em;">
            <p><h1 class="style2">&nbsp;&nbsp;&nbsp;ข้อแนะนำการใช้งาน :</h1>
                <ul>

                    <li>1.เปลี่ยน Package</li>
					<li>NO. = ต้องการใช้ Packageเดิม</li>
                    <li>2.Reset Comment</li>
					<li>NO. = ต้องการใช้ ค่าเดิม</li>
					<li>YES. = เปลี่ยนเป็นค่า default</li>
					</ul>
            </p>
			</div>
			</div>
			 
  </section>