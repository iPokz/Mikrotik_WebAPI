<?php
	include_once("../include/class.mysqldb.php");
	include_once("../include/config.inc.php");	
	include_once('../config/routeros_api.class.php');			
	include_once('../include/conn.php');
	$name=$_REQUEST['name'];
	$local=$_REQUEST['local'];// if($local==""){$local = "0.0.0.0";}
	$remote=$_REQUEST['remote'];

	$price=$_REQUEST['price'];
	$onup=":local whouser \$user;:local whoip [/ppp active get [find name=\$whouser] address];:local macaddr [/ppp active get [find name=\$whouser] caller-id];:log info \"user logged in: \$whouser Address: \$whoip Mac: \$macaddr\";{:local date [/system clock get date ];:local time [/system clock get time ];:if ( [/ppp secret get \$whouser comment ] =\"\" ) do={[/ppp secret set \$whouser comment=\"\$date \$time\"];:log info \"New PPPOE user logged in: \$whouser\"; }}";
	
	
	$limit=$_REQUEST['limit']; if($limit==""){$limit = "";}	
	
	if($name != ""){
		$sql="SELECT pro_name FROM pppoe_pro WHERE pro_name='".$name."'";
		$query=mysql_query($sql);
		$rows=mysql_num_rows($query);
		
		if($rows>0){
			//echo "<script>alert('มีชื่อ ".$name." แล้วในฐานขื้อมูล กรุณาตั้งชื่อใหม่.')</script>";
			//echo "<script>window.history.back()</script>";
			echo "<script language='javascript'>swal('Error!','มีชื่อ ".$name." แล้วในฐานขื้อมูล กรุณาตั้งชื่อใหม่!','error').then(function () {
    window.history.back();}, function (dismiss) {
  if (dismiss === 'overlay') {
    window.history.back();
   }})</script>";
		}else{
			mysql_query("INSERT INTO pppoe_pro VALUE('".$name."','".$local."','".$remote."','".$session."','".$limit."','','".$price."','','','','','','','')");
			$ARRAY = $API->comm("/ppp/profile/add", array(
									"name" => $name,
									//"session-timeout" => $session,
									"local-address" => $local,
									"remote-address" => $remote,
										"rate-limit" => $limit,
										"on-up" => $onup
									
									
									
								));		
			//echo "<script>alert('เพิ่ม Profile ".$name." สำเร็จแล้ว')</script>";
			//echo "<meta http-equiv='refresh' content='0;url=../system/index.php?page=pppoe_profile_list' />";
			echo "<script language='javascript'>swal('Save Done!','เพิ่ม Profile ".$name." สำเร็จแล้ว!','success').then(function () {
    window.location.href = '../system/index.php?page=pppoe_profile_list';}, function (dismiss) {
  if (dismiss === 'overlay') {
    window.location.href = '../system/index.php?page=pppoe_profile_list';
   }})</script>";
			exit;
		}
	}
?>