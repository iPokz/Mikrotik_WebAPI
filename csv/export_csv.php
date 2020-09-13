
<?php
include_once("../include/class.mysqldb.php");
	include_once("../include/config.inc.php");
	 $fileName =$_GET['file'];
	 $to_export=$_GET[to];
	set_time_limit(60);	
	// $id=$_SESSION['id'];
	//$fileName = "../csv/org_csv/Gen".date("YmdHi").".csv";
      $fileName = "../csv/select_csv/Gen".$_GET[id].".csv";
      $csv=date("YmdHi");
    
	 mysql_query("SET NAMES TIS620");
       $objWrite = fopen($fileName, "w");
       $i=1;
	   if($_GET[code]=="pppoe"){
	   $sql = mysql_query("SELECT * FROM pppoe_gen WHERE ".$to_export."='".$_GET['id']."'");
       $intRows = 0;
      while($result = mysql_fetch_array($sql)) {
                             $username =  $result['user'];
							 $password  =$result['pass'];
							 $comment  =$result['comment'];
							 $pro  =$result['profile'];

		  fwrite($objWrite, "$username,$password,$comment,$pro\n");
		  $i++;
	  } fclose($objWrite);
	  echo "<meta http-equiv='refresh' content='0;url=".$fileName."' />";
	   }else{
       
       $sql = mysql_query("SELECT * FROM mt_gen WHERE ".$to_export."='".$_GET['id']."'");
       $intRows = 0;
      while($result = mysql_fetch_array($sql)) {
                             $username = $result['user'];
							 $password  =$result['pass'];
							 $comment  =$result['comment'];
							 $pro  =$result['profile'];

		  fwrite($objWrite, "$username,$password,$comment,$pro\n");
		  $i++;
	  } fclose($objWrite);
	  echo "<meta http-equiv='refresh' content='0;url=".$fileName."' />";
	   }

	/*	echo "<script language='javascript'>swal('Save Done!','สร้างรายชื่อจำนวน  ".$num." users สำเร็จแล้ว".$no."! user','success').then(function () {
    window.location.href = '../system/index.php?page=listuser';}, function (dismiss) {
  if (dismiss === 'overlay') {
    window.location.href = '../system/index.php?page=listuser';
   }})</script>";
		exit();*/
?>




	

