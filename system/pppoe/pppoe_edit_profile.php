<?php
		
				
	include_once('../config/routeros_api.class.php');			
	include_once('../include/conn.php');
	include_once('../include/account.php');
	include_once('../include/convert.php');
	echo "<meta charset='utf-8'>" ;
			$profile=$_GET[name];		
			$Profile = $API->comm("/ppp/profile/print", array(
									"from" => $profile,
								));	
			if(!empty($_REQUEST['pro_name'])){

			$onup=":local whouser \$user;:local whoip [/ppp active get [find name=\$whouser] address];:local macaddr [/ppp active get [find name=\$whouser] caller-id];:log info \"user logged in: \$whouser Address: \$whoip Mac: \$macaddr\";{:local date [/system clock get date ];:local time [/system clock get time ];:if ( [/ppp secret get \$whouser comment ] =\"\" ) do={[/ppp secret set \$whouser comment=\"\$date \$time\"];:log info \"New PPPOE user logged in: \$whouser\"; }}";

					if($_REQUEST['pro_name']==$_GET['name']){
						$profile=$_GET['name'];
						$pro_name=$_REQUEST['pro_name'];
						$local=$_REQUEST['local'];
	                    $remote=$_REQUEST['remote'];
	                    $limit=$_REQUEST['limit']; if($limit==""){$limit = "";}	
	                    mysql_query("UPDATE pppoe_pro SET pro_name='".$_REQUEST['pro_name']."', pro_session='".$_REQUEST['session']."', pro_local='".$_REQUEST['local']."', pro_limit='".$_REQUEST['limit']."', pro_remote='".$_REQUEST['remote']."', pro_price='".$_REQUEST['price']."' WHERE pro_name='".$profile."'");
		
		$ARRAY = $API->comm("/ppp/profile/set", array(
								"name" => $pro_name,
								//"session-timeout" => $session,
									"local-address" => $local,
									"remote-address" => $remote,
									"rate-limit" => $limit,
										"on-up" => $onup,
								"numbers" => $profile,
							));

						
						echo "<script language='javascript'>swal('Save Done!','แก้ไข  ".$pro_name." สำเร็จแล้ว!','success').then(function () {
    window.location.href = 'index.php?page=pppoe_profile_list';}, function (dismiss) {if (dismiss === 'overlay') {
    window.location.href = 'index.php?page=pppoe_profile_list';}})</script>";
						exit();
					}else{

						$sql=mysql_query("SELECT pro_name FROM pppoe_pro where pro_name='".$_REQUEST['pro_name']."'");
						$num=mysql_num_rows($sql);						

						if($num==0){
							$profile=$_GET['name'];
							$pro_name=$_REQUEST['pro_name'];
						
	                       $local=$_REQUEST['local'];
	                       $remote=$_REQUEST['remote'];
	                       $limit=$_REQUEST['limit']; if($limit==""){$limit = "";}	
	                    mysql_query("UPDATE pppoe_pro SET pro_name='".$_REQUEST['pro_name']."', pro_session='".$_REQUEST['session']."', pro_local='".$_REQUEST['local']."', pro_limit='".$_REQUEST['limit']."', pro_remote='".$_REQUEST['remote']."', pro_price='".$_REQUEST['price']."' WHERE pro_name='".$profile."'");
		
		$ARRAY = $API->comm("/ppp/profile/set", array(
								"name" => $pro_name,
								//"session-timeout" => $session,
									"local-address" => $local,
									"remote-address" => $remote,
									"rate-limit" => $limit,
										"on-up" => $onup,
								"numbers" => $profile,
							));
							
							echo "<script language='javascript'>swal('Save Done!','แก้ไข  ".$pro_name." สำเร็จแล้ว!','success').then(function () {
    window.location.href = 'index.php?page=pppoe_profile_list';}, function (dismiss) {if (dismiss === 'overlay') {
    window.location.href = 'index.php?page=pppoe_profile_list';}})</script>";
							exit();
						}else{							
							echo "<script language='javascript'>swal('Error! ".$_REQUEST['pro_name']."','มีชื่อ ".$_REQUEST['pro_name']." แล้วในฐานข้อมูล กรุณาตั้งชื่อใหม่!','error').then(function () {}, function (dismiss) {if (dismiss === 'overlay') {}})</script>";
						}
					}
				}
									   								
?>


