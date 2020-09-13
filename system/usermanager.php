<?php
		
			include_once("../config/routeros_api.class.php");			
			include_once("../include/conn.php");
			include_once('../include/account.php');
			include_once('../include/convert.php');
					$ARRAY = $API->comm("/tool/user-manager/user/print");
				   $ARRAY2 = $API->comm("/ip/hotspot/active/print");
				   $ARRAY3 = $API->comm("/ip/hotspot/active/print");
				   $ARRAY4 = $API->comm("/tool/user-manager/profile/print");
                   $num4 =count($ARRAY4);
					
               
				  if($_REQUEST['check']!=""){
                    for($i=0;$i < count($_REQUEST['check']);$i++){
					$username=$_REQUEST['check'][$i];
					$act = $_REQUEST['active'];
					  
					  for($ino1=0; $ino1<$num4; $ino1++){
					if($ARRAY4[$ino1]['name']==$username){$usermaster=$ARRAY4[$ino1]['name'];}}}
					//echo "<script>alert('".$usermaster."')</script>";
					if($usermaster!=""){
					echo "<script language='javascript'>swal('Can Not Change User  ".$usermaster."!','จะมีผลกับการสร้างuser ในprofile ".$usermaster."','error').then(function () {
    window.location.href = 'index.php?page=usermanager';}, function (dismiss) {if (dismiss === 'overlay') {
    window.location.href = 'index.php?page=usermanager';}})</script>";
	
	                }
					if($usermaster==""){
					
				for($i=0;$i < count($_REQUEST['check']);$i++){
					$user=$_REQUEST['check'][$i];
					
					$num=count($_REQUEST['check']);
					$active = $_REQUEST['active'];if($active=="remove"){$acctive = "DELETE";}
					$active2 = $_REQUEST['active'];if($active=="disable"){$active2 = "remove";}
                    $num3 =count($ARRAY2);
					for($ino2=0; $ino2<$num3; $ino2++){
					if($ARRAY2[$ino2]['user']=="".$user.""){$user2 = "".$ino2."";
					$ARRAY3 = $API->comm("/ip/hotspot/active/".$active2."
						                         =.id=".$user2."");}
					}
					$ARRAY = $API->comm("/tool/user-manager/user/".$active."", array(
											"numbers" => $user,));
					mysql_query("".$acctive." FROM mt_gen WHERE user =  '".$user."'");
					
				}
                //echo "<script>alert('".$active." จำนวน ".$num."  users สำเร็จแล้ว.')</script>";
				//echo "<script>history.back();</script>";
				//echo "<meta http-equiv='refresh' content='0;url=index.php?page=usermanager' />";
				echo "<script language='javascript'>swal('".$active." Successfully!','".$active." จำนวน ".$num."  users สำเร็จแล้ว!','success').then(function () {
    window.location.href = 'index.php?page=usermanager';}, function (dismiss) {if (dismiss === 'overlay') {
    window.location.href = 'index.php?page=usermanager';}})</script>";
				exit();
			}
			}
?>

  <section class="content"> 

