<?php

	if(!empty($_REQUEST['ip'])){
	
  if(empty($_REQUEST['customerPin']) && empty($_REQUEST['userPin'])){
   echo "<script language='javascript'>swal('EMPTY SITE PIN !','ต้องกำหนด Site PIN อย่างน้อย จำนวน 1 ไซต์','error').then(function () {
   window.history.back();}, function (dismiss) {if (dismiss === 'overlay') {
    window.history.back();}})</script>";

						exit();
  
  
  }else{
        $cus_pin=$_REQUEST['customerPin'];
		 $user_pin=$_REQUEST['userPin'];

	  	if(!empty($cus_pin)){$cusPIN_data="or user_pin='".$cus_pin."'";}
	    if(!empty($user_pin)){$userPIN_data="or customer_pin='".$user_pin."'";}

	$sql=mysql_query("SELECT * FROM mt_config where admin_pin='".md5($_REQUEST['userPin'])."'or admin_pin='".md5($_REQUEST['customerPin'])."' ".$cusPIN_data." ".$userPIN_data."");
	 $num=mysql_num_rows($sql);
	 if($num==0){
		mysql_query("UPDATE mt_config SET mt_ip='".$_REQUEST['ip']."', mt_user='".$_REQUEST['username']."', mt_pass='".$_REQUEST['password']."', port_api='".$_REQUEST['portapi']."', port_web='".$_REQUEST['portweb']."',customer_pin='".$_REQUEST['customerPin']."',user_pin='".$_REQUEST['userPin']."',site_name='".$_REQUEST['siteName']."' WHERE mt_num='".$_GET['id']."'");
		//echo "<script language='javascript'>alert('Save Done')</script>";
		//echo "<meta http-equiv=\"refresh\" content=\"0;url=index.php\">";
		echo "<script language='javascript'>swal('Save Done!','แก้ไข SERVER สำเร็จแล้ว!','success').then(function () {
    window.location.href = 'index.php';}, function (dismiss) {
  if (dismiss === 'overlay') {
    window.location.href = 'index.php';
   }})</script>";
		exit();
    }else{
	 echo "<script language='javascript'>swal('ERROR SITE PIN !','กรุณาแก้ไข ไซต์ PIN ของท่านใหม่','error').then(function () {
   window.history.back();}, function (dismiss) {if (dismiss === 'overlay') {
    window.history.back();}})</script>";

						exit();
	 
	 
	 }
	}}									   								
