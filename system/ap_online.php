<?php

    include_once('../config/routeros_api.class.php');
    include_once('../include/conn.php');
	include_once('../include/convert.php');

        //$ARRAY3 = $API->comm("/ip/hotspot/user/print");
       // $ARRAY2 = $API->comm("/system/scheduler/print");
        $ARRAY = $API->comm("/ip/neighbor/print");                                                                                   
?>
<section class="content"> 
 
            <div class="row">
                <div class="col-lg-12">
                    <div class="<?php print panel_modify();?>">
                        <div class="<?php print $panel_heading;?>">
                            <strong>Access Points</strong>
                        <?php print $date_time_show;?></div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>ลำดับ</th>
                                            <th>เชื่อมต่อระหว่าง</th>
                                            <th>ชื่ออุปกรณ์</th>
                                            <th>ไอพีที่ใช้งาน</th>
                                            <th>เลขหมายเครื่อง</th>
                                            <th>เวอร์ชั่น</th>
											<th>รวมเวลาใช้งาน</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                                <?php
                                                

                                                    $num =count($ARRAY);
                                                   // $num2 =count($ARRAY2);
                                                  //  $num3 =count($ARRAY3);

                                                    for($i=0; $i<$num; $i++){   
                                                    $no=$i+1;
                                                   // $bytes =  $ARRAY[$i]['bytes-out']/1048576;

                                                        echo "<tr>";
                                                            echo "<td>".$no."</td>";
                                                            echo "<td>".$ARRAY[$i]['interface']."</td>";                                                                                                                                                 
                                                            echo "<td>".$ARRAY[$i]['identity']."</td>";                                                     
                                                            echo "<td>".$ARRAY[$i]['address']."</td>";
                                                            echo "<td>".$ARRAY[$i]['mac-address']."</td>";
															echo "<td>".$ARRAY[$i]['version']."</td>";
															echo "<td>".$ARRAY[$i]['uptime']."</td>";
                                                            
                                                            echo "</tr>";
													}
												?>                                                                                                                  
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>                    
        </div>
   
  </section>

