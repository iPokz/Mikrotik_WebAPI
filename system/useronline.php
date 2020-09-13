<?php
				
			include_once('../config/routeros_api.class.php');			
			include_once('../include/conn.php');
			include_once('../include/account.php');
			include_once('../include/convert.php');
																																															
			$ARRAY = $API->comm("/ip/hotspot/active/print");
			$ARRAY2 = $API->comm("/ip/hotspot/user/print");
			$ARRAY3 = $API->comm("/tool/user-manager/user/print");
			$ARRAY4 = $API->comm("/ip/hotspot/active/print");
			if($_REQUEST['check']!=""){			
				for($i=0;$i < count($_REQUEST['check']);$i++){
					$user=$_REQUEST['check'][$i];
					$num=count($_REQUEST['check']);
					$active = $_REQUEST['active'];if($active=="remove"){$acctive = "DELETE";}
					$num4 =count($ARRAY4);
					for($ino1=0; $ino1<$num4; $ino1++){
					if($ARRAY4[$ino1]['user']=="".$user.""){$user2 = "".$ino1."";
				    
					mysql_query("".$acctive." FROM mt_gen WHERE user =  '".$user."'");
					
						$ARRAY2 = $API->comm("/ip/hotspot/user/".$active."", array(
											"numbers" => $user,));
						$ARRAY3 = $API->comm("/tool/user-manager/user/".$active."", array(
											"numbers" => $user,));
						$ARRAY = $API->comm("/ip/hotspot/active/remove
						                         =.id=".$user2."");  
					}}
			
												 
				}
                 
				echo "<script language='javascript'>swal('".$active." Successfully!','".$active." จำนวน ".$num."  users  สำเร็จแล้ว!','success').then(function () {
    window.location.href = 'index.php?page=useronline';}, function (dismiss) {if (dismiss === 'overlay') {
    window.location.href = 'index.php?page=useronline';}})</script>";
				exit(); 
						
		}
?>

