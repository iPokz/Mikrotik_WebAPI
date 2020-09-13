<?php
include_once('../config/routeros_api.class.php');			
			include_once('../include/conn.php');
			include_once('../include/account.php');
			include_once('../include/convert.php');
$ARRAY = $API->comm("/ppp/profile/print");
?>
<style type="text/css">
<!--
.style1 {color: #0000FF;
         font-weight: bold;
		 }
.style2 {color: #990000; }
-->
</style>
<section class="content"> 

<div class="row">
`<div class="col-lg-12" >
             <div class="<?php print panel_modify();?>">
                <div class="<?php print $panel_heading;?>" >
                    <i class="fa fa-user"></i>&nbsp;&nbsp;<strong>PPPOE Add User - สร้างยูสเซอร์</strong> <?php print $date_time_show;?> </div>                    
                
                   <div class="panel-body">
                    <form id="add_pppoe" action="index.php?page=con_addpppoe_process" method="post">
					 
					 <div class="row">
                            <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                    <span class="style1">เลือก Package</span>
                                    <select name="package_id"  id="package_id" class="form-control" required>
					      <option value="">ต้องเลือก Package</option>
						   <?php
													$num =count($ARRAY);
													for($i=0; $i<$num; $i++){
														$seleceted = ($i == 0) ? 'selected="selected"' : '';
														echo '<option value="'.$ARRAY[$i]['name'].$selected.'">'.$ARRAY[$i]['name'].'</option>';
													}
												?>						 
							                   </select>
											   </div>
                                           </div>                            
                                    <div class="col-xs-12 col-md-6">
                                  <div class="form-group">
                                    <span class=" style1">Caller-id</span>
                                   <input name="mac" placeholder="Ex.11:22:33:44:55:66" type="text" class="form-control">  
							     </div>
                                </div>
                            </div>


						 <div class="row">
                            <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                    <span class="style1">Username</span>
                                     <input name="user"  id="user" placeholder="Username" class="form-control"  required>
						         </div>
                                </div>                            
                              <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                    <span class="style1">Password</span>
                                     <input name="pass"  id="pass" placeholder="Password" class="form-control"  required>
						           </div>
                                </div>                            
                            </div>

							<div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="cardExpiry"><span class="hidden-xs style1">Comment - เพิ่มเติม</span></label>
                                   <input name="comment" type="text" class="form-control"  maxlength="30"  placeholder="สูงสุด 30ตัวอักษร" >  
							  </div>
                                </div>
                            </div> 
            
                   
						
							
							
							<div class="row">
						<div class="col-lg-7 col-md-9 " >
                            <div class="form-group">
                                <?php
		
		                        $bottonbtn_success="on";
				$text_success="&nbsp;&nbsp;&nbsp;<i class=\"fa fa-check\"></i>&nbsp;Save&nbsp;&nbsp;&nbsp;";
               echo button_btn_submit_account($account,$text_success,$bottonbtn_success);
		
				                  ?>
								<button  class="btn btn-danger" type="reset">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-refresh"></i>&nbsp;Reset&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>&nbsp;&nbsp;&nbsp;<span class="hidden-xs"><button type="button" class="btn btn-info" data-toggle="collapse" data-target="#manual"><span class="style2">ข้อแนะนำการใช้งาน </span></button></span>

								 </div>
                              </div>
						    </div>

                  </form>
                </div>
            </div>           
			</div>
			 </div>
            
			<div id="manual" class="collapse">
            <div  class="panel content" style="font-size: 12pt; line-height: 2em;">
            <p><h1 class="style2">&nbsp;&nbsp;&nbsp;ข้อแนะนำการใช้งาน :</h1>
               <ul>
                   <li>เลือก Package, กำหนดชื่อและรหัสผ่าน</li>
                   <li>Caller-id เพิ่มเพื่อเจาะจง mac address </li>
                   
               </ul>
               </div>
			   </div>
			  
  </section>
       