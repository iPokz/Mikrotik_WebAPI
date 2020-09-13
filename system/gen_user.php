<?php
            include_once('../config/routeros_api.class.php');			
			include_once('../include/conn.php');
			include_once('../include/account.php');
			include_once('../include/convert.php');
			$ARRAY1 = $API->comm("/ip/hotspot/print");
			$ARRAY = $API->comm("/ip/hotspot/user/profile/print");
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
                   
                        <strong><i class="fa fa-users"></i>&nbsp;&nbsp;Hotspot Generate User - สร้างบัตรอินเตอร์เน็ต</strong><?php print $date_time_show;?>
                                     
                </div>
                <div class="panel-body">
                    <form name="login" action="index.php?page=con_genuser_process" method="post">
					 <div class="row">
                            <div class="col-xs-12  col-md-6">
                                <div class="form-group">
                                    <label for=""><span class="style1">เลือก Servers</span></label>
                                    <select name="server"  id="server" class="form-control" >
					      <option value="">all</option>
						   <?php
													$num =count($ARRAY1);
													for($i=0; $i<$num; $i++){
														$seleceted = ($i == 0) ? 'selected="selected"' : '';
														echo '<option value="'.$ARRAY1[$i]['name'].$selected.'">'.$ARRAY1[$i]['name'].'</option>';
													}
												?>						 
							</select>
                                        
                                    </div>
                                </div>
								<div class="col-xs-12  col-md-6">
                                <div class="form-group">
                                    <label for="cardNumber"><span class="style1">เลือก Package</span></label>
                                    <select name="package_id"  id="package_id" class="form-control" required>
					      <option value="">ต้องเลือก Packege</option>
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
                            <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                    <label for="cardExpiry"><span class=" style1">จำกัดเวลาใช้งาน</span></label>
                                   <input name="limit_uptime" type="text" placeholder="Ex.1d or 1h"  class="form-control">  
									
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                    <label for="cardCVC"><span class="style1">เจาะจง MAC Address</span></label>
                                    <input name="mac" type="text" placeholder="Ex.1A:2A:3A:4A:5A:6A"  class="form-control">  
									
                                </div>
                            </div>
                        </div>
							<div class="row">
                            <div class="col-xs-12  col-md-6">
                                <div class="form-group">
                                    <label for="cardNumber"><span class="style1">Pattern Charactors</span></label>
                                     <select name="str_char"  id="str_char" class="form-control">
					                <option value="abcdefghijklmnpqrstuvwxyz">a-z</option>
									<option value="ABCDEFGHIJKLMNPQRSTUVWXYZ">A-Z</option>
									<option value="123456789">1-9</option>
									<option value="ABCDEFGHIJKLMNPQRSTUVWXYZabcdefghijklmnpqrstuvwxyz">a-z,A-Z</option>
									<option value="abcdefghijkmnpqrstuvwxyz123456789">a-z,1-9</option>
									<option value="ABCDEFGHIJKLMNPQRSTUVWXYZ123456789">A-Z,1-9</option>
									<option value="ABCDEFGHIJKLMNPQRSTUVWXYZabcdefghijkmnpqrstuvwxyz123456789">a-z,A-Z,1-9</option>
  		                            </select>
                                   
                                </div>                            
                            </div>
                        <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                    <label for="couponCode"><span class="style2">Number of users</span></label>
									<img src="../img/help.png" width="16" height="16"  class="no1" data-toggle="tooltip" data-placement="right" title="จำนวนuserที่ต้องการสร้าง">
                                    <input name="max_user" type="text"  placeholder="จำนวนuserที่ต้องการสร้าง" value="10" maxlength="3" required class="form-control">
                                </div>
                            </div>                        
                        </div>

                        <div class="row">
                            <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                    <label for="cardExpiry"><span class=" style1">Prefix User</span> <img src="../img/help.png" width="16" height="16"  class="no1" data-toggle="tooltip" data-placement="right" title="Ex. wifishop@  Gen ออกมาจะได้ wifishop@userบัตร"></label>
                                   <input name="fix_user" type="text" placeholder="นำหน้า user"  value="" maxlength="5" class="form-control">  
									
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6 ">
                                <div class="form-group">
                                    <label for="cardCVC"><span class="style1">Prefix Password</span>&nbsp;<img src="../img/help.png" width="16" height="16"  class="no2" data-toggle="tooltip" data-placement="right" title="Ex. pass@ Gen ออกมาจะได้ pass@PassWordบัตร"></label>
                                    <input name="fix_pass" type="text"  placeholder="นำหน้า  password" value="" maxlength="5" class="form-control">  
									
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                    <label for="couponCode"><span class="style1">Username length</span></label>
									<img src="../img/help.png" width="16" height="16"  class="no2" data-toggle="tooltip" data-placement="right" title="จำนวนที่ต่อท้าย Prefix User">
                                    <select name="num_user" class="form-control">
									<option value="2">2</option>
                                              <option value="3">3</option>
                                              <option value="4">4</option>
                                              <option value="5">5</option>
                                              <option value="6" selected="selected">6</option>
                                              <option value="7">7</option>
                                              <option value="8">8</option>
                                              <option value="9">9</option>
                                              <option value="10">10</option>
                                            </select>
                               </div>
                            </div>                        
                        <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                    <label for="couponCode"><span class="style1">Password length</span></label>
									<img src="../img/help.png" width="16" height="16"  class="no2" data-toggle="tooltip" data-placement="right" title="จำนวนที่ต่อท้าย Prefix Password">
                                    <select name="num_pass"  class="form-control">
									<option value="2">2</option>
                                              <option value="3">3</option>
                                              <option value="4">4</option>
                                              <option value="5">5</option>
                                              <option value="6" selected="selected">6</option>
                                              <option value="7">7</option>
                                              <option value="8">8</option>
                                              <option value="9">9</option>
                                              <option value="10">10</option>
                                            </select>
                                </div>
                            </div>                        
                        </div>

						<div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="cardExpiry"><span class="hidden-xs style1">Comment - เพิ่มเติม</span></label>
                                   <input name="comment" type="text" class="form-control"  maxlength="30"  placeholder="สูงสุด 30ตัวอักษร" >  
							  </div>
                                </div>
                            </div> 
						 
						<div class="row">
						<div class="col-lg-12 col-md-12 " >
							<?php
		                    $bottonbtn_success="on";
				$text_success="<i class=\"fa fa-check\"></i>&nbsp;Generate";
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
                   <li>เลือก Server,Package, และรูปแบบตัวอักษร</li>
                  <li>จำกัดเวลาใช้งานหรือ Limit-uptime จะกำหนด ชั่วโมงการใช้งานเช่น Profile 1วันกำหนดให้ใช้ได้ 4ชม.ให้กำหนดไว้ที่ 4h ถ้าแชร์ userไม่ต้องกำหนด </li>
                   <li>รูปแบบตัวอักษรจะตัดตัว o(โอ) ออกไป เพือความง่ายต่อการกรอกระหว่าง 0(ศูนย์) กับ o(โอ)</li>
                 <li>Prefix user & password ใส่ได้ 5 ตัว เช่น  <u>wifi@</u>xxxxxxxx</li>
                 <li>length เป็นจำนวนหลักที่สร้างใบ เช่น ใส่ไป 9 จะได้ username ที่สร้าง 9 ตัวรวม prefix</li>
                 
               </ul>
			   </div>
			    </div>
			
  </section>
