<?php
		
			include_once("../config/routeros_api.class.php");			
			include_once("../include/conn.php");
			include_once('../include/account.php');
			include_once('../include/convert.php');
																																
			       $ARRAY = $API->comm("/ppp/secret/print");	
		           $ARRAY2 = $API->comm("/ppp/active/print");
				   $tran = $API->comm("/ppp/secret/print");
                   $copy =count($tran);
				  
				  if($_GET['cancel']=="yes"){mysql_query("DELETE FROM mt_edit WHERE mt_id =  '".$id."'");
				//echo "<meta http-equiv='refresh' content='0;url=index.php?page=pppoe_mik_user' />";
				}

		           
		if($_REQUEST['check']!=""){
			if($_REQUEST['active']=="remove"){$multi_function="open";}
				if($_REQUEST['active']=="disable"){$multi_function="open";}
				if($_REQUEST['active']=="enable"){$multi_function="open";}
				if($_REQUEST['active']=="transfer"){$multi_function="transfer";}
	##################################################################
			if($multi_function=="open"){
				for($i=0;$i < count($_REQUEST['check']);$i++){
					$user=$_REQUEST['check'][$i];
					$num=count($_REQUEST['check']);
					$active = $_REQUEST['active'];if($active=="remove"){$acctive = "DELETE";}
					$active2 = $_REQUEST['active'];if($active=="disable"){$active2 = "remove";}
					$num3 =count($ARRAY2);
					for($iii=0; $iii<$num3; $iii++){
					if($ARRAY2[$iii]['name']=="".$user.""){$user2 = "".$iii."";
					$ARRAY2 = $API->comm("/ppp/active/".$active2."
						                         =.id=".$user2."");
					}}
					$ARRAY = $API->comm("/ppp/secret/".$active."", array(
											"numbers" => $user,));
					mysql_query("".$acctive." FROM pppoe_gen WHERE user =  '".$user."'");
					
				}
				//echo "<script>alert('".$active."  จำนวน ".$num."  users สำเร็จแล้ว.')</script>";
				//echo "<script>history.back();</script>";
				//echo "<meta http-equiv='refresh' content='0;url=index.php?page=pppoe_mik_user' />";
				echo "<script language='javascript'>swal('".$active." Successfully!','".$active." จำนวน ".$num."  users สำเร็จแล้ว!','success').then(function () {
    window.location.href ='index.php?page=pppoe_mik_user';}, function (dismiss) {if (dismiss === 'overlay') {
    window.location.href ='index.php?page=pppoe_mik_user';}})</script>";
				exit();}
	###########################################################################################
			if($_REQUEST['active']=="set"){
			
			$group_code=round(date('YmdHi.s'));
				for($i=0;$i < count($_REQUEST['check']);$i++){
					$user=$_REQUEST['check'][$i];
					$active = $_REQUEST['active'];
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
                    window.location.href ='index.php?page=pppoe_edit_all&group_code=".$group_code."';}
					, function (dismiss) {
                       // dismiss can be 'cancel', 'overlay',
                         // 'close', and 'timer'
                           if (dismiss === 'cancel','overlay') {
						   window.location.href ='index.php?page=pppoe_mik_user&cancel=yes';}})</script>";
				exit();
				
				
				}else{echo "<script language='javascript'>swal('Error Count numbers Try again!','เกิดผิดพลาดในการนับจำนวน กรุณาลองใหม่!','error').then(function () {window.location.href = 'index.php?page=pppoe_mik_user&cancel=yes';}, function (dismiss) {if (dismiss === 'overlay') {window.location.href ='index.php?page=pppoe_mik_user&cancel=yes';}})</script>";}
			}
