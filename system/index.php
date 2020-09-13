<?php
	session_start();
	ob_start();

	include("../include/class.mysqldb.php");
	include("../include/config.inc.php");
	include_once('../include/account.php');
	if(empty($_SESSION['security']) || empty($_SESSION['APIUser'])){
		echo "<meta http-equiv='refresh' content='0;url=../admin/logout.php' />";
		exit();		
	}else if($_SESSION['id'] == ''){
		echo "<meta http-equiv='refresh' content='0;url=../admin/index.php' />";
		exit();
	}
header("Refresh: 1800; URL='../admin/login.php'");
?>

<!DOCTYPE html>
<html lang="en">

<head>
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

  
   <!-- <LINK REL="SHORTCUT ICON" HREF="../img/nongbua.ico"> -->      <!--+++++++  คำสั่งเรียกใช้ ภาพ ของ icon แสดงบน title bar ++++++++-->
<link href="../img/winbox-logo.png" rel="shortcut icon" type="image/x-icon" />
</head>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">


    <!-- Logo -->
    <a href="#" class="logo">
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
 <!-- Messages: style can be found in dropdown.less-->
          
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="../img/winbox.png" class="user-image" alt="User Image">
              <!-- <span class="hidden-xs"><?php echo ($_SESSION['APIUser']); ?><?php echo ($_SESSION['EmpUser']); ?><?php  echo $account;?> </span>-->
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="../img/winbox.png" class="img-circle" alt="User Image">

                <p>
                  <?php echo ($_SESSION['APIUser']); ?><?php echo ($_SESSION['EmpUser']); ?> - MIKROTIK API
                  <small>System Design </small>
                  <small>By MR.KRITTIN</small>
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="#"></a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#"></a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#"></a>
                  </div>
                </div>
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" target="_blank" class="btn btn-black ">New Tab</a>
                </div>
                <div class="pull-right">
                  <a href="../admin/logout.php" class="btn btn-black ">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
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
<!-- เปิดส่วนแสดงข้อมูลบนเว็บไซต์ -->
</body>

     <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="../img/winbox.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo ($_SESSION['APIUser']); ?><?php echo ($_SESSION['EmpUser']); ?></p>
          <a href="#"><i class="fa fa-circle"  style="color: #00ff00;"></i> Online</a>
        </div>
      </div>
 <!-- search form -->
      <form action="" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="page" class="form-control" id="search" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="id" id="search-btn"  value="<?php print $id; ?>" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
     
 <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li class="active treeview">
          <a href="index.php">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="label label-primary pull-right"></span></a>      
			</li>
			<li class="treeview">
          <a href="#">
            <i class="fa fa-wifi"></i><span>Hotspot </span> <span class="label label-primary pull-right"></span></a>
                  <ul class="treeview-menu">
			<li>
				<a  href="index.php?page=hotspotserver_list"><i class="fa fa-circle-o"></i> Hotspot Server List</a>
            </li>
          	      <li><a href="#"><i class="fa fa-play-circle"></i>Profile</a>
				      <ul class="treeview-menu">
				         <li><a href="#"><i class="fa fa-play-circle"></i> Add Profile </a>
						         <ul class="treeview-menu">
								        <li><a href="index.php?page=add_profile"><i class="fa fa-circle-o"></i> Add Normal Profile</a></li>
										<li><a href="index.php?page=add_macprofile"><i class="fa fa-circle-o"></i> Add Lock mac Profile</a></li>
										<li><a href="index.php?page=add_usermanager_profile"><i class="fa fa-circle-o"></i> Add Userman Profile</a></li>
								</ul>
						</li>
						<li><a href="index.php?page=profilelist"><i class="fa fa-circle-o"></i> Profile List</a></li>
				</ul>
		    </li>
          	<li><a href="#"><i class="fa fa-play-circle"></i> USER</a>
                        <ul class="treeview-menu">
					    <li><a href="#"><i class="fa fa-play-circle"></i> Add Account</a>
						       <ul class="treeview-menu">
							      <li><a href="index.php?page=manuser"><i class="fa fa-circle-o"></i> Add User Manual</a></li>
								  <li><a href="index.php?page=genuser"><i class="fa fa-circle-o"></i> Gen User</a></li>
								  <li><a href="index.php?page=add_usermanager"><i class="fa fa-circle-o"></i> Add UserManager</a></li>
								  <li><a href="index.php?page=gen_usermanager"><i class="fa fa-circle-o"></i> Gen UserManager</a></li>
							  </ul>
						</li>
						<li><a href="#"><i class="fa fa-play-circle"></i> Users List</a>
						       <ul class="treeview-menu">
							      <li><a href="index.php?page=listuser"><i class="fa fa-circle-o"></i> Databases User</a></li>
								  <li><a href="index.php?page=mikrotikuser"><i class="fa fa-circle-o"></i> Mikrotik User</a></li>
								  <li><a href="index.php?page=usermanager"><i class="fa fa-circle-o"></i> User Manager</a></li>
								  
							  </ul>
						</li>
			</ul>  
			</li>
            <li>
            <a href="#"><i class="fa fa-play-circle"></i> Other</a>
			        <ul class="treeview-menu">
					<li><a href="index.php?page=useronline"><i class="fa fa-circle-o"></i> User Online</a></li>
					<li><a href="index.php?page=hostonline"><i class="fa fa-circle-o"></i> Host Connect</a></li>
					</ul>
            </li>
			<li>
            <a  href="index.php?page=script_hotspot"><i class="fa fa-circle-o"></i> Script For Hotspot User</a>
            </li>
            

          </ul>
        </li>
