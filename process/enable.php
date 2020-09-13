<?php
	include_once('../config/routeros_api.class.php');			
	include_once('../include/conn.php');
	echo "<meta charset='utf-8'>" ;
	$username=$_GET['user'];
	if($_GET['return']=="mik"){
	$ARRAY = $API->comm("/ip/hotspot/user/enable
						=.id=".$_GET['user']."");	
	 echo "<script language='javascript'>swal('Enabled Successfully!','Enable User ".$username." สำเร็จแล้ว!','success').then(function () {
    window.history.back();}, function (dismiss) {
  if (dismiss === 'overlay') {
    window.history.back();}})</script>";
	exit;}
	if($_GET['return']=="userman"){
	$ARRAY = $API->comm("/tool/user-manager/user/enable
						=.id=".$_GET['user']."");
	 	
	echo "<script language='javascript'>swal('Enabled Successfully!','Enable User ".$username." สำเร็จแล้ว!','success').then(function () {
    window.location.href = 'index.php?page=usermanager';}, function (dismiss) {
  if (dismiss === 'overlay') {
    window.location.href = 'index.php?page=usermanager';}})</script>";
	exit;}
	if($_GET['return']=="pppoe"){
	$ARRAY = $API->comm("/ppp/secret/enable
						=.id=".$_GET['user']."");		
		
	echo "<script language='javascript'>swal('Enabled Successfully!','Enable User ".$username." สำเร็จแล้ว!','success').then(function () {
    window.location.href = 'index.php?page=pppoe_mik_user';}, function (dismiss) {
  if (dismiss === 'overlay') {
    
     window.location.href = 'index.php?page=pppoe_mik_user';}})</script>";
	exit;}

?>