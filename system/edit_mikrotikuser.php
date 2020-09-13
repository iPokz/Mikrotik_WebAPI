<?php
		
			include_once('../config/routeros_api.class.php');			
			include_once('../include/conn.php');
			include_once('../include/account.php');
			include_once('../include/convert.php');
			$user=$_GET[id];		
			$user = $API->comm("/ip/hotspot/user/print", array(
									"from" => $user,
								));		
			
				
				if(!empty($_REQUEST['username'])){

					if($_REQUEST['username']==$_GET['id']){
						$user=$_GET['id'];
						$password=$_REQUEST['password'];					
						$username=$_REQUEST['username'];
						$profile=$_REQUEST['profile'];
						$limit_uptime=$_REQUEST['limit_uptime']; if($limit_uptime==""){$limit_uptime = "00:00:00";}
						$ip=$_REQUEST['ip']; if($ip==""){$ip = "0.0.0.0";}
						$mac=$_REQUEST['mac']; if($mac==""){$mac = "00:00:00:00:00:00";}
						$db_comment=$_REQUEST['comment'];
						$mt_comment=iconv("utf-8", "tis-620",$_REQUEST['comment']);
						$email=$_REQUEST['email']; if($email==""){$email = "";}
                        $reset=$_REQUEST['reset'];
	                   mysql_query("UPDATE mt_gen SET user='".$_REQUEST['username']."', pass='".$_REQUEST['password']."', limit_uptime='".$_REQUEST['limit_uptime']."', profile='".$_REQUEST['profile']."', ip_address='".$_REQUEST['ip']."', mac_address='".$_REQUEST['mac']."', comment='".$db_comment."', email='".$_REQUEST['email']."' WHERE user='".$user."'");
						
						$ARRAY = $API->comm("/ip/hotspot/user/set", array(											
											"name"		=> $username,
											"password"  => $password,
											"profile"	=> $profile,
											"limit-uptime" => $limit_uptime,
							                "mac-address"  => $mac ,
		                                    "address"  => $ip ,
							                "comment"  => $mt_comment ,
			                                "email"  => $email ,
									        "numbers"	=> $user,
								));
						$ARRAY = $API->comm("/ip/hotspot/user/".$reset."-counters", array(											
											 "numbers"	=> $user,
								));
						//echo "<script>alert('แก้ไข  ".$username." สำเร็จแล้ว')</script>";
						//echo "<meta http-equiv='refresh' content='0;url=index.php?page=mikrotikuser' />";
						echo "<script language='javascript'>swal('Save Done!','แก้ไข  ".$username." สำเร็จแล้ว!','success').then(function () {
    window.location.href = 'index.php?page=mikrotikuser';}, function (dismiss) {if (dismiss === 'overlay') {
    window.location.href = 'index.php?page=mikrotikuser';}})</script>";
						exit();
					}else{

						$sql=mysql_query("SELECT user FROM mt_gen where user='".$_REQUEST['username']."'");
						$num=mysql_num_rows($sql);						

						if($num==0){
							$user=$_GET['id'];
							$password=$_REQUEST['password'];					
							$username=$_REQUEST['username'];
							$profile=$_REQUEST['profile'];
							$limit_uptime=$_REQUEST['limit_uptime']; if($limit_uptime==""){$limit_uptime = "00:00:00";}
							$ip=$_REQUEST['ip']; if($ip==""){$ip = "0.0.0.0";}
						    $mac=$_REQUEST['mac']; if($mac==""){$mac = "00:00:00:00:00:00";}
							$db_comment=$_REQUEST['comment'];
						    $mt_comment=iconv("utf-8", "tis-620",$_REQUEST['comment']);
						    $email=$_REQUEST['email']; if($email==""){$email = "";}
	                        $img=$user.".png";
							$file=$username.".png";
							mysql_query("UPDATE mt_gen SET user='".$_REQUEST['username']."', pass='".$_REQUEST['password']."', limit_uptime='".$_REQUEST['limit_uptime']."', profile='".$_REQUEST['profile']."', ip_address='".$_REQUEST['ip']."', mac_address='".$_REQUEST['mac']."', comment='".$db_comment."', email='".$_REQUEST['email']."' WHERE user='".$user."'");
							
							$ARRAY = $API->comm("/ip/hotspot/user/set", array(											
												"name"		=> $username,
												"password"  => $password,
												"profile"	=> $profile,
												"limit-uptime" => $limit_uptime,
								                "mac-address"  => $mac ,
		                                        "address"  => $ip ,
								                "comment"  => $mt_comment ,
			                                    "email"  => $email ,
									            "numbers"	=> $user,
									));	
							$ARRAY = $API->comm("/ip/hotspot/user/".$reset."-counters", array(											
											 "numbers"	=> $user,
								));
							
							//echo "<script>alert('แก้ไข  ".$username." สำเร็จแล้ว')</script>";
							//echo "<meta http-equiv='refresh' content='0;url=index.php?page=mikrotikuser' />";
							echo "<script language='javascript'>swal('Save Done!','แก้ไข  ".$username." สำเร็จแล้ว!','success').then(function () {
    window.location.href = 'index.php?page=mikrotikuser';}, function (dismiss) {if (dismiss === 'overlay') {
    window.location.href = 'index.php?page=mikrotikuser';}})</script>";
							exit();
						}else{							
							//echo "<script>alert('Can Not Change Hotspot User<".$username.">')</script>";
							//echo "<meta http-equiv='refresh' content='0;url=index.php?page=mikrotikuser' />";
							echo "<script language='javascript'>swal('Error user! ".$_REQUEST['username']."','มีชื่อ ".$_REQUEST['username']." แล้วในฐานข้อมูล กรุณาตั้งชื่อใหม่!','error').then(function () {}, function (dismiss) {if (dismiss === 'overlay') {}})</script>";
						}
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
 

