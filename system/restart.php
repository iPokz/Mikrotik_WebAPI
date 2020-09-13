<?php
			header( "location: http://sn1.perfectcontroller.com/admin" ); // แก้ Path Folder
			include_once('../config/routeros_api.class.php');			
			include_once('../include/conn.php');
			include_once('../include/convert.php');

			$ARRAY = $API->comm("/system/reboot");
									   								
?>
                 