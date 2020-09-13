<?php
include_once("../include/class.mysqldb.php");
	include_once("../include/config.inc.php");
	$to_print=$_GET[to];
	$sql = mysql_query("SELECT * FROM mt_gen WHERE ".$to_print."='".$_GET[id]."'");

while($result = mysql_fetch_array($sql)) {
$pro=mysql_fetch_array(mysql_query("SELECT * FROM mt_profile WHERE pro_name='".$result[profile]."'"));
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Hotspot Vouchers</title>
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
   line-height: 115%;   
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

color:#E2341D;
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

	
$sql = mysql_query("SELECT * FROM mt_gen WHERE ".$to_print."='".$_GET[id]."'");
$intRows = 0;
while($result = mysql_fetch_array($sql)) {
$pro=mysql_fetch_array(mysql_query("SELECT * FROM mt_profile WHERE pro_name='".$result[profile]."'"));

echo "<table class=\"kangndo\" style=\" display: inline-block; background-color:".$pro[color]."; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; border-style: initial; border-color: initial; width: 280px; height:140px;\">";
echo "<tbody>";
echo "<tr>";
echo "<td style=\"width: 190px; text-align: center;\"><span style=\"font-weight: bold; color: rgb(255, 255, 255); font-size: 11px; font-family: Tahoma;\">".$pro[card_name]."</span><br>
<table class=\"kangndo\" style=\"background-color:#FFFFFF; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; border-style: initial; border-color: initial; width: 100%; margin-right: auto; margin-left: auto;\">";
echo "<tbody>";
echo "<tr>";
echo "<td style=\"width: 50%; text-align: center;\">Package</td>";
echo "<td style=\"width: 50%; text-align: center;\">".$result[profile]."</td>";
echo "</tr>";
echo "<tr>";
echo "<td style=\"width: 50%; text-align: center;\">Home Page</td>";
echo "<td style=\"width: 50%; text-align: center;\">".$pro[home_page]."</td>";
echo "</tr>";
echo "<tr>";
echo "<td style=\"width: 50%; text-align: center;\">Time Limit</td>";
echo "<td style=\"width: 50%; text-align: center;\">".$pro[time_limit]."</td>";
echo "</tr>";
echo "<tr>";
echo "<td style=\"width: 50%; text-align: center;\">Price</td>";
echo "<td style=\"width: 50%; text-align: center;\">ราคา.&nbsp;".($pro[pro_price]+$pro[vat])."&nbsp;บาท</td>";
echo "</tr>";
echo "</tbody>";
echo "</table>";
echo "<table class=\"kangndo\" style=\"border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; border-style: initial; border-color: initial; width: 100%; margin-right: auto; margin-left: auto;\">";
echo "<tbody>";
echo "<tr>";
echo "<td style=\"width: 50%; text-align: center;\"><span class=\"style4\"style=\"color: rgb(255, 255, 255); font-family: Tahoma;\">Username</span></td>";
echo "<td style=\"width: 50%; text-align: center;\"><span class=\"style4\"style=\"color: rgb(255, 255, 255); font-family: Tahoma;\">Password</span></td>";
echo "</tr>";
 echo "<tr width: 50%>";
echo "<td style=\"background-color:#FFFFFF; width: 50%; text-align: center;\"><span style=\"color: #400000; font-size:16px; font-family:  Tahoma;\">".$result[user]."</span></td>";
echo "<td style=\"background-color:#FFFFFF; width: 50%; text-align: center;\"><span style=\"color: #400000; font-size:16px; font-family: Tahoma;\">".$result[pass]."</span></td>";
echo "</tr>";
echo "</tbody>";
echo "</table>";
echo "<table class=\"kangndo\" style=\"border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; border-style: initial; border-color: initial; width: 100%; margin-right: auto; margin-left: auto;\">";
echo "<tbody>";
echo "<tr>";
echo "<td style=\"width: 40%; text-align: left;\"><span style=\"color: rgb(255, 255, 255); font-family: Tahoma;\">".$pro[pro_limit]."</span></td>";
echo "<td style=\"width: 60%; text-align: right;\"><span style=\"color: rgb(255, 255, 255); font-family: Tahoma;\">Call: ".$pro[phone]." </span></td>";
echo "</tr>";
echo "</table>";
echo "</td>";
echo "<td style=\"background-color:#FFFFFF; width: 10px; text-align: center;\"><div align=\"center\" class=\"qrcode\" id=\"".$result[user]."\"><br><br><font color=\"red\"><span class=\"style3\"><font color=\"red\"><span class=\"style3\">SCAN LOG IN</span><br>
</font></span><script> jQuery(function(){jQuery('#".$result[user]."').qrcode(     {         \"render\": 'div',         \"size\": 80,         \"minVersion\": 5,         \"maxVersion\": 5,         \"ecLevel\": 'L',         \"mode\": 0,         \"text\": \"http://".$pro[server_ip]."/login?username=".$result[user]."&password=".$result[pass]."\",         \"quiet\": 0,     }  ); }) </script>       </div></td>";
echo "</tr>";
echo "</tbody>";
echo "</table>";
 echo"<body onload=\"window.print();\"> ";
}

?>

</body>
</html>




