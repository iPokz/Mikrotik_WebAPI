
<?php
		
			include_once("../config/routeros_api.class.php");			
			include_once("../include/conn.php");
			include_once('../include/account.php');
			include_once('../include/convert.php');
																																
			       $ARRAY = $API->comm("/ip/hotspot/user/print");
				   $ARRAY2 = $API->comm("/ip/hotspot/active/print");
				   $ARRAY3 = $API->comm("/ip/hotspot/active/print");
				   $ARRAY4 = $API->comm("/ip/hotspot/user/profile/print");
				   $tran = $API->comm("/ip/hotspot/user/print");
                   $copy =count($tran);
				
				  if($_GET['cancel']=="yes"){mysql_query("DELETE FROM mt_edit WHERE mt_id =  '".$id."'");
				//echo "<meta http-equiv='refresh' content='0;url=index.php?page=mikrotikuser' />";
				}



				if($_REQUEST['check']!=""){	
				if($_REQUEST['active']=="remove"){$multi_function="open";}
				if($_REQUEST['active']=="disable"){$multi_function="open";}
				if($_REQUEST['active']=="enable"){$multi_function="open";}
				if($_REQUEST['active']=="transfer"){$multi_function="transfer";}
	##############################################################################
					if($multi_function=="open"){
				for($i=0;$i < count($_REQUEST['check']);$i++){
					$user=$_REQUEST['check'][$i];
					
					$num=count($_REQUEST['check']);
					$active = $_REQUEST['active'];if($active=="remove"){$acctive = "DELETE";}
					$active2 = $_REQUEST['active'];if($active=="disable"){$active2 = "remove";}
                    $num3 =count($ARRAY3);
					$n=0;
					for($ino1=0; $ino1<$num3; $ino1++){
					if($ARRAY3[$ino1]['user']==$user){
						$n=($n+1);
						$user2 = $ino1;
						
						$ARRAY2 = $API->comm("/ip/hotspot/active/".$active2."
						                         =.id=".$user2."");
						}}
                     
					$ARRAY = $API->comm("/ip/hotspot/user/".$active."", array(
											"numbers" => $user,));
					mysql_query("".$acctive." FROM mt_gen WHERE user =  '".$user."'");
					
				}
                //echo "<script>alert('".$active." จำนวน ".$num."  users สำเร็จแล้ว.')</script>";
				//echo "<meta http-equiv='refresh' content='0;url=index.php?page=mikrotikuser' />";
				echo "<script language='javascript'>swal('".$active." Successfully!','".$active." จำนวน ".$num."  users สำเร็จแล้ว!','success').then(function () {
    window.location.href='index.php?page=mikrotikuser';}, function (dismiss) {if (dismiss === 'overlay') {
    window.location.href='index.php?page=mikrotikuser';}})</script>";
				exit();
			}
	########################################################################################
			if($_REQUEST['active']=="set"){
			
			$group_code=round(date('YmdHi.s'));
				for($i=0;$i < count($_REQUEST['check']);$i++){
					$user=$_REQUEST['check'][$i];
					$num=count($_REQUEST['check']);
			
			mysql_query("INSERT INTO mt_edit VALUE('','".$user."','".$group_code."','".$id."')");
			
			}
			$sql="SELECT * FROM mt_edit WHERE group_code='".$group_code."'";
            $query=mysql_query($sql);
            $rows=mysql_num_rows($query);
			if($rows==$num){
				
	echo "<script language='javascript'>swal({
                    title: 'Are you sure?',
                    text: 'ต้องการจะแก้ไข user ".$rows." จำนวน จริงหรือไม่ ?',
                    type: 'warning',
					//allowOutsideClick: false,
					//showCloseButton: true,
					 showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes,Next!',
                    cancelButtonText: 'No, cancel!',
                    }).then(
                    function () {
                    window.location.href = 'index.php?page=edit_all&group_code=".$group_code."';}
					, function (dismiss) {
                       // dismiss can be 'cancel', 'overlay',
                         // 'close', and 'timer'
                           if (dismiss === 'cancel','overlay') {
						   window.location.href = 'index.php?page=mikrotikuser&cancel=yes';}})</script>";
				exit();
				
				
				}else{echo "<script language='javascript'>swal('Error Count numbers Try again!','เกิดผิดพลาดในการนับจำนวน กรุณาลองใหม่!','error').then(function () {window.location.href='index.php?page=mikrotikuser&cancel=yes';}, function (dismiss) {if (dismiss === 'overlay') {window.location.href = 'index.php?page=mikrotikuser&cancel=yes';}})</script>";}
			}
	#######################################################################################
			if($multi_function=="transfer"){
				$date=date('Y-m-d H:i:s');
				$csv=round(date('YmdHi.s'));
                $group="Transfer-".$csv."";
				$num_check=0;
				for($i=0;$i < count($_REQUEST['check']);$i++){
					$usermik=$_REQUEST['check'][$i];
					$num=count($_REQUEST['check']);
					$sql="SELECT user FROM mt_gen WHERE user='".$usermik."'";
		$query=mysql_query($sql);
		$rows=mysql_num_rows($query);
		if($rows>0){
			$num_fail=$num_fail+($num_check+1);
			}else{ 
					 for($co=0; $co<$copy; $co++){
		 if($tran[$co]['name']==$usermik){
        $server=$tran[$co]['server'];if($tran[$co]['server']==""){$server="all";}
		mysql_query("INSERT INTO mt_gen VALUE('".$usermik."','".$tran[$co]['password']."','".$tran[$co]['limit-uptime']."','".$tran[$co]['profile']."','".$server."','".$tran[$co]['mac-address']."','".$tran[$co]['address']."','".$tran[$co]['e-mail']."','".iconv("tis-620", "utf-8",$tran[$co]['comment'])."','".$csv."','','".$group."','','".$date."','".$id."')");	
			
			 $num_pass=$num_pass+($num_check+1);}}

				}}
									if(($num_pass)!=($num)){
			 echo "<script language='javascript'>swal('Error transfer from ".$num." user!','database สำเร็จ ".($num_pass+0)." กรุณาตรวจสอบ!','info').then(function () {
    window.location.href = 'index.php?page=mikrotikuser';}, function (dismiss) {
  if (dismiss === 'overlay') {
    window.location.href = 'index.php?page=mikrotikuser';
   }})</script>";
		exit();}else{echo "<script language='javascript'>swal('transfer Successfully','เพิ่ม  userเข้า database สำเร็จแล้ว! จำนวนทั้งหมด ".($num_pass+0)." users','success').then(function () {
    window.location.href ='index.php?page=mikrotikuser';}, function (dismiss) {
  if (dismiss === 'overlay') {
    window.location.href ='index.php?page=mikrotikuser';
   }})</script>";
		exit();}
					}
