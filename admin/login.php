<?php 

 include "../include/class.mysqldb.php";
 include "../include/config.inc.php";
 include("convert.php");

	$secu=mysql_fetch_array(mysql_query("SELECT admin_pin FROM mt_config"));
	$ad_pin=$secu['admin_pin'];
	 $mdEmpty_pin=md5("000000000");
	
		if(empty($ad_pin)||($ad_pin==$mdEmpty_pin)){
		 //unset($_SESSION['EmpUser']);
 if(isset($_REQUEST['am_user'])){
	 $user = $_REQUEST['am_user'];
	 $pass = md5($_REQUEST['am_pass']);
	 $conn = new mysqldb();
	 $sql="SELECT * FROM am where am_user = '".$user."' and am_pass='".$pass."'";
	 $query = $conn ->query($sql);
	 $data = $conn->fetch($query);
	 
	 if($conn->num_rows()==0){
		 echo "<script language='javascript'>alert('Username or Password incorrect')</script>";
	 }else{
		///unset($_SESSION['EmpUser']);
		$_SESSION['APIUser']=$data->am_user;
		$_SESSION['APIID']=$data->am_id;
		$_SESSION['security']=$mdEmpty_pin;
	  // echo "<meta http-equiv='refresh' content='0;url=security_con.php' />";
	  echo "<meta http-equiv='refresh' content='0;url=index.php' />";  
		
		
		exit(0);
	 }
 }
 }else{
/////////////////////////////////////////////////////////////////////////////////
 ///unset($_SESSION['EmpUser']);
 if(isset($_REQUEST['am_user'])){
    $user = $_REQUEST['am_user'];
    $pass = $_REQUEST['security_pin'];
	$conn = new mysqldb();
    $sql="SELECT * FROM am where am_user = '".$user."'";
       $query = $conn ->query($sql);
	   $data = $conn->fetch($query);
	    
     if($conn->num_rows()==0){
		 echo "<script language='javascript'>alert('Username or Password incorrect')</script>";
	 }else{
	 ///unset($_SESSION['EmpUser']);
	 $_SESSION['APIUser']=$data->am_user;
	 $_SESSION['APIID']=$data->am_id;
	$admin_secu=mysql_fetch_array(mysql_query("SELECT admin_pin FROM mt_config"));
	$md_security_pin=md5($pass);
    if($md_security_pin==$admin_secu['admin_pin']){
	 $_SESSION['security']=$admin_secu['admin_pin'];
     
	echo "<meta http-equiv='refresh' content='0;url=index.php' />";
	$error=$admin_secu['admin_pin'];
	}else{
		$query=mysql_query("SELECT * FROM mt_config WHERE customer_pin='".$pass."'");
			$i=0;while($result=mysql_fetch_array($query)){
			$i++;
			$pass_cus=$result['customer_pin'];}
	        if(!empty($pass_cus)){
			$_SESSION['security']=$pass_cus;
			echo "<meta http-equiv='refresh' content='0;url=index.php' />";
			$error=$pass_cus;
			}else{
			$query=mysql_query("SELECT * FROM mt_config WHERE user_pin='".$pass."'");
			$i=0;while($result=mysql_fetch_array($query)){
			$i++;
			$pass_user=$result['user_pin'];}
	        if(!empty($pass_user)){
		    $_SESSION['security']=$pass_user;
			echo "<meta http-equiv='refresh' content='0;url=index.php' />";
			$error=$pass_user;
			}
		}
	}//no admin
	if(empty($error)){echo "<script language='javascript'>alert('Username or Password incorrect')</script>";}
	}}
 /////////////////////////////////////////////////////////////////////////////////////////
 }
?>
<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>API Mikrotik</title>

        <!-- CSS -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="../assets/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="../assets/css/form-elements.css">
        <link rel="stylesheet" href="../assets/css/style.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="assets/ico/favicon.png">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">
        <link href="../img/winbox-logo.png" rel="shortcut icon" type="image/x-icon" /> 
    </head>

    <body>

        <!-- Top content -->
        <div class="top-content">
        	
            <div class="inner-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2 text">
                            <h1><strong>ยินดีต้อนรับเข้าสู่ระบบจัดการ MikroTik</strong></h1>
                            <div class="description">
                            	
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 form-box">
                        	<div class="form-top">
                        		<div class="form-top-left">
                        			<h3><strong><font color="#009900">Login</font></strong></h3>
									 <?php
                           if(empty($ad_pin)||($ad_pin==$mdEmpty_pin)){
                                      ?>
                           <font  color="#0000ff"><p>กรุณากรอก <font color="#000000"><strong>Username</strong></font> และ<font color="#000000"> <strong>Password</strong></font></p></font>
									<?php
	                                }else{
                                     ?>
                           <font  color="#0000ff"><p>กรุณากรอก <font color="#000000"><strong>Username</strong></font> และ<font color="#000000"> <strong>PIN</strong></font></p></font>
									 <?php
	                                }
                                    ?>
                        		</div>
                        		<div class="form-top-right">
                        			<i class="fa fa-lock" style="color:red"></i>
                        		</div>
                            </div>
                            <div class="form-bottom">
			                    <form role="form" action="" method="post" name ="login"class="login-form">
			                    	<div class="form-group">
			                    		<label class="sr-only" for="form-username">Username</label>
			                        	<input type="text" name="am_user" placeholder="Username..." class="form-username form-control" id="form-username">
			                        </div>
			                        <div class="form-group">
									<?php
                                  if(empty($ad_pin)||($ad_pin==$mdEmpty_pin)){
                                     ?>
			                        	<label class="sr-only" for="form-password">Password</label>
			                        	<input type="password" name="am_pass" placeholder="Password..." class="form-password form-control" id="form-password">
									<?php
	                                 }else{
                                       ?>
									   <label class="sr-only" for="form-password">PIN</label>
			                        	<input type="password" name="security_pin" type="password" placeholder="กรุณาใส่รหัส PIN 4-8 หลัก" maxlength="8" class="form-password form-control" id="form-password">
									   <?php
	                                       }
                                        ?>
			                        </div>
			                        <button type="submit" class="btn">Sign in</button>
			                    </form>
		                    </div>
                        </div>
                    </div>
					<br>
                    <br>
					<div class="row">
<strong>   คู่มือการใช้งาน Mikrotik <a href="https://www.libraryhouze-internet.com/">  Copyright &copy; 2019 - <?php echo date("Y");?> </a></strong>
					 </div>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!--
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 social-login">
                        	<h3>...or login with:</h3>
                        	<div class="social-login-buttons">
	                        	<a class="btn btn-link-2" href="#">
	                        		<i class="fa fa-facebook"></i> Facebook
	                        	</a>
	                        	<a class="btn btn-link-2" href="#">
	                        		<i class="fa fa-twitter"></i> Twitter
	                        	</a>
	                        	<a class="btn btn-link-2" href="#">
	                        		<i class="fa fa-google-plus"></i> Google Plus
	                        	</a>
                        	</div>
                        </div>
                    </div>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->                    
                </div>
            </div>
            
        </div>


        <!-- Javascript -->
        <script src="../assets/js/jquery-1.11.1.min.js"></script>
        <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="../assets/js/jquery.backstretch.min.js"></script>
        <script src="../assets/js/scripts2.js"></script>
        
        <!--[if lt IE 10]>
            <script src="../assets/js/placeholder.js"></script>
        <![endif]-->

    </body>

</html>
