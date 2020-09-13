


	  <section class="content"> 
	 <div class="<?php print panel_modify();?>">
	 <div class="<?php print $panel_heading;?>"><a href="index.php" title="Refresh"> <i class="fa fa-spinner fa-pulse fa-1x fa-fw"></i></a>&nbsp;&nbsp;<strong>RouterOS</strong> Support version v6.43 or Latest version
	 <?php print $date_time_show;?>
	
	
   
							</div>

	   
	   <div class="panel-body">
       <table class="table table-striped table-hover">
         <thead>
    
        <tr>
            <th>STATUS <a href="#"  data-toggle="modal" data-target="#PINDetail" data-toggle="tooltip" data-placement="top" title="ดูรายละเอียด"><i class="fa fa-circle"<?php echo $security_account;?>> </i></a></th>
            <th class="text-center">IP / DNS</th>
            <th>SITE NAME</th>
			<th>ACCOUNT NAME</th>
			 <th class="text-center">Manage zone</th>
        </tr>
		
		
    </thead>
	 <?php

	 $secu=mysql_fetch_array(mysql_query("SELECT admin_pin FROM mt_config"));
	$admin_pin=$secu['admin_pin'];

if(!empty($admin_pin)&&($admin_pin==$_SESSION['security'])){
	$session_login="admin_pin";}else{
                                             if($secom_v2==$_SESSION['security']){
		$session_login="customer_pin";}else if($secom_v3==$_SESSION['security']){
		$session_login="user_pin";}		
		}
   