#################################################################################################
                    if($multi_function=="transfer"){
				$date=date('Y-m-d H:i:s');
				$csv=round(date('YmdHi.s'));
                $group="Transfer-".$csv."";
				$service="pppoe";
				$num_check=0;
				for($i=0;$i < count($_REQUEST['check']);$i++){
					$usermik=$_REQUEST['check'][$i];
					$num=count($_REQUEST['check']);
					$sql="SELECT user FROM pppoe_gen WHERE user='".$usermik."'";
		$query=mysql_query($sql);
		$rows=mysql_num_rows($query);
		if($rows>0){
			$num_fail=$num_fail+($num_check+1);
			}else{ 
					 for($co=0; $co<$copy; $co++){
		 if($tran[$co]['name']==$usermik){
   
		
		mysql_query("INSERT INTO pppoe_gen VALUE('".$usermik."','".$tran[$co]['password']."','".$tran[$co]['profile']."','".$tran[$co]['caller-id']."','".$tran[$co]['address']."','".iconv("tis-620", "utf-8",$tran[$co]['comment'])."','".$csv."','','".$group."','','".$date."','".$id."')");
			
			 $num_pass=$num_pass+($num_check+1);}}

				}}
									if(($num_pass)!=($num)){
			 echo "<script language='javascript'>swal('Error transfer from ".$num." user!','database สำเร็จ ".($num_pass+0)." กรุณาตรวจสอบ!','info').then(function () {
    window.location.href = 'index.php?page=pppoe_mik_user';}, function (dismiss) {
  if (dismiss === 'overlay') {
    window.location.href = 'index.php?page=pppoe_mik_user';
   }})</script>";
		exit();}else{echo "<script language='javascript'>swal('transfer Successfully','เพิ่ม  userเข้า database สำเร็จแล้ว! จำนวนทั้งหมด ".($num_pass+0)." users','success').then(function () {
    window.location.href ='index.php?page=pppoe_mik_user';}, function (dismiss) {
  if (dismiss === 'overlay') {
    window.location.href ='index.php?page=pppoe_mik_user';
   }})</script>";
		exit();}
					}
