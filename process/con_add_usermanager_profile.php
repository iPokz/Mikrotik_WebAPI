<?php
	include_once("../include/class.mysqldb.php");
	include_once("../include/config.inc.php");	
	include_once('../config/routeros_api.class.php');			
	include_once('../include/conn.php');
	$id=$_SESSION['id'];
	$name=$_REQUEST['name'];
	$owner=$_REQUEST['owner'];
	
	
	$str_validity=substr("".$_REQUEST['validity']."",-1);
	$num_validity=round("".$_REQUEST['validity']."");
	$validity_arr=array("D"=>"24","d"=>"24","H"=>"1","h"=>"1","W"=>"168","w"=>"168");
	$hour_validity= $validity_arr[$str_validity];
    $total_validity=($num_validity*$hour_validity);
	$um_validity=$_REQUEST['validity']; if($um_validity==""){$um_validity = "0";}
	$um_uptime_limit=$_REQUEST['uptime_limit'];if($um_uptime_limit==""){$um_uptime_limit = "0";}
	
	
	
	$price=$_REQUEST['price'];
	$um_price=$_REQUEST['price']; if($um_price==""){$um_price = "0";}
	$session=$_REQUEST['session']; if($session==""){$session = "00:00:00";}
    $db_session=$_REQUEST['session'];
	$idle=$_REQUEST['idle']; if($idle==""){$idle = "none";}
	$keep=$_REQUEST['keep']; if($keep==""){$keep = "00:02:00";}
	$auto=$_REQUEST['auto']; if($auto==""){$auto = "00:01:00";}
    $upload=$_REQUEST['upload'];if($upload!=""){$upload = "".$_REQUEST['upload']."/";}
	$um_upload=$_REQUEST['upload']; if($um_upload==""){$um_upload = "0";}
	$download=$_REQUEST['download'];
	$um_download=$_REQUEST['download']; if($um_download==""){$um_download = "0";}

    $limit="".$upload."".$download.""; if($limit=="/"){$limit = "";}
	$shared=$_REQUEST['shared']; if($shared==""){$shared = "unlimit";}
	$mk_shared=$_REQUEST['shared']; if($mk_shared==""){$mk_shared = "0";}

	$date=date('Y-m-d H:i:s');
	$csv=date("YmdHi");
	$password=date("YmdHi");
	$group="Master-userman-".$name."";

	$login=":local whouser \$user;:local whoip \$address;:local macaddr [/ip hotspot active get [find address=\$whoip] mac-address];:log info \"user logged in: \$whouser IP: \$whoip Mac: \$macaddr\";{:local date [/system clock get date ];:local time [/system clock get time ];:if ( [/tool user-manager user get \$user comment ] = \"\" ) do={[/tool user-manager user set \$user comment=\"\$date \$time\"];:log info \"New Hotspot user logged in: \$whouser\";}}";
    $logout=":log info \"\$user (\$address): logged out: \$cause \";";


	
	
	if($name != ""){
		$sql="SELECT pro_name FROM mt_profile WHERE pro_name='".$name."'";
		$query=mysql_query($sql);
		$rows=mysql_num_rows($query);

		$sql2="SELECT user FROM mt_gen WHERE user='".$name."'";
		$query2=mysql_query($sql2);
		$rows2=mysql_num_rows($query2);
		$error=$rows+$rows2;
		if($error>0){
			//echo "<script>alert('มีชื่อ ".$name." แล้วในฐานขื้อมูล กรุณาตั้งชื่อใหม่.')</script>";
			//echo "<script>window.history.back()</script>";
			echo "<script language='javascript'>swal('Error!','มีชื่อ ".$name." แล้วในฐานข้อมูล กรุณาตั้งชื่อใหม่!','error').then(function () {
    window.history.back();}, function (dismiss) {
  if (dismiss === 'overlay') {
    window.history.back();
   }})</script>";
		}else{
			
			$ARRAY = $API->comm("/tool/user-manager/profile/limitation/add", array(
									  "name" => $name,
				                      "group-name" => $name,
			                          "owner" => $owner,	
									  "uptime-limit" => $um_uptime_limit,
				                     "rate-limit-min-rx" => $um_upload,
				                      "rate-limit-rx" => $um_upload,
				                      "rate-limit-min-tx" => $um_download,
				                      "rate-limit-tx" => $um_download,
										
							));

            $ARRAY = $API->comm("/tool/user-manager/profile/add", array(
									  "name" => $name,
				                      "name-for-users" => $name,
			                          "owner" => $owner,	
									  "override-shared-users" => $shared,
				                     "validity" => $um_validity,
				                      "price" => $um_price,
				                      "starts-at" => "logon",
				            ));
			$ARRAY = $API->comm("/tool/user-manager/profile/profile-limitation/add", array(
									  "limitation" => $name,
				                      "profile" => $name,
			                          
				            ));

            $ARRAY = $API->comm("/tool/user-manager/user/add", array(
									  "customer" => $owner,	
									  "username"     => $name,
									  "password" => $password,	
									  "shared-users" => $shared,	
									
							));

            $ARRAY = $API->comm("/tool/user-manager/user/create-and-activate-profile", array(											
											"profile" => $name,
											"customer" => $owner,
							                "numbers"	=> $name,
								));

			$ARRAY = $API->comm("/ip/hotspot/user/profile/add", array(
									"name" => $name,
									"session-timeout" => $session,
									"idle-timeout" => $idle,
									"keepalive-timeout" => $keep,
									"status-autorefresh" => $auto,
									"shared-users" => $mk_shared,
									"rate-limit" => $limit,
									"on-login" => $login,
				                    "on-logout" => $logout
								));
			
			mysql_query("INSERT INTO mt_profile VALUE('".$name."','".$db_session."','".$idle."','".$keep."','".$auto."','".$total_validity."','".$shared."','".$limit."','".$price."','','','','','','','',NOW())");

			mysql_query("INSERT INTO mt_gen VALUE('".$name."','".$password."','','".$name."','','','','','','".$csv."','','".$group."','','".$date."','".$id."')");

			echo "<script language='javascript'>swal('Save Done!','เพิ่ม Profile ".$name." สำเร็จแล้ว!','success').then(function () {
    window.location.href = '../system/index.php?page=profilelist';}, function (dismiss) {
  if (dismiss === 'overlay') {
    window.location.href = '../system/index.php?page=profilelist';
   }})</script>";
			exit;
		}
	}
?>