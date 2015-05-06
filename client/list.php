<!DOCTYPE HTML>
<html lang="en">
<head>
<title>Home</title>
<meta charset="UTF-8">
<link rel="shortcut icon" type="image/x-icon" href="style/images/favicon.png">
<link rel="stylesheet" type="text/css" href="style/css/style.css" media="all">
<link href='http://fonts.googleapis.com/css?family=Amaranth' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Droid+Serif:400,400italic,700,700italic' rel='stylesheet' type='text/css'>
<!--[if IE 7]>
<link rel="stylesheet" type="text/css" href="style/css/ie7.css" media="all">
<![endif]-->
<!--[if IE 8]>
<link rel="stylesheet" type="text/css" href="style/css/ie8.css" media="all">
<![endif]-->
<!--[if IE 9]>
<link rel="stylesheet" type="text/css" href="style/css/ie9.css" media="all">
<![endif]-->
<script src="style/js/jquery-1.6.4.min.js"></script>
<script src="style/js/ddsmoothmenu.js"></script>
<script src="style/js/jquery.jcarousel.js"></script>
<script src="style/js/jquery.prettyPhoto.js"></script>
<script src="style/js/carousel.js"></script>
<script src="style/js/jquery.flexslider-min.js"></script>
<script src="style/js/jquery.masonry.min.js"></script>
<script src="style/js/jquery.slickforms.js"></script>
</head>
<body>
<div id="wrapper">
  <div id="sidebar">
      <div id="menu" class="menu-v">
      <ul>
        <li><a href="index.html">Home</a>
        </li>
        <li><a href="request1.html">Permintaan</a>
        </li>
        <li><a href="list.php" class="active">Unduh Sertifikat</a>
        </li>
        <li><a href="about_us.html">About Us</a>
        </li>
      </ul>
    </div>
  </div>
  <div id="content">
    <h1 class="title">Welcome To Certificate Authority</h1>
    <div class="line"></div>
    <div class="intro">
      <div>
      <table>
        <tr>
          <td>Nama Instansi</td>
          <td>Sertifikat [PEM]</td>
          <td>Sertifikat [DER]</td>
          <td>Tanggal Kadaluarsa</td>
        </tr>
      <?php
        include("../connection.php");

        $query = "SELECT id, nama, tgl_expired FROM request WHERE status = 2 ;";

        $result = mysql_query($query);

        while ($row = mysql_fetch_array($result)) {
          echo "        <tr>
          <td>".$row[1]."</td>
          <td><a href='download.php?id=".$row[0]."&crt=pem'>download</a></td>
          <td><a href='download.php?id=".$row[0]."&crt=der'>download</a></td>
          <td>".$row[2]."</td>
        </tr>"."\r\n";
        }

        mysql_close($conn);
      ?>
      </table>
    </div>
    </div>
  </div>
</div>
<div class="clear"></div>
<script src="style/js/scripts.js"></script>
<!--[if !IE]> -->
<script src="style/js/jquery.corner.js"></script>
<!-- <![endif]-->
</body>
</html>
