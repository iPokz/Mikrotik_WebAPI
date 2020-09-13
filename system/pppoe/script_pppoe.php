<?php
include_once('../config/routeros_api.class.php');			
			include_once('../include/conn.php');
			include_once('../include/account.php');
            include_once('../include/convert.php');
$ARRAY = $API->comm("/ppp/profile/print");
?>
<style type="text/css">
<!--
.style1 {
	color: #0000FF;
	font-weight: bold;
}
.style2 {color: #990000; }
-->
</style>
<section class="content"> 
  
      <div class="row">
             <div class="col-lg-12" >
            <div class="<?php print panel_modify();?>">
                <div class="<?php print $panel_heading;?>" >
                    <i class="fa fa-file"></i>&nbsp;&nbsp;<strong>PPPOE Add Script For Expire</strong>
                    <?php print $date_time_show;?></div>                    
               

                <div class="panel-body">
				<form name="login" action="index.php?page=add_pppoe_script_process" method="post">

				   <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <span class="style1">กำหนดวันลบ user หลังจากหมดอายุ (Deleted user after expiration)</span>
                                    <select name="after_expir" class="form-control">
									           <option value="24">1วัน (1day)</option>
                                              <option value="48">2วัน (2days)</option>
                                              <option value="72" selected="selected">3วัน (3days)</option>
                                              <option value="168">7วัน (7days)</option>
                                              <option value="240">10วัน (10days)</option>
                                              <option value="360">15วัน (15days)</option>
                                              <option value="720">30วัน (30days)</option>
                                            </select>
                               </div>
                            </div> 
							 </div>
					
					
					
					<!-- 1st -->
					<div class="row">
                            <div class="col-md-6 col-xs-6">
                                <div class="form-group">
                                    <span class="hidden-xs style1">เลือก Package No.1</span> <img src="../img/help.png" width="16" height="16"  class="no1" data-toggle="tooltip" data-placement="right" title="เลือกโปรไฟล์ที่จะให้สคริปตรวจสอบ user">
                                    <select name="pro_no1"  id="pro_no1" class="form-control" required>
					      
						   <?php
						   $sql="SELECT * FROM pppoe_pro ";
													$query=mysql_query($sql);	
												While($result=mysql_fetch_array($query)){
                                                $i++;
												$seleceted = ($i == 0) ? 'selected="selected"' : '';
														echo '<option value="'.$result['pro_name'].$selected.'">'.$result['pro_name'].'</option>';
													}
												?>						 
							              </select>
                                        </div>
                                      </div>
							<div class="col-md-6 col-xs-6">
							<div class="form-group">
                             <span class="hidden-xs style1">Expire Users No.1</span> <img src="../img/help.png" width="16" height="16"  class="no2" data-toggle="tooltip" data-placement="right" title="กำหนดวันหมดอายุ ของuser">
                           <div class="input-group">
                  <input name="expirepro_no1" type="text"  class="form-control" placeholder=" Ex.1h,4h,15d,30d " required>
                       <div class="input-group-btn">
                       <button type="button" class="btn btn-secondary dropdown-toggle" onclick="toggle_visibility('list2');"> click <i class="fa fa-caret-down "></i></button>
		           </div>
		          </div>
                 </div>
                  </div>
                    </div>
                        <!--hide  2--><div id="list2" style="display:none;"><!--hide  2-->
	                  <div class="row">
                             <div class="col-xs-6 col-md-6">
                                <div class="form-group">
                                    <span class=" hidden-xs style1">เลือก Package No.2</span> <img src="../img/help.png" width="16" height="16"  class="no1" data-toggle="tooltip" data-placement="right" title="เลือกโปรไฟล์ที่จะให้สคริปตรวจสอบ user">
                                   <select name="pro_no2"  id="pro_no2" class="form-control" >
					      <option value=""></option>
						  <?php
						   $sql="SELECT * FROM pppoe_pro ";
													$query=mysql_query($sql);	
												While($result=mysql_fetch_array($query)){
                                                $i++;
												$seleceted = ($i == 0) ? 'selected="selected"' : '';
														echo '<option value="'.$result['pro_name'].$selected.'">'.$result['pro_name'].'</option>';
													}
												?>						 
							</select>
                               </div>
                            </div>                        
                        <div class="col-md-6 col-xs-6">
							<div class="form-group">
                       <span class="hidden-xs style1">Expire Users No.2</span> <img src="../img/help.png" width="16" height="16"  class="no2" data-toggle="tooltip" data-placement="right" title="กำหนดวันหมดอายุ ของuser">
                           <div class="input-group">
                       <input name="expirepro_no2" type="text"  placeholder=" Ex.1h,4h,15d,30d "  class="form-control">
                       <div class="input-group-btn">
                       <button type="button" class="btn btn-secondary dropdown-toggle" onclick="toggle_visibility('list3');"> click <i class="fa fa-caret-down "></i></button>
		           </div>
		          </div>
                 </div>
                  </div>
                    </div>
						<!-- hide3 --><div id="list3" style="display:none;"><!-- hide 3-->
	                     <div class="row">
                             <div class="col-xs-6 col-md-6">
                                <div class="form-group">
                                    <span class=" hidden-xs style1">เลือก Package No.3</span> <img src="../img/help.png" width="16" height="16"  class="no1" data-toggle="tooltip" data-placement="right" title="เลือกโปรไฟล์ที่จะให้สคริปตรวจสอบ user">
                                   <select name="pro_no3"  id="pro_no3" class="form-control" >
					      <option value=""></option>
						   <?php
						   $sql="SELECT * FROM pppoe_pro ";
													$query=mysql_query($sql);	
												While($result=mysql_fetch_array($query)){
                                                $i++;
												$seleceted = ($i == 0) ? 'selected="selected"' : '';
														echo '<option value="'.$result['pro_name'].$selected.'">'.$result['pro_name'].'</option>';
													}
												?>						 
							</select>
                               </div>
                            </div>                        
                        <div class="col-md-6 col-xs-6">
							<div class="form-group">
                             <span class="hidden-xs style1">Expire Users No.3</span> <img src="../img/help.png" width="16" height="16"  class="no3" data-toggle="tooltip" data-placement="right" title="กำหนดวันหมดอายุ ของuser">
                           <div class="input-group">
                       <input name="expirepro_no3" type="text"  placeholder=" Ex.1h,4h,15d,30d "  class="form-control">
                       <div class="input-group-btn">
                       <button type="button" class="btn btn-secondary dropdown-toggle" onclick="toggle_visibility('list4');"> click <i class="fa fa-caret-down "></i></button>
		           </div>
		          </div>
                 </div>
                  </div>
                    </div>
						<!-- hide4 --><div id="list4" style="display:none;"><!-- hide 4--> 
						 <div class="row">
                             <div class="col-xs-6 col-md-6">
                                <div class="form-group">
                                    <span class=" hidden-xs style1">เลือก Package No.4</span> <img src="../img/help.png" width="16" height="16"  class="no1" data-toggle="tooltip" data-placement="right" title="เลือกโปรไฟล์ที่จะให้สคริปตรวจสอบ user">
                                   <select name="pro_no4"  id="pro_no4" class="form-control" >
					      <option value=""></option>
						  <?php
						   $sql="SELECT * FROM pppoe_pro ";
													$query=mysql_query($sql);	
												While($result=mysql_fetch_array($query)){
                                                $i++;
												$seleceted = ($i == 0) ? 'selected="selected"' : '';
														echo '<option value="'.$result['pro_name'].$selected.'">'.$result['pro_name'].'</option>';
													}
												?>						 
							</select>
                               </div>
                            </div>                        
                        <div class="col-md-6 col-xs-6">
							<div class="form-group">
                             <span class="hidden-xs style1">Expire Users No.4</span> <img src="../img/help.png" width="16" height="16"  class="no4" data-toggle="tooltip" data-placement="right" title="กำหนดวันหมดอายุ ของuser">
                           <div class="input-group">
                       <input name="expirepro_no4" type="text"  placeholder=" Ex.1h,4h,15d,30d "  class="form-control">
                       <div class="input-group-btn">
                       <button type="button" class="btn btn-secondary dropdown-toggle" onclick="toggle_visibility('list5');"> click <i class="fa fa-caret-down "></i></button>
		           </div>
		          </div>
                 </div>
                  </div>
                    </div>
						<!-- hide5 --><div id="list5" style="display:none;"><!-- hide 5--> 
						 <div class="row">
                             <div class="col-xs-6 col-md-6">
                                <div class="form-group">
                                    <span class=" hidden-xs style1">เลือก Package No.5</span> <img src="../img/help.png" width="16" height="16"  class="no1" data-toggle="tooltip" data-placement="right" title="เลือกโปรไฟล์ที่จะให้สคริปตรวจสอบ user">
                                   <select name="pro_no5"  id="pro_no5" class="form-control" >
					      <option value=""></option>
						   <?php
						   $sql="SELECT * FROM pppoe_pro ";
													$query=mysql_query($sql);	
												While($result=mysql_fetch_array($query)){
                                                $i++;
												$seleceted = ($i == 0) ? 'selected="selected"' : '';
														echo '<option value="'.$result['pro_name'].$selected.'">'.$result['pro_name'].'</option>';
													}
												?>						 
							</select>
                               </div>
                            </div>                        
                        <div class="col-md-6 col-xs-6">
							<div class="form-group">
                             <span class="hidden-xs style1">Expire Users No.5</span> <img src="../img/help.png" width="16" height="16"  class="no5" data-toggle="tooltip" data-placement="right" title="กำหนดวันหมดอายุ ของuser">
                           <div class="input-group">
                       <input name="expirepro_no5" type="text"  placeholder=" Ex.1h,4h,15d,30d "  class="form-control">
                       <div class="input-group-btn">
                       <button type="button" class="btn btn-secondary dropdown-toggle" onclick="toggle_visibility('list6');"> click <i class="fa fa-caret-down "></i></button>
		           </div>
		          </div>
                 </div>
                  </div>
                    </div>
						<!-- hide6 --><div id="list6" style="display:none;"><!-- hide 6--> 
						 <div class="row">
                             <div class="col-xs-6 col-md-6">
                                <div class="form-group">
                                    <span class=" hidden-xs style1">เลือก Package No.6</span> <img src="../img/help.png" width="16" height="16"  class="no1" data-toggle="tooltip" data-placement="right" title="เลือกโปรไฟล์ที่จะให้สคริปตรวจสอบ user">
                                   <select name="pro_no6"  id="pro_no6" class="form-control" >
					      <option value=""></option>
						  <?php
						   $sql="SELECT * FROM pppoe_pro ";
													$query=mysql_query($sql);	
												While($result=mysql_fetch_array($query)){
                                                $i++;
												$seleceted = ($i == 0) ? 'selected="selected"' : '';
														echo '<option value="'.$result['pro_name'].$selected.'">'.$result['pro_name'].'</option>';
													}
												?>						 
							</select>
                               </div>
                            </div>                        
                        <div class="col-md-6 col-xs-6">
							<div class="form-group">
                             <span class="hidden-xs style1">Expire Users No.6</span> <img src="../img/help.png" width="16" height="16"  class="no5" data-toggle="tooltip" data-placement="right" title="กำหนดวันหมดอายุ ของuser">
                           <div class="input-group">
                       <input name="expirepro_no6" type="text"  placeholder=" Ex.1h,4h,15d,30d "  class="form-control">
                       <div class="input-group-btn">
                       <button type="button" class="btn btn-secondary dropdown-toggle" onclick="toggle_visibility('list7');"> click <i class="fa fa-caret-down "></i></button>
		           </div>
		          </div>
                 </div>
                  </div>
                    </div>
						<!-- hide7 --><div id="list7" style="display:none;"><!-- hide 7--> 
						<div class="row">
                             <div class="col-xs-6 col-md-6">
                                <div class="form-group">
                                    <span class=" hidden-xs style1">เลือก Package No.7</span> <img src="../img/help.png" width="16" height="16"  class="no1" data-toggle="tooltip" data-placement="right" title="เลือกโปรไฟล์ที่จะให้สคริปตรวจสอบ user">
                                   <select name="pro_no7"  id="pro_no7" class="form-control" >
					      <option value=""></option>
						  <?php
						   $sql="SELECT * FROM pppoe_pro ";
													$query=mysql_query($sql);	
												While($result=mysql_fetch_array($query)){
                                                $i++;
												$seleceted = ($i == 0) ? 'selected="selected"' : '';
														echo '<option value="'.$result['pro_name'].$selected.'">'.$result['pro_name'].'</option>';
													}
												?>						 
							</select>
                               </div>
                            </div>                        
                       <div class="col-md-6 col-xs-6">
							<div class="form-group">
                             <span class="hidden-xs style1">Expire Users No.7</span> <img src="../img/help.png" width="16" height="16"  class="no7" data-toggle="tooltip" data-placement="right" title="กำหนดวันหมดอายุ ของuser">
                           <div class="input-group">
                       <input name="expirepro_no7" type="text"  placeholder=" Ex.1h,4h,15d,30d "  class="form-control">
                       <div class="input-group-btn">
                       <button type="button" class="btn btn-secondary dropdown-toggle" onclick="toggle_visibility('list8');"> click <i class="fa fa-caret-down "></i></button>
		           </div>
		          </div>
                 </div>
                  </div>
                    </div> 
                      <!-- hide8 --><div id="list8" style="display:none;"><!-- hide 8--> 
					   <div class="row">
                             <div class="col-xs-6 col-md-6">
                                <div class="form-group">
                                    <span class=" hidden-xs style1">เลือก Package No.8</span> <img src="../img/help.png" width="16" height="16"  class="no1" data-toggle="tooltip" data-placement="right" title="เลือกโปรไฟล์ที่จะให้สคริปตรวจสอบ user">
                                   <select name="pro_no8"  id="pro_no8" class="form-control" >
					      <option value=""></option>
						   <?php
						   $sql="SELECT * FROM pppoe_pro ";
													$query=mysql_query($sql);	
												While($result=mysql_fetch_array($query)){
                                                $i++;
												$seleceted = ($i == 0) ? 'selected="selected"' : '';
														echo '<option value="'.$result['pro_name'].$selected.'">'.$result['pro_name'].'</option>';
													}
												?>							 
							</select>
                               </div>
                            </div>                        
                        <div class="col-md-6 col-xs-6">
							<div class="form-group">
                             <span class="hidden-xs style1">Expire Users No.8</span> <img src="../img/help.png" width="16" height="16"  class="no8" data-toggle="tooltip" data-placement="right" title="กำหนดวันหมดอายุ ของuser">
                           <div class="input-group">
                       <input name="expirepro_no8" type="text"  placeholder=" Ex.1h,4h,15d,30d "  class="form-control">
                       <div class="input-group-btn">
                       <button type="button" class="btn btn-secondary dropdown-toggle" onclick="toggle_visibility('list9');"> click <i class="fa fa-caret-down "></i></button>
		           </div>
		          </div>
                 </div>
                  </div>
                    </div>
						 <!-- hide9 --><div id="list9" style="display:none;"><!-- hide 9--> 
					   <div class="row">
                             <div class="col-xs-6 col-md-6">
                                <div class="form-group">
                                    <span class=" hidden-xs style1">เลือก Package No.9</span> <img src="../img/help.png" width="16" height="16"  class="no1" data-toggle="tooltip" data-placement="right" title="เลือกโปรไฟล์ที่จะให้สคริปตรวจสอบ user">
                                   <select name="pro_no9"  id="pro_no9" class="form-control" >
					      <option value=""></option>
						   <?php
						   $sql="SELECT * FROM pppoe_pro ";
													$query=mysql_query($sql);	
												While($result=mysql_fetch_array($query)){
                                                $i++;
												$seleceted = ($i == 0) ? 'selected="selected"' : '';
														echo '<option value="'.$result['pro_name'].$selected.'">'.$result['pro_name'].'</option>';
													}
												?>							 
							</select>
                               </div>
                            </div>                        
                        <div class="col-md-6 col-xs-6">
							<div class="form-group">
                             <span class="hidden-xs style1">Expire Users No.9</span> <img src="../img/help.png" width="16" height="16"  class="no9" data-toggle="tooltip" data-placement="right" title="กำหนดวันหมดอายุ ของuser">
                           <div class="input-group">
                       <input name="expirepro_no9" type="text"  placeholder=" Ex.1h,4h,15d,30d "  class="form-control">
                       <div class="input-group-btn">
                       <button type="button" class="btn btn-secondary dropdown-toggle" onclick="toggle_visibility('list10');"> click <i class="fa fa-caret-down "></i></button>
		           </div>
		          </div>
                 </div>
                  </div>
                    </div>
						<!-- hide10 --><div id="list10" style="display:none;"><!-- hide 10--> 
					   <div class="row">
                             <div class="col-xs-6 col-md-6">
                                <div class="form-group">
                                    <span class=" hidden-xs style1">เลือก Package No.10</span> <img src="../img/help.png" width="16" height="16"  class="no1" data-toggle="tooltip" data-placement="right" title="เลือกโปรไฟล์ที่จะให้สคริปตรวจสอบ user">
                                   <select name="pro_no10"  id="pro_no10" class="form-control" >
					      <option value=""></option>
						   <?php
						   $sql="SELECT * FROM pppoe_pro ";
													$query=mysql_query($sql);	
												While($result=mysql_fetch_array($query)){
                                                $i++;
												$seleceted = ($i == 0) ? 'selected="selected"' : '';
														echo '<option value="'.$result['pro_name'].$selected.'">'.$result['pro_name'].'</option>';
													}
												?>							 
							</select>
                               </div>
                            </div>                        
                        <div class="col-md-6 col-xs-6">
							<div class="form-group">
                             <span class="hidden-xs style1">Expire Users No.10</span> <img src="../img/help.png" width="16" height="16"  class="no10" data-toggle="tooltip" data-placement="right" title="กำหนดวันหมดอายุ ของuser">
                           <div class="input-group">
                       <input name="expirepro_no10" type="text"  placeholder=" Ex.1h,4h,15d,30d "  class="form-control">
                       <div class="input-group-btn">
                       <button type="button" class="btn btn-secondary dropdown-toggle"> Ending<i class="fa fa-times "></i></button>
		           </div>
		          </div>
                 </div>
                  </div>
                    </div>
						   
						   <!--hide10 --> </div> <!--hide10 -->
						<!--hide9 --> </div> <!--hide9 -->
						<!--hide8 --> </div> <!--hide8 -->
						<!--hide7 --> </div> <!--hide7 -->
						<!--hide6 --> </div> <!--hide6 -->
						<!--hide5 --> </div> <!--hide5 -->
						<!--hide4 --> </div> <!--hide4 -->
						<!--hide3 --> </div> <!--hide3 -->
					   <!--hide2 --> </div><!--hide  2-->
					

						
                         <div class="row">
						<div class="col-lg-7 col-md-9 " >
                            <div class="form-group">
							<?php

							 $bottonbtn_success="on";
				$text_success="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class=\"fa fa-plus\"></i>&nbsp;Add Script&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
               echo button_btn_submit_account($account,$text_success,$bottonbtn_success);
			   ?>
                                <button id="btnSave" class="btn btn-danger" type="reset">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-refresh"></i>&nbsp;Reset&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>&nbsp;&nbsp;&nbsp;<span class="hidden-xs"><button type="button" class="btn btn-info" data-toggle="collapse" data-target="#manual"><span class="style2">ข้อแนะนำการใช้งาน </span></button></span>
                            </div>
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
				    <li>เลือก Package :คือเลือกprofile ที่ต้องการจะกำหนด วันหมดอายุ อย่างน้อย 1Package อย่างมากได้ทีละ10 Package</li>
                    <li>Expire Users:เลือกจำนวนวันหมดอายุ ของแต่ละprofile เช่น 1h,4h,15d,30d</li>
                   <li>h=hour(ชั่วโมง) ; d=day(วัน) ; 4h=4ชั่วโมง ; 7d=7วัน เป็นต้น </li>
                    <li>ระบบจะสร้างสคริป เพื่อรองรับกับ โปรไฟล์ ที่สร้างจากโปรแกรมเท่านั้น ห้ามมี commentอื่นๆ ที่ตัว userในโปรไฟล์ได้ที่กำหนดวันหมดอายุ</li>
					<li>ระบบจะสร้าง สคริปพร้อมกัน 2 สคริป</li>
                    <li>การทำงานของระบบจัดการuserมีดังนี้</li>
					<li>เมื่อมีการ login ครั้งแรก ระบบจะสร้าง คอมเม้น ที่userเป็นวันและเวลา ดังตัวอย่าง jan/16/2017 21:25:31</li>
					<li>สคริปที่ 1 สร้างไว้จะคำนวนวันและเวลา ที่comment หน่วยเป็น วินาที ทำงานทุกๆ 1นาที เมื่อหมดอายุ จะเซ็ต disable user </li>
					<li>สคริปที่ 2 สร้างไว้เพือจะ ลบ user ที่ disableหลังจากหมดอายุแล้ว</li>
					<li>สคริปจะจัดการกับuserที่มี commentดังตัวอย่างเท่านั้น</li>
					<li>สคริปจะอยู่ที่ Scheduler</li>
                    
                </ul>
            </p>
     
            
            <!-- <p>Built upon: Bootstrap, jQuery, 
                <a href="http://jqueryvalidation.org/">jQuery Validation Plugin</a>, 
                <a href="https://github.com/stripe/jquery.payment">jQuery.payment library</a>,
                and <a href="https://stripe.com/docs/stripe.js">Stripe.js</a>
            </p> -->
</div>

  </section>