?>
 <section class="content">  

        
		  <div class="<?php print panel_modify();?>">
          <div class="<?php print $panel_heading;?>"><strong>Edit Mikrotik Deviced</strong>
		  <?php print $date_time_show;?></div>
          <div class="modal-body">
              <div class="row">
                  <div class="col-xs-7">
                      <div class="well">
					  <?php
										$sql=mysql_query("SELECT * FROM mt_config WHERE mt_num='".$_GET['id']."'");
										$result=mysql_fetch_array($sql);
									?>
                          <form id="loginForm" method="POST" action="">
                             
							  <div class="row">
                              <div class="col-xs-12  col-md-6">
							  <div class="form-group">
                                  <label for="username" class="control-label">IP Address / DNS </label>
                                  <input type="text" class="form-control" id="ip" name="ip"  title="Please enter you IP/DNS" placeholder="xxx.sn.mynetname.net" value="<?php echo $result[mt_ip];?>"  required>
                                   </div> 
                              </div>
                              <div class="col-xs-12  col-md-6">
							  <div class="form-group">
                                  <label for="password" class="control-label">Site Name</label>
                                  <input type="text" class="form-control" id="siteName" name="siteName"  title="Please enter your Site Name" placeholder="Ex.ชื่อไซต์งาน" value="<?php echo $result[site_name];?>"  required>
								  </div>
								  </div>
                              </div>



							  <div class="row">
                              <div class="col-xs-12  col-md-6">
                              <div class="form-group">
                                  <label for="password" class="control-label">Username</label>
                                  <input type="text" class="form-control" id="username" name="username"  title="Please enter your username" value="<?php echo $result[mt_user];?>"  required>
                                  <span class="help-block"></span>
                              </div> 
                              </div>
                              <div class="col-xs-12  col-md-6">
							   <div class="form-group">
                                  <label for="password" class="control-label">Password</label>
                                  <input type="password" class="form-control" id="password" name="password"  title="Please enter your password" value="<?php echo $result[mt_pass];?>"  required>
                                  <span class="help-block"></span>
                               </div>
								  </div>
                              </div>

                                  <div class="row">
                              <div class="col-xs-12  col-md-6">
                                <div class="form-group">
                                  <label for="password" class="control-label">Port API</label>
                                  <input type="text" class="form-control" id="portapi" name="portapi"  title="Please enter your port-api" value="<?php echo $result[port_api];?>"  required>
                                  <span class="help-block"></span>
                               </div> 
                              </div>
                              <div class="col-xs-12  col-md-6">
							   <div class="form-group">
                                  <label for="password" class="control-label">Port Web Config</label>
                                  <input type="text" class="form-control" id="portweb" name="portweb"  title="Please enter your port-web" value="<?php echo $result[port_web];?>"  required>
                                  <span class="help-block"></span>
                              </div>
								  </div>
                              </div>

							 
							 <div class="row">
							  <?php 
	                     if($secom_v1==$_SESSION['security']){	
		                                                  ?>
									 
                              <div class="col-xs-12  col-md-6">
							  <div class="form-group">
                    <label for="password" class="control-label"></i>  Site PIN 
					<a href="#"  data-toggle="modal" data-target="#PINDetail" data-toggle="tooltip" data-placement="top" title="ดูรายละเอียด"><i class="fa fa-circle" style="color: #f7d13c"> </i></a></label>

                                  <input type="text" class="form-control" id="customerPin" name="customerPin"  title="Please enter your Site PIN" maxlength="8" value="<?php echo $result[customer_pin];?>" placeholder="Ex.12345678" >
                                   </div> 
                              </div>
							   <div class="col-xs-12  col-md-6">
							  <div class="form-group">
                  <label for="password" class="control-label"> Site PIN  
				  <a href="#"  data-toggle="modal" data-target="#PINDetail" data-toggle="tooltip" data-placement="top" title="ดูรายละเอียด"><i class="fa fa-circle" style="color: #ff1c15"> </i></a></label>
				  
                                  <input type="text" class="form-control" id="userPin" name="userPin"  title="Please enter your Site PIN" placeholder="Ex.12345678" value="<?php echo $result[user_pin];?>" >
								   </div>
								  </div>
                            
                            <?php  }else{
							 if($secom_v2==$_SESSION['security']){ ?>
							
						<input type="hidden" value="<?php echo $result[customer_pin];?>" name="customerPin">
						
                              <div class="col-xs-12  col-md-6">
							  <div class="form-group">
                    <label for="password" class="control-label"></i>  Site PIN 
					<a href="#"  data-toggle="modal" data-target="#PINDetail" data-toggle="tooltip" data-placement="top" title="ดูรายละเอียด"><i class="fa fa-circle" style="color: #f7d13c"> </i></a></label>
       
                                  <option type="text" class="form-control" id="customerPin" name="customerPin"  title="Please enter your Site PIN" maxlength="8" value="<?php echo $result[customer_pin];?>" placeholder="Ex.12345678"  required>
                                  <?php echo $result[customer_pin];?> 
								  </div> 
                              </div>
							   <div class="col-xs-12  col-md-6">
							  <div class="form-group">
                  <label for="password" class="control-label">  Site PIN  
				  <a href="#"  data-toggle="modal" data-target="#PINDetail" data-toggle="tooltip" data-placement="top" title="ดูรายละเอียด"><i class="fa fa-circle" style="color: #ff1c15"> </i></a></label>
				  
                                  <input type="text" class="form-control" id="userPin" name="userPin"  title="Please enter your Site PIN" placeholder="Ex.12345678" value="<?php echo $result[user_pin];?>" >
								   </div>
								  </div>
                             
                            <?php }
						  if($secom_v3==$_SESSION['security']){ ?>
                            <input type="hidden" value="<?php echo $result[customer_pin];?>" name="customerPin">
							 <input type="hidden" value="<?php echo $result[user_pin];?>" name="userPin">
						
                              <div class="col-xs-12  col-md-6">
							  <div class="form-group">
                    <label for="password" class="control-label">  Site PIN 
					<a href="#"  data-toggle="modal" data-target="#PINDetail" data-toggle="tooltip" data-placement="top" title="ดูรายละเอียด"><i class="fa fa-circle" style="color: #f7d13c"> </i></a></label>
                    
                                  <option type="text" class="form-control" id="customerPin" name="customerPin"  title="Please enter your Site PIN" maxlength="8" value="<?php echo $result[customer_pin];?>" placeholder="Ex.12345678"  required>****
                                 </div> 
                              </div>
							   <div class="col-xs-12  col-md-6">
							  <div class="form-group">
                  <label for="password" class="control-label">  Site PIN  
				  <a href="#"  data-toggle="modal" data-target="#PINDetail" data-toggle="tooltip" data-placement="top" title="ดูรายละเอียด"><i class="fa fa-circle" style="color: #ff1c15"> </i></a></label>
				  
                                  <option type="text" class="form-control" id="userPin" name="userPin"  title="Please enter your Site PIN" placeholder="Ex.12345678" value=""  required><?php echo $result[user_pin];?></option>
								   </div>
								  </div>
                             

                              <?php }}?>  
							  
							 </div>
							  
								  
                             
                              <div class="row">
                            <div class="col-xs-6 col-md-6">
                              
                                   <button type="button" class="btn btn-success btn-block test-btn">ทดสอบเชื่อมต่อ</button> 
							</div>
                            <div class="col-xs-6 col-md-6 pull-right">
                                <button id="btnSave" class="btn btn-warning  btn-block" type="reset"><i class="fa fa-refresh">&nbsp;&nbsp;</i>Reset</button>
                            </div>
                        </div>
                        
                     
                      </div>
                  </div>
                  <div class="col-xs-5">
                      <p class="lead">Test Connection </p>
						<div class="test-connect"><div>
				  
              </div>
          </div>
		  <input type="hidden" value="<?php echo $result[mt_num];?>" name="hide_id">

		  <?php
			if($secom_v3==$_SESSION['security']){ ?>
		  <input type="" class="btn btn-info disabled btn-block add-server" value="บันทึกการแก้ไข">
		 <?php
			  }else{ ?> 

		  <input type="submit" class="btn btn-info btn-block add-server" value="บันทึกการแก้ไข">

		  <?php } ?>
		  <input type="button" class="btn btn-danger btn-block add-server" value="ยกเลิกและย้อนกลับ" onclick="window.location='index.php?page=server'">
      </div>
	   </form>
  </div>
       <!-- Modal Detail-->
        <div class="modal fade" id="Detail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          
			 <div class="modal-dialog" role="document" style="height: 600px; width: 800px;">
 <div class="<?php print panel_modify();?>">
                        <div class="<?php print $panel_heading;?>">
                           <h3 class="box-title">รายละเอียด ADMIN LOGIN ด้วย PIN สามารถจัดการได้ในระบบ</h3>
						   <div class="box-tools pull-right">
						   <button type="button" class="btn btn-box-tool" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						   </div>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Security Site Levels</th>
                                            <th><i class="fa fa-circle" style="color: #ff1c15;"></i> Lower Class</th>
                                            <th><i class="fa fa-circle" style="color: #f7d13c;"></i> Middle Class</th>
                                             <th><i class="fa fa-circle" style="color: #00ff00;"></i> High Class</th>
											 <th><i class="fa fa-circle" style="color: #00ff00;"></i> None Security</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>สร้าง ไซต์งานเพิ่ม</td>
                                            <td class="text-center"><i class="fa fa-close" style="color: #ff1c15;"></i></td>
                                            <td class="text-center"><i class="fa fa-check"  style="color: #00c600;"></td>
                                            <td class="text-center"><i class="fa fa-check"  style="color: #00c600;"></td>
											<td class="text-center"><i class="fa fa-check"  style="color: #00c600;"></td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>แก้ไข ไซต์งาน</td>
                                            <td class="text-center"><i class="fa fa-close" style="color: #ff1c15;"></i></td>
                                            <td class="text-center"><i class="fa fa-check" style="color: #00c600;"></i></td>
                                            <td class="text-center"><i class="fa fa-check"  style="color: #00c600;"></td>
											<td class="text-center"><i class="fa fa-check"  style="color: #00c600;"></td>
                                        </tr>
										<tr>
                                            <td>3</td>
                                            <td>ลบ ไซต์งาน</td>
                                            <td class="text-center"><i class="fa fa-check" style="color: #00c600;"></i></td>
                                            <td class="text-center"><i class="fa fa-check"  style="color: #00c600;"></td>
                                            <td class="text-center"><i class="fa fa-check"  style="color: #00c600;"></td>
											<td class="text-center"><i class="fa fa-check"  style="color: #00c600;"></td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td>แก้ไข รหัส PIN ของตัวเอง</td>
                                            <td class="text-center"><i class="fa fa-close" style="color: #ff1c15;"></i></td>
                                            <td class="text-center"><i class="fa fa-close"  style="color: #ff1c15;"></td>
                                            <td class="text-center"><i class="fa fa-check"  style="color: #00c600;"></td>
											<td class="text-center"><i class="fa fa-check"  style="color: #00c600;"></td>
                                        </tr>
										<tr>
                                            <td>3</td>
                                            <td>แก้ไข รหัส PIN ไซต์ที่สร้างเอง</td>
                                            <td class="text-center"><i class="fa fa-close" style="color: #ff1c15;"></i></td>
                                            <td class="text-center"><i class="fa fa-check" style="color: #00c600;"></i></td>
                                            <td class="text-center"><i class="fa fa-check"  style="color: #00c600;"></td>
											<td class="text-center"><i class="fa fa-check"  style="color: #00c600;"></td>
                                        </tr>
                                         <tr>
                                            <td>5</td>
                                            <td>มองเห็น ทุกไซต์งาน</td>
                                            <td class="text-center"><i class="fa fa-close" style="color: #ff1c15;"></i></td>
                                            <td class="text-center"><i class="fa fa-close"  style="color: #ff1c15;"></td>
                                            <td class="text-center"><i class="fa fa-check"  style="color: #00c600;"></td>
											<td class="text-center"><i class="fa fa-check"  style="color: #00c600;"></td>
                                        </tr>
                                        <tr>
                                            <td>6</td>
                                            <td>แก้ไข ทุกไซต์งาน</td>
                                            <td class="text-center"><i class="fa fa-close" style="color: #ff1c15;"></i></td>
                                            <td class="text-center"><i class="fa fa-close"  style="color: #ff1c15;"></td>
                                            <td class="text-center"><i class="fa fa-check"  style="color: #00c600;"></td>
											<td class="text-center"><i class="fa fa-check"  style="color: #00c600;"></td>
                                        </tr>
										<tr>
                                            <td>7</td>
                                            <td>ปิด-เปิดระบบ Security Site</td>
                                            <td class="text-center"><i class="fa fa-close" style="color: #ff1c15;"></i></td>
                                            <td class="text-center"><i class="fa fa-close"  style="color: #ff1c15;"></td>
                                            <td class="text-center"><i class="fa fa-check"  style="color: #00c600;"></td>
											<td class="text-center"><i class="fa fa-check"  style="color: #00c600;"></td>
                                        </tr>
                                        </center></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    </div>


          </div>				
		<!-- ##############../Modal Detail..####################### -->

    <!-- Modal PINDetail-->
        <div class="modal fade" id="PINDetail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          
			 <div class="modal-dialog" role="document" style="width: 1000px;">
                 <div class="<?php print panel_modify();?>">
                        <div class="<?php print $panel_heading;?>">
                           <h3 class="box-title">รายละเอียด SITE PIN</h3>
						   <div class="box-tools pull-right">
						   <button type="button" class="btn btn-box-tool" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						   </div>
                        </div>
                        <div class="panel-body">
                            
                                 <table class="table table-striped table-hover"  id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>NO.</th>
                                             <th>Site Name</th>
											 <th>SERVER</th>
											 <th>USERNAME</th>
                                     <th><i class="fa fa-circle" style="color: #00ff00;"></i> PIN High Class</th>
									<th><i class="fa fa-circle" style="color: #f7d13c;"></i> PIN Middle Class</th>
                                     <th><i class="fa fa-circle" style="color: #ff1c15;"></i> PIN Lower Class</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                         <?php

	 $secu=mysql_fetch_array(mysql_query("SELECT admin_pin FROM mt_config"));
	$admin_pin=$secu['admin_pin'];

if(!empty($admin_pin)&&($admin_pin==$_SESSION['security'])){
	$session_login="admin_pin";}else{
                                             if($secom_v2==$_SESSION['security']){
		$session_login="customer_pin";}else if($secom_v3==$_SESSION['security']){
		$session_login="user_pin";}		
		}
   
$sql=mysql_query("SELECT * FROM mt_config WHERE ".$session_login."='".$_SESSION['security']."'");

         $no==1;
		while($result = mysql_fetch_array($sql)){
			//$API = new routeros_api();				
			//$API->debug = false;
			$no++;
          echo " <tr>";
			echo " <td>".$no."</td>"; 
			echo " <td>".$result['site_name']."</td>";
			echo " <td>".$result['mt_id']."</td>";
			echo " <td>".$_SESSION['APIUser']."</td>";
			echo " <td>****</td>";
			if($secom_v3==$_SESSION['security']){echo " <td>****</td>";}else{
			echo " <td>".$result['customer_pin']."</td>";}
			echo " <td>".$result['user_pin']."</td>";
			
			
			
		echo "</tr>";
					
					
					
					
					
					}?>
                                           
                                        </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    </div>


          				
		<!-- ##############/.Modal PINDetail ####################### -->

</section>