$sql=mysql_query("SELECT * FROM mt_config WHERE ".$session_login."='".$_SESSION['security']."'");


		while($result = mysql_fetch_array($sql)){
			$API = new routeros_api();				
			$API->debug = false;
			echo " <tr>";
	
					
					if($result['mt_num']==$result['mt_id']){
						echo " <td>";
		            if($API->connect($result['mt_ip'], $result['mt_user'], $result['mt_pass'])){echo "<a class='btn btn-success btn-xs' >ออนไลน์</a>";$conn="connect";}
					else{ echo "<a class='btn btn-danger btn-xs' >ออฟไลน์</a>";$conn="disconnect"; }
                    echo " </td>";
					echo "<td><center>";
					echo "".$result[mt_ip]."</td>";
					echo "<td>".$result[site_name]."</td>";
					echo "<td>".$result[mt_user]."</td>";
					
					echo "<td><center>";
					echo "<a class=\"btn btn-warning btn-xs\" title= \"click to edit\" href=\"index.php?page=editserver&id=".$result[mt_num]."\"><span class=\"fa fa-edit\"></span> แก้ไข  </a>&nbsp;&nbsp;";
					echo "<a class=\"btn btn-primary btn-xs\" href=\"index.php?page=add_customer_server&id=".$result[mt_num]."\"><span class=\"fa fa-tasks\"></span> เพิ่มผู้ดูแล Server ".$result[mt_id]." </a>&nbsp;&nbsp;";
					echo "<a class=\"btn btn-black btn-xs\" href=\"//".$result[mt_ip].":".$result[port_web]."\" target=\"_blank\"><span class=\"fa fa-globe\"></span> webconfig </a>&nbsp;&nbsp;";
					/*echo "<a onclick=\"return confirm('ต้องการจะลบ SERVER ID> =".$result[mt_num]."   <จริงหรือไม่ ?') \" href=\"index.php?page=deleteserver&id=".$result[mt_num]."\"*/
					echo "<a onclick=\"swal({
                    title: 'Are you sure?',
                    text: 'ต้องการจะลบ SERVER ID> ".$result[mt_num]." <จริงหรือไม่ ?',
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
                    window.location.href = 'index.php?page=deleteserver&id=".$result[mt_num]."';})\"
					class=\"btn btn-danger btn-xs\" title= \"click to remove\"><span class=\"fa fa-remove\" ></span> ลบ</a>&nbsp;&nbsp;";
					if($API->connect($result['mt_ip'], $result['mt_user'], $result['mt_pass'])){
	echo "<a class=\"btn btn-success2 btn-xs\" title= \"status $conn\" href=\"index.php?page=system_conn&id=".$result[mt_id]."&status=".$result[mt_num]."&conn=$conn\"><span class=\"fa fa-sign-in\"></span> เข้าสู่ระบบ  </a>";
	/* echo "<div class=\"btn-group\"><button type=\"button\" title= \"status $conn\"class=\"btn btn-success btn-xs dropdown-toggle\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\" ><span class=\"fa fa-sign-in\"></span>
                                                       เข้าสู่ระบบ <span class=\"caret\"></button>
													   <ul class=\"dropdown-menu\">
                                                       <li><a class=\"text-left\"  href=\"index.php?page=system_conn&id=".$result[mt_id]."&status=".$result[mt_num]."&dashboard=hotspot&conn=$conn\">HOTSPOT</a></li>
                                                       <li><a class=\"text-left\"   href=\"index.php?page=system_conn&id=".$result[mt_id]."&status=".$result[mt_num]."&dashboard=pppoe&conn=$conn\">PPPOE</a></li></div>";*/
	}else{
		echo "<a class=\"btn btn-danger btn-xs\" title= \"status $conn\" href=\"index.php?page=system_conn&id=".$result[mt_id]."&status=".$result[mt_num]."&conn=$conn\"><span class=\"fa fa-sign-in\"></span> เข้าสู่ระบบ  <span ></a>";}
					echo " </td>";
					 }else{

				    echo " <td>";
		            if($API->connect($result['mt_ip'], $result['mt_user'], $result['mt_pass'])){echo "<a class='btn btn-success btn-xs' > ออนไลน์</a>";$conn="connect";}
					else{ echo "<a class='btn btn-danger btn-xs' > ออฟไลน์</a>";$conn="disconnect"; }
                    echo " </td>";
					echo "<td><center>";
					echo "".$result[mt_ip]."</td>";
					echo "<td>".$result[site_name]."</td>";
					echo "<td>".$result[mt_user]."</td>";
					
					echo "<td class=\"text-center\">";
					echo "<a class=\"btn btn-warning btn-xs\" title= \"click to edit\" href=\"index.php?page=editserver&id=".$result[mt_num]."\"><span class=\"fa fa-edit\"></span> แก้ไข  </a>&nbsp;&nbsp;";
					echo "<a class=\"btn btn-info btn-xs\" ><span class=\"fa fa-tasks\"></span>&nbsp;&nbsp; ผู้ดูแล Server ".$result[mt_id]."&nbsp;&nbsp;&nbsp;&nbsp;  </a>&nbsp;&nbsp;";
					echo "<a class=\"btn btn-black btn-xs\" href=\"//".$result[mt_ip].":".$result[port_web]."\" target=\"_blank\"><span class=\"fa fa-globe\"></span> webconfig </a>&nbsp;&nbsp;";
					echo "<a onclick=\"swal({
                    title: 'Are you sure?',
                    text: 'ต้องการจะลบ SERVER ID> ".$result[mt_num]." <จริงหรือไม่ ?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, cancel!',
                    }).then(
                    function () {
                    window.location.href = 'index.php?page=deleteserver&id=".$result[mt_num]."';})\"
					class=\"btn btn-danger btn-xs\" title= \"click to remove\"><span class=\"fa fa-remove\" ></span> ลบ</a>&nbsp;&nbsp;";
					if($API->connect($result['mt_ip'], $result['mt_user'], $result['mt_pass'])){
	echo "<a class=\"btn btn-success2 btn-xs\"  title= \"status $conn\" href=\"index.php?page=system_conn&id=".$result[mt_id]."&status=".$result[mt_num]."&conn=$conn\"><span class=\"fa fa-sign-in\"></span> เข้าสู่ระบบ  </a>";
                    /* echo "<div class=\"btn-group\"><button type=\"button\" title= \"status $conn\"class=\"btn btn-success btn-xs dropdown-toggle\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\" ><span class=\"fa fa-sign-in\"></span>
                                                       เข้าสู่ระบบ <span class=\"caret\"></button>
													   <ul class=\"dropdown-menu\">
                                                       <li><a class=\"text-left\"  href=\"index.php?page=system_conn&id=".$result[mt_id]."&status=".$result[mt_num]."&dashboard=hotspot&conn=$conn\">HOTSPOT</a></li>
                                                       <li><a class=\"text-left\"   href=\"index.php?page=system_conn&id=".$result[mt_id]."&status=".$result[mt_num]."&dashboard=pppoe&conn=$conn\">PPPOE</a></li></div>";*/

	}else{
		echo "<a class=\"btn btn-danger btn-xs\" title= \"status $conn\" href=\"index.php?page=system_conn&id=".$result[mt_id]."&status=".$result[mt_num]."&conn=$conn\"><span class=\"fa fa-sign-in\"></span> เข้าสู่ระบบ  <span ></a>";}
					echo " </td>";
												 
								              }
					echo " </tr>";
					
                                              
					                        
				

                

		}
           

