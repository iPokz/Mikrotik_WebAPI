<?php
		
			include_once('../config/routeros_api.class.php');			
			include_once('../include/conn.php');
			include_once('../include/account.php');
			include_once('../include/convert.php');
			
			//$ARRAY = $API->comm("/ip/hotspot/user/print");
			
			 //$file = "../csv/org_csv/Gen".$_GET['id'].".csv";
		if($_REQUEST['check']!=""){
	###########################################################
			    if($_REQUEST['active']=="remove"){
				for($i=0;$i < count($_REQUEST['check']);$i++){
					
					$user=$_REQUEST['check'][$i];
					$num=count($_REQUEST['check']);
					
					mysql_query("DELETE FROM pppoe_gen WHERE user =  '".$user."'");
				   /*  $ARRAY = $API->comm("/ip/hotspot/user/remove", array(
											"numbers" => $user,
										));
					$ARRAY = $API->comm("/tool/user-manager/user/remove", array(
											"numbers" => $user,
										)); */
							
					//$img = $user.".png";
					//unlink("../qrcode/".$img);					
				}
				//echo "<script>alert('ลบจำนวน ".$num."  users สำเร็จแล้ว.')</script>";
				//echo "<script>history.back();</script>";
				echo "<script language='javascript'>swal('Delete Successfully!','ลบจำนวน ".$num."  users สำเร็จแล้ว.!','success').then(function () {
    window.location.href = 'index.php?page=pppoe_all_data_users&id=".$id."';}, function (dismiss) {
  if (dismiss === 'overlay') {
    window.location.href = 'index.php?page=pppoe_all_data_users&id=".$id."';
   }})</script>";
				exit();}
	###################################################################
			if($_REQUEST['active']=="print"){
			$group_print=date('YmdHis');
			for($i=0;$i < count($_REQUEST['check']);$i++){
					
					$user=$_REQUEST['check'][$i];
					$num=count($_REQUEST['check']);
					//echo "".$group_print."//";
        mysql_query("UPDATE pppoe_gen SET group_code='".$group_print."' WHERE user='".$user."'");


}echo "<script language='javascript'>javascript:window.open('../csv/print_pppoecard.php?to=group_code&id=".$group_print."')</script>";}
		
	###############################################################################	
		if($_REQUEST['active']=="csv"){
			$group_code=date('YmdHis');
			for($i=0;$i < count($_REQUEST['check']);$i++){
					
					$user=$_REQUEST['check'][$i];
					$num=count($_REQUEST['check']);
					
        mysql_query("UPDATE pppoe_gen SET group_code='".$group_code."' WHERE user='".$user."'");}


      echo "<script language='javascript'>javascript:window.open('../csv/export_csv.php?to=group_code&code=pppoe&id=".$group_code."')</script>";
}						
#####################################################################
          $ARRAY1 = $API->comm("/ppp/secret/print");
           $ARRAY2 = $API->comm("/ppp/profile/print");
			$num1 =count($ARRAY1);
	        $num2 =count($ARRAY2);
	        
	  		if($_REQUEST['active']=="transfer"){
				
				$mik_check=0;
			
			for($db=0;$db < count($_REQUEST['check']);$db++){
					$user_db=$_REQUEST['check'][$db];
					$num=count($_REQUEST['check']);
					
			
	$query=mysql_query("SELECT * FROM pppoe_gen WHERE user='".$user_db."'");
	                        while($db_export=mysql_fetch_array($query)){
		      $db_user=$db_export[user];                       $db_pass=$db_export[pass];
         $db_profile=$db_export[profile];                      
		 $db_comment=iconv("utf-8", "tis-620",$db_export['comment']);                    
		    $service="pppoe";
for($p=0; $p<$num2; $p++){if($db_profile==$ARRAY2[$p]['name']){
for($i=0; $i<$num1; $i++){if($ARRAY1[$i]['name']==$db_user){$db_user="";}}
if($db_user!=""){	$mik_newadd=$mik_newadd+($mik_check+1);
                
				$ARRAY = $API->comm("/ppp/secret/add", array(
									  
		            "service"	=> $service,
						"name"  => $db_user,
						"password" => $db_pass,	
							"profile"  => $db_profile, 
							//	caller-id"  => $db_mac ,
		                        //      "remote-address"  => $ip ,
			                       "comment"  => $db_comment
								  
							));
}
}}
}
}
if(($mik_newadd)!=($num)){
			 echo "<script language='javascript'>swal('Error transfer from ".$num." user!','pppoeสำเร็จ ".($mik_newadd+0)." กรุณาตรวจสอบ!','info').then(function () {
    window.location.href = 'index.php?page=pppoe_all_data_users&id=".$_GET['id']."';}, function (dismiss) {
  if (dismiss === 'overlay') {
    window.location.href = 'index.php?page=pppoe_all_data_users&id=".$_GET['id']."';
   }})</script>";
		exit();}else{echo "<script language='javascript'>swal('transfer Successfully','เพิ่ม  userสำเร็จแล้ว! จำนวนทั้งหมด ".($mik_newadd+0)." users','success').then(function () {
    window.location.href ='index.php?page=pppoe_all_data_users&id=".$_GET['id']."';}, function (dismiss) {
  if (dismiss === 'overlay') {
    window.location.href ='index.php?page=pppoe_all_data_users&id=".$_GET['id']."';
   }})</script>";
		exit();}
}        

