<?php
	error_reporting(0);
	session_start();
	if(empty($_SESSION['security']) || empty($_SESSION['APIUser'])){
		echo "<meta http-equiv='refresh' content='0;url=login.php' />";
		exit(0);
	}
	unset($_SESSION['id']);
	require('../config/routeros_api.class.php'); 
	include("../include/class.mysqldb.php");     
	include("../include/config.inc.php");
	include("convert.php");
$secom_admin=mysql_fetch_array(mysql_query("SELECT admin_pin FROM mt_config"));
	 $secom_v1=$secom_admin['admin_pin'];

	   $secom_user=mysql_query("SELECT * FROM mt_config WHERE user_pin='".$_SESSION['security']."'");
           while($Auser_pin=mysql_fetch_array($secom_user)){
			   $secom_v3=$Auser_pin['user_pin'];
			   if(!empty($secom_v3)){$security_account="style=\"color: #ff1c15;\"";}
		   }

		    $secom_customer=mysql_query("SELECT * FROM mt_config WHERE customer_pin='".$_SESSION['security']."'");
           while($Acust=mysql_fetch_array($secom_customer)){
			   $secom_v2=$Acust['customer_pin'];
			   if(!empty($secom_v2)){$security_account="style=\"color: #f7d13c;\"";}
		   }

$secom_admin=mysql_query("SELECT * FROM mt_config WHERE admin_pin='".$_SESSION['security']."'");
           while($admin_pin=mysql_fetch_array($secom_admin)){
			   if(!empty($secom_v1)){$security_account="style=\"color: #00ff00;\"";}
		   }

header("Refresh: 300; URL='../admin/login.php'");	
?>
<!DOCTYPE html>
<html>

<head>

	<!-- Script แสดงวันเวลา --> 
    <script type="text/javascript" >
        function date_time(id) {
            date = new Date;
            year = date.getFullYear();
            month = date.getMonth();
            months = new Array('มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม');
            d = date.getDate();
            day = date.getDay();
            days = new Array('วัน อาทิตย์ ที่', 'วัน จันทร์ ที่', 'วัน อังคาร ที่', 'วัน พุธ ที่', 'วัน พฤหัสบดี ที่', 'วัน ศุกร์ ที่', 'วัน เสาร์ ที่');
            h = date.getHours();
            if (h < 10) {
                h = "0" + h;
            }
            m = date.getMinutes();
            if (m < 10) {
                m = "0" + m;
            }
            s = date.getSeconds();
            if (s < 10) {
                s = "0" + s;
            }
            result = '' + days[day] + ' ' + d + ' ' + months[month] + ' พ.ศ.' + (year+543) + ' เวลา ' + h + ':' + m + ':' + s;
            document.getElementById(id).innerHTML =result;
            setTimeout('date_time("' + id + '");', '1000');
            return true;
        }

      
    </script>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Mikrotik API</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="../plugins/bootstrap/cssUI/bootstrap.min.css"><!-- size ui -->
  <!-- Font Awesome fa fa icon-->
  <link href="../assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
   <link rel="stylesheet" href="../distUI/css/AdminLTE.min.css"><!-- ui index -->
 
    <!-- sweetalert STYLES-->
   <script src="../plugins/sweetalert/dist/sweetalert2.min.js"></script><!-- alert -->
   <link rel="stylesheet" type="text/css" href="../plugins/sweetalert/dist/sweetalert2.css"/><!-- alert -->
     <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css"> -->
  <!--link Ionicons dashboad-->
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">

 <!-- <link rel="stylesheet" href="../plugins/datatable/dataTables1.10.15.bootstrap.min.css"> --><!--ตาราง ค้นหา up-down-->
	<!-- <link href="../plugins/bootstrap/dist/css/bootstrap.css" rel="stylesheet" /><!--ตาราง ค้นหา  สวย -->
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script><!-- click check box +ตาราง ค้นหา  --> 
   <link href="../assets/css/plugins/dataTables.bootstrap2.css" rel="stylesheet"/><!--ใช้ตารางนี้ ค้นหา จัดขอบ -->
<!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../distUI/css/skins/_all-skins-min.min.css"><!-- ui index -->
  <!-- GOOGLE FONTS-->
   <!-- <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' /> -->
  <link href="../assets/css/custom3.css" rel="stylesheet" />
<link href="../img/winbox-logo.png" rel="shortcut icon" type="image/x-icon" />
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">

    <!-- Logo -->
    <a href="index.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>M</b>T</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Mikrotik</b>API</span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
		  <li>
			<div id="google_translate_element" ></div>
          </li>
		  <li>
		  		 		 <!-- <a href="../language/change.php?lang=EN" ><img src="../language/lg/th.png" width="20" height="13"></i></a> -->

		  </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>

    </nav>
  </header>

<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->



     <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <!-- <img src="../distUI/img/user2-160x160.jpg" class="img-circle" alt="User Image"> -->
		  <img src="../img/winbox.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo ($_SESSION['APIUser']); ?><?php echo ($_SESSION['EmpUser']); ?></p>
          <a href="#"  data-toggle="modal" data-target="#Detail" data-toggle="tooltip" data-placement="top" title="ดูรายละเอียด"><i class="fa fa-circle"<?php echo $security_account;?>></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="page" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
<ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li class="active treeview">
          <a href="index.php">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>

		    <li class="treeview">
          <a href="index.php?page=add_server">
            <i class="fa fa-globe"></i>
            <span>Router OS Config</span>
           <span class="label label-primary pull-right"></span>
          </a>
        </li>

       
        <li class="treeview">
              <a href="index.php?page=Change-Password">
                <i class="fa fa-expeditedssl"></i>
                <span>Change Password </span>
                <span class="label label-primary pull-right"></span>
              </a>

        </li>
		 
	<?php 
	if($secom_v1==$_SESSION['security']){	
		?>
		       <li class="treeview">
              <a href="index.php?page=security_site">
                <i class="fa fa-expeditedssl"></i>
                <span>Security Site </span>
                <span class="label label-primary pull-right"></span>
              </a>

        </li>
   <?php }?>
        <li class="treeview">
          <a href="../admin/logout.php">
            <i class="fa fa-sign-out"></i>
            <span>Log Out</span>
           <span class="label label-primary pull-right"></span>
          </a>
        </li>
        
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
		
        <!-- Page Content -->
     <div class="content-wrapper"> 
	  <!-- <section class="content"> -->
	   <?php
// zone list
if($_REQUEST[page]=="add_customer_server"){include("add_customer_server.php");}
else if($_REQUEST[page]=="setup_server"){include("setup_server.php");}
else if($_REQUEST[page]=="add_server"){include("add_server.php");}

//zone link
else if($_REQUEST[page]=="system_conn"){include("../system/system_conn.php");}


// zone edit 
else if($_REQUEST[page]=="editserver"){include("edit_serv.php");}
else if($_REQUEST[page]=="Change-Password"){include("change_pass.php");}
else if($_REQUEST[page]=="security_site"){include("security_site.php");}



// zone delete

else if($_REQUEST[page]=="deleteserver"){include("delete_server.php");}

// default not value get page or welcome login
else{include("listserver.php");}?><!-- end last else -->
          
		 </div>

		

		 

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
       
          <!-- /.form-group

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Turn off notifications
              <input type="checkbox" class="pull-right">
            </label>
          </div>
          <!-- /.form-group 

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Delete chat history
              <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
            </label>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <!-- <div class="control-sidebar-bg"></div> -->

</div>
<script src="../plugins/jQueryUI/jquery-2.2.3.min.js"></script><!-- click ui -->
<!-- Bootstrap v3.3.7 -->
<script src="../distUI/js/bootstrap.min.js"></script><!-- slide bar fastclick -->
<script src="../distUI/js/app.min.js"></script><!-- click+ui -->

	 <!-- DataTables JavaScript -->
    <script src="../assets/js/plugins/dataTables/jquery.dataTables.js"></script><!-- db table -->
    <script src="../assets/js/plugins/dataTables/dataTables.bootstrap.js"></script><!-- db table -->
      
	  <script src="../plugins/jscolor/jscolor.js"></script><!-- click color -->
   <script src="../assets/js/admin-custom.js"></script><!--function  -->



            <!-- <script src="../assets/js/action2.js"></script> --><!--real-time  -->
			<!-- <script src="../assets/js/custom2.js"></script> -->
	 <!-- <script src="../assets/js/jquery-1.10.2.js"></script> --><!-- log -->
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- <script src="../distUI/js/pages/dashboard2.js"></script> -->
 <!-- <LINK REL="SHORTCUT ICON" HREF="../img/nongbua.ico">  -->
 <!-- <LINK REL="SHORTCUT ICON" HREF="../img/mik_logo.ico"> -->
   <script src="../distUI/js/demo.min.js"></script>

   <script type="text/javascript" > window.onload = date_time('date_time');</script>
   <script>
function popup(url,name,windowWidth,windowHeight){      
    myleft=(screen.width)?(screen.width-windowWidth)/2:100;   
    mytop=(screen.height)?(screen.height-windowHeight)/2:100;     
    properties = "width="+windowWidth+",height="+windowHeight;  
    properties +=",scrollbars=yes, top="+mytop+",left="+myleft;     
    window.open(url,name,properties);  
}</script>
    <!-- <script>
    $(document).ready(function() {
        $('#dataTables-example').dataTable();
    });
    </script> --> 
	<script type="text/javascript">
	$(document).ready(function() {
    $('#dataTables-example').DataTable( {
        "language": {
    "sProcessing":   "กำลังดำเนินการ...",
    "sLengthMenu":   "แสดง _MENU_ รายชื่อ",
    "sZeroRecords":  "ไม่พบข้อมูล",
    "sInfo":         "แสดง _START_ ถึง _END_ จาก _TOTAL_ รายชื่อ",
    "sInfoEmpty":    "แสดง 0 ถึง 0 จาก 0 รายชื่อ",
    "sInfoFiltered": "(ค้นหาข้อมูลจาก _MAX_ รายชื่อ)",
    "sInfoPostFix":  "",
    "sSearch":       "ค้นหา: ",
    "sUrl":          "",
    "oPaginate": {
        "sFirst":    "หน้าแรก",
        "sPrevious": "ก่อนหน้า",
        "sNext":     "ถัดไป",
        "sLast":     "หน้าสุดท้าย"
    }
}
    });
});
	</script>
<footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Desing By</b> คู่มือการใช้งาน Mikrotik  
        </div>
    <strong>Copyright &copy; 2019 - <?php echo date("Y");?> <a href="https://www.libraryhouze-internet.com/">คู่มือการใช้งาน Mikrotik </a>.</strong> All rights
  </footer>
  <script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'th'}, 'google_translate_element');
}
</script>

<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
</body>

</html>
