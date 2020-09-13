<?php
		
			include_once('../config/routeros_api.class.php');			
			include_once('../include/conn.php');
			include_once('../include/account.php');
			include_once('../include/convert.php');
			$ARRAY = $API->comm("/ip/hotspot/user/profile/print");
			$ARRAY2 = $API->comm("/ip/hotspot/user/print");
			
			$group_code=$_GET[group_code];
			$profile=$_REQUEST['profile'];
			$comment=$_REQUEST['comment'];
			$counters=$_REQUEST['counters'];
			$limit_uptime=$_REQUEST['limit_uptime'];
			$total=($profile+$comment+$limit_uptime+$counters);
		
		
			if($_REQUEST['profile']!=""){

                 
			if($total<"0"){
				echo "<script language='javascript'>swal('You Not Select!','กรุณาเลือกรายการ','error').then(function () {
    window.location.href='index.php?page=edit_all&group_code=".$group_code."';}, function (dismiss) {
  if (dismiss === 'overlay') {
    window.location.href='index.php?page=edit_all&group_code=".$group_code."';
   }})</script>";
		exit();
			
			}else{
				
				$num=0;
				$query=mysql_query("SELECT * FROM mt_edit WHERE group_code='".$group_code."'");
				while($result=mysql_fetch_array($query)){
					
				  
					               $num1=$num1+($num+1);
				                   $user= $result['user'];
								   $mik_use =count($ARRAY2);
								 

for($us=0; $us<$mik_use; $us++){if($ARRAY2[$us]['name']==$user){
            
$pro_set=$_REQUEST['profile'];if($pro_set==-1){$pro_set= $ARRAY2[$us]['profile'];}
$com_set=$ARRAY2[$us]['comment'];if($comment==1){$com_set="";}
$limitup=$ARRAY2[$us]['limit-uptime'];if($ARRAY2[$us]['limit-uptime']==""){$limitup="00:00:00";}
$limit_uptime_set=$limitup;if($limit_uptime==1){$limit_uptime_set="00:00:00";}
$db_limit_uptime=$ARRAY2[$us]['limit-uptime'];if($limit_uptime==1){$db_limit_uptime="";}
              $ARRAY = $API->comm("/ip/hotspot/user/set", array(											
												"profile"	=> $pro_set,
												"comment"  => $com_set ,
                                                "limit-uptime" => $limit_uptime_set,
												 "numbers"	=> $user,
									            
									));
									
	mysql_query("UPDATE mt_gen SET profile='".$pro_set."',comment='".$com_set."',limit_uptime='".$db_limit_uptime."' WHERE user='".$user."'");	
	
														   
														   }}		
					
				if($counters !="0"){$ARRAY = $API->comm("/ip/hotspot/user/reset-counters", array(												
												 "numbers"	=> $user,
									            
									));}
          
			}
			echo "<script language='javascript'>swal('Save Done!','แก้ไข user ".$num1." จำนวนสำเร็จแล้ว!','success').then(function () {
    window.location.href='index.php?page=mikrotikuser&cancel=yes';}, function (dismiss) {if (dismiss === 'overlay') {
    window.location.href='index.php?page=mikrotikuser&cancel=yes';}})</script>";
							exit();
			
			}
			}
			
			
									   								
?>

<style type="text/css">
<!--
.style1 {color: #0000FF}
.style2 {color: #990000}
-->
</style>
<section class="content"> 

 <form name="login" action="" method="post">
 <div class="row">
         <div class="col-lg-12" >
            <div class="<?php print panel_modify();?>">
                <div class="<?php print $panel_heading;?>" >
                    <strong><i class="fa fa-user"></i>&nbsp;&nbsp;Hotspot Edit Group</strong>
                    <?php print $date_time_show;?></div>                    
              
                <div class="panel-body">
                   
					<div class="row">
                           <div class="col-xs-12  col-md-6">
                                <div class="form-group">
                                    <label for="cardNumber"><span class="style1">เปลี่ยน Package</span></label>
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
								
                            <div class="col-xs-12  col-md-6">
                                <div class="form-group">
                                    <label for="cardNumber"><span class="style1">Reset Limit Uptime.</span></label>
                                    <select name="limit_uptime"  id="limit_uptime" class="form-control">
					                <option value="0" selected="selected">NO.</option>
									<option value="1">YES.</option>
									</select>
									</div>
									</div>
									</div>

                        <div class="row">
                       <div class="col-xs-12  col-md-6">
                                <div class="form-group">
                                   <label for="cardNumber"><span class="style1">Reset Comment.</span></label>
                                    <select name="comment"  id="comment" class="form-control">
					                <option value="0" selected="selected">NO.</option>
									<option value="1">YES.</option>
									</select>
									</div>
									</div>
                               <div class="col-xs-12  col-md-6">
                                <div class="form-group">
                                   <label for="cardNumber"><span class="style1">Reset Counters.</span></label>
                                    <select name="counters"  id="counters" class="form-control">
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
				

				
				<button id="btnCancel" class="btn btn-danger" type="reset"  Onclick="window.location.href = 'index.php?page=mikrotikuser&cancel=yes'"><i class="fa fa-times"></i>&nbsp;Cancel</button>
			
				
				
				<span class="hidden-xs">&nbsp;&nbsp;<button type="button" class="btn btn-info" data-toggle="collapse" data-target="#manual"><span class="style2">ข้อแนะนำการใช้งาน </span></button></span>
				</div>
				</div>
				

				
				 </div>
				 </div>
				 </div>
				 </div>
				  </form>
						
                                    
                       <div id="manual" class="collapse">
 <div  class="panel content" style="font-size: 12pt; line-height: 2em;">
            <p><h1 class="style2">&nbsp;&nbsp;&nbsp;ข้อแนะนำการใช้งาน :</h1>
                <ul>

                    <li>1.เปลี่ยน Package</li>
					<li>NO. = ต้องการใช้ Packageเดิม</li>
                    <li>2.Reset Limit Uptime</li>
					<li>NO. = ต้องการใช้ ค่าเดิม</li>
					<li>YES. = เปลี่ยนเป็นค่า default</li>
					<li>3.Reset Comment</li>
					<li>NO. = ต้องการใช้ ค่าเดิม</li>
					<li>YES. = เปลี่ยนเป็นค่า default</li>
                    <li>4.Reset Counters</li>
					<li>NO. = ต้องการใช้ ค่าเดิม</li>
					<li>YES. = เปลี่ยนเป็นค่า default</li>
            </ul>
            </p>
     
</div>

  </section>