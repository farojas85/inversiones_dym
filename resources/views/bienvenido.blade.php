<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <title>Inversiones DYM</title>

        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700" rel="stylesheet">

        <!-- Bootstrap core CSS -->
        <link href="fronted/css/bootstrap.min.css" rel="stylesheet">

        <!-- Owl Carousel CSS -->
        <link href="fronted/css/owl.carousel.css" rel="stylesheet">
        <link href="fronted/css/owl.theme.default.min.css" rel="stylesheet">

        <!-- Icon CSS -->
        <link href="fronted/css/font-awesome.min.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="fronted/css/style.css" rel="stylesheet">



        <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
        <!--[if lt IE 9]>
          <script src="fronted/js/html5shiv.js"></script>
          <script src="fronted/js/respond.min.js"></script>
        <![endif]-->

    </head>


    <body data-spy="scroll" data-target="#navbar-menu">

        <!-- Navbar -->
        <nav class="navbar navbar-custom navbar-expand-lg navbar-light">
            <div class="container">
                <a class="navbar-brand logo" href="#">Inversiones D&amp;M</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsMenu" aria-controls="navbarsMenu" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarsMenu">
                    <ul class="navbar-nav ml-auto">
                    @auth
                        <li class="nav-item active">
                            <a class="nav-link" href="/home">Home</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="btn btn-custom navbar-btn" href="/login">Iniciar Sesi&oacute;n</a>
                        </li>
                        <!--<li class="nav-item">
                            <a class="nav-link" href="/register">Registrarse</a>
                        </li>-->
                    @endauth
                    </ul>

                </div>
            </div>
        </nav>
        <!-- End navbar-custom -->
        <!-- HOME -->
        <section class="home bg-img-1" id="home">
            <div class="bg-overlay"></div>
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <div class="home-fullscreen">
                            <div class="full-screen">
                                <div class="home-wrapper home-wrapper-alt">
                                    <h2 class="text-white">Sistema de Gesti&oacute;n de Pr&eacute;stamos, Cr&eacute;ditos y Cobranza</h2>
                                    <h4 class="">Administre sus clientes, personal de cobros, sus pr&eacute;stamos y cobranzas de manera r&aacute;pida.</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- END HOME -->

        <!-- FOOTER -->
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <p class="text-muted copyright">&copy; 2019. Todos los Derechos Reservados</p>
                    </div>
                    <div class="col-md-3 ml-auto">
                        <ul class="social-icons text-md-right">
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                        </ul>
                    </div>
                </div> <!-- end row -->
            </div> <!-- end container -->
        </footer>
        <!-- End Footer -->       

        <!-- Back to top -->    
        <a href="#" class="back-to-top" id="back-to-top"> <i class="fa fa-angle-up"></i> </a>


        <!-- js placed at the end of the document so the pages load faster -->
        <script src="fronted/js/jquery.min.js"></script>
        <script src="fronted/js/popper.min.js"></script>
        <script src="fronted/js/bootstrap.min.js"></script>

        <!-- Jquery easing -->                                                      
        <script type="text/javascript" src="fronted/js/jquery.easing.1.3.min.js"></script>

        <!--common script for all pages-->
        <script src="fronted/js/jquery.app.js"></script>

        <script type="text/javascript">
            $('.owl-carousel').owlCarousel({
                loop:true,
                margin:10,
                nav:false,
                autoplay: true,
                autoplayTimeout: 4000,
                responsive:{
                    0:{
                        items:1
                    }
                }
            })
        </script>

    </body>
</html>