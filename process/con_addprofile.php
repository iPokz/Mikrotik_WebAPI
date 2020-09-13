<?php
	include_once("../include/class.mysqldb.php");
	include_once("../include/config.inc.php");	
	include_once('../config/routeros_api.class.php');			
	include_once('../include/conn.php');
	$name=$_REQUEST['name'];
	$session=$_REQUEST['session']; if($session==""){$session = "00:00:00";}
	$db_session=$_REQUEST['session'];
	$idle=$_REQUEST['idle']; if($idle==""){$idle = "none";}	
	$use=$_REQUEST['use']; if($use==""){$use = "0";}	
	$limit=$_REQUEST['limit']; if($limit==""){$limit = "";}	
	$keep=$_REQUEST['keep']; if($keep==""){$keep = "00:02:00";}	
	$auto=$_REQUEST['auto']; if($auto==""){$auto = "00:01:00";}
	$uptime=$_REQUEST['uptime'];
	$price=$_REQUEST['price'];
	$active=$_REQUEST['active'];
	$login=":local whouser \$user;:local whoip \$address;:local macaddr [/ip hotspot active get [find address=\$whoip] mac-address];:log info \"user logged in: \$whouser IP: \$whoip Mac: \$macaddr\";{:local date [/system clock get date ];:local time [/system clock get time ];:if ( [/ip hotspot user get \$user comment ] = \"\" ) do={[/ip hotspot user set \$user comment=\"\$date \$time\"];:log info \"New Hotspot user logged in: \$whouser\";}}";
    $logout=":log info \"\$user (\$address): logged out: \$cause \";";


	
	
	if($name != ""){
		$sql="SELECT pro_name FROM mt_profile WHERE pro_name='".$name."'";
		$query=mysql_query($sql);
		$rows=mysql_num_rows($query);
		
		if($rows>0){
			//echo "<script>alert('มีชื่อ ".$name." แล้วในฐานขื้อมูล กรุณาตั้งชื่อใหม่.')</script>";
			//echo "<script>window.history.back()</script>";
			echo "<script language='javascript'>swal('Error!','มีชื่อ ".$name." แล้วในฐานข้อมูล กรุณาตั้งชื่อใหม่!','error').then(function () {
    window.history.back();}, function (dismiss) {
  if (dismiss === 'overlay') {
    window.history.back();
   }})</script>";
		}else{
			mysql_query("INSERT INTO mt_profile VALUE('".$name."','".$db_session."','".$idle."','".$keep."','".$auto."','".$uptime."','".$use."','".$limit."','".$price."','','','','','','','',NOW())");
			$ARRAY = $API->comm("/ip/hotspot/user/profile/add", array(
									"name" => $name,
									"session-timeout" => $session,
									"idle-timeout" => $idle,
									"keepalive-timeout" => $keep,
									"status-autorefresh" => $auto,
									"shared-users" => $use,
									"rate-limit" => $limit,
									"on-login" => $login,
				                    "on-logout" => $logout
								));
			/*$ARRAY = $API->comm("/system/scheduler/add", array(
									"name" => $name,
									 "interval" => $interval,
									"on-event" => $on_event,
				                    "start-time" => $start_time
									
								));*/
			//echo "<script>alert('เพิ่ม Profile ".$name." สำเร็จแล้ว')</script>";
			//echo "<meta http-equiv='refresh' content='0;url=../system/index.php?page=profilelist' />";
			echo "<script language='javascript'>swal('Save Done!','เพิ่ม Profile ".$name." สำเร็จแล้ว!','success').then(function () {
    window.location.href = '../system/index.php?page=profilelist';}, function (dismiss) {
  if (dismiss === 'overlay') {
    window.location.href = '../system/index.php?page=profilelist';
   }})</script>";
			exit;
		}
	}
?>