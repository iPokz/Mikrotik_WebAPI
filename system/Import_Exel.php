<?php

include_once('../config/routeros_api.class.php');			
include_once('../include/conn.php');
include_once('../include/account.php');
include_once('../include/convert.php');


$ARRAY = $API->comm("/ip/hotspot/user/profile/print");
$ARRAY1 = $API->comm("/ip/hotspot/print");
$ARRAY2 = $API->comm("/ip/hotspot/user/print");
$ARRAY3 = $API->comm("/tool/user-manager/user/print");

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
  
          <div class="row">
           <div class="col-lg-12" >
            <div class="<?php print panel_modify();?>">
                <div class="<?php print $panel_heading;?>" >
      <i class="fa fa-upload"></i>&nbsp;&nbsp;<i class="fa fa-user"></i>&nbsp;&nbsp;<strong>Hotspot Import User</strong> <?php print $date_time_show;?> </div>
					
              
                <div class="panel-body">
                    <form action="" method="post" enctype="multipart/form-data" name="form1">
					 <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                   <span class="style1">เลือก Servers</span>
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
                                       </div>
						<div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <span class="style1">เลือก Package</span>
                                     <select name="profile"  id="profile" class="form-control" required>
					      <option value="">ต้องเลือก Package</option>
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
                                   <span class="style1">เลือกจำนวนวันที่ใช้งาน</span>
                                    <input name="limit_uptime"  id="limit_uptime" placeholder="Ex.1d or 1h" class="form-control" >
						        </div>
                                </div>                            
                           <div class="col-xs-12  col-md-6">
                                <div class="form-group">
                                   <span class="style1">เพิ่ม Comment.</span>
                                    <select name="comment"  id="comment" class="form-control">
					                <option value="0" selected="selected">NO.</option>
									<option value="1">YES.</option>
									</select>
                                       </div>
									</div>
                                </div>


							<br>
                            <input name="fileCSV" type="file" id="fileCSV" />
							<br>

							 <div class="row">
						<div class="col-lg-7 col-md-9 " >
                            <div class="form-group">
							<?php
                                              if($account!="read"){
										   echo "<button name=\"submit\" type=\"submit\"  value=\"submit\" class=\"btn btn-success\" ><i class=\"fa fa-check\"></i>&nbsp;Save&nbsp;</button>&nbsp;&nbsp;&nbsp;";
								}else{
									echo "<a name=\"submit\" type=\"submit\"  value=\"submit\" class=\"btn btn-success\" ><i class=\"fa fa-check\"></i>&nbsp;Save&nbsp;</a>&nbsp;&nbsp;&nbsp;";
								}
				                       ?>
								<button  class="btn btn-danger" type="reset">&nbsp;&nbsp;&nbsp;<i class="fa fa-refresh"></i>&nbsp;Reset&nbsp;&nbsp;&nbsp;</button>&nbsp;&nbsp;&nbsp;<span class="hidden-xs"><button type="button" class="btn btn-info" data-toggle="collapse" data-target="#manual"><span class="style2">ข้อแนะนำการใช้งาน </span></button></span>
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
                    <li>เลือก Server , Package, เลือกไฟล์ .CSV และ จำนวนวันใช้งาน(limit-uptime)</li>
                    <li>ระบบจะดึงมาแค่ user คอลั่มA กับ password คอลั่ม B จำนวนวันใช้งานถ้าไม่กำหนดจะเป็นค่า default .</li>
					<li>ถ้ามีการเลือก Comment จะเอามาจาก คอลั่ม C .</li>
					<li>Comment ใส่ได้ไม่เกิน 30 ตัวอักษร เพราะค่าจะแสดงที่ตารางยาวเกินไป.</li>
                </ul>
            </p>
			</div>
			</div>
		
  </section>
 <section class="content"> 
<?php


