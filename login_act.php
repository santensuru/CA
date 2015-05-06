<?php
include('connection.php');
if(isset($_POST['login'])){
	$user = mysql_real_escape_string(htmlentities($_POST['username']));
	$pass = mysql_real_escape_string(htmlentities(md5($_POST['password'])));

	$sql = mysql_query("SELECT * FROM user WHERE username='$user' AND password='$pass'") or die(mysql_error());
	if(mysql_num_rows($sql) == 0){
		echo 'User tidak ditemukan';
	}else{
		$row = mysql_fetch_assoc($sql);
		if($row['level'] == 1){
			$_SESSION['admin']=$user;
			echo '<script language="javascript">alert("Anda berhasil Login sebagai Admin!"); document.location="admin/index.php";</script>';
		}else{
			$_SESSION['guest']=$user;
			echo '<script language="javascript">alert("Anda berhasil Login sebagai Guest!"); document.location="guest/index.php";</script>';
		}
	}
}
?>