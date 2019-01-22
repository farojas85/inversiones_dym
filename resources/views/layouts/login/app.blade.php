<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta name="description" content="Sistema de Cobranzas" />
    <meta name="author" content="farbesoft" />
    <title>Inversiones DyM</title>
    <!-- google font -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet" type="text/css" />
	<!-- icons -->
    <link href="fonts/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
	<link href="fonts/material-design-icons/material-icon.css" rel="stylesheet" type="text/css" />
    <!-- bootstrap -->
	<link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- style -->
    <link rel="stylesheet" href="assets/css/pages/extra_pages.css">
	<!-- favicon -->
    <link rel="shortcut icon" href="assets/img/favicon.ico" /> 
</head>
<body>
    @yield('contenido')
    <!-- start js include path -->
    <script src="assets/plugins/jquery/jquery.min.js" ></script>
    <script src="assets/js/pages/extra_pages/pages.js" ></script>
    <!-- end js include path -->
</body>
</html>