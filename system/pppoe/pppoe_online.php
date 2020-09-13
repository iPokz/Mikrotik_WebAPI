<?php
				
			include_once('../config/routeros_api.class.php');			
			include_once('../include/conn.php');
			include_once('../include/account.php');
			include_once('../include/convert.php');
																																															
			$ARRAY = $API->comm("/ppp/active/print");
			$ARRAY2 = $API->comm("/ppp/secret/print");
			//$ARRAY3 = $API->comm("/tool/user-manager/user/print");
			if($_REQUEST['check']!=""){	
				if($_REQUEST['active']!="set"){
				for($i=0;$i < count($_REQUEST['check']);$i++){
					$user=$_REQUEST['check'][$i];
					$num=count($_REQUEST['check']);
					$active = $_REQUEST['active'];if($active=="remove"){$acctive = "DELETE";}
					$num3 =count($ARRAY);
					for($iii=0; $iii<$num3; $iii++){
					if($ARRAY[$iii]['name']=="".$user.""){$user2 = "".$iii."";}
					
					
					
					
				}
				mysql_query("".$acctive." FROM pppoe_gen WHERE user =  '".$user."'");
					
						$ARRAY2 = $API->comm("/ppp/secret/".$active."", array(
											"numbers" => $user,));
						
						$ARRAY = $API->comm("/ppp/active/remove
						                         =.id=".$user2."");
				}
                 
				//echo "<script>alert('".$active." จำนวน ".$num."  users สำเร็จแล้ว.')</script>";
				//echo "<script>history.back();</script>";
				//echo "<meta http-equiv='refresh' content='0;url=index.php?page=pppoe_online' />";
				echo "<script language='javascript'>swal('".$active." Successfully!','".$active." จำนวน ".$num."  users สำเร็จแล้ว!','success').then(function () {
    window.location.href = 'index.php?page=pppoe_online';}, function (dismiss) {if (dismiss === 'overlay') {
    window.location.href = 'index.php?page=pppoe_online';}})</script>";
				exit();
						
				}}
?>
<section class="content"> 
 
	<form name="name" action="" method="post">
	<div class="<?php print panel_modify();?>">
     <div class="<?php print $panel_heading;?>"><i class="fa fa-flash"></i><i class="fa fa-user"></i>
                            <strong> PPPOE ONLINE </strong>
         <?php print $date_time_show;?></div>
     <div class="panel-body">
    <table class="table table-striped table-hover" id="dataTables-example">
    <thead>
    <tr>
            <th width="3%"><input type="checkbox" id="selecctall"/></th>
			<th>NO.</th>
            <th>NAME</th>
            <th>IP ADDRESS</th>
			<th>CALLER ID</th>
			<th>UPTIME</th>
			<th>SESSION TIMELEFT</th>
			<th>COMMENT</th>
            <th class="text-center">ACTION</th>
                                                     </tr>
													 <tfoot>
            <th width="3%"><input type="checkbox" id="selecctall"/></th>
			<th>NO.</th>
            <th>NAME</th>
            <th>IP ADDRESS</th>
			<th>CALLER ID</th>
			<th>UPTIME</th>
			<th>SESSION TIMELEFT</th>
			<th>COMMENT</th>
            <th class="text-center">ACTION</th>
                                                     </tfoot>
                                                      </thead>
													   <tbody>
	                                                  <?php
		                                               $num =count($ARRAY);
                                                       $num2 =count($ARRAY2);
		                                              for($i=0; $i<$num; $i++){	
		                                               $no=$i+1;
													   // <!--start update mac-address and ip-address to databases-->  //
						mysql_query("UPDATE pppoe_gen SET caller_id='".$ARRAY[$i]['caller-id']."', address='".$ARRAY[$i]['address']."' WHERE user='".$ARRAY[$i]['name']."'");
						/*<!--End update --> */
	

                                                        echo "<tr>";
													    echo "<td><center><input class=\"checkbox1\" type=\"checkbox\" name=\"check[]\" id=\"check[]\" value=".$ARRAY[$i]['name']."></center></td>";		
													    echo "<td>".$no."</td>";													
														echo "<td>".$ARRAY[$i]['name']."</td>";											
														////echo "<td>".$ARRAY[$i]['service']."</td>";
														echo "<td>".$ARRAY[$i]['address']."</td>";
														echo "<td>".$ARRAY[$i]['caller-id']."</td>";
														echo "<td>".$ARRAY[$i]['uptime']."</td>";
														 echo "<td>";
									$user_seek= $API->comm("/ppp/secret/print", array(
									"from" => $ARRAY[$i]['name'],));
		###ตรวจสอบโปรไฟล์ที่กำหนด expireและprice (วันหมดอายุและราคามีครบหรือยัง?)###
							$exp=mysql_fetch_array(mysql_query("SELECT * FROM pppoe_pro WHERE pro_name='".$user_seek['0']['profile']."'"));
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
				echo $count=exp_time($convert_total,$dd,$ff);}}
				                                       echo "</td>";
														 echo "<td>";
                                                        for($ii=0; $ii<$num2; $ii++){
                                                                if($ARRAY2[$ii]['name']==$ARRAY[$i]['name']){
                                                            echo iconv("tis-620", "utf-8",$ARRAY2[$ii]['comment']);

                                                                }else{//
																}

                                                        }       echo "</td>";
														 echo "<td class=\"text-center\">";
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
                    window.location.href = 'index.php?page=kick&return=pppoe&user=".$ARRAY[$i]['name']."';})\"";
					echo  button_btn_xs_account($account,$onclick_kick,'','','','',$xs_kick,$text_kick);
					                        
				
				                                               echo "</td>";
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
									 # $enable_use="on";
									#  $edit_use="on";
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

	   