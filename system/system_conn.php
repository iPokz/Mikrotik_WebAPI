<?php
	session_start();
	if(!empty($_GET['id'])){
		$_SESSION['id']=$_GET['id'];
		$_SESSION['status']=$_GET['status'];
		
	}
	
	
	
		
		if($_GET['conn']=="connect") {	
			echo "<meta http-equiv='refresh' content='0;url=../system/index.php' />";	
		}else{	
			echo "<script language='javascript'>swal('Disconnect...',
  'สถานะไม่เชื่อมต่อ!',
  'error').then(
  function () {
    window.location.href = '../admin/index.php';
}, function (dismiss) {
  if (dismiss === 'overlay') {
   window.location.href = '../admin/index.php';
   }})</script>";
			exit();
		}
?>