<?php
	include_once("../include/class.mysqldb.php");
	include_once("../include/config.inc.php");
	include_once('../config/routeros_api.class.php');			
	
	include_once('../include/conn.php');
	echo "<meta charset='utf-8'>" ;
	
	$hotspot_server=$_REQUEST['server']; if($hotspot_server==""){$hotspot_server = "all";}
	$username=$_REQUEST['user'];
	$password=$_REQUEST['pass'];
	$limit_uptime=$_REQUEST['limit_uptime']; if($limit_uptime==""){$limit_uptime = "00:00:00";}
	$db_limit_uptime=$_REQUEST['limit_uptime'];
	$profiles=$_REQUEST['package_id'];
	$ip=$_REQUEST['ip']; if($ip==""){$ip = "0.0.0.0";}
	$db_ip=$_REQUEST['ip'];
	$mac=$_REQUEST['mac']; if($mac==""){$mac = "00:00:00:00:00:00";}
	$db_mac=$_REQUEST['mac'];
	$email=$_REQUEST['email'];
	$mt_comment=iconv("utf-8", "tis-620",$_REQUEST['comment']);
    $db_comment=$_REQUEST['comment'];
	$id=$_SESSION['id'];
	$date=date('Y-m-d H:i:s');
	// set.csv file 
	$filName = "../csv/org_csv/Gen".date("YmdHi").".csv";
	$csv=round(date('YmdHi.s'));
    $objWrite = fopen($filName, "w");
	 //END .csv file
	if($username != ""){
		$sql="SELECT user FROM mt_gen WHERE user='".$username."'";
		$query=mysql_query($sql);
		$rows=mysql_num_rows($query);
		if($rows>0){
			echo "<script language='javascript'>swal('Error!','มีชื่อ ".$username." แล้วในฐานข้อมูล กรุณาตั้งชื่อใหม่!','error').then(function () {
    window.history.back();}, function (dismiss) {
  if (dismiss === 'overlay') {
    window.history.back();
   }})</script>";
		}else{

		$ARRAY = $API->comm("/ip/hotspot/user/add", array(
									  "server" => $hotspot_server,	
									  "name"     => $username,
									  "password" => $password,	
									  "limit-uptime" => $limit_uptime,	
									  "profile"  => $profiles ,
			                          "mac-address"  => $mac ,
		                              "address"  => $ip ,
			                          "email"  => $email ,
			                          "comment"  => $mt_comment ,
							));
		$group="mikrotik-".$username."";
		///csv start
		fwrite($objWrite, "$username,$password,$db_limit_uptime \n");
	    ///csv end
		mysql_query("INSERT INTO mt_gen VALUE('".$username."','".$password."','".$db_limit_uptime."','".$profiles."','".$hotspot_server."','".$db_mac."','".$db_ip."','".$email."','".$db_comment."','".$csv."','','".$group."','','".$date."','".$id."')");
		//echo "<script>alert('เพิ่ม ".$username." สำเร็จแล้ว')</script>";
		//echo "<meta http-equiv='refresh' content='0;url=../system/index.php?page=listuser' />";
		echo "<script language='javascript'>swal('Save Done!','เพิ่ม ".$username." สำเร็จแล้ว!','success').then(function () {
    window.location.href = '../system/index.php?page=listuser';}, function (dismiss) {
  if (dismiss === 'overlay') {
    window.location.href = '../system/index.php?page=listuser';
   }})</script>";
		exit();
		}
	}
?>