<?php
include_once("../include/class.mysqldb.php");
	include_once("../include/config.inc.php");
  $profile=$_REQUEST['profile'];
	
$pro=mysql_fetch_array(mysql_query("SELECT * FROM mt_profile WHERE pro_name='".$profile."'"));


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Vouchers</title>
        <script src="../assets/qr/jquery.min.js" type="text/javascript"></script>
        <script src="../assets/qr/jquery.qrcode.min.js" type="text/javascript"></script>
        <style>
@media print {
  .noprint {
    display: none;
  }
  .pagebreak {
    page-break-after: always;
  }
}
            @media screen {
                html, body {
                    width: 800px;
                }
            }
            body
{
   padding: 0;
   margin:0;
   min-width: 1150px;
   color: #303F50;
   font-size: 10px;
   font-family: Arial, 'Arial Unicode MS', Helvetica, Sans-Serif;
   line-height: 85%;   
}
.kangndo table, table.kangndo
{
   border-collapse: collapse;
   margin: 2px;
}
.kangndo th, .kangndo td
{
   padding: 2px;
   border: solid 1px <?php print $pro[color];?>;
   vertical-align: top;
   text-align: center;
   font-weight: bold;
}
.vertical-text {
transform: rotate(90deg);
padding: 4px;
float: right;
font-size: 15px;
margin-top: 8px;
width: 10px;
color: #E2341D;
}
            img.logo {
                width: 100%;
                margin-left: auto;
                margin-right: auto;
            }

            .qrcode {
                height: 80px;
                width: 80px;
            }
.style2 {font-size: 9px}
.style3 {
	font-size: 6px;
}
        </style>
    </head>
    <body>
<?php
// Allow certain file formats
$target_dir = "../csv/upload_csv.php";
$target_file = $target_dir . basename($_FILES["csv"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Allow certain file formats
if($imageFileType != "csv" ) {
  echo "<script>alert('Sorry, only CSV files are allowed.')</script>";
	echo "<meta http-equiv='refresh' content='0;url=../system/index.php?page=upload_csv' />";
}else{


$objCSV = fopen($_FILES['csv']['tmp_name'], "r");

$cols1 = 0;
while (($objArr = fgetcsv($objCSV, 1000, ",")) !== FALSE) {

?>
<table class="kangndo" style=" display: inline-block; background-color:<?php print $pro[color];?>; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; border-style: initial; border-color: initial; width: 280px; height:120px;">
<tbody>
<tr>
<td style="width: 190px; text-align: center;"><span style="font-weight: bold; color: rgb(255, 255, 255); font-size: 11px; font-family: Tahoma;"><?php print $pro[card_name];?></span><br>
<table class="kangndo" style="background-color:#FFFFFF; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; border-style: initial; border-color: initial; width: 100%; margin-right: auto; margin-left: auto;">
<tbody>
<tr>
<td style="width: 50%; text-align: center;">Package</td>
<td style="width: 50%; text-align: center;"><?php print $profile; ?></td>
</tr>
<tr>
<td style="width: 50%; text-align: center;">Home Page</td>
<td style="width: 50%; text-align: center;"><?php print $pro[home_page];?></td>
</tr>
<tr>
<td style="width: 50%; text-align: center;">Time Limit</td>
<td style="width: 50%; text-align: center;"><?php print $pro[time_limit];?></td>
</tr>
<tr>
<td style="width: 50%; text-align: center;">Price</td>
<td style="width: 50%; text-align: center;">ราคา.&nbsp;<?php print ($pro[pro_price]+$pro[vat]);?>&nbsp;บาท</td>
</tr>
</tbody>
</table>
<table class="kangndo" style="border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; border-style: initial; border-color: initial; width: 100%; margin-right: auto; margin-left: auto;">
<tbody>
<tr>
<td style="width: 50%; text-align: center;"><span class="style4"style="color: rgb(255, 255, 255); font-family: Tahoma;">Username</span></td>
<td style="width: 50%; text-align: center;"><span class="style4"style="color: rgb(255, 255, 255); font-family: Tahoma;">Password</span></td>
</tr>
 <tr>
<td style="background-color:#FFFFFF; width: 50%; text-align: center;"><span style="color: #400000; font-family: Tahoma;"><?php print $objArr[0];?></span></td>
<td style="background-color:#FFFFFF; width: 50%; text-align: center;"><span style="color: #400000; font-family: Tahoma;"><?php print $objArr[1];?></span></td>
</tr>
</tbody>
</table>
<table class="kangndo" style="border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; border-style: initial; border-color: initial; width: 100%; margin-right: auto; margin-left: auto;">
<tbody>
<tr>
<td style="width: 40%; text-align: left;"><span style="color: rgb(255, 255, 255); font-family: Tahoma;"><?php print $pro[pro_limit];?></span></td>
<td style="width: 60%; text-align: right;"><span style="color: rgb(255, 255, 255); font-family: Tahoma;">Call: <?php print $pro[phone];?></span></td>
</tr>
</tbody>
</table>
</td>
<td style="background-color:#FFFFFF; width: 10px; text-align: center;"><div align="center" class="qrcode" id="<?php print $objArr[0];?>"><font color="red"><br><br><span class="style3"><font color="red"><span class="style3">SCAN LOG IN</span><br>
</font></span><script> jQuery(function(){jQuery('#<?php print $objArr[0];?>').qrcode(     {         "render": 'div',         "size": 80,         "minVersion": 5,         "maxVersion": 5,         "ecLevel": 'L',         "mode": 0,         "text": "http://<?php print $pro[server_ip];?>/login?username=<?php print $objArr[0];?>&password=<?php print $objArr[1];?>",         "quiet": 0,     }  ); }) </script>       </div></td>
</tr>
</tbody>
</table>

</body>
</html>

<?php

}}

?>
