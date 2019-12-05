<?php
    function cadastraUsuario($value){
        $arquivo = "json/usuarios.json";

        $jsonUsuarios = file_get_contents($arquivo);

        $arrayUsuarios = json_decode($jsonUsuarios, true);

        array_push($arrayUsuarios["usuarios"], $value);

        $jsonUsuarios = json_encode($arrayUsuarios, JSON_UNESCAPED_SLASHES);

        $cadastrou = file_put_contents($arquivo, $jsonUsuarios);

        return $cadastrou;
    }

    
    if($_POST){
        if($_FILES){
            if($_FILES["avatar"]["error"] == UPLOAD_ERR_OK){
                $nomeImg = $_FILES["avatar"]["name"];
                $nomeTmp = $_FILES["avatar"]["tmp_name"];

                $raizProjeto = dirname(__FILE__);

                $caminhoJson = "/assets/img/uploads/";

                $pastaUploads = $raizProjeto . $caminhoJson;

                $caminhoUpload = $pastaUploads . $nomeImg;

                $moveu = move_uploaded_file($nomeTmp, $caminhoUpload);
            }
        }

        $nome = $_POST["nome"];
        $email = $_POST["email"];
        $senha = $_POST["senha"];

        $novoUsuario = [
            "nome" => $nome,
            "email" => $email,
            "senha" => password_hash($senha, PASSWORD_DEFAULT),
        ];

        $cadastrou = cadastraUsuario($novoUsuario);
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
    
    <form class="form-signin" method="POST" enctype="multipart/form-data" >
      <!-- <img class="mb-4" src="assets/images/logo.png" alt="" > -->
      <h2>Registrar-se</h2>
      <p>Faça o cadastro de um cliente para que tenha acesso ao sistema de Busniess Inteligence (BI)</p>
      <!-- <h1 class="h3 mb-3 font-weight-normal">Faça login</h1> -->
      <label for="nome" class="sr-only" name="nome">Nome</label>
      <input type="text" id="nome" name="nome" class="form-control" placeholder="Seu nome" required autofocus>
      <label for="inputEmail" class="sr-only">Endereço de email</label>
      <input type="email" id="email" name="email" class="form-control" placeholder="Seu email" required autofocus>
      <label for="inputPassword" class="sr-only">Senha</label>
      <input type="password" id="senha" name="senha" class="form-control" placeholder="Senha" required>
      <div class="checkbox mb-3">
        <!-- <label>
          <input type="checkbox" value="remember-me"> Lembrar de mim
        </label> -->
      </div>
      <button class="btn btn-lg btn-dark btn-block" type="submit">Registrar</button>
      <br>

      <p><a href="index.php">Fazer Login</a></p>

      <br>
      <?php if(isset($cadastrou) && $cadastrou): ?>
            <div class="alert alert-success">
                <p>Usuário cadastrado com sucesso</p>
            </div>
        <?php endif; ?>
      <p class="mt-5 mb-3 text-muted">&copy; 2019</p>
    </form>

    


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>