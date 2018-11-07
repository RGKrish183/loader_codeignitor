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

		<script src="https://code.highcharts.com/highcharts.js"></script>
		<script src="https://code.highcharts.com/modules/exporting.js"></script>
		<script src="https://code.highcharts.com/modules/export-data.js"></script>

		<div id="container" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>

	</div>

	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
</div>

</body>
<script>

$.ajax({
	url:'./chartdata',
	method:'get',
	success:function(data){
		let chart = JSON.parse(data);

		let final = new Array();

		chart.forEach(element => {
			let temp = new Object();
			temp["y"] = parseInt(element.y);
			temp["name"] = (element.name);
			final.push(temp);
		});


		Highcharts.chart('container', {
		chart: {
			plotBackgroundColor: null,
			plotBorderWidth: null,
			plotShadow: false,
			type: 'pie'
		},
		title: {
			text: 'Users Details'
		},
		tooltip: {
			pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
		},
		plotOptions: {
			pie: {
			allowPointSelect: true,
			cursor: 'pointer',
			dataLabels: {
				enabled: true,
				format: '<b>{point.name}</b>: {point.percentage:.1f} %',
				style: {
				color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
				}
			}
			}
		},
		series: [{
			name: 'Brands',
			colorByPoint: true,
			data: final
		}]
		});


		// console.log(data);
	}
});


</script>

</html>