###########################################################################		
}?>
<section class="content"> 

   
        <form name="user" action="" method="post">
		<div class="row">
         <div class="col-lg-12" >
                   <div class="<?php print panel_modify();?>">
                        <div class="<?php print $panel_heading;?>"><i class="fa fa-user"></i>
                            <strong> PPPOE ALL DATABASES USERS</strong>                            
                        <?php print $date_time_show;?></div>
						 <div class="panel-body">
						<span style="color:#ffffff;
float: left;
"><a href="index.php?page=pppoe_dtb_user" class="btn btn-default fa fa-arrow-left"></a>&nbsp;<a href="index.php?page=pppoe_all_data_users&id=<?php echo $_GET['id']; ?>" class="btn btn-default fa fa-rotate-right"></a> </span><?php  echo "<span class=\"\">";           
	                                
									$tran_use="on";
									$text="select transfer to mikrotik user";
							   $tran=botton_small_account($account,'','','','',$tran_use,$text);
							  echo "<span  style=\"float: right; \">".$tran."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>";
	                        ?><br><br>
							<table class="table table-striped table-hover" id="dataTables-example">
                                  <thead>
                                        <tr>   
											<th width="3%"><input type="checkbox" id="selecctall"/></th>  
                                        	<th>NO.</th>                                                                         	
                                            <th>USERNAME</th>                                            
                                            <th>PROFILES</th>
											
											<th>MAC LOGIN</th>
											<th>COMMENT</th>
											<th class="text-center">วันที่ Login</th>
                                            <th class="text-center">ACTION</th>                                                                                        
                                        </tr>
										<tfoot>   
											<th width="3%"><input type="checkbox" id="selecctall1"/></th>  
                                        	<th>NO.</th>                                                                         	
                                            <th>USERNAME</th>                                            
                                            <th>PROFILES</th>
											
											<th>MAC LOGIN</th>
											<th>COMMENT</th>
											<th class="text-center">วันที่ Login</th>
                                            <th class="text-center">ACTION</th>                                                                                        
                                        </tfoot>
                                    </thead>
                                    <?php
                                                    
													$mt_id=$_GET['id'];
													
													$query=mysql_query("SELECT * FROM pppoe_gen WHERE mt_id='".$mt_id."'");
												$i=0;
													while($result=mysql_fetch_array($query)){
														$i++;
													echo "<tr>";
															echo "<td><input class=\"checkbox1\" type=\"checkbox\" name=\"check[]\" id=\"check[]\" value=".$result['user']."></td>";		
															echo "<td>".$i."</td>";								
															echo "<td>".$result['user']."</td>";
															echo "<td>".$result['profile']."</td>";	
															
															echo "<td>".$result['caller_id']."</td>";
															echo "<td>".$result['comment']."</td>";
															echo "<td class=\"text-center\">";
                                                         ###ตรวจสอบโปรไฟล์ที่กำหนด expireและprice (วันหมดอายุและราคามีครบหรือยัง?)###
							$exp=mysql_fetch_array(mysql_query("SELECT * FROM pppoe_pro WHERE pro_name='".$result['profile']."'"));
	                        $check_profile=$exp['pro_expire'];
							$check_price=$exp['pro_price'];
							###ตรวจสอบความถูกต้องของ comment  ###
                           if((($check_profile) && ($check_price))>0){
							 $check_comment=substr("".$result['comment']."",-30,11);
						  $comm1_check_arr=substr("".$check_comment."",-5,1); //jan/16/2017อิงเครื่องหมาย ../../..
			             $comm2_check_arr=substr("".$check_comment."",-8,1); //jan/16/2017อิงเครื่องหมาย ../../..
			              $check1_comment=array("/"=>"normal");
			              $check2_comment=array("/"=>"normal");
		                   $for_school1=$check1_comment[$comm1_check_arr];
		                  $for_school2=$check2_comment[$comm2_check_arr];
                         ###ถ้า commentมาจากที่ระบบสร้างให้###
		                   if(!empty($for_school1 && $for_school2)){  echo Convert_time($check_comment);    }}
						### ##### }} ###จบสคริปคัดกรอง comment ###
															echo"</td>";
															echo "<td class=\"text-center\">";
												
                                                            echo "<div class=\"btn-group\"><button type=\"button\" class=\"btn btn-info btn-xs dropdown-toggle\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\" onclick=\"swal({
                                                         title: 'เลือกดำเนินการ?',
                                                          text: '".$result['user']."',
                                                       type: 'question',
                                                      showCloseButton: true,
                                                showCancelButton: true,
                                                 confirmButtonColor: '#ff8000',
                                                  cancelButtonColor: '#d33',
                                                   confirmButtonText: 'แก้ไข!',
                                                    cancelButtonText: 'ลบ!',
                                                    //confirmButtonClass: 'btn btn-success',
                                                       //cancelButtonClass: 'btn btn-black',
                                                               // buttonsStyling: false
                                                               }).then(function () {
                                                              window.location.href = 'index.php?page=pppoe_edituser&return=pppoe_allDB&code=".$mt_id."&id=".$result['user']."';
                                                          }, function (dismiss) {
                       // dismiss can be 'cancel', 'overlay',
                         // 'close', and 'timer'
                           if (dismiss === 'cancel') {
                      swal({
                     title: 'Are you sure?',
                    text: 'ต้องการจะลบ  ".$result['user']."  จริงหรือไม่ ?',
                    type: 'warning',
	                showCloseButton: true,
	                showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, cancel!',
														}).then(
                    function () {
                    window.location.href = 'index.php?page=delete&return=pppoe_allDB&code=".$mt_id."&id=".$result['user']."';})}})\"> เลือกดำเนินการ <span ></button></div>";
												
													   echo "</td>";							
														echo "</tr>";
													
													}
												?>

										                   
                                </table>
                            <!-- /#page-wrapper -->
								<div class="form-group input-group">                                        
                                       &nbsp;&nbsp;&nbsp;
									   <?php
									# $delete_use="on";
									 # $disable_use="on";
									  #$enable_use="on";
									   $print_use="on";
									   $csv_use="on";
                               $del=botton_account($account,$delete_use);
                               $dis=botton_account($account,'',$disable_use);
							   $ena=botton_account($account,'','',$enable_use);
							   $pri=botton_account($account,'','','','',$print_use);
							   $csv=botton_account($account,'','','','','',$csv_use);
							   $bottonbtn_danger="on";
				$text_danger="<i class=\"fa fa-times\"></i>&nbsp;Delete&nbsp;";
               $delete_button= button_btn_submit_account($account,$text_danger,'',$bottonbtn_danger);
									echo $delete_button; echo $del ;echo $dis; echo $ena;echo $pri;echo $csv;
				?>
									 <!--   <button class="btn btn-danger" title= "select to remove" type="submit"><i class="fa fa-times"></i>&nbsp;Delete&nbsp;</button>  -->
									   
									   
									    </div>
										 </div>
									   </div>
                                    </div>
									 </div>
									 </form>
								
  </section>
    