<li class="treeview">
          <a href="#">
            <i class="fa fa-podcast"></i><span>PPPOE </span> <span class="label label-primary pull-right"></span></a>
                  <ul class="treeview-menu">
          	      <li><a href="#"><i class="fa fa-play-circle"></i>Profile</a>
				      <ul class="treeview-menu">
				         <li><a href="index.php?page=add_pppoe_profile"><i class="fa fa-circle-o"></i> Add Profile </a></li>
						 <li><a href="index.php?page=pppoe_profile_list"><i class="fa fa-circle-o"></i> Profile List</a></li>
				</ul>
		    </li>
          	<li><a href="#"><i class="fa fa-play-circle"></i> USER</a>
                        <ul class="treeview-menu">
					    <li><a href="#"><i class="fa fa-play-circle"></i> Add Account</a>
						       <ul class="treeview-menu">
							      <li><a href="index.php?page=add_pppoe"><i class="fa fa-circle-o"></i> Add PPPOE Manual </a></li>
								  <li><a href="index.php?page=gen_pppoe"><i class="fa fa-circle-o"></i> Gen PPPOE</a></li>
								</ul>
						</li>
						<li><a href="#"><i class="fa fa-play-circle"></i> Users List</a>
						       <ul class="treeview-menu">
							      <li><a href="index.php?page=pppoe_dtb_user"><i class="fa fa-circle-o"></i> Databases User</a></li>
								  <li><a href="index.php?page=pppoe_mik_user"><i class="fa fa-circle-o"></i> Mikrotik User</a></li>
								</ul>
						</li>
			</ul>  
			</li>
            <li>
            <a href="#"><i class="fa fa-play-circle"></i> Other</a>
			        <ul class="treeview-menu">
					<li><a href="index.php?page=pppoe_online"><i class="fa fa-circle-o"></i> PPPOE Online </a></li>
					</ul>
            </li>
			<li>
            <a  href="index.php?page=script_pppoe"><i class="fa fa-circle-o"></i> Script For PPPOE User</a>
            </li>
            

          </ul>
        </li>
		<li class="treeview">
		<a href="#"><i class="fa fa-sitemap"></i><span>Import&Export</span> <span class="label label-primary pull-right"></span>  </a>
		          <ul class="treeview-menu">
            
                   <li><a href="index.php?page=Import_Exel"><i class="fa fa-circle-o"></i> Import Hotspot User  </a></li>
                   <li><a href="index.php?page=pppoe_Import_Exel"><i class="fa fa-circle-o"></i> Import PPPOE User</a> </li>
                   <li><a href="index.php?page=import_usermanager"><i class="fa fa-circle-o"></i> Import User Manager </a></li>
			      </ul>
		
		
		</li>
		<li class="treeview">
		<a href="#"><i class="fa fa-btc"></i><span>Money </span> <span class="label label-primary pull-right"></span>  </a>
		          <ul class="treeview-menu">
            
                   <li><a href="index.php?page=total_money"><i class="fa fa-circle-o"></i>Hotspot Money</a></li>
                   <li><a href="index.php?page=pppoe_total_money"><i class="fa fa-circle-o"></i>PPPOE Money</a> </li>
				   </ul>
		
		
		</li>
		<li class="treeview">
          		<a href="index.php?page=Access_Points_online">
            		<i class="fa fa-random"></i>
            		<span>Device Connect</span>
           			<span class="label label-primary pull-right"></span>   
          		</a>

        </li>
		<li class="treeview">
          		<a href="index.php?page=ip_list">
            		<i class="fa fa-link"></i>
            		<span>IP Addresses List</span>
           			<span class="label label-primary pull-right"></span>   
          		</a>

        </li>
		<li class="treeview">
          		<a href="index.php?page=pool_list">
            		<i class="fa fa-sitemap"></i>
            		<span>Pool List</span>
           			<span class="label label-primary pull-right"></span>   
          		</a>

        </li>
		<li class="treeview">
          		<a href="index.php?page=interface">
            		<i class="fa fa-line-chart"></i>
            		<span>Interface List</span>
           			<span class="label label-primary pull-right"></span>   
          		</a>

        </li>
		<li class="treeview">
          		<a href="index.php?page=dhcp">
            		<i class="fa fa-laptop"></i>
            		<span>DHCP List</span>
           			<span class="label label-primary pull-right"></span>   
          		</a>

        </li>
		  <!-- <li class="treeview">
          		<a href="index.php?page=test">
            		<i class="fa fa-paperclip"></i>
            		<span>Example</span>
           			<span class="label label-primary pull-right"></span>   
          		</a>

        </li>
				 <li class="treeview">
          		<a href="index.php?page=test2">
            		<i class="fa fa-paperclip"></i>
            		<span>Example2</span>
           			<span class="label label-primary pull-right"></span>   
          		</a>

        </li> -->
		<li class="treeview">
          <a href="#" onclick="swal({
                                title: 'เลือกดำเนินการ?',
                                //text: '',
                                 type: 'question',
                                showCloseButton: true,
                                showCancelButton: true,
                                 confirmButtonColor: '#ff8000',
                                 cancelButtonColor: '#d33',
                                   confirmButtonText: 'Restart',
                                   cancelButtonText: 'Shutdown',
									//allowOutsideClick: false,
                                    //confirmButtonClass: 'btn btn-success',
                                    //cancelButtonClass: 'btn btn-black',
                                     // buttonsStyling: false
                                     }).then(function () {
                                   swal({
                     title: 'เริ่มระบบใหม่เดี๋ยวนี้หรือไม่?',
                    //text: 'Restart system now?',
                    type: 'warning',
	                showCloseButton: true,
	                showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'ตกลง',
                    cancelButtonText: 'ยกเลิก',
					//allowOutsideClick: false
					}).then(
                    function () {
                    window.location.href = 'index.php?page=restart';})
						 
                                                          }, function (dismiss) {
                       // dismiss can be 'cancel', 'overlay',
                         // 'close', and 'timer'
						//window.location.href = 'index.php?page=confirm';
						
                           if (dismiss === 'cancel') {
                      swal({
                     title: 'ปิดระบบเดี๋ยวนี้หรือไม่?',
                    //text: 'Shutdown system now?',
                    type: 'warning',
	                showCloseButton: true,
	                showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'ตกลง',
                    cancelButtonText: 'ยกเลิก',
					//allowOutsideClick: false,
														},).then(
                    function () {
                    window.location.href = 'index.php?page=shutdown';})}})">
            <i class="fa fa-power-off"></i>
            <span>ShutDown  </span>
           <span class="label label-primary pull-right"></span>     
          </a>
        </li>
		<li class="treeview">
          <a href="../admin/index.php?page=server">
            <i class="fa fa-sign-out"></i>
            <span>Back To Site  </span>
           <span class="label label-primary pull-right"></span>     
          </a>
        </li>
       </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
		
   <div class="content-wrapper"> 

     <?php
