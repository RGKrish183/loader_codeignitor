<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>
</head>

<link rel="stylesheet" href="<?php echo site_url(); ?>application/libraries/bootstrap/css/bootstrap.min.css" >
<script src="<?php echo site_url(); ?>application/libraries/javascripts/jquery.min.js" ></script>
<script src="<?php echo site_url(); ?>application/libraries/bootstrap/js/bootstrap.min.js"></script>

<link rel="stylesheet" href="<?php echo site_url(); ?>application/libraries/datatables/css/jquery.dataTables.min.css">
<script src="<?php echo site_url(); ?>application/libraries/datatables/js/jquery.dataTables.min.js"></script>

<body>

<a href="./add/" class="btn btn-warning">+ Add</a>
<a href="./logout" class="btn btn-danger">Logout</a>

<div id="container">
	<h1>Welcome to CodeIgniter!</h1>

	<div id="body">

		<table id="myTable" width="100%" border="1">
		<thead>
		<tr>
			<th>First Name</th>
			<th>User Name</th>
			<th>Password</th>
			<th>Edit</th>
			<th>Delete</th>
		</tr>
		</thead>
		<tbody>
		<?php
			if(count($data) > 0) {
				
				foreach ($data as $userdata) {
					?>
					<tr>
						<td><?php echo $userdata->user_firstname; ?></td>					
						<td><?php echo $userdata->user_name; ?></td>					
						<td><?php echo $userdata->user_pass; ?></td>					
						<td><a href="./edit?id=<?php echo $userdata->id; ?>">Edit</a></td>					
						<td><a href="./delete?id=<?php echo $userdata->id; ?>" onclick="return confirm('Are you sure wants to remove this reocrd?');" >Delete</a></td>					
					</tr>
					<?php
				}
			}
		?>
		</table>
		</tbody>
	</div>

	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
</div>

</body>
<script>
$(document).ready( function () {
    $('#myTable').DataTable();
} );
</script>

</html>