<form name="name" action="" method="post">
	<div class="<?php print panel_modify();?>">
	<div class="<?php print $panel_heading;?>"><i class="fa fa-user"></i>
      <strong>HOTSPOT USER MANAGER</strong>   <?php print $date_time_show;?>
	  </div>
	  <div class="panel-body">
	  <?php echo "<span class=\"\">";           
	                                 $small_delete_use="on";
									  $small_disable_use="on";
									  $small_enable_use="on";
                               $small_del=botton_small_account($account,$small_delete_use,'','','');
                               $small_dis=botton_small_account($account,'',$small_disable_use,'','');
							   $small_ena=botton_small_account($account,'','',$small_enable_use,'');
									echo $small_del ;echo $small_dis; echo $small_ena;
									echo"</span><br><br>";?>
	
    <table class="table table-striped table-hover" id="dataTables-example">
	<thead>
    <tr>   
		<th width="3%"><input type="checkbox" id="selecctall"/></th>  
                                            <th>NO.</th>
											<th>USERNAME</th>
											<th>MAC ADDRESS</th>
											<th>PROFILE</th>
                                             <th>UP/DOWNLOAD</th>
											<!-- <th>START DATE/TIME</th> -->
											<th>EXPIRE or COMMENT</th>
											<th class="text-center">ACTION USERS</th>
											</tr>
											 <tfoot>   
		<th width="3%"><input type="checkbox" id="selecctall1"/></th>  
                                            <th>NO.</th>
											<th>USERNAME</th>
											<th>MAC ADDRESS</th>
											<th>PROFILE</th>
                                             <th>UP/DOWNLOAD</th>
											<!-- <th>START DATE/TIME</th> -->
											<th>EXPIRE or COMMENT</th>
											<th class="text-center">ACTION USERS</th>
											</tfoot>
                                             </thead>
                                               <?php
									   
												   $i=0;
													$num =count($ARRAY);
													$num2 =count($ARRAY2);
													for($i=0; $i<$num; $i++){	
													$no=$i+1;
													//$check_limit=$ARRAY[$i]['limit-uptime'];
													//$check_uptime=$ARRAY[$i]['uptime'];
					$check_status=$ARRAY[$i]['disabled'];
					$profile_check=$ARRAY[$i]['actual-profile'];
				$color=Expire_color($check_limit,$check_uptime,$check_status,$profile_check);
													echo "<tr>";
														echo "<td><center><input class=\"checkbox1\" type=\"checkbox\" name=\"check[]\" id=\"check[]\" value=".$ARRAY[$i]['username']."></center></td>";		
													    echo "<td><span style=\"color:".$color.";\">".$no."</span></td>";
														echo "<td><span style=\"color:".$color.";\">".$ARRAY[$i]['username']."</span></td>";
														echo "<td><span style=\"color:".$color.";\">";
														$result=mysql_fetch_array(mysql_query("SELECT * FROM mt_gen WHERE user='".$ARRAY[$i]['username']."'"));
														$mac =$ARRAY[$i]['caller-id'];if($mac==""){$mac = $result['mac_address'];}
														echo "".$mac."";
														echo "</span></td>";
														echo "<td><span style=\"color:".$color.";\">";
                                                        if($ARRAY[$i]['actual-profile']==""){
                                                        echo "<a class=\"btn btn-danger btn-xs\"\"><span></span> Expires </a>";
                                                        }else{echo "".$ARRAY[$i]['actual-profile']."";
						                                 }
                                                       echo "</span></td>";
													   echo "<td><span style=\"color:".$color.";\">";
													   $upload=$ARRAY[$i]['upload-used'];if($ARRAY[$i]['upload-used']==""){$upload="";}else if($ARRAY[$i]['upload-used']<1073741824){$upload="".(round($ARRAY[$i]['upload-used']/1048576,1))."Mbs/";}
														else if($ARRAY[$i]['upload-used']>1073741824){$upload="".(round($ARRAY[$i]['upload-used']/1073741824,2))."Gbs/";}
														$download=$ARRAY[$i]['download-used'];if($ARRAY[$i]['download-used']==""){$download="";}else if($ARRAY[$i]['download-used']<1073741824){$download="".(round($ARRAY[$i]['download-used']/1048576,1))."Mbs";}
														else if($ARRAY[$i]['download-used']>1073741824){$download="".(round($ARRAY[$i]['download-used']/1073741824,2))."Gbs";}
														echo "".$upload."".$download."";
                                                        
						                               //echo "</span></td>";
														/// echo "<td>".$ARRAY[$i]['comment']."</span></td>";
                                                      echo "<td><span style=\"color:".$color.";\">";
													
					$dd=$ARRAY[$i]['comment'];
					
                    ###ตรวจสอบโปรไฟล์ที่กำหนด expireและprice (วันหมดอายุและราคามีครบหรือยัง?)###
							$exp=mysql_fetch_array(mysql_query("SELECT * FROM mt_profile WHERE pro_name='".$ARRAY[$i]['actual-profile']."'"));
	                        $check_profile=$exp['pro_expire'];
							#$check_price=$exp['pro_price'];
							###ตรวจสอบความถูกต้องของ comment  ###
                           #if((($check_profile) && ($check_price))>0){
							   if(($check_profile)>0){
						  
						   $check_comment=substr("".$ARRAY[$i]['comment']."",-30,20);
						  $comm1_check_arr=substr("".$check_comment."",-14,1); //jan/16/2017 18:26:31อิงเครื่องหมาย ../../..
			             $comm2_check_arr=substr("".$check_comment."",-17,1); //jan/16/2017 18:26:31อิงเครื่องหมาย ../../..
			              $check1_comment=array("/"=>"normal");
			              $check2_comment=array("/"=>"normal");
		                   $for_school1=$check1_comment[$comm1_check_arr];
		                  $for_school2=$check2_comment[$comm2_check_arr];
                         ###ถ้า commentมาจากที่ระบบสร้างให้ ###
		                   if(!empty($for_school1 && $for_school2)){
						###หลังจากคัดแล้ว ##### }} ###จบสคริปคัดกรอง comment ###
						$ff=$check_profile;
						    $sw_time="on";
						   $dd=$check_comment;
                         $dr=expdate($dd,$ff,$sw_time);
                          echo "หมดอายุ ".$dr;
						   }else{echo $dd;}}else{echo $dd;}


							   echo "</span></td>";
													
														 
                          echo "<td class=\"text-right\">";
						  if($account!="read"){
							  $connect=0;
                       
					   for($ii=0; $ii<$num2; $ii++){
					   if($ARRAY2[$ii]['user']==$ARRAY[$i]['username']){
						   $connect=($connect+1);
					   // <!--start update mac-address and ip-address to databases-->  //
						mysql_query("UPDATE mt_gen SET mac_address='".$ARRAY2[$ii]['mac-address']."', ip_address='".$ARRAY2[$ii]['address']."' WHERE user='".$ARRAY2[$ii]['user']."'");
						/*<!--End update --> */
						
						
					  }}   
                       if($connect!=0){ echo "<a class=\"btn btn-success2 btn-xs\" title= \"click to kick user online\" onclick=\"swal({
                    title: 'Are you sure?',
                    text: 'ต้องการจะKick  ".$ARRAY[$i]['username']."  จริงหรือไม่ ?',
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
                    window.location.href = 'index.php?page=kick&return=userman&user=".$ARRAY[$i]['username']."';});\"><span class=\"fa fa-wifi\">  </span> ".$connect." </a>&nbsp;&nbsp;";
                       }
						if($ARRAY[$i]['disabled']=="false"){
							for($ino1=0; $ino1<$num4; $ino1++){
					if($ARRAY4[$ino1]['name']==$ARRAY[$i]['username']){$error=$ARRAY4[$ino1]['name'];}}
					if($error!=$ARRAY[$i]['username']){
						echo "<a class=\"btn btn-success btn-xs\" title= \"click to disable\" href=\"index.php?page=disable&return=userman&user=".$ARRAY[$i]['username']."\"><span></span> Enable </a>&nbsp;&nbsp;";}else{
							
						echo "<a class=\"btn btn-success btn-xs\" title= \"click to disable\" onclick=\"
					swal('Can Not Disable User  ".$ARRAY[$i]['username']."!','จะมีผลกับการสร้างuser ในprofile ".$ARRAY[$i]['username']."','error').then(function () {
    window.location.href = 'index.php?page=usermanager';}, function (dismiss) {if (dismiss === 'overlay') {
    window.location.href = 'index.php?page=usermanager';}})\";><span></span> Enable </a>&nbsp;&nbsp;";}
					
                        
                         }else{
							 
                         echo "<a class=\"btn btn-black btn-xs\" title= \"click to enable\"href=\"index.php?page=enable&return=userman&user=".$ARRAY[$i]['username']."\"><span></span> Disable </a>&nbsp;&nbsp;";
                         }

						 #########################EDIT####################################
				$result=mysql_fetch_array(mysql_query("SELECT * FROM mt_gen WHERE user='".$ARRAY[$i]['username']."'"));
				$db_comment=$ARRAY[$i]['comment'];if($ARRAY[$i]['comment']==""){$db_comment = $result['comment'];}	
		
						// echo"<a class=\"btn btn-warning btn-xs\" title= \"click to edit\" href='index.php?page=editusermanager&master=".$error."&id=".$ARRAY[$i]['username']."'><span class=\"fa fa-edit\"></span>แก้ไข</a>&nbsp;&nbsp;";
                    $xs_edit="on";
				   $onclick_edit="onclick=\"swal({
                    title: 'name: ".$ARRAY[$i]['username']." , pass: ".$ARRAY[$i]['password']."',
                    text: '".$db_comment."',             
                    type: 'question',
					//allowOutsideClick: false,
					//showCloseButton: true,
					 showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, Edit!',
                    cancelButtonText: 'No, cancel!',
                    }).then(
                    function () {
              window.location.href='index.php?page=editusermanager&master=".$error."&id=".$ARRAY[$i]['username']."';})\"";	 
					echo  $edit_btn_xs=button_btn_xs_account($account,$onclick_edit,'','','',$xs_edit); 	

                         
						 ############################################################
						
						 
						 
						 echo"<a class=\"btn btn-danger btn-xs\" title= \"click to remove\" 
						 onclick=\"swal({
                    title: 'Are you sure?',
                    text: 'ต้องการจะลบ  ".$ARRAY[$i]['username']."  จริงหรือไม่ ?',
                    type: 'warning',
					//allowOutsideClick: false,
					//showCloseButton: true,
					 showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, cancel!',
                    }).then(
                    function () {
                    window.location.href = 'index.php?page=delete&return=userman&id=".$ARRAY[$i]['username']."';})\"><span class=\"fa fa-times\"></span>ลบ</a></td>";
                          }else{

						  for($ii=0; $ii<$num2; $ii++){
					   if($ARRAY2[$ii]['user']=="".$ARRAY[$i]['username']."");
					  // <!--start update mac-address and ip-address to databases-->  //
						mysql_query("UPDATE mt_gen SET mac_address='".$ARRAY2[$ii]['mac-address']."', ip_address='".$ARRAY2[$ii]['address']."' WHERE user='".$ARRAY2[$ii]['user']."'");
						/*<!--End update --> */
					  }   
                       if($ARRAY[$i]['active-sessions']==""){
                       
                        }else{ echo "<a class=\"btn btn-success2 btn-xs\" title= \"click to kick user online\" ><span class=\"fa fa-wifi\">  </span> ".$ARRAY[$i]['active-sessions']." </a>&nbsp;&nbsp;";
                        }
						if($ARRAY[$i]['disabled']=="false"){
                        echo "<a class=\"btn btn-success btn-xs\" title= \"click to disable\" ><span></span> Enable </a>&nbsp;&nbsp;";
                         }else{
                         echo "<a class=\"btn btn-black btn-xs\" title= \"click to enable\"><span></span> Disable </a>&nbsp;&nbsp;";
                         }
						 echo"<a class=\"btn btn-warning btn-xs\" title= \"click to edit\" href='index.php?page=editusermanager&id=".$ARRAY[$i]['username']."'><span class=\"fa fa-edit\"></span>แก้ไข</a>&nbsp;&nbsp;";
                         echo"<a class=\"btn btn-danger btn-xs\" title= \"click to remove\" ><span class=\"fa fa-times\"></span>ลบ</a></td>";
						  }

						 echo "</tr>";
													
						}
						?>
                         </table>
                           
                        <!-- /#page-wrapper -->
					                  <div class="form-group input-group">                                        
                                       &nbsp;&nbsp;&nbsp;
									   <?php

					                  $delete_use="on";
									  $disable_use="on";
									  $enable_use="on";
                               $del=botton_account($account,$delete_use,'','','');
                               $dis=botton_account($account,'',$disable_use,'','');
							   $ena=botton_account($account,'','',$enable_use,'');
									echo $del ;echo $dis; echo $ena;
									  
				                       ?>
								
                      </div>
					    </div>
					  </div>
					  </form>
					 
  </section>
    