if(isset($_POST['submit']) && $_POST['submit']=='submit'){
	// Allow certain file formats
$target_dir = "index.php?page=Import_Exel";
$target_file = $target_dir . basename($_FILES["fileCSV"]["name"]);
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Allow certain file formats
if($imageFileType != "csv" ) {
  echo "<script language='javascript'>swal('Error Import!','กรุณาเลือกไฟล์นามสกุล .csv!','info').then(function () {
    window.location.href ='index.php?page=Import_Exel';}, function (dismiss) {
  if (dismiss === 'overlay') {
    window.location.href ='index.php?page=Import_Exel';
   }})</script>";
		exit();
}else{
	$server=$_REQUEST['server'];
    $id=$_SESSION['id'];
	$num2 =count($ARRAY2);
	$num3 =count($ARRAY3);
	mysql_query("SET NAMES TIS620");

$objCSV = fopen($_FILES["fileCSV"]['tmp_name'], "r");

while (($objArr = fgetcsv($objCSV, 1000, ",")) !== FALSE) {


    $username_add=$objArr[0];    //user ดึงมาจาก .csv (col A)
    $password_add=$objArr[1];    //password ดึงมาจาก .csv (col B)
	if($_REQUEST['comment']==1){
	$comment_add=$objArr[2];    //comment ดึงมาจาก .csv (col C)
	}else{
	$comment_add="";
	}
    $server =$_REQUEST['server']; if($server==""){$server = "all";}
	$hotspot_profile = $_REQUEST['profile'];
    $limit_uptime=$_REQUEST['limit_uptime']; if($limit_uptime==""){$limit_uptime = "00:00:00";}
	$db_limit_uptime=$_REQUEST['limit_uptime'];
	
	$date=date('Y-m-d H:i');
	$num_check=0;
	

    if($username_add  != '' ){
		$project=$project+($num_check+1);
		$sql="SELECT user FROM mt_gen WHERE user='".$username_add."'";
		$query=mysql_query($sql);
		$rows=mysql_num_rows($query);
		if($rows>0){
			$fail=$username_add;$num_fail=$num_fail+($num_check+1);
for($i=0; $i<$num2; $i++){if($ARRAY2[$i]['name']==$fail){$fail="";$mik_fail=$mik_fail+($num_check+1);}}
	for($i=0; $i<$num3; $i++){if($ARRAY3[$i]['username']==$fail){$fail="";$man_fail=$man_fail+($num_check+1);}}
			//$mik_total=$mik_total+($num_check+1);
			if($fail!=""){
				
				/////////////////////////////step1/////////////////////////////
				$mik_add=$mik_add+($num_check+1);
              

                          $ARRAY = $API->comm("/ip/hotspot/user/add", array(
									"server" => $server,	
									"name"		=> $fail,
									"password"	=> $password_add,
                                    "limit-uptime" => $limit_uptime,
							         "comment" => $comment_add,
									"profile"	=> $hotspot_profile
			                       ));
			   

		$part1=mysql_fetch_array(mysql_query("SELECT * FROM mt_gen WHERE user='".$fail."'"));
			    $group_fail="".($part1['group_name'])."";}}else{
				
				/////////////////////////////step2/////////////////////////////
				$db_add=$db_add+($num_check+1);

				$csv=round(date('YmdHi.s'));
		$group="ImportMik-".$csv."";
		
$mysql_add=mysql_query("INSERT INTO mt_gen VALUE('".$username_add."','".$password_add."','".$db_limit_uptime."','".$_REQUEST['profile']."','".$server."','','','','".$comment_add."','".$csv."','','".$group."','','".$date."','".$id."')");
}}else{
echo "<script language='javascript'>swal('Error Empty file!','ไม่มีข้อมูลในไฟล์!','info').then(function () {
    window.location.href ='index.php?page=Import_Exel';}, function (dismiss) {
  if (dismiss === 'overlay') {
    window.location.href ='index.php?page=Import_Exel';
   }})</script>";
		exit();}}fclose($objCSV);
               /////////////////////////////step3/////////////////////////////
	$mik_check=0;
	$query=mysql_query("SELECT * FROM mt_gen WHERE csv_code='".$csv."'");
	                        while($db_export=mysql_fetch_array($query)){
		      $db_users=$db_export['user'];                       $db_pass=$db_export['pass'];
          $db_profile=$db_export['profile'];                      $db_new_group=$db_export['group_name'];
		  $db_limituptime=$db_export['limit_uptime'];if($db_limituptime==""){$db_limituptime = "00:00:00";}            $db_server=$db_export['server_pro'];
		  $db_comment=$db_export['comment'];
		  $new_user=$db_users;$num_newadd=$num_newadd+($mik_check+1);
		for($i=0; $i<$num2; $i++){if($ARRAY2[$i]['name']==$new_user){$new_user="";$new_mik_fail=$new_mik_fail+($mik_check+1);}}
	for($i=0; $i<$num3; $i++){if($ARRAY3[$i]['username']==$new_user){$new_user="";$new_man_fail=$new_man_fail+($mik_check+1);}}			
		                                    if($new_user!=""){
										$mik_newadd=$mik_newadd+($mik_check+1);
					  $ARRAY = $API->comm("/ip/hotspot/user/add", array(
									"server" => $db_server,	
									"name"		=> $new_user,
									"password"	=> $db_pass,
                                    "limit-uptime" => $db_limituptime,
						            "comment" => $db_comment,
									"profile"	=> $db_profile
			                       ));}}			
				
				/////////////////////////////step4/////////////////////////////
                
                $check_group="".$group_fail." , ".$db_new_group."";
				$updateDB = $API->comm("/ip/hotspot/user/print");
				$num2 =count($updateDB);
				if(($mik_fail+$man_fail+$new_mik_fail+$new_man_fail+$mik_add)>0){
					for($i=0; $i<$num2; $i++){
	mysql_query("UPDATE mt_gen SET
	server_pro='".$updateDB[$i]['server']."',pass='".$updateDB[$i]['password']."', profile='".$updateDB[$i]['profile']."',limit_uptime='".$updateDB[$i]['limit-uptime']."',comment='".$updateDB[$i]['comment']."' WHERE user='".$updateDB[$i]['name']."'");}
	             echo "<script language='javascript'>swal('Error Import from ".$project." Table!','databaseสำเร็จ ".($db_add+0)." และ hotspotสำเร็จ ".($mik_add+$mik_newadd)." กรุณาตรวจสอบ! ".$check_group."','info').then(function () {
    window.location.href = 'index.php?page=listuser';}, function (dismiss) {
  if (dismiss === 'overlay') {
    window.location.href = 'index.php?page=listuser';
   }})</script>";
		exit();}else{echo "<script language='javascript'>swal('Save Done from ".$project." Table!','เพิ่ม  Group ".$db_new_group." สำเร็จแล้ว! จำนวนทั้งหมด ".$mik_newadd." users','success').then(function () {
    window.location.href ='index.php?page=listuser';}, function (dismiss) {
  if (dismiss === 'overlay') {
    window.location.href ='index.php?page=listuser';
   }})</script>";
		exit();}
				
				
}}?>

</section>
             