// zone add[from]

if(($_GET[page]=="genuser")||($_GET[page]=="hgu")){include("gen_user.php");}
else if(($_GET[page]=="manuser")||($_GET[page]=="hau")){include("adduser.php");}
else if(($_GET[page]=="add_profile")||($_GET[page]=="hap")){include("add_profile.php");}
else if(($_GET[page]=="add_usermanager_profile")||($_GET[page]=="haump")){include("add_usermanager_profile.php");}
else if(($_GET[page]=="add_macprofile")||($_GET[page]=="hamp")){include("add_macprofile.php");}
else if($_GET[page]=="upload_csv"){include("../csv/upload_csv.php");}
else if(($_GET[page]=="Import_Exel")||($_GET[page]=="hiu")){include("Import_Exel.php");}
else if(($_GET[page]=="add_pppoe")||($_GET[page]=="pau")){include("pppoe/add_pppoe.php");}
else if(($_GET[page]=="gen_pppoe")||($_GET[page]=="pgu")){include("pppoe/gen_pppoe.php");}
else if(($_GET[page]=="add_pppoe_profile")||($_GET[page]=="pap")){include("pppoe/add_pppoe_profile.php");}
else if(($_GET[page]=="pppoe_Import_Exel")||($_GET[page]=="piu")){include("pppoe/pppoe_Import_Exel.php");}
else if(($_GET[page]=="add_usermanager")||($_GET[page]=="haum")){include("add_usermanager.php");}
else if(($_GET[page]=="gen_usermanager")||($_GET[page]=="hgum")){include("gen_usermanager.php");}
else if(($_GET[page]=="import_usermanager")||($_GET[page]=="hium")){include("import_usermanager.php");}
else if($_GET[page]=="hotspot_transfer_profile"){include("hotspot_transfer_profile.php");}
else if($_GET[page]=="pppoe_transfer_profile"){include("pppoe/pppoe_transfer_profile.php");}





