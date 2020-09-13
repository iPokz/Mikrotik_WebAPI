<?php
				
			include_once('../config/routeros_api.class.php');			
			include_once('../include/conn.php');
			include_once('../include/account.php');
			include_once('../include/convert.php');																																												
			$ARRAY = $API->comm("/ip/hotspot/host/print");
			$ARRAY2 = $API->comm("/ip/hotspot/host/print");
			//$ARRAY2 = $API->comm("/ip/hotspot/user/print");
			//$ARRAY3 = $API->comm("/tool/user-manager/user/print");
			if($_REQUEST['check']!=""){
            if($_REQUEST['active']=="remove"){		
				for($i=0;$i < count($_REQUEST['check']);$i++){
					$user=$_REQUEST['check'][$i];
					$num=count($_REQUEST['check']);
					$active = $_REQUEST['active'];if($active=="remove"){$acctive = "DELETE";}
					$num3 =count($ARRAY2);
					for($iii=0; $iii<$num3; $iii++){
					if($ARRAY2[$iii]['to-address']=="".$user.""){$user2 = "".$iii."";}
					
					
					////$users=($ARRAY[$user]['user']);////แปล id=>user
					
				}
				/*mysql_query("".$acctive." FROM mt_gen WHERE user =  '".$user."'");
					
						$ARRAY2 = $API->comm("/ip/hotspot/user/".$active."", array(
											"numbers" => $user,));
						$ARRAY3 = $API->comm("/tool/user-manager/user/".$active."", array(
											"numbers" => $user,));
						$ARRAY = $API->comm("/ip/hotspot/active/remove
						                         =.id=".$user2."");*/
                        $ARRAY = $API->comm("/ip/hotspot/host/".$active."
						                         =.id=".$user2."");
				}
                 
				//echo "<script>alert('".$active." จำนวน ".$num."  users สำเร็จแล้ว')</script>";
				//echo "<script>history.back();</script>";
				//echo "<meta http-equiv='refresh' content='0;url=index.php?page=hostonline' />";
				echo "<script language='javascript'>swal('".$active." จำนวน ".$num."  host สำเร็จแล้ว!','','success').then(function () {
    window.location.href = 'index.php?page=hostonline';}, function (dismiss) {if (dismiss === 'overlay') {
    window.location.href = 'index.php?page=hostonline';}})</script>";
				exit();
						
		}}
