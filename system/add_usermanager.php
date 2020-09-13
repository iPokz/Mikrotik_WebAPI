<?php
include_once('../config/routeros_api.class.php');			
			include_once('../include/conn.php');
			include_once('../include/account.php');
			include_once('../include/convert.php');
$ARRAY1 = $API->comm("/tool/user-manager/customer/print");
$ARRAY = $API->comm("/tool/user-manager/profile/print");
?>
<style type="text/css">
<!--
.style1 {color: #0000FF}
.style2 {color: #990000; }
-->
</style>
<section class="content"> 


 <div class="row">
         <div class="col-lg-12" >
            <div class="<?php print panel_modify();?>">
                <div class="<?php print $panel_heading;?>" >
                    <strong><i class="fa fa-user"></i>&nbsp;&nbsp;Hotspot Add UserManager - สร้างยูสเซอร์ </strong><?php print $date_time_show;?> </div>                    
              
                <div class="panel-body">
                    <form name="login" action="index.php?page=con_add_usermanager_process" method="post">
					 <div class="row">
                             <div class="col-xs-12  col-md-6">
                                <div class="form-group">
                                    <label for=""><span class="style1"> Customers</span></label>
                                   <select name="server"  id="server" class="form-control" required>
					      <option value="">ต้องเลือก Owner</option>
						   <?php
													$num =count($ARRAY1);
													for($i=0; $i<$num; $i++){
														$seleceted = ($i == 0) ? 'selected="selected"' : '';
														echo '<option value="'.$ARRAY1[$i]['login'].$selected.'">'.$ARRAY1[$i]['login'].'</option>';
													}
												?>						 
							</select>
                                    </div>
                                </div>                            
                            <div class="col-xs-12  col-md-6">
                                <div class="form-group">
                                    <label for="cardNumber"><span class="style1">เลือก Profiles</span></label>
                                    <select name="package_id"  id="package_id" class="form-control" required>
					      <option value="">ต้องเลือก Profiles</option>
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
                            <div class="col-xs-12  col-md-6">
                                <div class="form-group">
                                    <label for="cardExpiry"><span class=" style1">Username</span></label>
                                   <input name="user" type="text" placeholder="Username" class="form-control" required>  
									
                                </div>
                            </div>
                           <div class="col-xs-12  col-md-6">
                                <div class="form-group">
                                    <label for="cardCVC"><span class="style1">Password</span></label>
                                    <input name="pass" type="text" placeholder="Password" class="form-control" required>  
									
                                </div>
                            </div>
                        </div>
						<div class="row">
                           <div class="col-xs-12  col-md-6">
                                <div class="form-group">
                                    <label for="cardExpiry"><span class=" style1">เจาะจง IP Address</span></label>
                                   <input name="ip" type="text" placeholder="Ex.172.0.0.3"  class="form-control">  
									
                                </div>
                            </div>
                            <div class="col-xs-12  col-md-6">
                                <div class="form-group">
                                    <label for="cardCVC"><span class="style1">เจาะจง MAC Address</span></label>
                                    <input name="mac" type="text" placeholder="Ex.1A:2A:3A:4A:5A:6A"  class="form-control">  
									
                                </div>
                            </div>
                        </div>
							<div class="row">
                           <div class="col-xs-12  col-md-6">
                                <div class="form-group">
                                    <label for="cardExpiry"><span class=" style1">E-mail</span></label>
                                   <input name="email" type="email" placeholder="Ex.123@hotmail.com"  class="form-control">  
							  </div>
                                </div>
                            </div>
							<!-- <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="cardExpiry"><span class="hidden-xs style1">Comment - เพิ่มเติม</span></label>
                                   <input name="comments" type="text" class="form-control">  
							  </div>
                                </div>
                            </div>   -->
            
                        <div class="row">
						<div class="col-lg-7 col-md-9 " >
                            <div class="form-group">
							<?php
		                       $bottonbtn_success="on";
				$text_success="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class=\"fa fa-check\"></i>&nbsp;Save&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
               echo button_btn_submit_account($account,$text_success,$bottonbtn_success); 
								?>
                                <button id="btnSave" class="btn btn-danger" type="reset">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-refresh"></i>&nbsp;Reset&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>&nbsp;&nbsp;&nbsp;<span class="hidden-xs"><button type="button" class="btn btn-info" data-toggle="collapse" data-target="#manual"><span class="style2">ข้อแนะนำการใช้งาน </span></button></span>
                            </div>
                        </div>
						</div>
                     </div>  
                    </form>
                </div>
            </div>
			</div>
			
			<div id="manual" class="collapse">
   <div  class="panel content" style="font-size: 12pt; line-height: 2em;">
            <p><h1 class="style2">&nbsp;&nbsp;&nbsp;ข้อแนะนำการใช้งาน :</h1>
                <ul>
                    <li>ก่อนที่จะ Add Userได้ ให้ท่านสร้าง User Master เป็นต้นแบบไว้ที่ UserManager ที่มีชื่อเหมือนกันกับ Profileนั้นๆทุกอย่าง และให้ปรับแต่ง userตามต้องการเพื่อเป็นต้นแบบไว้ให้copy   ให้สร้าง Profileละ 1 ชื่อ หรือให้สร้าง โปรไฟล์ก่อนที่ add userman profile ระบบจะสร้าง User Masterให้เอง</li>
					<li>Ex..profile name=1Day ให้สร้าง username=1Day password=xxxxxxxx profile=1Day</li>
                   <li>เลือก Owner และเลือก Profile</li>
				   <li>ตัวอย่าง การเจาะจง IP Address > <strong>192.168.1.20</strong></li>
                    <li>ตัวอย่าง การเจาะจง MAC Address > <strong>00:FD:AE:98:65:AA</strong></li>
                   <li>ตัวเลือก ที่ไม่กำหนดจะเป็นค่า default .</li>
				   <li>ทดสอบกับ user manager v6.30.4</li>
                </ul>
            </p>
			</div>
</div>

  </section>