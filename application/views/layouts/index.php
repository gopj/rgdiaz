<!DOCTYPE html>

<head>
    <base href="<?=base_url()?>"/>
    <!-- metas -->
    <meta charset="utf-8">
    <meta name="author" content="Chitrakoot Web" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="description" content="RDi&acute;az - Servicios Integrales en Materia Ambiental" />

    <!-- title  -->
    <title>RDi&acute;az - Servicios Integrales en Materia Ambiental</title>

    <!-- favicon -->
    <link rel="shortcut icon" href="<?=base_url('img/minilogo.png')?>">
    <link rel="apple-touch-icon" href="<?=base_url('img/crizal/logos/apple-touch-icon-57x57.png')?>">
    <link rel="apple-touch-icon" sizes="72x72" href="<?=base_url('img/crizal/logos/apple-touch-icon-72x72.png')?>">
    <link rel="apple-touch-icon" sizes="114x114" href="<?=base_url('img/crizal/logos/apple-touch-icon-114x114.png')?>">

    <!-- plugins -->
    <link href="<?=base_url('css/crizal/bootstrap.min.css');?>" rel="stylesheet">
    <link rel="stylesheet" href="<?=base_url('css/crizal/plugins.css');?>" />

    <!-- revolution slider css -->
    <link rel="stylesheet" href="<?=base_url('css/crizal/rev_slider/settings.css')?>">
    <link rel="stylesheet" href="<?=base_url('css/crizal/rev_slider/layers.css')?>">
    <link rel="stylesheet" href="<?=base_url('css/crizal/rev_slider/navigation.css')?>">

    <!-- search css -->
    <link rel="stylesheet" href="<?=base_url('css/crizal/search.css')?>" />

    <!-- custom css -->
    <link href="css/crizal/styles.css" rel="stylesheet" id="colors">
</head>