<style type="text/css">
<!--
.style1 {color: #0000FF;
          font-weight: bold;
}
.style2 {color: #990000}

-->
</style>
<section class="content"> 
 <?php
					$result=mysql_fetch_array(mysql_query("SELECT * FROM pppoe_pro WHERE pro_name='".$_GET['name']."'"));
					?>

<div class="row">
         <div class="col-lg-12" >
            <div class="<?php print panel_modify();?>">
                <div class="<?php print $panel_heading;?>" >
                    <i class="fa fa-edit"></i>&nbsp;&nbsp;<strong>PPPOE Edit Profile</strong>
                     <?php print $date_time_show;?></div> 
					 
                 <div class="panel-body">
                    <form name="" action="" method="post">
					 <div class="row">
                            <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                    <span class="style1">Profile Name</span>
                                    <input name="pro_name" type="text" placeholder="Profile Name"  class="form-control" value="<?php echo $Profile['0']['name'];?>" required >
									<input type="hidden" name="name" value="<?php echo $_GET['name'];?>">
                              </div>                            
                            </div>
                        <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                    <span class="style1">Price <img src="../img/help.png" width="16" height="16"  class="no1" data-toggle="tooltip" data-placement="right" title="กำหนดราคา ของ profile"></span>
                                    <input name="price" type="text" placeholder="กำหนดราคา ของ profile Exe.25,50,100"  class="form-control" value="<?php echo $result['pro_price']; ?>" >
								</div>                            
                            </div>
                        </div>

						<div class="row">
                            <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                    <span class="style1">Local Address <img src="../img/help.png" width="16" height="16"  class="no1" data-toggle="tooltip" data-placement="right" title="กำหนดไอพี หรือไอพี pool Exe.10.0.0.1 ,pool1"></span>
                                    <input name="local" type="text" placeholder="กำหนดไอพี หรือไอพี pool Exe.10.0.0.1 ,pool1"  class="form-control" value="<?php echo $Profile['0']['local-address'];?>" required >
								</div>                            
                            </div>
                        <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                    <span class="style1">Remote Address <img src="../img/help.png" width="16" height="16"  class="no1" data-toggle="tooltip" data-placement="right" title="กำหนดกลุ่มไอพีที่ให้บริการ"></span>
                                    <select name="remote"  id="remote" class="form-control" required>
					      <option value="<?php echo $Profile['0']['remote-address']; ?>"><?php echo $Profile['0']['remote-address']; ?></option>
                                            	<?php
													
											    $ARRAY = $API->comm("/ip/pool/print");
											    $num =count($ARRAY);
													for($i=0; $i<$num; $i++){
														$seleceted = ($i == 0) ? 'selected="selected"' : '';
														if($ARRAY[$i]['name']!=$Profile['0']['remote-address']){
															echo '<option value="'.$ARRAY[$i]['name'].$selected.'">'.$ARRAY[$i]['name'].'</option>';
														}
														
													}
												?>						 
							           </select>
                                       </div>
                                </div>                            
                            </div>
                      
						
						
						 <div class="row">
                            <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                    <span class=" style1">Session Timeout</span> <img src="../img/help.png" width="16" height="16"  class="no1" data-toggle="tooltip" data-placement="right" title="กำหนดเวลา เชื่อมต่อสูงสุด">
                                    <input name="session" type="text"  class="form-control" placeholder="Exe.30d 00:00:00" value="<?php echo $Profile['0']['session-timeout'];?>" >
                               </div>                            
                            </div>
                        <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                    <span class=" style1">Rate Limit (rx/tx)</span> <img src="../img/help.png" width="16" height="16"  class="no1" data-toggle="tooltip" data-placement="right" title="กำหนดค่าความเร็วอินเตอร์เน็ต ของแพ็คเกจ Ex.512K/5M">
                                    <input name="limit" type="text"  placeholder="upload/download" class="form-control" value="<?php echo $Profile['0']['rate-limit'];?>" >
                               </div>
                            </div>                        
                        </div>



                        <div class="row">
						<div class="col-lg-12 col-md-12 " >
						<?php
								$bottonbtn_success="on";
				$text_success="&nbsp;&nbsp;&nbsp;<i class=\"fa fa-check\"></i>&nbsp;Save&nbsp;&nbsp;&nbsp;&nbsp;";
               echo button_btn_submit_account($account,$text_success,$bottonbtn_success);	  
				?>
                        <button id="btnCancel" class="btn btn-danger" type="reset"  Onclick="window.location.href = 'index.php?page=pppoe_profile_list'">&nbsp;&nbsp;&nbsp;<i class="fa fa-times"></i>&nbsp;Cancel&nbsp;&nbsp;&nbsp;</button>&nbsp;&nbsp;
						
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
                  
                  <li><strong>Profile Name</strong> การแก้ไข หรือปรับปรุง เปลี่ยนแปลงชื่อ จะทำให้หลายๆระบบ ไม่ทำงาน ...เเนะนำให้สร้างใหม่ </li>
					<li><strong>Price</strong> กำหนดราคา ของบัตร ที่จะใช้ โปรไฟล์นี้  150 = 150บาท</li>
                    <li><strong>Local Address </strong>ให้กำหนดไอพี server หรือกำหนดไอพี pool</li>
                    <li><strong>Remote Address </strong>ให้กำหนดกลุ่มไอพี pool ที่จะให้ user ใช้งาน </li>
					<li>ตัวเลือกที่ไม่กำหนค่า จะเป็นค่า  Default.</li>
                </ul>
            </div>
			 </div>
			
  </section>