// zone list
else if(($_GET[page]=="listuser")||($_GET[page]=="hdbu")){include("listuser.php");}
else if(($_GET[page]=="mikrotikuser")||($_GET[page]=="hmu")){include("mikrotikuser.php");}
else if(($_GET[page]=="total_money")||($_GET[page]=="hm")){include("total_money.php");}
else if(($_GET[page]=="pppoe_total_money")||($_GET[page]=="pm")){include("pppoe/pppoe_total_money.php");}
else if($_GET[page]=="date_list"){include("date_list.php");}
else if($_GET[page]=="pppoe_date_list"){include("pppoe/pppoe_date_list.php");}
else if($_GET[page]=="month_list"){include("month_list.php");}
else if($_GET[page]=="pppoe_month_list"){include("pppoe/pppoe_month_list.php");}
else if(($_GET[page]=="money_month")||($_GET[page]=="hmm")){include("money_month.php");}
//else if(($_GET[page]=="money_year")||($_GET[page]=="hmy")){include("money_year.php");}
else if(($_GET[page]=="pppoe_money_month")||($_GET[page]=="pmm")){include("pppoe/pppoe_money_month.php");}
else if($_GET[page]=="user"){include("user.php");}
else if(($_GET[page]=="profilelist")||($_GET[page]=="hp")){include("profile_list.php");}
//else if($_GET[page]=="profileall"){include("profileall.php");}
else if(($_GET[page]=="useronline")||($_GET[page]=="huo")){include("useronline.php");}
//else if(($_GET[page]=="hosts_online")||($_GET[page]=="hho")){include("hosts_online.php");}
else if(($_GET[page]=="hostonline")||($_GET[page]=="hc")){include("hostonline.php");}
else if(($_GET[page]=="interface")||($_GET[page]=="if")){include("interface.php");}
else if($_GET[page]=="dhcp"){include("dhcp.php");}
//else if($_GET[page]=="mikrotik_user"){include("mikrotikuserall.php");}
else if(($_GET[page]=="Access_Points_online")||($_GET[page]=="ap")){include("ap_online.php");}
else if(($_GET[page]=="pppoe_dtb_user")||($_GET[page]=="pdbu")){include("pppoe/pppoe_dtb_user.php");}
else if($_GET[page]=="pppoe_user"){include("pppoe/pppoe_user.php");}
else if(($_GET[page]=="pppoe_mik_user")||($_GET[page]=="pmu")){include("pppoe/pppoe_mikrotikuser.php");}
else if(($_GET[page]=="pppoe_profile_list")||($_GET[page]=="pp")){include("pppoe/pppoe_profile_list.php");}
else if(($_GET[page]=="pppoe_online")||($_GET[page]=="po")){include("pppoe/pppoe_online.php");}
else if(($_GET[page]=="script_hotspot")||($_GET[page]=="has")){include("script_hotspot.php");}
else if(($_GET[page]=="script_pppoe")||($_GET[page]=="pas")){include("pppoe/script_pppoe.php");}
else if(($_GET[page]=="usermanager")||($_GET[page]=="hum")){include("usermanager.php");}
else if(($_GET[page]=="all_data_users")||($_GET[page]=="hadbu")){include("all_data_users.php");}
else if(($_GET[page]=="pppoe_all_data_users")||($_GET[page]=="padbu")){include("pppoe/pppoe_all_data_users.php");}
else if(($_GET[page]=="card")||($_GET[page]=="hc")){include("card.php");}
else if(($_GET[page]=="pppoe_card")||($_GET[page]=="pc")){include("pppoe/pppoe_card.php");}
//else if(($_GET[page]=="pppoe_money_year")||($_GET[page]=="pmy")){include("pppoe/pppoe_money_year.php");}
else if($_GET[page]=="test"){include("test.php");}
else if($_GET[page]=="test2"){include("test2.php");}
else if($_GET[page]=="restart"){include("restart.php");}
else if($_GET[page]=="shutdown"){include("shutdown.php");}
else if($_GET[page]=="ip_list"){include("ip_list.php");}
else if($_GET[page]=="pool_list"){include("pool_list.php");}
else if($_GET[page]=="hotspotserver_list"){include("hotspotserver_list.php");}