#######################################################################


}?>
<section class="content"> 

    
<form name="name" action="" method="post">
	<div class="<?php print panel_modify();?>">
	<div class="<?php print $panel_heading;?>"><i class="fa fa-user"></i>
      <strong> PPPOE MIKROTIK USERS </strong>
	 <?php print $date_time_show;?> </div>
	  <div class="panel-body">
						   <?php 
						                  echo "<span class=\"\">";           
	                                $small_delete_use="on";
									  $small_disable_use="on";
									  $small_enable_use="on";
									  $small_edit_use="on";
									  $tran_use="on";
									$text="select transfer to database user";
                               $small_del=botton_small_account($account,$small_delete_use);
                               $small_dis=botton_small_account($account,'',$small_disable_use);
							   $small_ena=botton_small_account($account,'','',$small_enable_use);
							   $small_edi=botton_small_account($account,'','','',$small_edit_use);
							   $tran=botton_small_account($account,'','','','',$tran_use,$text);
								echo $small_del ;echo $small_dis; echo $small_ena;echo $small_edi;
									
							  
							  echo "<span  style=\"float: right; \">".$tran."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>";
	                        echo"</span><br><br>";?>
							<table class="table table-striped table-hover" id="dataTables-example">
	                           <thead>
                               <tr>   
		                      <th width="3%"><input type="checkbox" id="selecctall"/></th>  
                                            <th>NO.</th>
											<th>USERNAME</th>                                           
                                            <!-- <th>PASSWORD</th> -->
                                            <th>PROFILE</th>
										    <th>CALLER ID</th>
											 <th>COMMENT</th>
											<th class="text-center">EXPIRE DATE/TIME</th>
                                            <th class="text-center">ACTION</th>                                                                                        
                                        </tr>
										<tfoot>   
		                      <th width="3%"><input type="checkbox" id="selecctall1"/></th>  
                                            <th>NO.</th>
											<th>USERNAME</th>                                           
                                            <!-- <th>PASSWORD</th> -->
                                            <th>PROFILE</th>
										    <th>CALLER ID</th>
											<th>COMMENT</th>
											<th class="text-center">EXPIRE DATE/TIME</th>
                                            <th class="text-center">ACTION</th>                                                                                        
                                        </tfoot>
                                  </thead>
                                    <tbody>
                                        
                                            
												<?php
													$i=0;
													$num =count($ARRAY);
													$num2 =count($ARRAY2);
													for($i=0; $i<$num; $i++){	
													$no=$i+1;
			                                        ##$check_limit=$ARRAY[$i]['limit-uptime'];
													##$check_uptime=$ARRAY[$i]['uptime'];
						$check_status=$ARRAY[$i]['disabled'];
					   $profile_check="0ff";
					   $xs_dis="on";
					   $xs_enab="on";
					
					
					
					
					$color=Expire_color($check_limit,$check_uptime,$check_status,$profile_check);
					$href_dis="href=\"index.php?page=disable&return=pppoe&user=".$ARRAY[$i]['name']."&return=pppoe\"";
                    $href_enab="href=\"index.php?page=enable&return=pppoe&user=".$ARRAY[$i]['name']."\"";    
					$dis_btn_xs=button_btn_xs_account($account,$href_dis,'',$xs_dis);
					$enab_btn_xs=button_btn_xs_account($account,$href_enab,'','',$xs_enab);
					$result=mysql_fetch_array(mysql_query("SELECT * FROM pppoe_gen WHERE user='".$ARRAY[$i]['name']."'"));
					$mac =$ARRAY[$i]['caller-id'];if($mac==""){$mac = $result['caller_id'];}
					$db_comment=iconv("tis-620", "utf-8",$ARRAY[$i]['comment']);if($ARRAY[$i]['comment']==""){$db_comment = $result['comment'];}	

					


													echo "<tr>";
														echo "<td><center><input class=\"checkbox1\" type=\"checkbox\" name=\"check[]\" id=\"check[]\" value=".$ARRAY[$i]['name']."></center></td>";		
													    echo "<td><span style=\"color:".$color.";\">".$no."</span></td>";
														echo "<td><span style=\"color:".$color.";\">".$ARRAY[$i]['name']."</span></td>";														
														//echo "<td><span style=\"color:".$color.";\">".$ARRAY[$i]['password']."</span></td>";
														echo "<td><span style=\"color:".$color.";\">".$ARRAY[$i]['profile']."</span></td>";
														//echo "<td><span style=\"color:".$color.";\">".$ARRAY[$i]['caller-id']."</span></td>";
														echo "<td><span style=\"color:".$color.";\">";
                                                     
											
														echo "".$mac."";
                                                        echo "</span></td>";
														echo "<td><span style=\"color:".$color.";\">".iconv("tis-620", "utf-8",$ARRAY[$i]['comment'])."</span></td>";
								                      echo "<td><center><span style=\"color:".$color.";\">";
				
					
                            $dd=$ARRAY[$i]['comment'];
                         ###ตรวจสอบโปรไฟล์ที่กำหนด expireและprice (วันหมดอายุและราคามีครบหรือยัง?)###
							$exp=mysql_fetch_array(mysql_query("SELECT * FROM pppoe_pro WHERE pro_name='".$ARRAY[$i]['profile']."'"));
	                        $check_profile=$exp['pro_expire'];
							#$check_price=$exp['pro_price'];
							###ตรวจสอบความถูกต้องของ comment  ###
                           #if((($check_profile) && ($check_price))>0){
							   if(($check_profile)>0){
						  /// $check_comment=$ARRAY[$i]['comment'];
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
						   }}

							   echo "</span></center></td>";
														echo "<td class=\"text-right\">";
			
			
			
			#######################################################################################
			
			
			
                                                        for($ii=0; $ii<$num2; $ii++){
                       if($ARRAY2[$ii]['name']==$ARRAY[$i]['name']){
                        // <!--start update mac-address and ip-address to databases-->  //
						mysql_query("UPDATE pppoe_gen SET caller_id='".$ARRAY2[$ii]['caller-id']."', address='".$ARRAY2[$ii]['address']."' WHERE user='".$ARRAY[$i]['name']."'");
						/*<!--End update --> */
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
                    window.location.href ='index.php?page=kick&return=pppoe&user=".$ARRAY[$i]['name']."';})\"";
					echo  $kick_btn_xs=button_btn_xs_account($account,$onclick_kick,'','','','',$xs_kick,'');
                        }}
						######################################################
                    if($ARRAY[$i]['disabled']=="false"){echo $dis_btn_xs; }else{ echo $enab_btn_xs;}


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
                    window.location.href ='index.php?page=edit_pppoe_mik_user&id=".$ARRAY[$i]['name']."';})\"";	 
					echo  $edit_btn_xs=button_btn_xs_account($account,$onclick_edit,'','','',$xs_edit); 
        ######################################################################################
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
                    window.location.href ='index.php?page=delete&return=pppoe&id=".$ARRAY[$i]['name']."';})\"";
                   echo  $del_btn_xs=button_btn_xs_account($account,$onclick_del,$xs_delete); 


						                                  
                  echo "</td>";
					echo "</tr>";
                                                            
															
													
													}
												?>
                                  </thead>
								     <tbody>
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