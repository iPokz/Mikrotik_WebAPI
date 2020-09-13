<?php
	include_once("../include/class.mysqldb.php");
	include_once("../include/config.inc.php");
	include_once('../config/routeros_api.class.php');			
	//include_once('../phpqrcode/qrlib.php');
	include_once('../include/conn.php');
	echo "<meta charset='utf-8'>" ;
	
	//$hotspot_server=$_REQUEST['server']; if($hotspot_server==""){$hotspot_server = "all";}
	$username=$_REQUEST['user'];
	$password=$_REQUEST['pass'];
	//$limit_uptime=$_REQUEST['limit_uptime']; if($limit_uptime==""){$limit_uptime = "00:00:00";}
	$profiles=$_REQUEST['package_id'];
	//$ip=$_REQUEST['ip']; if($ip==""){$ip = "0.0.0.0";}
	//$mac=$_REQUEST['mac']; if($mac==""){$mac = "00:00:00:00:00:00";}
	//$email=$_REQUEST['email']; if($email==""){$email = "";}
	$db_ip=$_REQUEST['ip'];// if($ip==""){$ip = "0.0.0.0";}
	$ip=""; if($db_ip!=""){$ip = ",\"remote-address\"  => \$ip";}
	$db_mac=$_REQUEST['mac'];// if($mac==""){$mac = "00:00:00:00:00:00";}
	//$mac=$_REQUEST['mac']; if($db_mac!=""){$mac = ",\"caller-id\"  => \$mac";}
	$mt_comment=iconv("utf-8", "tis-620",$_REQUEST['comment']);
    $db_comment=$_REQUEST['comment'];
	$service="pppoe";
	$id=$_SESSION['id'];
	$date=date('Y-m-d H:i:s');
	// set.csv file 
	$filName = "../csv/org_csv/Gen".date("YmdHi").".csv";
	$csv=round(date('YmdHi.s'));
    $objWrite = fopen($filName, "w");
	 //END .csv file
	if($username != ""){
		$sql="SELECT user FROM pppoe_gen WHERE user='".$username."'";
		$query=mysql_query($sql);
		$rows=mysql_num_rows($query);
		if($rows>0){
			echo "<script language='javascript'>swal('Error!','มีชื่อ ".$username." แล้วในฐานข้อมูล กรุณาตั้งชื่อใหม่!','error').then(function () {
    window.history.back();}, function (dismiss) {
  if (dismiss === 'overlay') {
    window.history.back();
   }})</script>";
		}else{
		$ARRAY = $API->comm("/ppp/secret/add", array(
									  
		            "service"	=> $service,"name"  => $username,
						"password" => $password,	
							"profile"  => $profiles ,
								"caller-id"  => $db_mac ,
		                              //"remote-address"  => $ip ,
			                          "comment"  => $mt_comment
								  
							));
		$group=$username;

		fwrite($objWrite, "$username,$password,$profiles \n");

		mysql_query("INSERT INTO pppoe_gen VALUE('".$username."','".$password."','".$profiles."','".$db_mac."','".$db_ip."','".$db_comment."','".$csv."','','".$group."','','".$date."','".$id."')");
		//echo "<script>alert('เพิ่ม ".$username." สำเร็จแล้ว')</script>";
		//echo "<meta http-equiv='refresh' content='0;url=../system/index.php?page=pppoe_dtb_user' />";
		echo "<script language='javascript'>swal('Save Done!','เพิ่ม ".$username." สำเร็จแล้ว!','success').then(function () {
    window.location.href = 'index.php?page=pppoe_dtb_user';}, function (dismiss) {
  if (dismiss === 'overlay') {
    window.location.href = 'index.php?page=pppoe_dtb_user';
   }})</script>";
		exit();
	}
	}
?>