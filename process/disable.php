<?php
	include_once('../config/routeros_api.class.php');			
	include_once('../include/conn.php');
	echo "<meta charset='utf-8'>" ;
	$username=$_GET['user'];
	//&return=mik
	if($_GET['return']=="mik"){
	$ARRAY = $API->comm("/ip/hotspot/user/disable
						=.id=".$_GET['user']."");
	echo "<script language='javascript'>swal('Disabled Successfully!','Disable User ".$username." สำเร็จแล้ว!','success').then(function () {
    window.location.href = 'index.php?page=mikrotikuser';}, function (dismiss) {
  if (dismiss === 'overlay') {
    window.location.href = 'index.php?page=mikrotikuser';}})</script>";
	exit;}
	if($_GET['return']=="userman"){
	$ARRAY = $API->comm("/tool/user-manager/user/disable
						=.id=".$_GET['user']."");
	 	
	echo "<script language='javascript'>swal('Disabled Successfully!','Disable User ".$username." สำเร็จแล้ว!','success').then(function () {
    window.location.href = 'index.php?page=usermanager';}, function (dismiss) {
  if (dismiss === 'overlay') {
    window.location.href = 'index.php?page=usermanager';}})</script>";
	exit;}
	if($_GET['return']=="pppoe"){
	$ARRAY = $API->comm("/ppp/secret/disable
						=.id=".$_GET['user']."");		
		
	echo "<script language='javascript'>swal('Disabled Successfully!','Disable User ".$username." สำเร็จแล้ว!','success').then(function () {
    window.location.href = 'index.php?page=pppoe_mik_user';}, function (dismiss) {
  if (dismiss === 'overlay') {
    
     window.location.href = 'index.php?page=pppoe_mik_user';}})</script>";
	exit;}
	
						
?>