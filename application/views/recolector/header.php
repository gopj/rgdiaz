<?php
	session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<!-- base_url -->
		<base href="<?php echo base_url(); ?>"/>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!-- Bootstrap CSS --> 	
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<link href="css/bootstrap4/open-iconic-bootstrap.css" rel="stylesheet">
    	<link href="css/bootstrap4/sticky-footer.css" rel="stylesheet">
    	<!-- <link href="css/bootstrap4/dataTables.bootstrap4.min.css" rel="stylesheet"> -->
    	<link href="css/bootstrap4/jquery.dataTables.min.css" rel="stylesheet">
    	<link href="css/recolector.css" rel="stylesheet">
    	

    	<style type="text/css">
			/*table.dataTable thead tr {
				background-color: #28A745;
				color: white;
			}
			table.dataTable tfoot tr { 
				background-color: #28A745;
				color: white;	
			}
			.page-item.active .page-link {
				background-color: #28A745;
				border-color: black;
			}*/

			table.dataTable thead th{
				background: white;
			}

			table.dataTable.table-striped.DTFC_Cloned tbody tr:nth-of-type(odd) {
				background: #F3F3F3;
			}

			table.dataTable.table-striped.DTFC_Cloned tbody tr:nth-of-type(even) {
				background: white;
			}
    	</style>
		<title>Recolector</title>
	</head>
	<body>
	
		<nav class="navbar navbar-dark bg-success">
			<a class="navbar-brand" href="#">
				Recolector
			</a>
		</nav>

		<div class="container" style="padding-top:10px;">
			<div class="row">
				<div class="span14">
					<img src="img/logo.png" style="width:300px;">
				</div>
			</div>
		</div>
					