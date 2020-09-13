<?php
	include_once('../config/routeros_api.class.php');			
	include_once('../include/conn.php');
	include_once('../include/account.php');
	$ARRAY2 = $API->comm("/tool/user-manager/profile/print");
	echo "<meta charset='utf-8'>" ;
	$user=$_GET['id'];
    $cancel="no";
	if($account=="read"){$cancel="yes";}
	if($account=="write"){$cancel="yes";}
	
    	if($cancel!="yes"){
	if($_GET['return']=="mik"){
	$ARRAY = $API->comm("/ip/hotspot/user/remove", array(
								"numbers" => $user,
							));
		mysql_query("DELETE FROM mt_gen WHERE user = '".$user."' ");
		echo "<script language='javascript'>swal('Delete Successfully!','ลบ ".$user." สำเร็จแล้ว!','success').then(function () {
    window.location.href = 'index.php?page=mikrotikuser';}, function (dismiss) {
  if (dismiss === 'overlay') {
    window.location.href = 'index.php?page=mikrotikuser';}})</script>";
		exit;}

	
	
	if($_GET['return']=="userman"){
		$num2 =count($ARRAY2);
					for($ii=0; $ii<$num2; $ii++){
					if($ARRAY2[$ii]['name'] ==$user){$username=$ARRAY2[$ii]['name'];}}
		if($user==$username){echo "<script language='javascript'>swal('Can Not Remove User  ".$user."!','จะมีผลกับการสร้างuser ในprofile ".$user."','error').then(function () {
    window.location.href = 'index.php?page=usermanager';}, function (dismiss) {if (dismiss === 'overlay') {
    window.location.href = 'index.php?page=usermanager';}})</script>";}else{

		$ARRAY = $API->comm("/tool/user-manager/user/remove", array(
								"numbers" => $user,
							));
		mysql_query("DELETE FROM mt_gen WHERE user = '".$user."' ");

		echo "<script language='javascript'>swal('Delete Successfully!','ลบ ".$user." สำเร็จแล้ว!','success').then(function () {
    window.location.href = 'index.php?page=usermanager';}, function (dismiss) {
  if (dismiss === 'overlay') {
    window.location.href = 'index.php?page=usermanager';}})</script>";
	}}

	
	
	if($_GET['return']=="pppoe"){
	$ARRAY = $API->comm("/ppp/secret/remove", array(
								"numbers" => $user,
							));	
		mysql_query("DELETE FROM pppoe_gen WHERE user = '".$user."' ");
		echo "<script language='javascript'>swal('Delete Successfully!','ลบ ".$user."  สำเร็จแล้ว!','success').then(function () {
    window.location.href = 'index.php?page=pppoe_mik_user';}, function (dismiss) {
  if (dismiss === 'overlay') {
    
     window.location.href = 'index.php?page=pppoe_mik_user';}})</script>";
		exit;}

	
	
	if($_GET['return']=="allDB"){
	mysql_query("DELETE FROM mt_gen WHERE user =  '".$user."'");
     echo "<script language='javascript'>swal('Delete Successfully!','ลบ ".$user." สำเร็จแล้ว!','success').then(function () {
      window.location.href = 'index.php?page=all_data_users&id=".$id."';}, function (dismiss) {
      if (dismiss === 'overlay') {
    
     window.location.href = 'index.php?page=all_data_users&id=".$id."';}})</script>";
	exit;}

	
	
	if($_GET['return']=="DB"){
	 mysql_query("DELETE FROM mt_gen WHERE user =  '".$user."'");
     echo "<script language='javascript'>swal('Delete Successfully!','ลบ ".$user." สำเร็จแล้ว!','success').then(function () {
      window.location.href = 'index.php?page=user&id=".$_GET['code']."';}, function (dismiss) {
      if (dismiss === 'overlay') {
    
     window.location.href = 'index.php?page=user&id=".$_GET['code']."';}})</script>";
	exit;}

	
	
	if($_GET['return']=="pppoe_allDB"){mysql_query("DELETE FROM pppoe_gen WHERE user =  '".$user."'");
     echo "<script language='javascript'>swal('Delete Successfully!','ลบ ".$user."  สำเร็จแล้ว!','success').then(function () {
    window.location.href = 'index.php?page=pppoe_all_data_users&id=".$id."';}, function (dismiss) {
  if (dismiss === 'overlay') {
   window.location.href = 'index.php?page=pppoe_all_data_users&id=".$id."';}})</script>";
	exit;}

	
	
	if($_GET['return']=="pppoe_DB"){
		mysql_query("DELETE FROM pppoe_gen WHERE user =  '".$user."'");
     echo "<script language='javascript'>swal('Delete Successfully!','ลบ ".$user."  สำเร็จแล้ว!','success').then(function () {
    window.location.href = 'index.php?page=pppoe_user&id=".$_GET['code']."';}, function (dismiss) {
  if (dismiss === 'overlay') {
    window.location.href = 'index.php?page=pppoe_user&id=".$_GET['code']."';}})</script>";
	exit;}
		}else{
			
	##############################################################################################################		
	if($_GET['return']=="mik"){

		echo "<script language='javascript'>swal('Can Not Remove User  ".$user."!','ระบบไม่อนุญาตสิทธิ์ ในการลบ!','error').then(function () {
    window.location.href = 'index.php?page=mikrotikuser';}, function (dismiss) {
  if (dismiss === 'overlay') {
    window.location.href = 'index.php?page=mikrotikuser';}})</script>";
		exit;}

	
	
	if($_GET['return']=="userman"){

    echo "<script language='javascript'>swal('Can Not Remove User  ".$user."!','ระบบไม่อนุญาตสิทธิ์ ในการลบ!','error').then(function () {
    window.location.href = 'index.php?page=usermanager';}, function (dismiss) {
  if (dismiss === 'overlay') {
    window.location.href = 'index.php?page=usermanager';}})</script>";
	}

	
	
	if($_GET['return']=="pppoe"){

		echo "<script language='javascript'>swal('Can Not Remove User  ".$user."!','ระบบไม่อนุญาตสิทธิ์ ในการลบ!','error').then(function () {
    window.location.href = 'index.php?page=pppoe_mik_user';}, function (dismiss) {
  if (dismiss === 'overlay') {
    
     window.location.href = 'index.php?page=pppoe_mik_user';}})</script>";
		exit;}

	
	
	if($_GET['return']=="allDB"){

     echo "<script language='javascript'>swal('Can Not Remove User  ".$user."!','ระบบไม่อนุญาตสิทธิ์ ในการลบ!','error').then(function () {
      window.location.href = 'index.php?page=all_data_users&id=".$id."';}, function (dismiss) {
      if (dismiss === 'overlay') {
    
     window.location.href = 'index.php?page=all_data_users&id=".$id."';}})</script>";
	exit;}

	
	
	if($_GET['return']=="DB"){

     echo "<script language='javascript'>swal('Can Not Remove User  ".$user."!','ระบบไม่อนุญาตสิทธิ์ ในการลบ!','error').then(function () {
      window.location.href = 'index.php?page=user&id=".$_GET['code']."';}, function (dismiss) {
      if (dismiss === 'overlay') {
    
     window.location.href = 'index.php?page=user&id=".$_GET['code']."';}})</script>";
	exit;}

	
	
	if($_GET['return']=="pppoe_allDB"){
     echo "<script language='javascript'>swal('Can Not Remove User  ".$user."!','ระบบไม่อนุญาตสิทธิ์ ในการลบ!','error').then(function () {
    window.location.href = 'index.php?page=pppoe_all_data_users&id=".$id."';}, function (dismiss) {
  if (dismiss === 'overlay') {
   window.location.href = 'index.php?page=pppoe_all_data_users&id=".$id."';}})</script>";
	exit;}

	
	
	if($_GET['return']=="pppoe_DB"){
	
     echo "<script language='javascript'>swal('Can Not Remove User  ".$user."!','ระบบไม่อนุญาตสิทธิ์ ในการลบ!','error').then(function () {
    window.location.href = 'index.php?page=pppoe_user&id=".$_GET['code']."';}, function (dismiss) {
  if (dismiss === 'overlay') {
    window.location.href = 'index.php?page=pppoe_user&id=".$_GET['code']."';}})</script>";
	exit;}			
			
}

?>