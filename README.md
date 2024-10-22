<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>IES Infanta Elena</title>
  <!DOCTYPE html>

  <!-- Aquí va el favicon -->
  <link rel="icon" href="n7hSOEiD_400x400.ico" type="image/x-icon">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <style>
 .fondo-div {
            width: 100%;           /* Ancho del div */
            height: 500px;        /* Alto del div */
            background-image: url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcReAy5u_NniI_-NduEBrw6y1Jn13j1qpPMzhw&s'); /* Ruta de la imagen */
            background-size: cover; /* Ajusta la imagen para cubrir todo el div */
            background-position: center; /* Centra la imagen */
            color: white;          /* Color del texto dentro del div */
            display: flex;         /* Usar flexbox para centrar el contenido */
            justify-content: center; /* Centra horizontalmente */
            align-items: center;   /* Centra verticalmente */
            text-align: center;    /* Centra el texto */
        }

    body {
  background-color: lightgray;
    }

    .contenedor {
      display: flex;
      align-items: center;
      justify-content: center;
    }

    img {
      width: 70%;
      height: auto;
    }

    #menu_principal {
      background-color: gainsboro;
      border-radius:  30px 30px 0px 0px;
     
    }

    .navbar-collapse ul li {

    margin: 10%;
     

    }

    .navbar-collapse ul li a {
      border-radius: 30%;
      padding: 20%;
      width: 100%;
      height: 90%;
      
    }

    .navbar-collapse ul li a:hover {
      
      background-color: purple;
      color: white;
    }

    h1 {
      padding: 5% 10% 10% 10%;
      font-size: 4em;
    }

    #active {
      color: white;
      border-radius: 30%;
      background-color: purple;
      

    }
  </style>
</head>

<body class="m-3">
  <nav id="menu_principal" class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#"><img
        src="https://www.iesinfantaelena.es/wp-content/uploads/2023/01/logoiesinfantaelena-300x78.png" alt=""></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" id="active" href="#">Inicio</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Contenido</a>
        </li>
   
        <li class="nav-item">
          <a class="nav-link" href="#">Profesores</a>
        </li>
      
      </ul>
    </div>
  </nav>
  <main>
    <div class="fondo-div">
    <h1 class="text-center">Consejeria Infanta Elena</h1>
  </div>
  </main>
</body>

</html>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