// zone add[process]
else if($_GET[page]=="con_adduser_process"){include("../process/con_adduser.php");}
else if($_GET[page]=="con_genuser_process"){include("../process/con_genuser.php");}
//else if($_GET[page]=="con_editprofile_process"){include("../process/con_editprofile.php");}
else if($_GET[page]=="con_addprofile_process"){include("../process/con_addprofile.php");}
else if($_GET[page]=="con_add_usermanager_profile_process"){include("../process/con_add_usermanager_profile.php");}
else if($_GET[page]=="con_addmacprofile_process"){include("../process/con_addmacprofile.php");}
else if($_GET[page]=="con_addpppoe_process"){include("../process/con_addpppoe.php");}
else if($_GET[page]=="con_genuser_pppoe_process"){include("../process/con_genuser_pppoe.php");}
else if($_GET[page]=="con_addpppoe_profile_process"){include("../process/con_addpppoe_profile.php");}
//else if($_GET[page]=="con_editpppoe_profile_process"){include("../process/con_editpppoe_profile.php");}
else if($_GET[page]=="disable"){include("../process/disable.php");}
else if($_GET[page]=="enable"){include("../process/enable.php");}
else if($_GET[page]=="add_script_process"){include("../process/add_script.php");}
else if($_GET[page]=="add_pppoe_script_process"){include("../process/add_pppoe_script.php");}
//else if($_GET[page]=="pppoe_disable_process"){include("../process/pppoe_disable.php");}
//else if($_GET[page]=="pppoe_enable_process"){include("../process/pppoe_enable.php");}
else if($_GET[page]=="con_add_usermanager_process"){include("../process/con_add_usermanager.php");}
else if($_GET[page]=="con_gen_usermanager_process"){include("../process/con_gen_usermanager.php");}




// zone edit 
//else if($_GET[page]=="editserver"){include("edit_serv.php");}
else if($_GET[page]=="edituser"){include("edit_user.php");}
else if($_GET[page]=="edit_all"){include("edit_all.php");}
else if($_GET[page]=="pppoe_edit_all"){include("pppoe/pppoe_edit_all.php");}
else if($_GET[page]=="editmikrotikuser"){include("edit_mikrotikuser.php");}
else if($_GET[page]=="editprofile"){include("edit_profile.php");}
else if($_GET[page]=="pppoe_edituser"){include("pppoe/pppoe_edit_user.php");}
else if($_GET[page]=="edit_pppoe_mik_user"){include("pppoe/edit_pppoe_mikrotikuser.php");}
else if($_GET[page]=="pppoe_edit_profile"){include("pppoe/pppoe_edit_profile.php");}
else if($_GET[page]=="editusermanager"){include("edit_usermanager.php");}
else if($_GET[page]=="edit_card"){include("edit_card.php");}
else if($_GET[page]=="edit_pppoe_card"){include("pppoe/edit_pppoe_card.php");}


// zone delete

else if($_GET[page]=="delete"){include("../process/delete.php");}
else if($_GET[page]=="host_kick"){include("../process/host_kick.php");}
else if($_GET[page]=="kick"){include("../process/kick.php");}
else if($_GET[page]=="pppoe_online_kick"){include("../process/pppoe_online_kick.php");}

// default not value get page or welcome login
else{include("dashboard.php");}?><!-- end last else -->

 </div>

		

		 

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">

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
	  <script src="../assets/js/system-real-time2.js"></script>
<!-- <script
  src="https://code.jquery.com/jquery-1.11.0.js"
  integrity="sha256-zgND4db0iXaO7v4CLBIYHGoIIudWI5hRMQrPB20j0Qw="
  crossorigin="anonymous"></script> --><!-- log -->
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- <script src="../distUI/js/pages/dashboard2.js"></script> -->
 <LINK REL="SHORTCUT ICON" HREF="../img/nongbua.ico"> 
   <script src="../distUI/js/demo.min.js"></script>
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
</script> --><!-- orig -->
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
