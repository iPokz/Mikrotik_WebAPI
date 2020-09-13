<?php
		
			include_once('../config/routeros_api.class.php');			
			include_once('../include/conn.php');
			include_once('../include/account.php');
			include_once('../include/convert.php');
																																
			
		
		?>
		<section class="content"> 
 
		
 <form name="name" action="" method="post">
        <div class="<?php print panel_modify();?>">
                        <div class="<?php print $panel_heading;?>"><i class="fa fa-credit-card"></i>
                           <strong> HOTSPOT CARD </strong><?php print $date_time_show;?> </div>
						<div class="panel-body">
						<span style="color:#ffffff;
float: left;
"><a href="index.php?page=listuser" class="btn btn-default fa fa-arrow-left"></a>&nbsp;<a href="index.php?page=card" class="btn btn-default fa fa-rotate-right"></a></span><br><br>
                       <table class="table table-striped table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>   
											<th>NO.</th>
											<th>PACKAGE</th>
                                            <th>CARD NAME</th>
                                                                                        
                                            <th>Home Page</th>
                                            <th>TIME LIMIT</th>
                                            <th>PRICE+VAT</th>
                                            <th>CALL NO.</th>
											<th>SERVER IP</th>
											<th >COLOR</th>
											<th>ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                            
												<?php

													$id=$_SESSION['id'];
													$sql="SELECT * FROM mt_profile ";
													$query=mysql_query($sql);	
													$no==1;
													While($result=mysql_fetch_array($query)){	
													$no++;
													echo "<tr>";
														 echo "<td>".$no."</td>";																		echo"<td>".$result['pro_name']."</td>";														echo"<td>".$result['card_name']."</td>";
														
														echo "<td>".$result['home_page']."</td>";
														echo "<td>".$result['time_limit']."</td>";
														echo "<td>".$result['pro_price']."+".$result['vat']."</td>";
														echo "<td>".$result['phone']."</td>";
														echo "<td>".$result['server_ip']."</td>";
														echo "<td><span style=\"color:".$result['color'].";\">".$result['color']."  <i class=\"fa fa-circle\"></i></span> </td>";
														echo "<td><a class='btn btn-warning btn-xs' title=\"click to edit\" href='index.php?page=edit_card&name=".$result['pro_name']."'><span class=\"glyphicon glyphicon-edit\"></span> แก้ไข  </a></td>";
														
													echo "</tr>";
													}
												?>
                                                                                                   
                                         </tbody>                                      
                                     </table>
									 
									  </div>
									  </div>
									  </form>
									 
  </section>
    
