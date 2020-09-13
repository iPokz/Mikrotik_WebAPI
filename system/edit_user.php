<?php
		
			include_once('../config/routeros_api.class.php');			
			include_once('../include/conn.php');	
			include_once('../include/convert.php');	
			$ARRAY = $API->comm("/ip/hotspot/user/profile/print");		
			
				
				if(!empty($_REQUEST['username'])){

					if($_REQUEST['username']==$_GET['id']){
						$user=$_GET['id'];
						$password=$_REQUEST['password'];					
						$username=$_REQUEST['username'];
						$profile=$_REQUEST['profile'];
						$limit_uptime=$_REQUEST['limit_uptime']; if($limit_uptime==""){$limit_uptime = "00:00:00";}
						$db_limit_uptime=$_REQUEST['limit_uptime'];
						$db_ip=$_REQUEST['ip'];
						$db_mac=$_REQUEST['mac'];
						$ip=$_REQUEST['ip']; if($ip==""){$ip = "0.0.0.0";}
						$mac=$_REQUEST['mac']; if($mac==""){$mac = "00:00:00:00:00:00";}
						$caller=$_REQUEST['mac'];
						$email=$_REQUEST['email'];
	                    $img=$user.".png";
						$customer="admin";
						$file=$username.".png";
						/*/@unlink("../qrcode/".$img);
						//QRcode::png('http://'.$ip.'/login?username='.$username.'&password='.$password.'', '../qrcode/'.$file.'');
						/*mysql_query("UPDATE mt_gen SET user='".$_REQUEST['username']."', pass='".$_REQUEST['password']."', limit_uptime='".$_REQUEST['db_limit_uptime']."', profile='".$_REQUEST['profile']."', ip_address='".$_REQUEST['db_ip']."', mac_address='".$_REQUEST['db_mac']."', email='".$_REQUEST['email']."' WHERE user='".$user."'");
						
						$ARRAY = $API->comm("/ip/hotspot/user/set", array(											
											"name"		=> $username,
											"password"  => $password,
											"profile"	=> $profile,
											"limit-uptime" => $limit_uptime,
							                "mac-address"  => $mac ,
		                                    "address"  => $ip ,
			                                "email"  => $email ,
									        "numbers"	=> $user,
								));
						$ARRAY = $API->comm("/tool/user-manager/user/set", array(											
											"username"	=> $username,
											"password"  => $password,
											//"profile" => $profile,
											//"customer" => $customer,
							                "caller-id"  => $caller ,//create-and-activate-profile
		                                    "ip-address"  => $ip ,
			                                "email"  => $email ,
									        "numbers"	=> $user,
								));
						
						echo "<script>alert('แก้ไข  ".$username." สำเร็จแล้ว')</script>";
						//echo "<script>history.back();</script>";
						echo "<meta http-equiv='refresh' content='0;url=index.php?page=listuser' />";*/
						if($_GET['return']=="allDB"){
						echo "<script language='javascript'>swal('Can Not Change Hotspot User  ".$username."!','สามารถแก้ไขได้ที่หน้า Mikrotik user และ User manager','error').then(function () {
    window.location.href = 'index.php?page=all_data_users&id=".$_GET['code']."';}, function (dismiss) {if (dismiss === 'overlay') {
    window.location.href = 'index.php?page=all_data_users&id=".$_GET['code']."';}})</script>";
						}
						if($_GET['return']=="DB"){
						echo "<script language='javascript'>swal('Can Not Change Hotspot User  ".$username."!','สามารถแก้ไขได้ที่หน้า Mikrotik user และ User manager','error').then(function () {
    window.location.href = 'index.php?page=user&id=".$_GET['code']."';}, function (dismiss) {if (dismiss === 'overlay') {
    window.location.href = 'index.php?page=user&id=".$_GET['code']."';}})</script>";

						exit();
						}
						
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
							$caller=$_REQUEST['mac'];
						    $email=$_REQUEST['email']; if($email==""){$email = "";}
	                        $img=$user.".png";
							$file=$username.".png";
							//@unlink("qrcode/".$img);
							//QRcode::png('http://'.$ip.'/login?username='.$username.'&password='.$password.'', 'qrcode/'.$file.'');
						/*	mysql_query("UPDATE mt_gen SET user='".$_REQUEST['username']."', pass='".$_REQUEST['password']."', limit_uptime='".$_REQUEST['limit_uptime']."', profile='".$_REQUEST['profile']."', ip_address='".$_REQUEST['ip']."', mac_address='".$_REQUEST['mac']."', email='".$_REQUEST['email']."' WHERE user='".$user."'");
							
							$ARRAY = $API->comm("/ip/hotspot/user/set", array(											
												"name"		=> $username,
												"password"  => $password,
												"profile"	=> $profile,
												"limit-uptime" => $limit_uptime,
								                "mac-address"  => $mac ,
		                                        "address"  => $ip ,
			                                    "email"  => $email ,
									            "numbers"	=> $user,
									));
							$ARRAY = $API->comm("/tool/user-manager/user/set", array(											
											"username"	=> $username,
											"password"  => $password,
											//"profile"	=> $profile,
											//"limit-uptime" => $limit_uptime,
							                "caller-id"  => $caller ,
		                                    "ip-address"  => $ip ,
			                                "email"  => $email ,
									        "numbers"	=> $user,
								)); */
							
							//echo "<script>alert('แก้ไข  ".$username." สำเร็จแล้ว')</script>";
							//echo "<script>history.back();</script>";
							//echo "<meta http-equiv='refresh' content='0;url=index.php?page=listuser' />";

							if($_GET['return']=="allDB"){
						echo "<script language='javascript'>swal('Can Not Change Hotspot User  ".$username."!','สามารถแก้ไขได้ที่หน้า Mikrotik user และ User manager','error').then(function () {
    window.location.href = 'index.php?page=all_data_users&id=".$_GET['code']."';}, function (dismiss) {if (dismiss === 'overlay') {
    window.location.href = 'index.php?page=all_data_users&id=".$_GET['code']."';}})</script>";
						}
						   if($_GET['return']=="DB"){
						   echo "<script language='javascript'>swal('Can Not Change Hotspot User  ".$username."!','สามารถแก้ไขได้ที่หน้า Mikrotik user และ User manager','error').then(function () {
    window.location.href = 'index.php?page=user&id=".$_GET['code']."';}, function (dismiss) {if (dismiss === 'overlay') {
    window.location.href = 'index.php?page=user&id=".$_GET['code']."';}})</script>";
						   }
							
							exit();
						}else{
							$username=$_REQUEST['username'];
							if($_GET['return']=="allDB"){
						echo "<script language='javascript'>swal('Can Not Change Hotspot User  ".$username."!','สามารถแก้ไขได้ที่หน้า Mikrotik user และ User manager','error').then(function () {
    window.location.href = 'index.php?page=all_data_users&id=".$_GET['code']."';}, function (dismiss) {if (dismiss === 'overlay') {
    window.location.href = 'index.php?page=all_data_users&id=".$_GET['code']."';}})</script>";
						}
						if($_GET['return']=="DB"){
						echo "<script language='javascript'>swal('Can Not Change Hotspot User  ".$username."!','สามารถแก้ไขได้ที่หน้า Mikrotik user และ User manager','error').then(function () {
    window.location.href = 'index.php?page=user&id=".$_GET['code']."';}, function (dismiss) {if (dismiss === 'overlay') {
    window.location.href = 'index.php?page=user&id=".$_GET['code']."';}})</script>";
	                        exit();
						}
							
						}
					}
				}
			
									   								
