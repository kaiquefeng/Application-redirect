<?php 
    function logarUsuario($email, $senha){
        $arquivo = "json/usuarios.json";
        $logado = false;

        $jsonUsuarios = file_get_contents($arquivo);

        $arrayUsuarios = json_decode($jsonUsuarios, true);

        foreach ($arrayUsuarios["usuarios"] as $key => $value) {
            if($email == $value["email"] && password_verify($senha, $value["senha"])){
                session_start();

                $_SESSION["nome"] = $value["nome"];
                $_SESSION["senha"] = $value["senha"];
                $_SESSION["logado"] = true;

                break;
            }
        }
        return $logado;
    }

    if($_POST){
        $email = $_POST["email"];
        $senha = $_POST["senha"];

        $logado = logarUsuario($email, $senha);
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Login</title>
</head>


  <body class="text-center container">
    <form class="form-signin" method="POST">
      <img class="mb-4" src="assets/images/logo.png" alt="" >
      <!-- <h1 class="h3 mb-3 font-weight-normal">Faça login</h1> -->
      <label for="email" class="sr-only">Endereço de email</label>
      <input type="email" id="email" name="email" class="form-control" placeholder="Seu email" required autofocus>
      
      <label for="senha" class="sr-only">Senha</label>
      <input type="password" id="senha" name="senha" class="form-control" placeholder="Senha" required> <br>
      <!-- <div class="checkbox mb-3">
        <label>
          <input type="checkbox" value="remember-me"> Lembrar de mim
        </label>
      </div> -->
      <button class="btn btn-lg btn-dark btn-block" type="submit">Login</button>
      <br>
      

      <?php if($_POST && isset($logado) && !$logado): ?>
            <div class="alert alert-danger">
                <p>Usuário ou senha inválidos</p>
            </div>
        <?php elseif(isset($logado) && $logado):?>
            <?php header("Location: cursinho-da-poli.php"); ?>
        <?php endif; ?>

      <p class="mt-5 mb-3 text-muted">&copy; 2019</p>
    </form>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>