<div class="row">
         <div class="col-lg-12" >
            <div class="<?php print panel_modify();?>">
                <div class="<?php print $panel_heading;?>" >
                   
                        <strong><i class="fa fa-user"></i>&nbsp;&nbsp;Hotspot Edit Mikrotik User</strong>
                    <?php print $date_time_show;?></div>
					<div class="panel-body">
                    <form name="login" action="" method="post">
					<div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="cardNumber"><span class="style1">เลือก Package</span></label>
                                    <select name="profile"  id="profile" class="form-control" required>
					      <option value="<?php echo $user['0']['profile']; ?>"><?php echo $user['0']['profile']; ?></option>
                                            	<?php
													
											    $ARRAY = $API->comm("/ip/hotspot/user/profile/print");
											    $num =count($ARRAY);
													for($i=0; $i<$num; $i++){
														$seleceted = ($i == 0) ? 'selected="selected"' : '';
														if($ARRAY[$i]['name']!=$user['0']['profile']){
															echo '<option value="'.$ARRAY[$i]['name'].$selected.'">'.$ARRAY[$i]['name'].'</option>';
														}
														
													}
												?>						 
							</select>
                                        
                                </div>                            
                            </div>
                        </div>
						<div class="row">
                           <div class="col-xs-12  col-md-6">
                                <div class="form-group">
                                    <label for="cardExpiry"><span class=" style1">Username</span></label>
                                   <input name="username" type="text" placeholder="Username" class="form-control" value="<?php echo $user['0']['name'];?>" required>  
									</div>
                                </div>
                            <div class="col-xs-12  col-md-6">
                                <div class="form-group">
                                    <label for="cardCVC"><span class="style1">Password</span></label>
                                    <input name="password" type="text" placeholder="Password" class="form-control" value="<?php echo $user['0']['password'];?>" >  
									
                                </div>
                            </div>
                        </div>

						 <div class="row">
                           <div class="col-xs-12  col-md-6">
                                <div class="form-group">
                                    <label for="cardNumber"><span class="style1">เลือกจำนวนวันที่ใช้งาน</span></label>
                                    <input name="limit_uptime"  id="limit_uptime" placeholder="Ex.1d or 1h" class="form-control" value="<?php echo $user['0']['limit-uptime'];?>" >
									</div>
                                </div>
                           <div class="col-xs-12  col-md-6">
                                <div class="form-group">
                                    <label for="cardCVC"><span class="style1">Reset All Counters.</span></label>
                                     <select name="reset"  id="reset" class="form-control">
					                <option value="" selected="selected">NO.</option>
									<option value="reset">YES.</option>
									</select>
                                </div>
                            </div>
                        </div>

						<div class="row">
                            <div class="col-xs-12  col-md-6">
                                <div class="form-group">
                                    <label for="cardExpiry"><span class=" style1">เจาะจง IP Address</span></label>
                                   <input name="ip" type="text" class="form-control" placeholder="Ex.172.0.0.3" value="<?php echo $user['0']['address'];?>">  
									</div>
                                </div>
                              <div class="col-xs-12  col-md-6">
                                <div class="form-group">
                                    <label for="cardCVC"><span class="style1">เจาะจง MAC Address</span></label>
                                    <input name="mac" type="text" placeholder="Ex.1A:2A:3A:4A:5A:6A" class="form-control" value="<?php echo $user['0']['mac-address'];?>">  
									 </div>
                                  </div>
                                 </div>

						<div class="row">
                            <div class="col-xs-12  col-md-6">
                                <div class="form-group">
                                    <label for="cardExpiry"><span class=" style1">Comment</span></label>
                                   <input name="comment" type="text" placeholder="Ex.jen/31/2017 23:00:00"  class="form-control" value="<?php echo iconv("tis-620", "utf-8",$user['0']['comment']);?>" maxlength="30">  
							  </div>
                                </div>
								<div class="col-xs-12  col-md-6">
                                <div class="form-group">
                                    <label for="cardExpiry"><span class=" style1">E-mail</span></label>
                                   <input name="email" type="email" placeholder="Ex.123@hotmail.com" class="form-control" value="<?php echo $user['0']['email'];?>">  
							  </div>
                                </div>
                            </div>
                            
						<!-- <div class="form-group">
                                    <label for="couponCode"><span class="style1">Profile Name</span></label>
                               <option  type="text"   class="form-control" required ><?php echo $result['user']; ?></option>
                                </div> -->	
					
						<div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="cardExpiry"><span class=" style1">วันหมดอายุ</span></label>
                                   <option type="text" class="form-control" >
								   <?php 
	                        ###ตรวจสอบโปรไฟล์ที่กำหนด expireและprice (วันหมดอายุและราคามีครบหรือยัง?)###
							$exp=mysql_fetch_array(mysql_query("SELECT * FROM mt_profile WHERE pro_name='".$user['0']['profile']."'"));
	                        $check_profile=$exp['pro_expire'];
							#$check_price=$exp['pro_price'];
							###ตรวจสอบความถูกต้องของ comment  ###
                           #if((($check_profile) && ($check_price))>0){
							   if(($check_profile)>0){
						   $check_comment=substr("".$user['0']['comment']."",-30,20);
						  $comm1_check_arr=substr("".$check_comment."",-14,1); //jan/16/2017 18:26:31อิงเครื่องหมาย ../../..
			             $comm2_check_arr=substr("".$check_comment."",-17,1); //jan/16/2017 18:26:31อิงเครื่องหมาย ../../..
			              $check1_comment=array("/"=>"normal");
			              $check2_comment=array("/"=>"normal");
		                   $for_school1=$check1_comment[$comm1_check_arr];
		                  $for_school2=$check2_comment[$comm2_check_arr];
                         ###ถ้า commentมาจากที่ระบบสร้างให้ ###
		                   if(!empty($for_school1 && $for_school2)){
						###หลังจากคัดแล้ว ##### }} ###จบสคริปคัดกรอง comment ###
						$ff=$check_profile;
						    $sw_time="on";
						   $dd=$check_comment;
						   $dr=expdate($dd,$ff);
                          $count=exp_time($convert_total,$dd,$ff);
	                      $count2=$count; if($count==""){$count2 ="0 วัน";}
	                      if(($count || $dr)!=""){echo "หมดอายุ ".$dr." เหลือเวลาอีก : ".$count2."";}
                        
						   }}
	
	                        ################## END #####################
	                                 ?>
	                            </option>  
							  
							  </div>
                                </div>
                            </div>
							
            
                      <div class="row">
						<div class="col-lg-12 col-md-12 " >
					                    <?php
		                
						 $bottonbtn_success="on";
				$text_success="&nbsp;&nbsp;&nbsp;<i class=\"fa fa-check\"></i>&nbsp;Save&nbsp;&nbsp;&nbsp;";
               echo button_btn_submit_account($account,$text_success,$bottonbtn_success);
				?>

                         <button id="btnCancel" class="btn btn-danger" type="reset"  Onclick="window.location.href = 'index.php?page=mikrotikuser'">&nbsp;&nbsp;&nbsp;<i class="fa fa-times"></i>&nbsp;Cancel&nbsp;&nbsp;&nbsp;</button>&nbsp;&nbsp;
						 <span class="hidden-xs"><button id="btnSave" class="btn btn-warning" type="reset">&nbsp;&nbsp;&nbsp;<i class="fa fa-refresh"></i>&nbsp;Reset&nbsp;&nbsp;&nbsp;</button>&nbsp;&nbsp;<button type="button" class="btn btn-info" data-toggle="collapse" data-target="#manual"><span class="style2">ข้อแนะนำการใช้งาน </span></button></span>
                        </div>
						</div>
						</form>
						 </div>
                       </div>
                      </div>           
			         </div>
             
                   <div id="manual" class="collapse">
                    <div  class="panel content" style="font-size: 12pt; line-height: 2em;">
            <p><h1 class="style2">&nbsp;&nbsp;&nbsp;ข้อแนะนำการใช้งาน :</h1>
                <ul>
                    <li>เลือก Package, และ จำนวนวันที่ใช้งาน</li>
                    <li>ตัวอย่าง การเจาะจง IP Address > <strong>192.168.1.20</strong></li>
                    <li>ตัวอย่าง การเจาะจง MAC Address > <strong>00:FD:AE:98:65:AA</strong></li>
					<li>วันหมดอายุ จะแสดงเมื่อมี comment และ ได้กำหนด expire ที่ profile แล้วเท่านั้น </li>
                   <li>ตัวเลือก ที่ไม่กำหนดจะเป็นค่า <strong>default .</strong> </li>
                </ul>
            </p>
			</div>
			</div>

  </section>