?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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

<section class="content"> 

 <div class="row">
         <div class="col-lg-12" >
            <div class="<?php print panel_modify();?>">
                <div class="<?php print $panel_heading;?>" >
                    <strong><i class="fa fa-user"></i>&nbsp;&nbsp;Hotspot Edit user - แก้ไขยูสเซอร์</strong>
                    <?php print $date_time_show;?></div>                    
             
                <div class="panel-body">
                    <form name="login" action="" method="post">
					<?php
					$result=mysql_fetch_array(mysql_query("SELECT * FROM mt_gen WHERE user='".$_REQUEST['id']."'"));
					?>
					 <div class="row">
                            <div class="col-xs-12  col-md-6">
                                <div class="form-group">
                                    <label for="cardNumber"><span class="style2">เลือก Package</span></label>
                                    <select name="profile"  id="profile" class="form-control" required>
					      <option value="<?php echo $result['profile']; ?>"><?php echo $result['profile']; ?></option>
                                            	<?php
													$num =count($ARRAY);
													for($i=0; $i<$num; $i++){
														$seleceted = ($i == 0) ? 'selected="selected"' : '';
														if($ARRAY[$i]['name']!=$result['profile']){
															echo '<option value="'.$ARRAY[$i]['name'].$selected.'">'.$ARRAY[$i]['name'].'</option>';
														}
														
													}
												?>						 
							</select>
                                     </div>                            
                                 </div>
								<div class="col-xs-12  col-md-6">
                                <div class="form-group">
                                    <label for="cardNumber"><span class="style2">เลือกจำนวนวันที่ใช้งาน</span></label>
                                    <input name="limit_uptime"  id="limit_uptime" placeholder=" Ex. 1d or 1h " class="form-control" value="<?php echo $result['limit_uptime']; ?>" >
						         </div>
                                </div>                            
                            </div>
                       
                        <div class="row">
                            <div class="col-xs-12  col-md-6">
                                <div class="form-group">
                                    <label for="cardExpiry"><span class=" style2">Username</span></label>
                                   <input name="username" type="text" class="form-control" placeholder="Username"  value="<?php echo $result['user']; ?>" required>  
									</div>
                            </div>
                            <div class="col-xs-12  col-md-6">
                                <div class="form-group">
                                    <label for="cardCVC"><span class="style2">Password</span></label>
                                    <input name="password" type="text" class="form-control" placeholder="Password"  value="<?php echo $result['pass']; ?>" required>  
									 </div>
                            </div>
                        </div>

						<div class="row">
                            <div class="col-xs-12  col-md-6">
                                <div class="form-group">
                                    <label for="cardExpiry"><span class=" style2">เจาะจง IP Address</span></label>
                                   <input name="ip" type="text" class="form-control" placeholder="Ex.172.0.0.3"  value="<?php echo $result['ip_address']; ?>">  
									
                                </div>
                            </div>
                            <div class="col-xs-12  col-md-6">
                                <div class="form-group">
                                    <label for="cardCVC"><span class="style2">เจาะจง MAC Address</span></label>
                                    <input name="mac" type="text" class="form-control" placeholder="Ex.1A:2A:3A:4A:5A:6A"  value="<?php echo $result['mac_address']; ?>">  
									 </div>
                            </div>
							</div>

							<div class="row">
                       <div class="col-xs-12  col-md-6">
                                <div class="form-group">
                                    <label for="cardExpiry"><span class=" style2">Comment</span></label>
                                   <input name="comment" type="text"  placeholder="Ex.jen/31/2017 23:00:00" class="form-control" value="<?php echo $result['comment']; ?>">  
							  </div>
                                </div>
                            <div class="col-xs-12  col-md-6">
                                <div class="form-group">
                                    <label for="cardExpiry"><span class=" style2">E-mail</span></label>
                                   <input name="email" type="email"  placeholder="Ex.123@hotmail.com" class="form-control" value="<?php echo $result['email']; ?>">  
							  </div>
                                </div>
                            </div>
                       
                            <div class="row">
						<div class="col-lg-12 col-md-12 " >                                    
                                       <?php
						if($account!="read"){
                    echo "<button id=\"btnSave\" class=\"btn btn-success\" type=\"submit\">&nbsp;&nbsp;&nbsp;<i class=\"fa fa-check\"></i>&nbsp;Save&nbsp;&nbsp;&nbsp;&nbsp;</button>&nbsp;&nbsp;&nbsp;<button id=\"btnCancel\" class=\"btn btn-danger\" type=\"reset\"  Onclick=\"javascript:history.back()\">&nbsp;&nbsp;&nbsp;&nbsp;<i class=\"fa fa-times\"></i>&nbsp;Cancel&nbsp;&nbsp;&nbsp;&nbsp;</button> ";
					}else{echo "<a id=\"btnSave\" class=\"btn btn-success\" type=\"submit\">&nbsp;&nbsp;&nbsp;<i class=\"fa fa-check\"></i>&nbsp;Save&nbsp;&nbsp;&nbsp;&nbsp;</a>&nbsp;&nbsp;&nbsp;<button id=\"btnCancel\" class=\"btn btn-danger\" type=\"reset\"  Onclick=\"javascript:history.back()\">&nbsp;&nbsp;&nbsp;&nbsp;<i class=\"fa fa-times\"></i>&nbsp;Cancel&nbsp;&nbsp;&nbsp;&nbsp;</button> ";
								   }
				?>
                        &nbsp;&nbsp;&nbsp;<span class="hidden-xs"><button id="btnSave" class="btn btn-warning" type="reset">&nbsp;&nbsp;&nbsp;<i class="fa fa-refresh"></i>&nbsp;Reset&nbsp;&nbsp;&nbsp;</button>&nbsp;&nbsp;<button type="button" class="btn btn-info" data-toggle="collapse" data-target="#manual"><span class="style2">ข้อแนะนำการใช้งาน </span></button></span>
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
                    <li>CAN NOT EDIT</li>
					<li>สามารถแก้ไขได้ที่หน้า Mikrotik user list และ User maneger list</li>
                    </ul>
            </p> 
			</div>
			    </div>
				
  </section>