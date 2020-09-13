<?php
		
			include_once('../config/routeros_api.class.php');			
			include_once('../include/conn.php');
			include_once('../include/account.php');
			include_once('../include/convert.php');
			$profile=$_GET[name];		
			$Profile = $API->comm("/ip/hotspot/user/profile/print", array(
									"from" => $profile,
								));	
								if(!empty($_REQUEST['pro_name'])){

					if($_REQUEST['pro_name']==$_GET['name']){
						
                        $profile=$_REQUEST['pro_name'];
	$name=$_REQUEST['name'];
	$session=$_REQUEST['session']; if($session==""){$session = "00:00:00";}
	$db_session=$_REQUEST['session'];
	$idle=$_REQUEST['idle']; if($idle==""){$idle = "none";}	
	$use=$_REQUEST['use']; if($use==""){$use = "0";}	
	$limit=$_REQUEST['limit']; if($limit==""){$limit = "";}	
	$keep=$_REQUEST['keep']; if($keep==""){$keep = "00:02:00";}
	$auto=$_REQUEST['auto']; if($auto==""){$auto = "00:01:00";}
	$price=$_REQUEST['price'];
	
		mysql_query("UPDATE mt_profile SET pro_name='".$_REQUEST['pro_name']."', pro_session='".$_REQUEST['db_session']."', pro_idle='".$_REQUEST['idle']."', pro_limit='".$_REQUEST['limit']."', pro_users='".$_REQUEST['use']."', pro_keepalive='".$_REQUEST['keep']."', pro_autorefresh='".$_REQUEST['auto']."', pro_price='".$_REQUEST['price']."' WHERE pro_name='".$name."'");
		
		$ARRAY = $API->comm("/ip/hotspot/user/profile/set", array(
								"name" => $profile,
								"session-timeout" => $session,
								"idle-timeout" => $idle,
								"keepalive-timeout" => $keep,
								"status-autorefresh" => $auto,
								"shared-users" => $use,
								"rate-limit" => $limit,
								//"address-list" => $list,
								"numbers" => $name
							));	
						
						echo "<script language='javascript'>swal('Save Done!','แก้ไข  ".$profile." สำเร็จแล้ว!','success').then(function () {
    window.location.href = 'index.php?page=profilelist';}, function (dismiss) {if (dismiss === 'overlay') {
    window.location.href = 'index.php?page=profilelist';}})</script>";
						exit();
					}else{

						$sql=mysql_query("SELECT pro_name FROM mt_profile where pro_name='".$_REQUEST['pro_name']."'");
						$num=mysql_num_rows($sql);						

						if($num==0){
							$profile=$_REQUEST['pro_name'];
	$name=$_REQUEST['name'];
	$session=$_REQUEST['session']; if($session==""){$session = "00:00:00";}
	$db_session=$_REQUEST['session'];
	$idle=$_REQUEST['idle']; if($idle==""){$idle = "none";}	
	$use=$_REQUEST['use']; if($use==""){$use = "0";}	
	$limit=$_REQUEST['limit']; if($limit==""){$limit = "";}	
	$keep=$_REQUEST['keep']; if($keep==""){$keep = "00:02:00";}
	$auto=$_REQUEST['auto']; if($auto==""){$auto = "00:01:00";}
	$price=$_REQUEST['price'];
	
		mysql_query("UPDATE mt_profile SET pro_name='".$_REQUEST['pro_name']."', pro_session='".$_REQUEST['db_session']."', pro_idle='".$_REQUEST['idle']."', pro_limit='".$_REQUEST['limit']."', pro_users='".$_REQUEST['use']."', pro_keepalive='".$_REQUEST['keep']."', pro_autorefresh='".$_REQUEST['auto']."', pro_price='".$_REQUEST['price']."' WHERE pro_name='".$name."'");
		
		$ARRAY = $API->comm("/ip/hotspot/user/profile/set", array(
								"name" => $profile,
								"session-timeout" => $session,
								"idle-timeout" => $idle,
								"keepalive-timeout" => $keep,
								"status-autorefresh" => $auto,
								"shared-users" => $use,
								"rate-limit" => $limit,
								//"address-list" => $list,
								"numbers" => $name
							));
							
							echo "<script language='javascript'>swal('Save Done!','แก้ไข  ".$profile." สำเร็จแล้ว!','success').then(function () {
    window.location.href = 'index.php?page=profilelist';}, function (dismiss) {if (dismiss === 'overlay') {
    window.location.href = 'index.php?page=profilelist';}})</script>";
							exit();
						}else{							
							echo "<script language='javascript'>swal('Error! ".$_REQUEST['pro_name']."','มีชื่อ ".$_REQUEST['pro_name']." แล้วในฐานข้อมูล กรุณาตั้งชื่อใหม่!','error').then(function () {}, function (dismiss) {if (dismiss === 'overlay') {}})</script>";
						}
					}
				}
									   								
