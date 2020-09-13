<?php
	include_once('../config/routeros_api.class.php');
	include_once("../include/class.mysqldb.php");
	include_once("../include/config.inc.php");
	//include_once('../phpqrcode/qrlib.php');
	include_once('ran.php');			
	include_once('../include/conn.php');
	
	set_time_limit(60);	
	$num=$_REQUEST['max_user'];
		
		$hotspot_server =$_REQUEST['server'];if($hotspot_server==""){$hotspot_server = "all";}
	    $user = $_REQUEST['username'];
		$pass = $_REQUEST['password'];
		$profile=$_REQUEST['package_id'];
		$limit_uptime=$_REQUEST['limit_uptime']; if($limit_uptime==""){$limit_uptime = "00:00:00";}
		$ip=$_REQUEST['ip']; if($ip==""){$ip = "0.0.0.0";}
	    $mac=$_REQUEST['mac']; if($mac==""){$mac = "00:00:00:00:00:00";}
	    $email=$_REQUEST['email'];
	    $mt_comment=iconv("utf-8", "tis-620",$_REQUEST['comment']);
        $db_comment=$_REQUEST['comment'];
		$date=date('Y-m-d H:i:s');
	    $id=$_SESSION['id'];
		$db_limit_uptime=$_REQUEST['limit_uptime'];
		$db_ip=$_REQUEST['ip'];
		$db_mac=$_REQUEST['mac'];

		///csv on
		$fileName = "../csv/org_csv/Gen".date("YmdHi").".csv";
		$csv=round(date('YmdHi.s'));
		$objWrite = fopen($fileName, "w");
		///csv off
		$i=1;
		$num_check=0;
		do{
		    $username=$_REQUEST['fix_user'].genUser();		
			$password=$_REQUEST['fix_pass'].genPass();
			$sql=mysql_query("SELECT * FROM mt_gen WHERE user='".$username."'");
			$row=mysql_num_rows($sql);
			
				
			if($row<=0){
				$ARRAY = $API->comm("/ip/hotspot/user/add", array(
									"server" => $hotspot_server,	
									"name"		=> $username,
									"password"	=> $password,
                                    "limit-uptime" => $limit_uptime,
									"profile"	=> $profile,
			                        "mac-address"  => $mac ,
		                            "address"  => $ip ,
			                        "email"  => $email ,
			                        "comment"  => $mt_comment ,
									));
				$group="mikrotik-".$_REQUEST['fix_user']."";
				///csv start
			   fwrite($objWrite, "$username,$password,$db_limit_uptime \n");
			    ///csv end
				$mik_add=$mik_add+($num_check+1);
				$add=mysql_query("INSERT INTO mt_gen VALUE('".$username."','".$password."','".$db_limit_uptime."','".$profile."','".$hotspot_server."','".$db_mac."','".$db_ip."','".$email."','".$db_comment."','".$csv."','','".$group."','','".$date."','".$id."')");
				
				$i++;
				
			}
		}while($i<=$num);
		
       
		
				
		//echo "<script>alert('สร้างรายชื่อจำนวน  ".$num." users สำเร็จแล้ว')</script>";
		//echo "<meta http-equiv='refresh' content='0;url=../system/index.php?page=listuser' />";
		echo "<script language='javascript'>swal('Save Done!','สร้างรายชื่อจำนวน  ".$num." users สำเร็จ ".$mik_add." user','success').then(function () {
    window.location.href = '../system/index.php?page=listuser';}, function (dismiss) {
  if (dismiss === 'overlay') {
    window.location.href = '../system/index.php?page=listuser';
   }})</script>";
		exit();
?>
