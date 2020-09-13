<?php

include_once('../config/routeros_api.class.php');			
include_once('../include/conn.php');
include_once('../include/account.php');
include_once('../include/convert.php');


$ARRAY = $API->comm("/ppp/profile/print");
 $ARRAY2 = $API->comm("/ppp/secret/print");

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
                        <i class="fa fa-upload"></i>&nbsp;&nbsp;<i class="fa fa-user"></i>&nbsp;&nbsp;<strong>PPPOE Import User</strong><?php print $date_time_show;?> </div>
					
              
                <div class="panel-body">
                    <form action="" method="post" enctype="multipart/form-data" name="form1">
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
                            <div class="col-xs-12">
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
                    <li>เลือก Package, เลือกไฟล์ .CSV</li>
                    <li>ระบบจะดึงมาแค่ user คอลั่มA กับ password คอลั่ม B </li>
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
$target_dir = "index.php?page=pppoe_Import_Exel";
$target_file = $target_dir . basename($_FILES["fileCSV"]["name"]);
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Allow certain file formats
if($imageFileType != "csv" ) {
  echo "<script language='javascript'>swal('Error Import!','กรุณาเลือกไฟล์นามสกุล .csv!','info').then(function () {
    window.location.href ='index.php?page=pppoe_Import_Exel';}, function (dismiss) {
  if (dismiss === 'overlay') {
    window.location.href ='index.php?page=pppoe_Import_Exel';
   }})</script>";
		exit();
}else{

	$profile=$_REQUEST['profile'];
    $id=$_SESSION['id'];
	$num2 =count($ARRAY2);
	$objCSV = fopen($_FILES["fileCSV"]['tmp_name'], "r");
	mysql_query("SET NAMES TIS620");
    while (($objArr = fgetcsv($objCSV, 1000, ",")) !== FALSE) {


    $username_add=$objArr[0];    //user ดึงมาจาก .csv (col A)
    $password_add=$objArr[1];    //password ดึงมาจาก .csv (col B)
		if($_REQUEST['comment']==1){
	$comment_add=$objArr[2];    //comment ดึงมาจาก .csv (col C)
	}else{
	$comment_add="";
	}
    $pppoe_profile = $_REQUEST['profile'];
    $service="pppoe";
	$date=date('Y-m-d H:i');
	$num_check=0;
	if($username_add  != '' ){
		$project=$project+($num_check+1);
		$sql="SELECT user FROM pppoe_gen WHERE user='".$username_add."'";
		$query=mysql_query($sql);
		$rows=mysql_num_rows($query);
		if($rows>0){
			$fail=$username_add;$num_fail=$num_fail+($num_check+1);
for($i=0; $i<$num2; $i++){if($ARRAY2[$i]['name']==$fail){$fail="";$mik_fail=$mik_fail+($num_check+1);}}
	if($fail!=""){
				
				/////////////////////////////step1/////////////////////////////
				$mik_add=$mik_add+($num_check+1);
                          $ARRAY = $API->comm("/ppp/secret/add", array(
									
									"name"		=> $fail,
									"password"	=> $password_add,
									"comment" => $comment_add,
									"service"	=> $service,
									"profile"	=> $pppoe_profile
			                       ));
		$part1=mysql_fetch_array(mysql_query("SELECT * FROM pppoe_gen WHERE user='".$fail."'"));
			    $group_fail="".($part1['group_name'])."";}}else{
				
				/////////////////////////////step2/////////////////////////////
				$db_add=$db_add+($num_check+1);

				$csv=round(date('YmdHi.s'));
		$group="Importpppoe-".$csv."";

$mysql_add=mysql_query("INSERT INTO pppoe_gen VALUE('".$username_add."','".$password_add."','".$profile."','','','".$comment_add."','".$csv."','','".$group."','','".$date."','".$id."')");
}}else{
echo "<script language='javascript'>swal('Error Empty file!','ไม่มีข้อมูลในไฟล์!','info').then(function () {
    window.location.href ='index.php?page=pppoe_Import_Exel';}, function (dismiss) {
  if (dismiss === 'overlay') {
    window.location.href ='index.php?page=pppoe_Import_Exel';
   }})</script>";
		exit();}}fclose($objCSV);
               /////////////////////////////step3/////////////////////////////
	$mik_check=0;
	$query=mysql_query("SELECT * FROM pppoe_gen WHERE csv_code='".$csv."'");
	                        while($db_export=mysql_fetch_array($query)){
		      $db_users=$db_export['user'];                       $db_pass=$db_export['pass'];
          $db_profile=$db_export['profile'];                      $db_new_group=$db_export['group_name'];
		  $db_comment=$db_export['comment']; 
		  $new_user=$db_users;
		  $num_newadd=$num_newadd+($mik_check+1);
		for($i=0; $i<$num2; $i++){if($ARRAY2[$i]['name']==$new_user){$new_user="";$new_mik_fail=$new_mik_fail+($mik_check+1);}}
				
		                                    if($new_user!=""){
										$mik_newadd=$mik_newadd+($mik_check+1);
					 $ARRAY = $API->comm("/ppp/secret/add", array(
									"service"	=> $service,
									"name"		=> $new_user,
									"password"	=> $db_pass,
						            "comment"	=> $db_comment,
                                    "profile"	=> $db_profile
			                       ));}}			
				
				/////////////////////////////step4/////////////////////////////
                
                $check_group="".$group_fail." , ".$db_new_group."";
				$updateDB = $API->comm("/ppp/secret/print");
				$num2 =count($updateDB);
				if(($mik_fail+$new_mik_fail+$mik_add)>0){
					for($i=0; $i<$num2; $i++){
	mysql_query("UPDATE pppoe_gen SET
	pass='".$updateDB[$i]['password']."', profile='".$updateDB[$i]['profile']."',comment='".$updateDB[$i]['comment']."' WHERE user='".$updateDB[$i]['name']."'");}
	             echo "<script language='javascript'>swal('Error Import from ".$project." Table!','databaseสำเร็จ ".($db_add+0)." และ pppoeสำเร็จ ".($mik_add+$mik_newadd)." กรุณาตรวจสอบ! ".$check_group."','info').then(function () {
    window.location.href = 'index.php?page=pppoe_dtb_user';}, function (dismiss) {
  if (dismiss === 'overlay') {
    window.location.href = 'index.php?page=pppoe_dtb_user';
   }})</script>";
		exit();}else{echo "<script language='javascript'>swal('Save Done from ".$project." Table!','เพิ่ม  Group ".$db_new_group." สำเร็จแล้ว! จำนวนทั้งหมด ".$mik_newadd." users','success').then(function () {
    window.location.href ='index.php?page=pppoe_dtb_user';}, function (dismiss) {
  if (dismiss === 'overlay') {
    window.location.href ='index.php?page=pppoe_dtb_user';
   }})</script>";
		exit();}
				}}
?>
 </section>