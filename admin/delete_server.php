<?php
if(!empty($_GET['id'])){
		mysql_query("DELETE FROM mt_config WHERE mt_num='".$_GET['id']."'");
		//echo "<script>alert('ลบ SERVER  สำเร็จแล้ว.')</script>";
	   // echo "<meta http-equiv=\"refresh\" content=\"0;url=index.php\">";
	   echo "<script language='javascript'>swal('ลบ SERVER  สำเร็จแล้ว!','You clicked the button!','success').then(
  function () {
  window.location.href = window.location.href = 'index.php';;}, function (dismiss) {
  if (dismiss === 'overlay') {
    window.location.href = 'index.php';
   }})</script>";
		exit(0);
	}	
?>