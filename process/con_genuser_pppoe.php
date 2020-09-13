<?php
	include_once('../config/routeros_api.class.php');
	include_once("../include/class.mysqldb.php");
	include_once("../include/config.inc.php");
	
	include_once('ran.php');			
	include_once('../include/conn.php');
	
	set_time_limit(60);	
	$num=$_REQUEST['max_user'];
		
		//$hotspot_server =$_REQUEST['server'];; if($hotspot_server==""){$hotspot_server = "all";}
	    $user = $_REQUEST['username'];
		$pass = $_REQUEST['password'];
		$profile=$_REQUEST['package_id'];
		$ip=$_REQUEST['ip'];// if($ip==""){$ip = "0.0.0.0";}
	    $db_ip=$_REQUEST['ip'];
	    $mac=$_REQUEST['mac'];// if($mac==""){$mac = "00:00:00:00:00:00";}
	    $db_mac=$_REQUEST['mac'];
		 $service="pppoe";
		$date=date('Y-m-d H:i:s');
	    $id=$_SESSION['id'];
		$group=$_REQUEST['fix_user'];
		$mt_comment=iconv("utf-8", "tis-620",$_REQUEST['comment']);
        $db_comment=$_REQUEST['comment'];
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
			$sql=mysql_query("SELECT * FROM pppoe_gen WHERE user='".$username."'");
			$row=mysql_num_rows($sql);
			
				
			if($row<=0){
				$ARRAY = $API->comm("/ppp/secret/add", array(
									//"server" => $hotspot_server,
				                    "service"	=> $service,
									"name"		=> $username,
									"password"	=> $password,
                                    //"limit-uptime" => $limit_uptime,
									"profile"	=> $profile,
			                        "caller-id"  => $mac ,
		                           // "remote-address"  => $ip ,
			                       // "email"  => $email ,
			                      "comment"  => $mt_comment ,
									));
				
				///csv start
			   fwrite($objWrite, "$username,$password,$profile \n");
			    ///csv end
				$mik_add=$mik_add+($num_check+1);
				mysql_query("INSERT INTO pppoe_gen VALUE('".$username."','".$password."','".$profile."','".$db_mac."','".$db_ip."','".$db_comment."','".$csv."','','".$group."','','".$date."','".$id."')");
				
				$i++;			
			}
		}while($i<=$num);
		//echo "<script>alert('สร้างรายชื่อจำนวน  ".$num." users  สำเร็จแล้ว')</script>";
		//echo "<meta http-equiv='refresh' content='0;url=../system/index.php?page=pppoe_dtb_user' />";
		echo "<script language='javascript'>swal('Save Done!','สร้างรายชื่อจำนวน  ".$num." users สำเร็จ ".$mik_add." users!','success').then(function () {
    window.location.href = '../system/index.php?page=pppoe_dtb_user';}, function (dismiss) {
  if (dismiss === 'overlay') {
    window.location.href = '../system/index.php?page=pppoe_dtb_user';
   }})</script>";
		exit();
?>
