<?php
	include_once('../config/routeros_api.class.php');
	include_once("../include/class.mysqldb.php");
	include_once("../include/config.inc.php");
	//include_once('../phpqrcode/qrlib.php');
	include_once('ran.php');			
	include_once('../include/conn.php');
	
	set_time_limit(60);	
	$num=$_REQUEST['max_user'];
		
		$hotspot_server =$_REQUEST['server'];
	    $user = $_REQUEST['username'];
		$pass = $_REQUEST['password'];
		$profile=$_REQUEST['package_id'];
		//$limit_uptime=$_REQUEST['limit_uptime'];; if($limit_uptime==""){$limit_uptime = "00:00:00";}
		$ip=$_REQUEST['ip']; if($ip==""){$ip = "";}
	    //$mac=$_REQUEST['mac'];
	   // $email=$_REQUEST['email']; if($email==""){$email = "";}
	   // $comments=$_REQUEST['comments']; if($comments==""){$comments = "";}
		$date=date('Y-m-d H:i:s');
	    $id=$_SESSION['id'];
		///csv on
		$fileName = "../csv/org_csv/Gen".date("YmdHi").".csv";
		$csv=round(date('YmdHi.s'));
		$objWrite = fopen($fileName, "w");
		///csv off
        $num_check=0;
		$i=1;
		do{
		    $username=$_REQUEST['fix_user'].genUser();		
			$password=$_REQUEST['fix_pass'].genPass();
			$sql=mysql_query("SELECT * FROM mt_gen WHERE user='".$username."'");
			$row=mysql_num_rows($sql);
			
				
			if($row<=0){
				$ARRAY = $API->comm("/tool/user-manager/user/add", array(
									"customer" => $hotspot_server,	
									"username"	=> $username,
									"password"	=> $password,
                                   // "limit-uptime" => $limit_uptime,
									"copy-from"	=> $profile,
			                       // "caller-id"  => $mac ,
		                           // "address"  => $ip ,
			                       // "email"  => $email ,
			                       // "comment"  => $comments ,
									));
				 $ARRAY = $API->comm("/tool/user-manager/user/create-and-activate-profile", array(											
											//"username"	=> $username,
											//"password"  => $password,
											"profile" => $profile,
											"customer" => $hotspot_server,
							                //"caller-id"  => $caller ,//create-and-activate-profile
		                                   // "ip-address"  => $ip ,
			                              //  "email"  => $email ,
									        "numbers"	=> $username,
								));
				$group="usermanager-".$_REQUEST['fix_user']."";
				///csv start
			   fwrite($objWrite, "$username,$password,$profile \n");
			    ///csv end
				$mik_add=$mik_add+($num_check+1);
				$add=mysql_query("INSERT INTO mt_gen VALUE('".$username."','".$password."','".$limit_uptime."','".$profile."','".$hotspot_server."','".$mac."','".$ip."','".$email."','".$comment."','".$csv."','','".$group."','','".$date."','".$id."')");
				
				$i++;			
			}
		}while($i<=$num);
		
       //echo "<script>alert('สร้างรายชื่อจำนวน  ".$num." users สำเร็จแล้ว')</script>";
		//echo "<meta http-equiv='refresh' content='0;url=../system/index.php?page=listuser' />";
		echo "<script language='javascript'>swal('Save Done!','สร้างรายชื่อจำนวน  ".$num." users สำเร็จ ".$mik_add." users!','success').then(function () {
    window.location.href = '../system/index.php?page=listuser';}, function (dismiss) {
  if (dismiss === 'overlay') {
    window.location.href = '../system/index.php?page=listuser';
   }})</script>";
		exit();
?>
