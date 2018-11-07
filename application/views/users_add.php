<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>
</head>
<body>
<link rel="stylesheet" href="<?php echo site_url(); ?>application/libraries/bootstrap/css/bootstrap.min.css" >
<script src="<?php echo site_url(); ?>application/libraries/javascripts/jquery.min.js" ></script>
<script src="<?php echo site_url(); ?>application/libraries/bootstrap/js/bootstrap.min.js"></script>

<div id="container">
	<h1>Welcome to CodeIgniter!</h1>

	<div class="col-md-6">
		<form action="../insert" method="post">
		<input type="hidden" name="skey" value="<?php echo $skey ?>">
		<label for="user_firstname">
			First Name:
			<input type="text" name="user_firstname" id="user_firstname" class="form-control">
		</label>
		<br/>
		<label for="user_name">
			User Name: *
			<input type="text" name="user_name" id="user_name" class="form-control" required>
		</label>
		<br/>
		<label for="user_pass">
			User Passowrd: *
			<input type="text" name="user_pass" id="user_pass" class="form-control" required>
		</label>
		<br/>
		<input type="submit" class="btn btn-success" name="useradd_action" id="useradd_action" value="Add">
		<input type="button" class="btn btn-danger" onclick="window.location.href='../index'" value="Cancel">
		</form>
	</div>

	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
</div>

</body>
</html>