?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">
<!--
.style1 {color: #0000FF;
          font-weight: bold;
}
.style2 {color: #990000}

-->
</style>
<section class="content"> 
  
<div class="row">
         <div class="col-lg-12" >
            <div class="<?php print panel_modify();?>">
                <div class="<?php print $panel_heading;?>" >
                    <i class="fa fa-folder-open"></i>&nbsp;&nbsp;<strong>Hotspot Edit Profile</strong>
                    <?php print $date_time_show;?></div>                    
               
                <div class="panel-body">
                    <form name="login" action="" method="post">
					
					 <div class="row">
                            <div class="col-xs-12  col-md-6">
                                <div class="form-group">
                                    <span class="style1">Profile Name</span>
                                    <input name="pro_name" type="text" placeholder="Profile Name"  class="form-control" value="<?php echo $Profile['0']['name'];?>" required >
									<input type="hidden" name="name" value="<?php echo $_GET['name'];?>">
                              </div>                            
                            </div>
							 <div class="col-xs-12 col-md-6">
						<?php
					$result=mysql_fetch_array(mysql_query("SELECT * FROM mt_profile WHERE pro_name='".$_GET[name]."'"));
					?>
                                <div class="form-group">
                                    <span class=" style1">Price <img src="../img/help.png" width="16" height="16"  class="no1" data-toggle="tooltip" data-placement="right" title="กำหนดราคา ของ profile"></span>
                                    <input name="price" type="text" placeholder="Ex.150" class="form-control" value="<?php echo $result['pro_price']; ?>">
                               </div>
							</div>
                        </div>


						<div class="row">
                            <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                    <span class=" style1">Session Timeout <img src="../img/help.png" width="16" height="16"  class="no1" data-toggle="tooltip" data-placement="right" title="กำหนดเวลาเชื่อมต่อสูงสุด"></span>
                                    <input name="session" type="text" placeholder="Ex.04:00:00" class="form-control" value="<?php echo $Profile['0']['session-timeout'];?>" >
                               </div>                            
                            </div>
                        <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                    <span class=" style1">Idle Timeout <img src="../img/help.png" width="16" height="16"  class="no1" data-toggle="tooltip" data-placement="right" title="กำหนดเวลา logout userออกจากระบบถ้าไม่ได้ใช้งาน"></span>
                                    <input name="idle" type="text"  placeholder="Ex.00:02:00"  class="form-control" value="<?php echo $Profile['0']['idle-timeout'];?>" >
                               </div>
							   </div>
                        </div>


						<div class="row">
                            <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                    <span class=" style1">Keepalive Timeout <img src="../img/help.png" width="16" height="16"  class="no1" data-toggle="tooltip" data-placement="right" title="กำหนดเวลา logout userออกจากระบบถ้าไม่ได้เชื่อมต่อ"></span>
                                    <input name="keep" type="text"  placeholder="Ex.00:02:00"  class="form-control" value="<?php echo $Profile['0']['keepalive-timeout'];?>" >
                               </div>
                            </div>
							<div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                    <span class=" style1">Status Autorefresh <img src="../img/help.png" width="16" height="16"  class="no1" data-toggle="tooltip" data-placement="right" title="ตั้งเวลาอัพเดทสถานะ ของ user"></span>
                                   <input name="auto" type="text" placeholder="Ex.00:01:00"  class="form-control" value="<?php echo $Profile['0']['status-autorefresh'];?>" >  
								 </div>	
                                </div>
                            </div>


							<div class="row">
                             <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                    <span class="style1">Shared Users<img src="../img/help.png" width="16" height="16"  class="no2" data-toggle="tooltip" data-placement="right" title="กำหนดจำนวนเครื่องที่สามารถใช้พร้อมกันได้ ต่อ 1user"></span>
                                    <input name="use" type="text"  placeholder="Ex.1"  class="form-control"  value="<?php echo $Profile['0']['shared-users'];?>" >  
								</div>
							   </div>
							 <div class="col-xs-12  col-md-6">
                                <div class="form-group">
                                    <span class=" style1">Rate Limit (rx/tx) <img src="../img/help.png" width="16" height="16"  class="no1" data-toggle="tooltip" data-placement="right" title="กำหนดค่าความเร็วอินเตอร์เน็ต ของแพ็คเกจ Ex.512K/5M"></span>
                                    <input name="limit" type="text"  placeholder="upload/download" class="form-control" value="<?php echo $Profile['0']['rate-limit'];?>" >
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

				                <button id="btnCancel" class="btn btn-danger" type="reset"  Onclick="window.location.href = 'index.php?page=profilelist'">&nbsp;&nbsp;&nbsp;<i class="fa fa-times"></i>&nbsp;Cancel&nbsp;&nbsp;&nbsp;</button>&nbsp;&nbsp;
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
                  <li>การแก้ไข หรือปรับปรุง เปลี่ยนแปลงชื่อ จะทำให้หลายๆระบบ ไม่ทำงาน ...เเนะนำให้สร้างใหม่ </li>
                  <li>การแก้ไข หรือปรับปรุง ไม่ได้รวมกับโปรไฟล์ ในUser manager</li>
                  <li>ตัวเลือก ที่ไม่กำหนดจะเป็นค่า default .</li>
                </ul>
				</div>
                </div>
			
  </section>