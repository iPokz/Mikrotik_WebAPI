<?php
		
			include_once('../config/routeros_api.class.php');			
			include_once('../include/conn.php');
			include_once('../include/account.php');
			include_once('../include/convert.php');
			$ARRAY1 = $API->comm("/tool/user-manager/customer/print");
				
			
?>

<style type="text/css">
<!--
.style1 {color: #0000FF}
.style2 {color: #990000}
.style3 {color: #FF0000; }
-->
</style>
<section class="content"> 

       <div class="row">
         <div class="col-lg-12" >

		<div class="<?php print panel_modify();?>">
                <div class="<?php print $panel_heading;?>" >
                    <strong><i class="fa fa-folder-open"></i>&nbsp;&nbsp;Hotspot Add Usermanager Profile</strong><?php print $date_time_show;?></div>                    
                
                <div class="panel-body">
                    <form name="add_pro_userman" action="index.php?page=con_add_usermanager_profile_process" method="post">
					 <div class="row">
                            <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                    <label for="couponCode"><span class="style1">Profile Name</span></label>
                                    <input name="name" type="text" placeholder="Profile Name"  class="form-control" required >
                                </div>                            
                            </div>
                        <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                    <label for="cardExpiry"><span class=" style1"> Customers</span></label>
                                    <!-- <div class="input-group"> -->
                                        <select name="owner"  id="owner" class="form-control" required>
					      <option value="">เลือก Owner</option>
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
                        </div>

						<div class="row">
                            <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                    <label for="cardExpiry"><span class=" style1">Validity</span> <img src="../img/help.png" width="16" height="16"  class="no1" data-toggle="tooltip" data-placement="right" title="กำหนดอายุ ของ profile"></label>
                                    <input name="validity" type="text" placeholder="Ex.1h,4h,15d,30d" class="form-control"  >
                                </div>                            
                            </div>
                        <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                    <label for="cardExpiry"><span class=" style1">Uptime-limit</span> <img src="../img/help.png" width="16" height="16"  class="no1" data-toggle="tooltip" data-placement="right" title="กำหนดเวลาให้ใช้งานสูงสุดของ  user"></label>
                                    <input name="uptime_limit" type="text" placeholder="Ex.1h,4h,15d,30d" class="form-control" >
                               </div>
							   </div>
							   </div>

						<div class="row">
                            <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                    <label for="cardExpiry"><span class=" style1">Session Timeout</span> <img src="../img/help.png" width="16" height="16"  class="no1" data-toggle="tooltip" data-placement="right" title="กำหนดเวลาเชื่อมต่อ สูงสุด"></label>
                                    <input name="session" type="text" placeholder="Ex.04:00:00"   class="form-control" >
                               </div>                            
                            </div>
                        <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                    <label for="cardExpiry"><span class=" style1">Idle Timeout</span> <img src="../img/help.png" width="16" height="16"  class="no1" data-toggle="tooltip" data-placement="right" title="กำหนดเวลา logout userออกจากระบบถ้าไม่ได้ใช้งาน"></label>
                                    <input name="idle" type="text" placeholder="Ex.00:02:00" class="form-control" value="none" >
                               </div>
							   </div>
							   </div>
						
						<div class="row">
                            <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                    <label for="cardExpiry"><span class=" style1">Keepalive Timeout</span> <img src="../img/help.png" width="16" height="16"  class="no1" data-toggle="tooltip" data-placement="right" title="กำหนดเวลา logout userออกจากระบบถ้าไม่ได้เชื่อมต่อ"></label>
                                    <input name="keep" type="text" placeholder="Ex.00:02:00" class="form-control" value="00:02:00" >
                               </div>
                            </div>
							<div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                    <label for="cardExpiry"><span class=" style1 ">Status Autorefresh</span> <img src="../img/help.png" width="16" height="16"  class="no1" data-toggle="tooltip" data-placement="right" title="ตั้งเวลาอัพเดทสถานะ ของ user"></label>
                                   <input name="auto" type="text" placeholder="Ex.00:01:00" value="00:01:00"  class="form-control">  
								 </div>	
                                </div>
                            </div>

                            <div class="row">
                             <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                    <label for="cardExpiry"><span class=" style1">Rate Limit RX</span> <img src="../img/help.png" width="16" height="16"  class="no1" data-toggle="tooltip" data-placement="right" title="กำหนดค่าความเร็ว upload ของแพ็คเกจ Ex.512K or 5M"></label>
                                    <input name="upload" type="text"  placeholder="Upload Ex..1M" class="form-control" >
                               </div>
                            </div>                        
                        <div class="col-xs-12 col-md-6">
							<div class="form-group">
                                    <label for="cardCVC"><span class=" style1">Rate Limit TX</span> <img src="../img/help.png" width="16" height="16"  class="no2" data-toggle="tooltip" data-placement="right" title="กำหนดค่าความเร็ว download ของแพ็คเกจ Ex.512K or 5M"></label>
                                    <input name="download" type="text" placeholder="Download Ex.5M"  class="form-control"  >  
								</div>                            
                            </div>
                        </div>

						<div class="row">
                            <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                    <label for="cardExpiry"><span class=" style1">Shared Users</span> <img src="../img/help.png" width="16" height="16"  class="no2" data-toggle="tooltip" data-placement="right" title="กำหนดจำนวนเครื่องที่สามารถใช้พร้อมกันได้ ต่อ 1user"></label>
                                    <input name="shared" type="text" value="1"  class="form-control">  
							  </div>
                                </div>
                                 <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                    <label for="cardExpiry"><span class=" style1">Price</span> <img src="../img/help.png" width="16" height="16"  class="no1" data-toggle="tooltip" data-placement="right" title="กำหนดราคา ของ profile"></label>
                                    <input name="price" type="text" placeholder="Ex.150" class="form-control" >
                               </div>
							   </div>
							   </div>
						<br>
					<div class="row">
						<div class="col-lg-12 col-md-12 " >
                           
							<?php
		                $bottonbtn_success="on";
				$text_success="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class=\"fa fa-check\"></i>&nbsp;Save&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
               echo button_btn_submit_account($account,$text_success,$bottonbtn_success);
				?>
                            <button id="btnSave" class="btn btn-danger" type="reset">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-refresh"></i>&nbsp;Reset&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
							&nbsp;&nbsp;&nbsp;<span class="hidden-xs"><button type="button" class="btn btn-info" data-toggle="collapse" data-target="#manual"><span class="style2">ข้อแนะนำการใช้งาน </span></button></span>
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
                    <li><strong>โปรแกรมจะทำการสร้าง Profile,Profile limitation,User Master ใน usermanager และProfile ใน winbox เพื่อลดขั้นตอนในการปรับแต่ง </strong></li>สร้าง Profile ด้วย โปรแกรมAPI ตัวนี้จะสามารถรู้รายรับ ในusermanได้ และสร้าง userในusermanด้วยAPIได้ 
					<li>โปรไฟล์ที่จะสร้างขึ้นนี้จะรองรับกับ user ที่อยู่ใน usermanagerเท่านั้น ไม่เกี่ยวกับ userใน winbox</li>
					<li><strong>Profile Name</strong> ตั้งชื่อโปรไฟล์ อย่ามีเว้นวรรค และอย่าตั้งชื่อด้วยตัวเลข เพียง 1หลัก เพราะจะทำให้ สคริปบางตัวไม่ทำงาน</li>
					<li><strong>Customers</strong> เลือก Owner</li>
					<li><strong>Validity</strong> กำหนดอายุ ของ profile เช่น 4h หรือ 30d</li>
					<li><strong>Uptime-limit</strong> กำหนดเวลาให้ใช้งานสูงสุดของ  user เช่น 4h  30d</li>
					<li><strong>Price</strong> กำหนดราคา ของบัตร ที่จะใช้ โปรไฟล์นี้  150 = 150บาท</li>
					
                    <li>ตัวเลือกที่ไม่กำหนค่า จะเป็นค่า  Default.</li>
					
                </ul>
				</div>
                </div>
			
  </section>