?>
 <section class="content"> 

	<form name="name" action="" method="post">
	<div class="<?php print panel_modify();?>">
     <div class="<?php print $panel_heading;?>"><i class="fa fa-flash"></i><i class="fa fa-us"></i>
                            <strong> HOST CONNECT </strong><?php print $date_time_show;?></div>
     <div class="panel-body">
    <table class="table table-striped table-hover" id="dataTables-example">
    <thead>
    <tr>
            <th width="3%"><input type="checkbox" id="selecctall"/></th>
			<th>NO.</th>
            <th>ADDRESS</th>
            <th>TO ADDRESS</th>
			<th>MAC ADDRESS</th>
			<th>UPTIME</th>
			<th>COMMENT</th>
			<th class="text-center">ACTION</th>
                                                     </tr>
													 <tfoot>
            <th width="3%"><input type="checkbox" id="selecctall1"/></th>
			<th>NO.</th>
            <th>ADDRESS</th>
            <th>TO ADDRESS</th>
			<th>MAC ADDRESS</th>
			<th>UPTIME</th>
			<th>COMMENT</th>
			<th class="text-center">ACTION</th>
                                                     </tfoot>
                                                      </thead>
	                                                  <?php

                                         

		                                               $num =count($ARRAY);
                                                      // $num2 =count($ARRAY2);
		                                              for($i=0; $i<$num; $i++){	
		                                               $no=$i+1;
	

                                                        echo "<tr>";
													    echo "<td><center><input class=\"checkbox1\" type=\"checkbox\" name=\"check[]\" id=\"check[]\" value=".$ARRAY[$i]['to-address']."></center></td>";		
													    echo "<td>".$no."</td>";													
														echo "<td>".$ARRAY[$i]['address']."</td>";											
														echo "<td>".$ARRAY[$i]['to-address']."</td>";
														echo "<td>".$ARRAY[$i]['mac-address']."</td>";
														echo "<td>".$ARRAY[$i]['uptime']."</td>";
														echo "<td>".iconv("tis-620", "utf-8",$ARRAY[$i]['comment'])."</td>";
														echo "<td class=\"text-right\">";
													/*	echo "<td>".$ARRAY[$i]['session-time-left']."</td>";
														 echo "<td>";
                                                        for($ii=0; $ii<$num2; $ii++){
                                                                if($ARRAY2[$ii]['name']==$ARRAY[$i]['user']){
                                                                    echo $ARRAY2[$ii]['comment'];

                                                                }else{//
																}

                                                        }       echo "</td>";
														echo "<td>".$ARRAY[$i]['login-by']."</td>";if($ARRAY[$i]['dynamic']=="true"){$D = "D";}
				else if($ARRAY[$i]['DHCP']=="true"){$H = "H";}
				else if($ARRAY[$i]['authorized']=="true"){$A = "A";}
				DHCP   */
				
				$A = $ARRAY[$i]['authorized'];if($A=="true"){$A = "A";}else if($A=="false"){$A = "";}
				$TA = $ARRAY[$i]['authorized'];if($TA=="true"){$TA = "A- authorized ,";}else if($TA=="false"){$TA = "";}
                $D = $ARRAY[$i]['dynamic'];if($D=="true"){$D = "D";}
				$TD = $ARRAY[$i]['dynamic'];if($TD=="true"){$TD = " D-dynamic ";}
				$H = $ARRAY[$i]['DHCP'];if($H=="true"){$H = "H";}
				$TH = $ARRAY[$i]['DHCP'];if($TH=="true"){$TH = " H - DHCP ";}
				$P = $ARRAY[$i]['bypassed'];if($P=="true"){$P = "P";}else if($P=="false"){$P = "";}
                $TP = $ARRAY[$i]['bypassed'];if($TP=="true"){$TP = " P-bypassed ";}else if($TP=="false"){$TP = "";}
                $S = $ARRAY[$i]['static'];if($S=="true"){$S = "S";}
				$TS = $ARRAY[$i]['static'];if($TS=="true"){$TS = " S-static ";}
                
                {
               echo "<button class=\"btn btn-default btn-xs\" title= \"".$TA."".$TD."".$TH."".$TP."".$TS."\" data-toggle=\"tooltip\"  <span></span>".$A."".$D."".$H."".$P."".$S."</button>&nbsp;&nbsp;";
				}
				if($account!="read"){
					//echo  "<a onclick=\"return confirm('ต้องการจะ Kick> ".$ARRAY[$i]['to-address']." <จริงหรือไม่ ?') \" href='index.php?page=host_kick&user=".$ARRAY[$i]['to-address']."' class=\"btn btn-danger btn-xs\"  title= \"click to kick host \">
					echo  "<a class=\"btn btn-danger btn-xs\"  title= \"click to kick host \" onclick=\"swal({
                    title: 'Are you sure?',
                    text: 'ต้องการจะKick  ".$ARRAY[$i]['to-address']."  จริงหรือไม่ ?',
                    type: 'warning',
					//allowOutsideClick: false,
					//showCloseButton: true,
					 showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, kicked it!',
                    cancelButtonText: 'No, cancel!',
                    }).then(
                    function () {
                    window.location.href = 'index.php?page=kick&return=host&user=".$ARRAY[$i]['to-address']."';});\">
					<span class=\"glyphicon glyphicon-remove\" ></span> Kick</a></td>";
				}else{
					echo  "<a class=\"btn btn-danger btn-xs\"  title= \"click to kick host \"><span class=\"glyphicon glyphicon-remove\" ></span> Kick</a></td>";


					}
              // echo  "<a onclick=\"return confirm('ต้องการจะ Kick> ".$ARRAY[$i]['to-address']." <จริงหรือไม่ ?') \" href='../process/host_kick.php?user=".$ARRAY[$i]['to-address']."' class=\"btn btn-danger btn-xs\"  title= \"click to kick host \"><span class=\"glyphicon glyphicon-remove\" ></span> Kick</a></td>";
			   echo "</tr>";

}
?>
 
    </table>
	
	<div class="form-group input-group">

	 <?php
	 if($account!="read"){
	 echo "<button  value=\"remove\" data-toggle=\"tooltip\" title= \"select to kick host online\" name=\"active\" class=\"btn btn-danger\" type=\"submit\"><i class=\"fa fa-times\"></i>&nbsp;Remove&nbsp;</button>";
	 }else{
	 echo "<a  value=\"remove\" title= \"select to kick host online\" name=\"active\" class=\"btn btn-danger\" type=\"submit\"><i class=\"fa fa-times\"></i>&nbsp;Remove&nbsp;</a>";
	 }
				                       ?>
									    </div>
										 </div>
										  </div>
										  </form>


  </section>