<?php
		
			include_once('../config/routeros_api.class.php');			
			include_once('../include/conn.php');
			include_once('../include/account.php');
			include_once('../include/convert.php');
					
			
				
				if(!empty($_REQUEST['profile'])){
                        $pro_name=$_REQUEST['profile'];
						$time_limit=$_REQUEST['time_limit'];					
						$data_limit=$_REQUEST['data_limit'];
						$vat=$_REQUEST['vat'];
						$card_name=$_REQUEST['card_name'];
						$phone=$_REQUEST['phone'];
						$server_ip=$_REQUEST['server_ip'];
						$color="#".$_REQUEST['color']."";
	                   mysql_query("UPDATE pppoe_pro SET card_name='".$card_name."', data_limit='".$data_limit."', time_limit='".$time_limit."', vat='".$vat."', phone='".$phone."', server_ip='".$server_ip."', color='".$color."' WHERE pro_name='".$pro_name."'");

						echo "<script language='javascript'>swal('Save Done!','แก้ไข  Card ".$pro_name." สำเร็จแล้ว!','success').then(function () {
    window.location.href = 'index.php?page=pppoe_card';}, function (dismiss) {if (dismiss === 'overlay') {
    window.location.href = 'index.php?page=pppoe_card';}})</script>";
						exit();
						}
						
			
									   								
?>


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
 
           <form name="login" action="" method="post">
       <div class="row">
         <div class="col-lg-12" >

            <div class="<?php print panel_modify();?>">
                <div class="<?php print $panel_heading;?>" >
                   <i class="fa fa-credit-card"></i>&nbsp;&nbsp;<strong>Edit PPPOE Card - แก้ไขการ์ด</strong>
                      <?php print $date_time_show;?> </div>
                <div class="panel-body">
                    
					<?php
					$result=mysql_fetch_array(mysql_query("SELECT * FROM pppoe_pro WHERE pro_name='".$_GET['name']."'"));
					?>
					 <div class="row">
                            <div class="col-xs-12  col-md-6">
                                <div class="form-group">
                                    <span class="style1"> Package</span>
                                    <select name="profile"  id="profile" class="form-control" required>
					      <option value="<?php echo $result['pro_name']; ?>"><?php echo $result['pro_name']; ?></option>
                               </select>
                                  </div>
                                </div>                            
                            <div class="col-xs-12  col-md-6">
                                <div class="form-group">
                                    <span class="style1">Card Name</span>
                                    <input name="card_name"  id="card_name" placeholder=" Ex. PPPOE  WIFI CARD" class="form-control" value="<?php echo $result['card_name']; ?>" >
						         </div>
                                </div>                            
                            </div>
                        
						<div class="row">
                            <div class="col-xs-12  col-md-6">
                                <div class="form-group">
                                   <span class=" style1">Data Limit</span>
								   <img src="../img/help.png" width="16" height="16" data-toggle="tooltip" data-placement="right" title="จำนวนข้อมูลที่จะกำหนดให้ใช้งาน">
                                   <input name="data_limit" type="text" class="form-control" placeholder="Ex.Max download/upload"  value="<?php echo $result['data_limit']; ?>" >  
								 </div>
                            </div>
                            <div class="col-xs-12  col-md-6">
                                <div class="form-group">
                                    <span class="style1">Time Limit</span>
									<img src="../img/help.png" width="16" height="16" data-toggle="tooltip" data-placement="right" title="จำนวนวันที่จะกำหนดให้ใช้งาน">
                                    <input name="time_limit" type="text" class="form-control" placeholder="Ex.อายุใช้งาน 1 วัน"  value="<?php echo $result['time_limit']; ?>" >  
									 </div>
                                 </div>
                               </div>
						
						<div class="row">
                            <div class="col-xs-12  col-md-6">
                                <div class="form-group">
                                    <span class=" style1">VAT.</span>
									<img src="../img/help.png" width="16" height="16" data-toggle="tooltip" data-placement="right" title="ราคา vat + Price">
                                   <input name="vat" type="text" class="form-control" placeholder="Ex.5 or 7"  value="<?php echo $result['vat']; ?>">  
								 </div>
                            </div>
                            <div class="col-xs-12  col-md-6">
                                <div class="form-group">
                                    <span class="style1">Server IP</span>
									<img src="../img/help.png" width="16" height="16" data-toggle="tooltip" data-placement="right" title="IP server Login ด้วยQR">
                                    <input name="server_ip" type="text" class="form-control" placeholder="Ex.192.168.10.1"  value="<?php echo $result['server_ip']; ?>">  
									
                                </div>
                            </div>
                        </div>
						
						<div class="row">
                            <div class="col-xs-12  col-md-6">
                                <div class="form-group">
                                    <span class=" style1">Call Number</span>
									<img src="../img/help.png" width="16" height="16" data-toggle="tooltip" data-placement="right" title="เบอร์ติอต่อ">
                                   <input name="phone" type="text"  placeholder="Ex.084-7986-564" class="form-control" value="<?php echo $result['phone']; ?>">  
							  </div>
                                </div>
                             <div class="col-xs-12  col-md-6">
                                <div class="form-group">
                                    <span class=" style1">Color Card</span>
									<img src="../img/help.png" width="16" height="16" data-toggle="tooltip" data-placement="right" title="กำหนดสีพื้นหลังของบัตร"><br>
				<input name="color"  id="color"  class="jscolor" value="<?php echo $result['color']; ?>">
                                        
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
				<button id="btnCancel" class="btn btn-danger" type="reset"  Onclick="javascript:history.back()">&nbsp;&nbsp;&nbsp;<i class="fa fa-times"></i>&nbsp;Cancel&nbsp;&nbsp;&nbsp;</button>&nbsp;&nbsp;&nbsp;
                      
					 <span class="hidden-xs"> <button id="btnSave" class="btn btn-warning" type="reset">&nbsp;&nbsp;&nbsp;<i class="fa fa-refresh"></i>&nbsp;Reset&nbsp;&nbsp;&nbsp;&nbsp;</button>
							&nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-info" data-toggle="collapse" data-target="#manual"><span class="style2">ข้อแนะนำการใช้งาน </span></button></span>
                        </div>
						</div>
                       
                           
							</div>
							</div>
							</div>
							</div>
							 </form>



 <div id="manual" class="collapse">
               <div  class="panel content" style="font-size: 12pt; line-height: 2em;">
                  <p><h1 class="style1">&nbsp;&nbsp;&nbsp;ข้อแนะนำการใช้งาน :</h1>
                <ul>
                    <li>Card name ตั้งชื่อการ์ด</li>
					<li>Data Limit จำนวนข้อมูลที่จะกำหนดให้ใช้งาน</li>
					<li>Time Limit จำนวนวันที่จะกำหนดให้ใช้งาน</li>
					<li>VAT ราคาบัตรรวมกับ vat</li>
					<li>Server IP ไอพี Login ด้วยQR</li>
					<li>Call Number เบอร์ติอต่อ</li>
					<li>Color Card สีพื้นหลังของบัตร</li>
                    </ul>
            </p>
			</div>
			</div>
			
  </section>