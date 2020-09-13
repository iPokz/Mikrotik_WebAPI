<?php
	include_once("../include/class.mysqldb.php");
	include_once("../include/config.inc.php");
	include_once('../config/routeros_api.class.php');			
	//include_once('../phpqrcode/qrlib.php');
	include_once('../include/conn.php');
	echo "<meta charset='utf-8'>" ;
	set_time_limit(60);
	
	$hotspot_server=$_REQUEST['server'];
	$username=$_REQUEST['user'];
	$password=$_REQUEST['pass'];
	$profiles=$_REQUEST['package_id'];
	$ip=$_REQUEST['ip']; if($ip==""){$ip = "0.0.0.0";}
	$mac=$_REQUEST['mac'];
	$email=$_REQUEST['email'];
	$comments=$_REQUEST['comments'];
	$id=$_SESSION['id'];
	$date=date('Y-m-d H:i:s');
	$db_limit_uptime=$_REQUEST['limit_uptime'];
	$db_ip=$_REQUEST['ip'];
	$db_mac=$_REQUEST['mac'];
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
   exit();
		}else{
		$ARRAY = $API->comm("/tool/user-manager/user/add", array(
									  "customer" => $hotspot_server,	
									  "username"     => $username,
									  "password" => $password,	
									 // "limit-uptime" => $limit_uptime,	
									"copy-from"  => $profiles ,
                                      //"create-and-activate-profile"  => $profiles ,
			                          "caller-id"  => $mac ,
		                              "ip-address"  => $ip ,
			                          "email"  => $email ,
			                          "comment"  => $comments ,
							));

       $ARRAY = $API->comm("/tool/user-manager/user/create-and-activate-profile", array(											
											//"username"	=> $username,
											//"password"  => $password,
											"profile" => $profiles,
											"customer" => $hotspot_server,
							                //"caller-id"  => $caller ,//create-and-activate-profile
		                                   // "ip-address"  => $ip ,
			                              //  "email"  => $email ,
									        "numbers"	=> $username,
								));

		$group="usermanager-".$username."";
		///csv start
		fwrite($objWrite, "$username,$password,$profiles \n");
	    ///csv end
		
		mysql_query("INSERT INTO mt_gen VALUE('".$username."','".$password."','".$db_limit_uptime."','".$profiles."','".$hotspot_server."','".$db_mac."','".$db_ip."','".$email."','".$comments."','".$csv."','','".$group."','','".$date."','".$id."')");
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