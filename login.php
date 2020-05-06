<!DOCTYPE html>
<html>
<head>
	<title>login</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
 
	<h1>L O G I N</h1>
 
	<?php 
	if(isset($_GET['pesan'])){
		if($_GET['pesan']=="gagal"){
			echo "<div class='alert'>Username dan Password tidak sesuai !</div>";
		}
	}
	?>
  
	<div class="kotak_login">
 
		<form action="index.php" method="post">
			<label>Username</label>
			<input type="text" name="username" class="form_login" required="required">
 
			<label>Password</label>
			<input type="password" name="password" class="form_login" required="required">
 
			<input type="submit" class="tombol_login" value="LOGIN">
 
			<br/>
			<br/>
		</form>
		
	</div>
 
 
</body>
</html>