<section class="content"> 

	<form name="name" action="" method="post">
	<div class="<?php print panel_modify();?>">
     <div class="<?php print $panel_heading;?>"><i class="fa fa-flash"></i><i class="fa fa-user"></i>
                            <strong>HOTSPOT USER ONLINE </strong><?php print $date_time_show;?></div>
     <div class="panel-body">
    <table class="table table-striped table-hover" id="dataTables-example">
    <thead>
    <tr>
            <th><input type="checkbox" id="selecctall"/></th>
			<th>NO.</th>
            <th>USERNAME</th>
            <th>ADDRESS</th>
			<th>MAC ADDRESS</th>
			<!--<th>UPTIME</th>-->
			<th>SESSION TIMELEFT</th>
			<th>COMMENT</th>
            <th>LOGIN BY</th>
            <th class="text-center">ACTION</th>
                                                     </tr>
													 <tfoot>
            <th><input type="checkbox" id="selecctall1"/></th>
			<th>NO.</th>
            <th>USERNAME</th>
            <th>ADDRESS</th>
			<th>MAC ADDRESS</th>
			<!--<th>UPTIME</th>-->
			<th>SESSION TIMELEFT</th>
			<th>COMMENT</th>
            <th>LOGIN BY</th>
            <th class="text-center">ACTION</th>
                                                     </tfoot>
                                                      </thead>
	                                                  <?php
                                                      

		                                               $num =count($ARRAY);
                                                       $num2 =count($ARRAY2);
													   $num3 =count($ARRAY3);
		                                              for($i=0; $i<$num; $i++){	
		                                               $no=$i+1;
													   // <!--start update mac-address and ip-address to databases-->  //
						mysql_query("UPDATE mt_gen SET mac_address='".$ARRAY[$i]['mac-address']."', ip_address='".$ARRAY[$i]['address']."' WHERE user='".$ARRAY[$i]['user']."'");
						/*<!--End update --> */
	

                                                        echo "<tr>";
													    echo "<td><center><input class=\"checkbox1\" type=\"checkbox\" name=\"check[]\" id=\"check[]\" value=".$ARRAY[$i]['user']."></center></td>";		
													    echo "<td>".$no." ";
														
														echo "</td>";													
														echo "<td>".$ARRAY[$i]['user']."</td>";											
														echo "<td>".$ARRAY[$i]['address']."</td>";
														echo "<td>".$ARRAY[$i]['mac-address']."</td>";
												        //echo "<td>".$ARRAY[$i]['uptime']."</td>";
														///echo "<td>".$ARRAY[$i]['session-time-left']."</td>";
														echo "<td>";
				                                 echo $ARRAY[$i]['session-time-left'];
				
	                                          if($ARRAY[$i]['session-time-left']==""){
												  $user_seek= $API->comm("/ip/hotspot/user/print", array(
									"from" => $ARRAY[$i]['user'],));
			
			###ตรวจสอบโปรไฟล์ที่กำหนด expireและprice (วันหมดอายุและราคามีครบหรือยัง?)###
							$exp=mysql_fetch_array(mysql_query("SELECT * FROM mt_profile WHERE pro_name='".$user_seek['0']['profile']."'"));
	                        $check_profile=$exp['pro_expire'];
							#$check_price=$exp['pro_price'];
							###ตรวจสอบความถูกต้องของ comment  ###
                           #if((($check_profile) && ($check_price))>0){
							   if(($check_profile)>0){
						 $check_comment=substr("".$user_seek['0']['comment']."",-30,20);
						  /// $check_comment=$ARRAY[$i]['comment'];
						  $comm1_check_arr=substr("".$check_comment."",-14,1); //jan/16/2017 18:26:31อิงเครื่องหมาย ../../..
			             $comm2_check_arr=substr("".$check_comment."",-17,1); //jan/16/2017 18:26:31อิงเครื่องหมาย ../../..
			              $check1_comment=array("/"=>"normal");
			              $check2_comment=array("/"=>"normal");
		                  $for_school1=$check1_comment[$comm1_check_arr];
		                  $for_school2=$check2_comment[$comm2_check_arr];
                         ###ถ้า commentมาจากที่ระบบสร้างให้ ###
		                   if(!empty($for_school1 && $for_school2)){
						###หลังจากคัดแล้ว ##### }} ###จบสคริปคัดกรอง comment ###
	          $dd=$check_comment;
			 $ff=$check_profile;
			echo $count=exp_time($convert_total,$dd,$ff);}

							   }}

														echo "</td>";	
														 echo "<td>";
                                                        for($ii=0; $ii<$num2; $ii++){
                                                                if($ARRAY2[$ii]['name']==$ARRAY[$i]['user']){
                                                                   echo iconv("tis-620", "utf-8",$ARRAY2[$ii]['comment']);

                                                                }else{//
																}

                                                        }
														for($ino2=0; $ino2<$num3; $ino2++){
                                                                if($ARRAY3[$ino2]['username']==$ARRAY[$i]['user']){echo $ARRAY3[$ino2]['comment'];}

                                                        }echo "</td>";
														echo "<td>".$ARRAY[$i]['login-by']."</td>";
                                                         echo "<td class=\"text-right\">";
                                                        $R = $ARRAY[$i]['radius'];if($R=="true"){$R = "R";}else if($R=="false"){$R = "";}
				                                        $TR = $ARRAY[$i]['radius'];if($TR=="true"){$TR = "R - radius ";}else if($TR=="false"){$TR = "";}
														if($ARRAY[$i]['radius']=="true"){ echo "<a class=\"btn btn-default btn-xs\" title= \"".$TR."\" <span></span>".$R."</a>";}
													
                                        $xs_kick="on";
										$text_kick="Kick";
							$onclick_kick="onclick=\"swal({
                    title: 'Are you sure?',
                    text: 'ต้องการจะKick  ".$ARRAY[$i]['name']."  จริงหรือไม่ ?',
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
                    window.location.href = 'index.php?page=kick&return=useronline&ip=".$ARRAY[$i]['address']."&user=".$ARRAY[$i]['user']."';})\"";
					echo  button_btn_xs_account($account,$onclick_kick,'','','','',$xs_kick,$text_kick);
					                        
			                                       
												   echo "</td>";
			                                        echo "</tr>";

                                         }
                                       ?>                         
                                       </table>
                                       <div class="form-group input-group">                                        
                                       &nbsp;&nbsp;&nbsp;
									    <?php
									    $delete_use="on";
									  $disable_use="on";
									#  $enable_use="on";
                               $del=botton_account($account,$delete_use);
                               $dis=botton_account($account,'',$disable_use);
							   $ena=botton_account($account,'','',$enable_use);
									echo $del ;echo $dis; echo $ena;
									  
				                       ?>
									  
                      </div>
					    </div>
						  </div>
						  </form>
					 
  </section>


	   