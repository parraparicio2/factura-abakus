<!doctype html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<!--meta name="viewport" content="width=device-width, initial-scale=1"-->

<title>Factura</title>
<link rel="icon" type="images/png" href="images/logouser.png" />
<link href="css/style.css" rel="stylesheet">
<link href="css/bootstrap.css" rel="stylesheet">
<link rel="stylesheet" href="css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="css/jquery-ui-1.9.2.custom.css">

  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap-3.3.6.js"></script>
  <script src="js/jquery-ui-1.9.2.custom.min.js"></script>
  <script src="js/functions.js"></script>
  
</head>
<?php 

   //require_once(dirname(__FILE__) . '/functions.php');
require_once('/modalmessages.php');
?>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="index.php">Abako Ventures</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Mantenimiento
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="productos.php">Productos</a></li>
          <li><a href="sedes.php">Sedes</a></li>
          <li><a href="clientes.php">Clientes</a></li> 
        </ul>
      </li>
      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Facturación
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="factura.php">Facturar</a></li>
		  <li><a href="buscarfactura.php">Buscar Factura</a></li>
        </ul>
      </li>

      
    </ul>
  </div>
</nav>

<body>