<body>

    <!-- start page loading -->
    <div id="preloader">
        <div class="row loader">
            <div class="loader-icon"></div>
        </div>
    </div>
    <!-- end page loading -->

    <!-- start main-wrapper section -->
    <div class="main-wrapper">

        <!-- start header section -->
        <header class="header-style1 menu_area-light">

            <div class="navbar-default">

                <!-- start top search -->
                <div class="top-search bg-theme">
                    <div class="container">
                        <form class="search-form" action="search.html" method="GET" accept-charset="utf-8">
                            <div class="input-group">
                                <span class="input-group-addon cursor-pointer">
                                    <button class="search-form_submit fas fa-search font-size18 text-white" type="submit"></button>
                                </span>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- end top search -->

                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-12 col-lg-12">
                            <div class="menu_area alt-font">
                                <nav class="navbar navbar-expand-lg navbar-light no-padding">
                                    <div class="navbar-header navbar-header-custom">
                                        <!-- start logo -->
                                        <a href="" class="navbar-brand"><img id="logo" src="<?=base_url('img/logos/logo.png')?>" alt="logo"></a>
                                        <!-- end logo -->
                                    </div>

                                    <div class="navbar-toggler"></div>

                                    <!-- menu area -->
                                    <ul class="navbar-nav ml-auto" id="nav" style="display: none;">
                                        <li><a href="<?=base_url()?>">Inicio</a></li>
                                        <li><a href="<?=base_url()?>#section_servicios">Servicios</a></li>
                                        <li><a href="<?=base_url()?>#section_contacto">Contacto</a></li>
                                        <li><a href="<?=base_url()?>#section_sitios">Sitios de Interes</a></li>
                                        <li><a href="<?=base_url('/home/sesion')?>" style="color: #86bc42;">Acceder</a></li>
                                    </ul>
                                    <!-- end menu area -->

                                    <!-- start attribute navigation -->
                                    <div class="attr-nav sm-no-margin sm-margin-70px-right xs-margin-65px-right">
                                        <ul class="top-social-icon">
                                            <li><a href="https://www.facebook.com/RD%C3%ADaz-304155623326307/" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                                        </ul>
                                    </div>
                                    <!-- end attribute navigation -->
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </header>

		<?php echo $output; ?>

        <!-- start footer section -->
        <footer>
            <div class="container">
                <div class="row">

                    <div class="col-lg-4 col-md-6">
                      <br><br>
                      <img alt="footer-logo" src="<?=base_url('img/logos/logo-footer.png')?>">
                    </div>
                      
                    <div class="col-lg-6 col-md-6 offset-lg-1">
                        <h3 class="footer-title-style2 text-theme-color">Ponte en contacto</h3>
                        <ul class="footer-list">
                            <li>
                                <span class="d-inline-block vertical-align-top font-size18"><i class="fas fa-map-marker-alt text-theme-color" style="margin-left: 4px;"></i></span>
                                <span class="d-inline-block width-110 vertical-align-top padding-10px-left">Calle C, núm 427, Parque Industrial Lo de Villa; Colima, Col. C.P. 28075</span>
                            </li>
                            <li>
                                <span class="d-inline-block vertical-align-top font-size18"><i class="fas fa-mobile-alt text-theme-color" style="margin-left: 4px;"></i></span>
                                <span class="d-inline-block width-85 vertical-align-top padding-10px-left" style="margin-left: 2px;">312 157 8255 (WhatsApp Directo)</span>
                            </li>
                            <li>
                                <span class="d-inline-block vertical-align-top font-size18"><i class="fas fa-phone text-theme-color"></i></span>
                                <span class="d-inline-block width-85 vertical-align-top padding-10px-left">312 207 8828 (Oficina)</span>
                            </li>
                            <li>
                                <span class="d-inline-block vertical-align-top font-size18"><i class="far fa-envelope text-theme-color"></i></span>
                                <span class="d-inline-block width-85 vertical-align-top padding-10px-left"> <a href="mailto: diaz281@yahoo.com.mx">diaz281@yahoo.com.mx </a> | <a href="mailto: rigediaz@hotmail.com"> rigediaz@hotmail.com </a> </span>
                            </li>
                            <li>
                                <span class="d-inline-block vertical-align-top font-size18"><i class="fas fa-globe text-theme-color"></i></span>
                                <span class="d-inline-block width-85 vertical-align-top padding-10px-left">www.rdiaz.mx</span>
                            </li>
                        </ul>
                    </div>

                </div>

            </div>
            <div class="footer-bar">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 text-left xs-text-center xs-margin-5px-bottom">
                            <div class="footer-social-icons small">
                                <ul>
                                    <li><a href="https://www.facebook.com/RD%C3%ADaz-304155623326307/" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6 text-right xs-text-center">
                            <p class="xs-margin-5px-top xs-font-size13">Derechos reservados &copy; <?php echo date("Y"); ?> RDíaz</p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end footer section -->
    </div>
    <!-- end main-wrapper section -->

    <!-- start scroll to top -->
    <a href="javascript:void(0)" class="scroll-to-top"><i class="fas fa-angle-up" aria-hidden="true"></i></a>
    <!-- end scroll to top -->

   <!-- all js include start -->

   <!-- jquery -->
   <script src="<?=base_url('js/crizal/jquery.min.js')?>"></script>

   <!-- modernizr js -->
   <script src="<?=base_url('js/crizal/modernizr.js')?>"></script>

   <!-- bootstrap -->
   <script src="<?=base_url('js/crizal/bootstrap.min.js')?>"></script>

   <!-- navigation -->
   <script src="<?=base_url('js/crizal/nav-menu.js')?>"></script>

   <!-- serch -->
   <script src="search/search.js"></script>

   <!-- tab -->
   <script src="<?=base_url('js/crizal/easy.responsive.tabs.js')?>"></script>
   
   <!-- owl carousel -->
   <script src="<?=base_url('js/crizal/owl.carousel.js')?>"></script>

   <!-- jquery.counterup.min -->
   <script src="<?=base_url('js/crizal/jquery.counterup.min.js')?>"></script>

   <!-- stellar js -->
   <script src="<?=base_url('js/crizal/jquery.stellar.min.js')?>"></script>

   <!-- waypoints js -->
   <script src="<?=base_url('js/crizal/waypoints.min.js')?>"></script>

   <!-- tab js -->
   <script src="<?=base_url('js/crizal/tabs.min.js')?>"></script>

   <!-- countdown js -->
   <script src="<?=base_url('js/crizal/countdown.js')?>"></script>

   <!-- jquery.magnific-popup js -->
   <script src="<?=base_url('js/crizal/jquery.magnific-popup.min.js')?>"></script>

   <!-- isotope.pkgd.min js -->
   <script src="<?=base_url('js/crizal/isotope.pkgd.min.js')?>"></script>

   <!--  chart js -->
   <script src="<?=base_url('js/crizal/chart.min.js')?>"></script>

   <!-- thumbs js -->
   <script src="<?=base_url('js/crizal/owl.carousel.thumbs.js')?>"></script>

   <!-- animated js -->
   <script src="<?=base_url('js/crizal/animated-headline.js')?>"></script>

   <!--  clipboard js -->
   <script src="<?=base_url('js/crizal/clipboard.min.js')?>"></script>

   <!--  prism js -->
   <script src="<?=base_url('js/crizal/prism.js')?>"></script>

   <script src="<?=base_url('js/valida_form_contacto.js')?>"></script>

   <script src="<?=base_url('js/valida_form_session.js')?>"></script>
   

   <!-- revolution slider js files start -->
   <script src="<?=base_url('js/crizal/rev_slider/jquery.themepunch.tools.min.js')?>"></script>
   <script src="<?=base_url('js/crizal/rev_slider/jquery.themepunch.revolution.min.js')?>"></script>
   <script src="<?=base_url('js/crizal/rev_slider/extensions/revolution.extension.actions.min.js')?>"></script>
   <script src="<?=base_url('js/crizal/rev_slider/extensions/revolution.extension.carousel.min.js')?>"></script>
   <script src="<?=base_url('js/crizal/rev_slider/extensions/revolution.extension.kenburn.min.js')?>"></script>
   <script src="<?=base_url('js/crizal/rev_slider/extensions/revolution.extension.layeranimation.min.js')?>"></script>
   <script src="<?=base_url('js/crizal/rev_slider/extensions/revolution.extension.migration.min.js')?>"></script>
   <script src="<?=base_url('js/crizal/rev_slider/extensions/revolution.extension.navigation.min.js')?>"></script>
   <script src="<?=base_url('js/crizal/rev_slider/extensions/revolution.extension.parallax.min.js')?>"></script>
   <script src="<?=base_url('js/crizal/rev_slider/extensions/revolution.extension.slideanims.min.js')?>"></script>
   <script src="<?=base_url('js/crizal/rev_slider/extensions/revolution.extension.video.min.js')?>"></script>
   
   <!-- map js -->
   <script src="<?=base_url('js/crizal/map.js')?>"></script>

   <!-- custom scripts -->
   <script src="<?=base_url('js/main.js')?>"></script>

   <!-- contact form scripts -->
   <script src="js/crizal/mailform/jquery.form.min.js"></script>
   <script src="js/crizal/mailform/jquery.rd-mailform.min.c.js"></script>

   <!-- all js include end -->
   
</body>

</html>