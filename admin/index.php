<!doctype html>

<html lang="spa">

  <head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Inicio de Sesión · Pollería</title>

    <link href="../resources/bootstrap/css/bootstrap.min.css" rel="stylesheet">



    <style>

      .bd-placeholder-img {

        font-size           : 1.125rem;

        text-anchor         : middle;

        -webkit-user-select : none;

        -moz-user-select    : none;

        user-select         : none;

      }



      @media (min-width: 768px) {

        .bd-placeholder-img-lg {

          font-size         : 3.5rem;

        }

      }

      

      html,

body {

  height: 100%;

}



body {

  display: flex;

  align-items: center;

  padding-top: 40px;

  padding-bottom: 40px;


}



.form-signin {

  width: 100%;

  max-width: 330px;

  padding: 15px;

  margin: auto;

}



.form-signin .checkbox {

  font-weight: 400;

}



.form-signin .form-floating:focus-within {

  z-index: 2;

}



.form-signin input[type="email"] {

  margin-bottom: -1px;

  border-bottom-right-radius: 0;

  border-bottom-left-radius: 0;

}



.form-signin input[type="password"] {

  margin-bottom: 10px;

  border-top-left-radius: 0;

  border-top-right-radius: 0;

}



      

    </style>



    

    <!-- Custom styles for this template -->

    <link href="signin.css" rel="stylesheet">

    </head>

    <body class="text-center">

        <main class="form-signin">

            <form>

                <img class="mb-4" src="../resources/images/general/gallo.png" alt="" w>

                <h1 class="h3 mb-3 font-weight-normal">Iniciar Sesión</h1>

        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas porttitor congue massa. urna</p>



    <div class="form-floating">

      <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">

      <label for="floatingInput">Usuario</label>

    </div>

    <div class="form-floating">

      <input type="password" class="form-control" id="floatingPassword" placeholder="Password">

      <label for="floatingPassword">Contraseña</label>

    </div>



    <div class="checkbox mb-3">

      <label>

        <input type="checkbox" value="remember-me"> Recordarme

      </label>

    </div>

    <button class="w-100 btn btn-lg btn-primary" type="submit">Ingresar</button>

    <p class="mt-5 mb-3 text-muted">&copy; 2021–2022</p>

            </form>

        </main>  

    </body>

</html>