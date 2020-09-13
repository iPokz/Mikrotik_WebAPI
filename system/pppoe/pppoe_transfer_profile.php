<?php
		
			include_once('../config/routeros_api.class.php');			
			include_once('../include/conn.php');
			include_once('../include/account.php');
			include_once('../include/convert.php');
			$ARRAY = $API->comm("/ppp/profile/print");
			$group_code=$_GET['group_code'];
			
			$onup=":local whouser \$user;:local whoip [/ppp active get [find name=\$whouser] address];:local macaddr [/ppp active get [find name=\$whouser] caller-id];:log info \"user logged in: \$whouser Address: \$whoip Mac: \$macaddr\";{:local date [/system clock get date ];:local time [/system clock get time ];:if ( [/ppp secret get \$whouser comment ] =\"\" ) do={[/ppp secret set \$whouser comment=\"\$date \$time\"];:log info \"New PPPOE user logged in: \$whouser\"; }}";


   if($_REQUEST['active']!=''){
    $num_check=0;
	$query=mysql_query("SELECT * FROM mt_edit WHERE group_code='".$group_code."'");
					while($result=mysql_fetch_array($query)){
														$ii++;
		
		$price=$_REQUEST['price'.$result['user'].''];
		$sql="SELECT * FROM pppoe_pro WHERE pro_name='".$result['user']."'";
		$query2=mysql_query($sql);
		$rows=mysql_num_rows($query2);
		$num =count($ARRAY);
	for($i=0; $i<$num; $i++){													
	if($ARRAY[$i]['name']==$result['user']){
		
		if($rows>0){
	$num_set=$num_set+($num_check+1);
	mysql_query("UPDATE pppoe_pro SET pro_name='".$result['user']."',pro_session='".$ARRAY[$i]['session-timeout']."',
	pro_local='".$ARRAY[$i]['local-address']."',
	pro_limit='".$ARRAY[$i]['rate-limit']."',
	pro_remote='".$ARRAY[$i]['remote-address']."',
	pro_price='".$price."'
	 WHERE pro_name='".$result['user']."'");
			}else{
	$num_add=$num_add+($num_check+1);
    $name=$ARRAY[$i]['name'];
	$local=$ARRAY[$i]['local-address'];
    $remote=$ARRAY[$i]['remote-address'];
    $session=$ARRAY[$i]['session-timeout'];
    $limit=$ARRAY[$i]['rate-limit'];
    $API->comm("/ppp/profile/set", array(
									
									"on-up" => $onup,
									"numbers" => $name
								));
	
	
	mysql_query("INSERT INTO pppoe_pro VALUE('".$name."','".$local."','".$remote."','".$session."','".$limit."','','".$price."','','','','','','','')");	
			}

           
			

	}}}
	echo "<script language='javascript'>swal('transfer Successfully','เพิ่ม  Profileเข้า database สำเร็จแล้ว! จำนวนทั้งหมด ".($num_set+$num_add)."รายการ  set on-up ".($num_add+0)." รายการ','success').then(function () {
    window.location.href ='index.php?page=pppoe_profile_list&cancel=yes';}, function (dismiss) {
  if (dismiss === 'overlay') {
    window.location.href ='index.php?page=pppoe_profile_list&cancel=yes';
   }})</script>";
		exit();	
		
		}?>

<style type="text/css">
<!--
.style1 {color: #0000FF}
.style2 {color: #990000}
-->
</style>
<section class="content"> 

 <form name="login" action="" method="post">
 <div class="row">
         <div class="col-lg-12" >
            <div class="<?php print panel_modify();?>">
                <div class="<?php print $panel_heading;?>" >
                    <strong><i class="fa fa-exchange"></i>&nbsp;&nbsp;PPPOE Transfer Profile</strong>
                    <?php print $date_time_show;?></div>                    
              
                <div class="panel-body">
<?php
$query=mysql_query("SELECT * FROM mt_edit WHERE group_code='".$group_code."'");
												$i=0;
													while($result=mysql_fetch_array($query)){
														$i++;?>
				
				 <div class="row">
                            <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                    <label for="couponCode"><span class="style1">Profile Name</span></label>
                               <option  type="text"   class="form-control" required ><?php echo $result['user']; ?></option>
                                </div>                            
                            </div>
                        <div class="col-xs-12 col-md-6">
                        <div class="form-group">
                       <label for="cardExpiry"><span class=" style1">Price <?php echo $result['user']; ?></span> <img src="../img/help.png" width="16" height="16"  class="no1" data-toggle="tooltip" data-placement="right" title="กำหนดราคา ของ profile <?php echo $result['user']; ?>"></label>
	<?php $profile=mysql_fetch_array(mysql_query("SELECT * FROM pppoe_pro WHERE pro_name='".$result['user']."'"));?>
                         <input name="price<?php echo $result['user'];?>" type="text" placeholder="Ex.150" value="<?php echo $profile['pro_price']; ?>" class="form-control" required>
                               </div>
							   </div>
                        </div>   
					  <?php }?>
                           
							<br>
							<br>
							<div class="row">
						<div class="col-md-7 " > 

						
						 <?php
		               
						 $bottonbtn_success="on";
				$text_success="<i class=\"fa fa-check\"></i>&nbsp;Confirm";
               echo button_btn_submit_account($account,$text_success,$bottonbtn_success);
				?>
				

				
				<button id="btnCancel" class="btn btn-danger" type="reset"  Onclick="window.location.href = 'index.php?page=profilelist&cancel=yes'"><i class="fa fa-times"></i>&nbsp;Cancel</button>
			
				
				
				<span class="hidden-xs">&nbsp;&nbsp;<button type="button" class="btn btn-info" data-toggle="collapse" data-target="#manual"><span class="style2">ข้อแนะนำการใช้งาน </span></button></span>
				</div>
				</div>
				

				
				 </div>
				 </div>
				 </div>
				 </div>
				  </form>
						
                                    
                       <div id="manual" class="collapse">
 <div  class="panel content" style="font-size: 12pt; line-height: 2em;">
            <p><h1 class="style2">&nbsp;&nbsp;&nbsp;ข้อแนะนำการใช้งาน :</h1>
                <ul>

                    <li>เป็นรูปแบบการ copy ข้อมูลจากโปรไฟล์ แล้วถ่ายโอนข้อมูลไปยัง Database</li>
					<li>ให้กรอกข้อมูล จำนวนเงิน เป็นตัวเลข เท่านั้น เพื่อจะกำหนดรายรับแต่ล่ะโปรไฟล์ แล้วจะเป็นข้อมูลแสดง Chart</li>
                    <li>Profile ที่ยังไม่มีใน database ระบบจะ set ค่า On-upใหม่ เพื่อจะได้ใช้งานกับ ระบบจัดการ นับวันหมดอายุ และนับจำนวน รายรับ</li>
					<li>เมื่อเพิ่ม Profile ตรงส่วนนี้เสร็จแล้ว ให้ท่านไปสร้าง PPPOE Script เพื่อกำหนดวันหมดอายุของUser และ Edit Card เพื่อปริ้นบัตร</li>
					
					
            </ul>
            </p>
     
</div>
</div>
  </section>