?>
 
    </table>
            </div>
            </div>
             <!-- Modal -->
        <div class="modal fade" id="Detail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          
			 <div class="modal-dialog" role="document" style="height: 600px; width: 800px;">
 <div class="<?php print panel_modify();?>">
                        <div class="<?php print $panel_heading;?>">
                           <h3 class="box-title">รายละเอียด ADMIN LOGIN ด้วย PIN สามารถจัดการได้ในระบบ</h3>
						   <div class="box-tools pull-right">
						   <button type="button" class="btn btn-box-tool" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						   </div>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Security Site Levels</th>
                                            <th><i class="fa fa-circle" style="color: #ff1c15;"></i> Lower Class</th>
                                            <th><i class="fa fa-circle" style="color: #f7d13c;"></i> Middle Class</th>
                                             <th><i class="fa fa-circle" style="color: #00ff00;"></i> High Class</th>
											 <th><i class="fa fa-circle" style="color: #00ff00;"></i> None Security</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>สร้าง ไซต์งานเพิ่ม</td>
                                            <td class="text-center"><i class="fa fa-close" style="color: #ff1c15;"></i></td>
                                            <td class="text-center"><i class="fa fa-check"  style="color: #00c600;"></td>
                                            <td class="text-center"><i class="fa fa-check"  style="color: #00c600;"></td>
											<td class="text-center"><i class="fa fa-check"  style="color: #00c600;"></td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>แก้ไข ไซต์งาน</td>
                                            <td class="text-center"><i class="fa fa-close" style="color: #ff1c15;"></i></td>
                                            <td class="text-center"><i class="fa fa-check" style="color: #00c600;"></i></td>
                                            <td class="text-center"><i class="fa fa-check"  style="color: #00c600;"></td>
											<td class="text-center"><i class="fa fa-check"  style="color: #00c600;"></td>
                                        </tr>
										<tr>
                                            <td>3</td>
                                            <td>ลบ ไซต์งาน</td>
                                            <td class="text-center"><i class="fa fa-check" style="color: #00c600;"></i></td>
                                            <td class="text-center"><i class="fa fa-check"  style="color: #00c600;"></td>
                                            <td class="text-center"><i class="fa fa-check"  style="color: #00c600;"></td>
											<td class="text-center"><i class="fa fa-check"  style="color: #00c600;"></td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td>แก้ไข รหัส PIN ของตัวเอง</td>
                                            <td class="text-center"><i class="fa fa-close" style="color: #ff1c15;"></i></td>
                                            <td class="text-center"><i class="fa fa-close"  style="color: #ff1c15;"></td>
                                            <td class="text-center"><i class="fa fa-check"  style="color: #00c600;"></td>
											<td class="text-center"><i class="fa fa-check"  style="color: #00c600;"></td>
                                        </tr>
										<tr>
                                            <td>3</td>
                                            <td>แก้ไข รหัส PIN ไซต์ที่สร้างเอง</td>
                                            <td class="text-center"><i class="fa fa-close" style="color: #ff1c15;"></i></td>
                                            <td class="text-center"><i class="fa fa-check" style="color: #00c600;"></i></td>
                                            <td class="text-center"><i class="fa fa-check"  style="color: #00c600;"></td>
											<td class="text-center"><i class="fa fa-check"  style="color: #00c600;"></td>
                                        </tr>
                                         <tr>
                                            <td>5</td>
                                            <td>มองเห็น ทุกไซต์งาน</td>
                                            <td class="text-center"><i class="fa fa-close" style="color: #ff1c15;"></i></td>
                                            <td class="text-center"><i class="fa fa-close"  style="color: #ff1c15;"></td>
                                            <td class="text-center"><i class="fa fa-check"  style="color: #00c600;"></td>
											<td class="text-center"><i class="fa fa-check"  style="color: #00c600;"></td>
                                        </tr>
                                        <tr>
                                            <td>6</td>
                                            <td>แก้ไข ทุกไซต์งาน</td>
                                            <td class="text-center"><i class="fa fa-close" style="color: #ff1c15;"></i></td>
                                            <td class="text-center"><i class="fa fa-close"  style="color: #ff1c15;"></td>
                                            <td class="text-center"><i class="fa fa-check"  style="color: #00c600;"></td>
											<td class="text-center"><i class="fa fa-check"  style="color: #00c600;"></td>
                                        </tr>
										<tr>
                                            <td>7</td>
                                            <td>ปิด-เปิดระบบ Security Site</td>
                                            <td class="text-center"><i class="fa fa-close" style="color: #ff1c15;"></i></td>
                                            <td class="text-center"><i class="fa fa-close"  style="color: #ff1c15;"></td>
                                            <td class="text-center"><i class="fa fa-check"  style="color: #00c600;"></td>
											<td class="text-center"><i class="fa fa-check"  style="color: #00c600;"></td>
                                        </tr>
                                        </center></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    </div>


          </div>				
		<!-- ##################################### -->
		<!-- Modal PINDetail-->
        <div class="modal fade" id="PINDetail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          
			 <div class="modal-dialog" role="document" style="width: 1000px;">
                 <div class="<?php print panel_modify();?>">
                        <div class="<?php print $panel_heading;?>">
                           <h3 class="box-title">รายละเอียด SITE PIN</h3>
						   <div class="box-tools pull-right">
						   <button type="button" class="btn btn-box-tool" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						   </div>
                        </div>
                        <div class="panel-body">
                            
                                 <table class="table table-striped table-hover"  id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>NO.</th>
                                             <th>Site Name</th>
											 <th>SERVER</th>
											 <th>USERNAME</th>
                                     <th><i class="fa fa-circle" style="color: #00ff00;"></i> PIN High Class</th>
									<th><i class="fa fa-circle" style="color: #f7d13c;"></i> PIN Middle Class</th>
                                     <th><i class="fa fa-circle" style="color: #ff1c15;"></i> PIN Lower Class</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                         <?php

	 $secu=mysql_fetch_array(mysql_query("SELECT admin_pin FROM mt_config"));
	$admin_pin=$secu['admin_pin'];

