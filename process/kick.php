<?php
	include_once("../include/class.mysqldb.php");
	include_once("../include/config.inc.php");
	include_once('../config/routeros_api.class.php');			
	include_once('../include/conn.php');
	echo "<meta charset='utf-8'>" ;
	$ARRAY = $API->comm("/ip/hotspot/active/print");
	$ARRAY2 = $API->comm("/ip/hotspot/host/print");
	$ARRAY3 = $API->comm("/ppp/active/print");
	$ARRAY4 = $API->comm("/ip/hotspot/active/print");

	                
					 
                        if ($_GET['user']!=""){
	                    if ($_GET['return']=="mik"){
		                         $num =count($ARRAY);
		                           $no=0;
	                             for($i=0; $i<$num; $i++){
	                            if($ARRAY[$i]['user']==$_GET['user']){$user = $i;
	                        $no=($no+1);
	                          //echo $user;
							  $ARRAY4 = $API->comm("/ip/hotspot/active/remove
			             		=.id=".$user."");
	                           }}
                        	

                             	echo "<script language='javascript'>swal('Kick User Successfully!','kicked user ".$_GET['user']." จำนวน ".$no." สำเร็จแล้ว!','success').then(function () {
                                  window.history.back();}, function (dismiss) {
                                 if (dismiss === 'overlay') {
                                   window.history.back();}})</script>"; 
                         	exit;
                           	 }
	                  if ($_GET['return']=="userman"){
	              	   $num =count($ARRAY);
		                 $no=0;
	                       for($i=0; $i<$num; $i++){
	                        if($ARRAY[$i]['user']==$_GET['user']){$user = $i;
	                             $no=($no+1);
	                         //  echo $user;
							 $ARRAY4 = $API->comm("/ip/hotspot/active/remove
						=.id=".$user."");
	                           }}
	                    
                          	echo "<script language='javascript'>swal('Kick User Successfully!','kicked user ".$_GET['user']." จำนวน ".$no." สำเร็จแล้ว!','success').then(function () {
                                   window.history.back();}, function (dismiss) {
                                  if (dismiss === 'overlay') {
                                 window.history.back();}})</script>"; 
	                        exit;
	                           }
	                              if ($_GET['return']=="useronline"){
		                          $num =count($ARRAY);
		                           $no=0;
	                               for($i=0; $i<$num; $i++){
	                               if($ARRAY[$i]['address']==$_GET['ip']){$user = $i;
	                                $no=($no+1);
	                             //  echo $user;
								 $ARRAY = $API->comm("/ip/hotspot/active/remove
						                 =.id=".$user."");
	                           }}
	                             
	                        echo "<script language='javascript'>swal('Kick User Successfully!','kicked user ".$_GET['user']." จำนวน ".$no." สำเร็จแล้ว!','success').then(function () {
                                 window.history.back();}, function (dismiss) {
                                 if (dismiss === 'overlay') {
                                 window.history.back();}})</script>"; 
	                            exit;
	                            }
								if ($_GET['return']=="host"){
		                         $num2 =count($ARRAY2);
								 $no=0;
	                             for($ii=0; $ii<$num2; $ii++){
	                             if($ARRAY2[$ii]['to-address']=="".$_GET['user'].""){$user = "".$ii."";
								  $no=($no+1);
								   $ARRAY2 = $API->comm("/ip/hotspot/host/remove
						          =.id=".$user."");
								  }}
								 
	                             
								 
								 echo "<script language='javascript'>swal('Kicked!','Kick IP. ".$_GET['user']." จำนวน ".$no." สำเร็จแล้ว!','success').then(function () {
                                       window.location.href = 'index.php?page=hostonline';}, function (dismiss) {
                                        if (dismiss === 'overlay') {
                                      window.location.href = 'index.php?page=hostonline';
                                       }})</script>";
	                            exit;
	                            }
   if ($_GET['return']=="pppoe"){
                                  $num =count($ARRAY3);
	                            for($i=0; $i<$num; $i++){
	                             if($ARRAY3[$i]['name']=="".$_GET['user'].""){$user = "".$i."";
								 $ARRAY3 = $API->comm("/ppp/active/remove
						       =.id=".$user."");
								 }}
	                           	echo "<script language='javascript'>swal('Kick User Successfully!','kicked user ".$_GET['user']." สำเร็จแล้ว!','success').then(function () {
                              window.history.back();}, function (dismiss) {
                                if (dismiss === 'overlay') {
                              window.history.back();}})</script>";
	                           exit;
                               


                                }
								}else{
								echo "<script language='javascript'>swal('Error user?','กรุณาลองใหม่!','error').then(function () {
								window.history.back();}, function (dismiss) {if (dismiss === 'overlay') {
								window.history.back();}})</script>";
								}

?>