##################################################################################






}
?>
 
	  <section class="content"> 

<form name="name" action="" method="post">
	<div class="<?php print panel_modify();?>">
	<div class="<?php print $panel_heading;?>"><i class="fa fa-user"></i>
      <strong>HOTSPOT MIKROTIK USERS</strong><?php print $date_time_show;?></div>
	   <div class="panel-body">
	 <span><?php  echo "<span class=\"\">";           
	                                 $small_delete_use="on";
									  $small_disable_use="on";
									  $small_enable_use="on";
									  $small_edit_use="on";
                               $small_del=botton_small_account($account,$small_delete_use);
                               $small_dis=botton_small_account($account,'',$small_disable_use);
							   $small_ena=botton_small_account($account,'','',$small_enable_use);
							   $small_edi=botton_small_account($account,'','','',$small_edit_use);
									echo $small_del ;echo $small_dis; echo $small_ena;echo $small_edi;
									$tran_use="on";
									$text="select transfer to database user";
							  $tran=botton_small_account($account,'','','','',$tran_use,$text);
							  echo "<span  style=\"float: right; \">".$tran."</span>";
	                       ?>
     </span><br><br>
    <table class="table table-striped table-hover" id="dataTables-example">
	<thead>
                                 <tr>   
		                 <th  width="3%"><input type="checkbox" id="selecctall"/></th>  
                                            <th>NO.</th>
											<th>USERNAME</th>
											<th>PROFILE</th>
                                            <th>MAC ADDRESS</th>
                                            <th>UP / DOWNLOAD</th>
                                             <!-- <th>START DATE/TIME</th> -->
											 <th>EXPIRE or COMMENT</th>
											<th class="text-center">ACTION USERS</th>                                                 </tr>
											<tfoot>   
		                <th  width="3%"><input type="checkbox" id="selecctall1"/></th>  
                                            <th>NO.</th>
											<th>USERNAME</th>
											<th>PROFILE</th>
                                            <th>MAC ADDRESS</th>
                                            <th>UP / DOWNLOAD</th>
                                             <!-- <th>START DATE/TIME</th> -->
											 <th>EXPIRE or COMMENT</th>
											<th class="text-center">ACTION USERS</th>                                                 </tfoot>
                                             </thead>
											  <tbody>
                                               <?php
	                                                
													$num =count($ARRAY);
													$num2 =count($ARRAY2);
													for($i=0; $i<$num; $i++){	
													$no=$i+1;
													
													$check_limit=$ARRAY[$i]['limit-uptime'];
													$check_uptime=$ARRAY[$i]['uptime'];
													$check_status=$ARRAY[$i]['disabled'];
													$profile_check="0ff";
                                                    $xs_dis="on";
													$xs_enab="on";

					
					$color=Expire_color($check_limit,$check_uptime,$check_status,$profile_check);
					$href_dis="href=\"index.php?page=disable&return=mik&user=".$ARRAY[$i]['name']."\"";
                    $href_enab="href=\"index.php?page=enable&return=mik&user=".$ARRAY[$i]['name']."\"";    
					$dis_btn_xs=button_btn_xs_account($account,$href_dis,'',$xs_dis);
					$enab_btn_xs=button_btn_xs_account($account,$href_enab,'','',$xs_enab);
                    

					
		$result=mysql_fetch_array(mysql_query("SELECT * FROM mt_gen WHERE user='".$ARRAY[$i]['name']."'"));
		$mac =$ARRAY[$i]['mac-address'];if($ARRAY[$i]['mac-address']==""){$mac = $result['mac_address'];}		
		$db_comment=iconv("tis-620", "utf-8",$ARRAY[$i]['comment']);if($ARRAY[$i]['comment']==""){$db_comment = $result['comment'];}	
		$db_ip=$ARRAY[$i]['address'];if($ARRAY[$i]['address']==""){$db_ip = $result['ip_address'];}
													
													echo "<tr>";
													echo "<td>";
													if($ARRAY[$i]['name']!="default-trial"){
														echo "<center><input class=\"checkbox1\" type=\"checkbox\" name=\"check[]\" id=\"check[]\" value=".$ARRAY[$i]['name']."></center>";}
														echo "</td>";
													    echo "<td><span style=\"color:".$color.";\">".$no."</span></td>";
														echo "<td><span style=\"color:".$color.";\">";
														if($ARRAY[$i]['dynamic']=="true"){echo "trial";}else{
															echo $ARRAY[$i]['name'];}
                                                        echo "</span></td>";
														echo "<td><span style=\"color:".$color.";\">";
                                                      /*  if(($ARRAY[$i]['limit-uptime']=="1s")||($ARRAY[$i]['limit-uptime']==$ARRAY[$i]['uptime'])){
                                                        echo "<a class=\"btn btn-danger btn-xs\"\"><span></span> Expires </a>";
                                                        }else{echo "".$ARRAY[$i]['profile']."";
						                                 }*/
                                                       echo "".$ARRAY[$i]['profile']."";
						                               echo "</span></td>";
														echo "<td><span style=\"color:".$color.";\">";
                                                     
											
														echo "".$mac."";
                                                        echo "</span></td>";
                                                        echo "<td><span style=\"color:".$color.";\">";
														$bytes_in=$ARRAY[$i]['bytes-in'];if($ARRAY[$i]['bytes-in']=="0"){$bytes_in="";}else if($ARRAY[$i]['bytes-in']<1073741824){$bytes_in="".(round($ARRAY[$i]['bytes-in']/1048576,1))."Mbs/";}
														else if($ARRAY[$i]['bytes-in']>1073741824){$bytes_in="".(round($ARRAY[$i]['bytes-in']/1073741824,2))."Gbs/";}
														$bytes_out=$ARRAY[$i]['bytes-out'];if($ARRAY[$i]['bytes-out']=="0"){$bytes_out="";}else if($ARRAY[$i]['bytes-out']<1073741824){$bytes_out="".(round($ARRAY[$i]['bytes-out']/1048576,1))."Mbs";}
														else if($ARRAY[$i]['bytes-out']>1073741824){$bytes_out="".(round($ARRAY[$i]['bytes-out']/1073741824,2))."Gbs";}
														echo "".$bytes_in."".$bytes_out."";
                                                       echo "</span></td>";
														echo "<td><span style=\"color:".$color.";\">";
														//echo "".$ARRAY[$i]['comment']."";
					$dd=$ARRAY[$i]['comment'];if($ARRAY[$i]['comment']=="counters and limits for trial users"){$dd="";}
                    ###ตรวจสอบโปรไฟล์ที่กำหนด expireและprice (วันหมดอายุและราคามีครบหรือยัง?)###
							$exp=mysql_fetch_array(mysql_query("SELECT * FROM mt_profile WHERE pro_name='".$ARRAY[$i]['profile']."'"));
	                        $check_profile=$exp['pro_expire'];
							#$check_price=$exp['pro_price'];
							###ตรวจสอบความถูกต้องของ comment  ###
                           #if((($check_profile) && ($check_price))>0){
							   if(($check_profile)>0){
						 $check_comment=substr("".$ARRAY[$i]['comment']."",-30,20);
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
						$ff=$check_profile;
						    $sw_time="on";
						   $dd=$check_comment;
                         $dr=expdate($dd,$ff,$sw_time);
                          echo "หมดอายุ ".$dr;
						   }else{echo iconv("tis-620", "utf-8",$dd); }}else{echo iconv("tis-620", "utf-8",$dd); }
                          
                       echo "</span></td>";
							echo "<td class=\"text-right\">";
							$connect=0;
                       for($ii=0; $ii<$num2; $ii++){
						   
						  if($ARRAY2[$ii]['user']==$ARRAY[$i]['name']){
							  $connect=($connect+1);
							
							 
							 // <!--start update mac-address and ip-address to databases-->  //
						mysql_query("UPDATE mt_gen SET mac_address='".$ARRAY2[$ii]['mac-address']."', ip_address='".$ARRAY2[$ii]['address']."' WHERE user='".$ARRAY[$i]['name']."'");
						/*<!--End update --> */
                       
						}}
			##########################################################
						if($connect!=0){
                             $xs_kick="on";
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
                    window.location.href = 'index.php?page=kick&return=mik&user=".$ARRAY[$i]['name']."';})\"";
					echo  $kick_btn_xs=button_btn_xs_account($account,$onclick_kick,'','','','',$xs_kick,$connect);
					}
			###########################################################			
		   if($ARRAY[$i]['disabled']=="false"){echo $dis_btn_xs;}else{ echo $enab_btn_xs;}
					
        	###############################################################
					$xs_edit="on";
				   $onclick_edit="onclick=\"swal({
                    title: 'name:".$ARRAY[$i]['name']." , pass:".$ARRAY[$i]['password']."',
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
                    window.location.href ='index.php?page=editmikrotikuser&id=".$ARRAY[$i]['name']."';})\"";	 
					echo  $edit_btn_xs=button_btn_xs_account($account,$onclick_edit,'','','',$xs_edit); 	 
			####################################################################			 
					$xs_delete="on";
				$onclick_del="onclick=\"swal({
                    title: 'Are you sure?',
                    text: 'ต้องการจะลบ  ".$ARRAY[$i]['name']."  จริงหรือไม่ ?',
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
                    window.location.href = 'index.php?page=delete&return=mik&id=".$ARRAY[$i]['name']."';})\"";
                   echo  $del_btn_xs=button_btn_xs_account($account,$onclick_del,$xs_delete);      
				####################################################################		
						echo"</td>";
						echo "</tr>";
													
						}
						?>
						 </tbody>
       </table>
	 
                           
      
					                  <div class="form-group input-group">                                        
                                       &nbsp;&nbsp;&nbsp;
									   <?php

								
									  $delete_use="on";
									  $disable_use="on";
									  $enable_use="on";
									  $edit_use="on";
									 
                               $del=botton_account($account,$delete_use);
                               $dis=botton_account($account,'',$disable_use);
							   $ena=botton_account($account,'','',$enable_use);
							   $edi=botton_account($account,'','','',$edit_use);
							    
									echo $del ;echo $dis; echo $ena;echo $edi;
									
								    
										?>
									
                      </div>
					  </div>
					   </div>
					   </form>
    
              </section>  


	