if(!empty($admin_pin)&&($admin_pin==$_SESSION['security'])){
	$session_login="admin_pin";}else{
                                             if($secom_v2==$_SESSION['security']){
		$session_login="customer_pin";}else if($secom_v3==$_SESSION['security']){
		$session_login="user_pin";}		
		}
   
$sql=mysql_query("SELECT * FROM mt_config WHERE ".$session_login."='".$_SESSION['security']."'");

         $no==1;
		while($result = mysql_fetch_array($sql)){
			//$API = new routeros_api();				
			//$API->debug = false;
			$no++;
          echo " <tr>";
			echo " <td>".$no."</td>"; 
			echo " <td>".$result['site_name']."</td>";
			echo " <td>".$result['mt_id']."</td>";
			echo " <td>".$_SESSION['APIUser']."</td>";
			echo " <td>****</td>";
			if($secom_v3==$_SESSION['security']){echo " <td>****</td>";}else{
			echo " <td>".$result['customer_pin']."</td>";}
			echo " <td>".$result['user_pin']."</td>";
			
			//echo " <td></td>";
			
		echo "</tr>";
					
					
					
					
					
					}?>
                                           
                                        </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    </div>


          				
		<!-- ##############/.Modal PINDetail ####################### -->
               
              </section>  

	
