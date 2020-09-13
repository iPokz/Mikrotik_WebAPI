<?php
		
			include_once('../config/routeros_api.class.php');			
			include_once('../include/conn.php');
			include_once('../include/convert.php');
			$ARRAY = $API->comm("/ppp/profile/print");		
			
				
				if(!empty($_REQUEST['username'])){

					if($_REQUEST['username']==$_GET['id']){
						$username=$_REQUEST['username'];
						$user=$_GET['id'];
						if($_GET['return']=="pppoe_allDB"){
						echo "<script language='javascript'>swal('Error ".$username."!','สามารถแก้ไขได้ที่หน้าPPPOE Mikrotik user ','error').then(function () {
    window.location.href = 'index.php?page=pppoe_all_data_users&id=".$_GET['code']."';}, function (dismiss) {if (dismiss === 'overlay') {
    window.location.href = 'index.php?page=pppoe_all_data_users&id=".$_GET['code']."';}})</script>";
                         exit();}
						if($_GET['return']=="pppoe_DB"){
						echo "<script language='javascript'>swal('Error ".$username."!','สามารถแก้ไขได้ที่หน้าPPPOE Mikrotik user ','error').then(function () {
    window.location.href = 'index.php?page=pppoe_user&id=".$_GET['code']."';}, function (dismiss) {if (dismiss === 'overlay') {
    window.location.href = 'index.php?page=pppoe_user&id=".$_GET['code']."';}})</script>";
                         exit();}
						
					}else{
                        $username=$_REQUEST['username'];
						$user=$_GET['id'];
						$sql=mysql_query("SELECT user FROM pppoe_gen where user='".$_REQUEST['username']."'");
						$num=mysql_num_rows($sql);						

						if($num==0){
							$username=$_REQUEST['username'];
						$user=$_GET['id'];
						if($_GET['return']=="pppoe_allDB"){
						echo "<script language='javascript'>swal('Error ".$username."!','สามารถแก้ไขได้ที่หน้าPPPOE Mikrotik user ','error').then(function () {
    window.location.href = 'index.php?page=pppoe_all_data_users&id=".$_GET['code']."';}, function (dismiss) {if (dismiss === 'overlay') {
    window.location.href = 'index.php?page=pppoe_all_data_users&id=".$_GET['code']."';}})</script>";
                         exit();}
						if($_GET['return']=="pppoe_DB"){
						echo "<script language='javascript'>swal('Error ".$username."!','สามารถแก้ไขได้ที่หน้าPPPOE  Mikrotik user ','error').then(function () {
    window.location.href = 'index.php?page=pppoe_user&id=".$_GET['code']."';}, function (dismiss) {if (dismiss === 'overlay') {
    window.location.href = 'index.php?page=pppoe_user&id=".$_GET['code']."';}})</script>";
							exit();}
							
							
						}else{
							$username=$_REQUEST['username'];
							if($_GET['return']=="pppoe_allDB"){
							echo "<script language='javascript'>swal('Error ".$username."!','สามารถแก้ไขได้ที่หน้าPPPOE Mikrotik user ','error').then(function () {
    window.location.href = 'index.php?page=pppoe_all_data_users&id=".$_GET['code']."';}, function (dismiss) {if (dismiss === 'overlay') {
    window.location.href = 'index.php?page=pppoe_all_data_users&id=".$_GET['code']."';}})</script>";
                         exit();}
						if($_GET['return']=="pppoe_DB"){
						echo "<script language='javascript'>swal('Error ".$username."!','สามารถแก้ไขได้ที่หน้าPPPOE  Mikrotik user ','error').then(function () {
    window.location.href = 'index.php?page=pppoe_user&id=".$_GET['code']."';}, function (dismiss) {if (dismiss === 'overlay') {
    window.location.href = 'index.php?page=pppoe_user&id=".$_GET['code']."';}})</script>";
	                        exit();}
							
						}
					}
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
 
