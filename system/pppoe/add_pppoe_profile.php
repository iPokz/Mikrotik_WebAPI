<?php
		
			include_once('../config/routeros_api.class.php');			
			include_once('../include/conn.php');
			include_once('../include/account.php');
			include_once('../include/convert.php');
			$ARRAY = $API->comm("/ip/pool/print");
				
			
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
                   
                        <i class="fa fa-folder-open"></i>&nbsp;&nbsp;<strong>PPPOE Add Profile</strong>
                    <?php print $date_time_show;?></div> 
					<div class="panel-body">
                    <form name="pppoe" action="index.php?page=con_addpppoe_profile_process" method="post">
					<div class="row">
                            <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                    <label for="couponCode"><span class="style1">Profile Name</span></label>
                                    <input name="name" type="text" placeholder="Profile Name"  class="form-control" required >
                                </div>                            
                            </div>
                        <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                    <label for="cardExpiry"><span class="style1">Price</span> <img src="../img/help.png" width="16" height="16"  class="no1" data-toggle="tooltip" data-placement="right" title="กำหนดราคา ของ profile"></label>
                                    <input name="price" type="text" placeholder="Ex.150" class="form-control" >
                               </div>
							   </div>
                            </div>

						<div class="row">
                            <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                    <label for="couponCode"><span class="style1">Local Address</span></label>
                                    <input name="local" type="text" placeholder="กำหนดไอพี หรือไอพี pool Exe.10.0.0.1 ,pool1"  class="form-control" required >
                                </div>                            
                            </div>
                        <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                    <label for="cardNumber"><span class="style1">Remote Address</span></label>
                                    <select name="remote"  id="remote" class="form-control" required>
					      <option value="">ต้องเลือก กลุ่มไอพีที่ให้บริการ</option>
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
                                    <label for="couponCode"><span class="style1">Session Timeout</span> <img src="../img/help.png" width="16" height="16"  class="no1" data-toggle="tooltip" data-placement="right" title="กำหนดเวลา เชื่อมต่อสูงสุด"></label>
                                    <input name="session" type="text" placeholder="Exe.04:00:00" class="form-control" >
                               </div>
                            </div>
							<div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                    <label for="couponCode"><span class="style1">Rate Limit (rx/tx)</span> <img src="../img/help.png" width="16" height="16"  class="no1" data-toggle="tooltip" data-placement="right" title="กำหนดค่าความเร็วอินเตอร์เน็ต ของแพ็คเกจ Ex.512K/5M"></label>
                                    <input name="limit" type="text"  placeholder="upload/download" class="form-control"  >
                               </div>
                            </div>                        
                        </div>

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
                       
                    </form>
                </div>
            </div>
			</div>
			</div>
            
  <div id="manual" class="collapse">
   <div  class="panel content" style="font-size: 12pt; line-height: 2em;">
            <p><h1 class="style2">&nbsp;&nbsp;&nbsp;ข้อแนะนำการใช้งาน :</h1>
                <ul>
				<li><strong>Profile Name</strong> ตั้งชื่อโปรไฟล์ อย่ามีเว้นวรรค และอย่าตั้งชื่อด้วยตัวเลข เพียง 1หลัก เพราะจะทำให้ สคริปบางตัวไม่ทำงาน</li>
					<li><strong>Price</strong> กำหนดราคา ของบัตร ที่จะใช้ โปรไฟล์นี้  150 = 150บาท</li>
                    <li><strong>Local Address </strong>ให้กำหนดไอพี server หรือกำหนดไอพี pool</li>
                    <li><strong>Remote Address </strong>ให้กำหนดกลุ่มไอพี pool ที่จะให้ user ใช้งาน </li>
					<li>ตัวเลือกที่ไม่กำหนค่า จะเป็นค่า  Default.</li>
                </ul>
            </div>
          </div>
		
  </section>