<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
	<html lang="es" class="no-js">
		<head>
			<base href="<?php echo base_url(); ?>"/>
			<meta charset="UTF-8"/>
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
			<meta name="description" content="RDIAZ Servicios Integrales en Materia Ambiental"/>
			<meta name="Keywords" content="rdiaz, rgdiaz, ambiental, servicios" />
			<meta http-equiv="expires" content="-1" >
			<title>RDíaz</title>
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<link href="img/minilogo.png" type="image/x-icon" rel="shortcut icon" />
			<link rel="author" type="text/plain" href="humans.txt"/>
			<link rel="sitemap" type="application/xml" title="Sitemap" href="sitemap.xml"/>
			<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
			<link rel="stylesheet" type="text/css" href="css/bootstrap-responsive.css">
			<link rel="stylesheet" type="text/css" href="css/estilos.css">
			<script type="text/javascript" src="js/jquery.js"></script>
			<script src="js/vendor/modernizr-2.6.2.min.js"></script>
			<script type="text/javascript" src="js/bootstrap.js"></script>
			<script type="text/javascript" src="js/valida_form_contacto.js"></script>
			<script type="text/javascript" src="js/valida_form_session.js"></script>
			<script type="text/javascript" src="js/carousel.js"></script>
			<script type="text/javascript" src="js/transition.js"></script>
			<script type="text/javascript" src="js/collapse.js"></script>
			<script>
				$(document).ready(function(){
                	$("#mySlide").carousel();
            	});

            	function seccion(val)
            	{
            		if (val==1)
            		{
            			document.getElementById('info1').style.display='block';
            			document.getElementById('info2').style.display='none';
            			document.getElementById('info3').style.display='none';
            			document.getElementById('info4').style.display='none';
            			document.getElementById('info5').style.display='none';
            			document.getElementById('info6').style.display='none';
            		}
            		if (val==2)
            		{
            			document.getElementById('info1').style.display='none';
            			document.getElementById('info2').style.display='block';
            			document.getElementById('info3').style.display='none';
            			document.getElementById('info4').style.display='none';
            			document.getElementById('info5').style.display='none';
            			document.getElementById('info6').style.display='none';
            		}
            		if (val==3)
            		{
            			document.getElementById('info1').style.display='none';
            			document.getElementById('info2').style.display='none';
            			document.getElementById('info3').style.display='block';
            			document.getElementById('info4').style.display='none';
            			document.getElementById('info5').style.display='none';
            			document.getElementById('info6').style.display='none';
            		}
            		if (val==4)
            		{
            			document.getElementById('info1').style.display='none';
            			document.getElementById('info2').style.display='none';
            			document.getElementById('info3').style.display='none';
            			document.getElementById('info4').style.display='block';
            			document.getElementById('info5').style.display='none';
            			document.getElementById('info6').style.display='none';
            		}
            		if (val==5)
            		{
            			document.getElementById('info1').style.display='none';
            			document.getElementById('info2').style.display='none';
            			document.getElementById('info3').style.display='none';
            			document.getElementById('info4').style.display='none';
            			document.getElementById('info5').style.display='block';
            			document.getElementById('info6').style.display='none';
            		}
            		if (val==6)
            		{
            			document.getElementById('info1').style.display='none';
            			document.getElementById('info2').style.display='none';
            			document.getElementById('info3').style.display='none';
            			document.getElementById('info4').style.display='none';
            			document.getElementById('info5').style.display='none';
            			document.getElementById('info6').style.display='block';
            		}
            	}
			</script>
			<script type="text/javascript">
				$(document).on("ready",main);

				function main(){
					$("#menu a").on("click",irA);
				}

				function irA(){
					var seccion = $(this).attr("href");
					$("body, html").animate({
						scrollTop: $(seccion).offset().top-10
					},400);
				}
			</script>
			<!--[if lt IE 9]>
				<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
			< ![endif]-->
		</head>
		<body>
			<nav >
				<div class="navbar navbar-fixed-top">
					<div class="navbar-inner">
						<div class="container">
							<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</a>
							<div id="menu" class="collapse nav-collapse">
								<ul class="nav pull-right">
									<li class="divider-vertical"></li>
									<li><a href="<?php echo site_url('home/index')?>">Inicio</a></li>
									<li class="divider-vertical"></li>
									<li><a href="#servicios">Servicios</a></li>
									<li class="divider-vertical"></li>
									<li><a href="<?php echo site_url('home/contacto')?>" style="cursor:pointer">Contacto</a></li>
									<li class="divider-vertical"></li>
									<li><a href="<?php echo site_url('home/sitios_interes');?>" style="cursor:pointer">Sitios de interés</a></li>
									<li class="divider-vertical"></li>
									<li><a href="<?php echo site_url('home/sesion');?>" style="margin-top:-10px;"><button type="button" class="btn btn-primary">Acceso a Clientes</button></a></li>
										<!--<form action="<?php// echo site_url('home/sesion');?>" method="post">
											<input type="submit" class="btn btn-primary" value="<Acceso a Clientes"/>
										</form></li>-->
									<li class="divider-vertical"></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</nav>
			
			<div class="container" style="padding-top:50px;">
				<div class="row">
					<div class="span12">
						<img src="img/logo.png" style="height:119px; width:300px;">

						<a href="https://www.facebook.com/RD%C3%ADaz-304155623326307/" target="_blank" class="pull-right" style="padding-top:50px;">
							<img src="img/Facebook_Logo.png" style="height:60px; width:55px;">
						</a>
					</div>
				</div>

					
				
				