<div class="row">
         <div class="col-lg-12" >
            <div class="<?php print panel_modify();?>">
                <div class="<?php print $panel_heading;?>" >
                    <i class="fa fa-user"></i>&nbsp;&nbsp;<strong>PPPOE Edit Database User - แก้ไขยูสเซอร์</strong>
                    <?php print $date_time_show;?></div>                    
              
                <div class="panel-body">
                    <form name="login" action="" method="post">
					<?php
					$result=mysql_fetch_array(mysql_query("SELECT * FROM pppoe_gen WHERE user='".$_REQUEST['id']."'"));
					?>
					 <div class="row">
                            <div class="col-xs-12  col-md-6">
                                <div class="form-group">
                                    <span class="style1">เลือก Package</span>
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
                                   <span class=" style1">Comment</span>
                                   <input name="comment" type="text"  placeholder="Ex.jen/31/2017 23:00:00" class="form-control" value="<?php echo $result['comment']; ?>">  
							  </div>
                                </div>
                            </div>
						
                        <div class="row">
                            <div class="col-xs-12  col-md-6">
                                <div class="form-group">
                                    <span class="style1">Username</span>
                                   <input name="username" type="text" class="form-control" placeholder="Username"  value="<?php echo $result['user']; ?>" required>  
									
                                </div>
                            </div>
                            <div class="col-xs-12  col-md-6">
                                <div class="form-group">
                                    <span class="style1">Password</span>
                                    <input name="password" type="text" class="form-control" placeholder="Password"  value="<?php echo $result['pass']; ?>" required>  
									
                                </div>
                            </div>
                        </div>

						<div class="row">
                            <div class="col-xs-12  col-md-6">
                                <div class="form-group">
                                    <span class=" style1">เจาะจง IP Address</span>
                                   <input name="ip" type="text" class="form-control" placeholder="Ex.172.0.0.3"  value="<?php echo $result['address']; ?>">  
									
                                </div>
                            </div>
                            <div class="col-xs-12  col-md-6">
                                <div class="form-group">
                                    <span class="style1">เจาะจง MAC Address</span>
                                    <input name="mac" type="text" class="form-control" placeholder="Ex.1A:2A:3A:4A:5A:6A"  value="<?php echo $result['caller_id']; ?>">  
									
                                </div>
                            </div>
                        </div>
						
							
                        <div class="row">
						<div class="col-lg-12 col-md-12 " >                                         
                                       <?php
						if($account!="read"){
                    echo "<button id=\"btnSave\" class=\"btn btn-success\" type=\"submit\">&nbsp;&nbsp;&nbsp;&nbsp;<i class=\"fa fa-check\"></i>&nbsp;Save&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>&nbsp;&nbsp;&nbsp;&nbsp;<button id=\"btnCancel\" class=\"btn btn-danger\" type=\"reset\"  Onclick=\"javascript:history.back()\">&nbsp;&nbsp;&nbsp;<i class=\"fa fa-times\"></i>&nbsp;Cancel&nbsp;&nbsp;&nbsp;</button> ";
					}else{echo "<a id=\"btnSave\" class=\"btn btn-success\" type=\"submit\">&nbsp;&nbsp;&nbsp;&nbsp;<i class=\"fa fa-check\"></i>&nbsp;Save&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>&nbsp;&nbsp;&nbsp;&nbsp;<button id=\"btnCancel\" class=\"btn btn-danger\" type=\"reset\"  Onclick=\"javascript:history.back()\">&nbsp;&nbsp;&nbsp;<i class=\"fa fa-times\"></i>&nbsp;Cancel&nbsp;&nbsp;&nbsp;</button> ";
								   }
				?>
				                  &nbsp;&nbsp;&nbsp;<span class="hidden-xs"><button id="btnSave" class="btn btn-warning" type="reset">&nbsp;&nbsp;&nbsp;<i class="fa fa-refresh"></i>&nbsp;Reset&nbsp;&nbsp;&nbsp;</button>&nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-info" data-toggle="collapse" data-target="#manual"><span class="style2">ข้อแนะนำการใช้งาน 
                       
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
					<li>สามารถแก้ไขได้ที่หน้า PPPOE Mikrotik user </li>
                    </ul>
            </p>
			</div>
			</div>
			
  </section>