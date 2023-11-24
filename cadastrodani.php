<!DOCTYPE HTML>


<html>

<head>

  <meta charset="utf-8" />
  <title>Ateliê Psicopedagógico</title>

  <link rel="shortcut icon" href="public/assets/images/logoremovido.png">

  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
  <link rel="stylesheet" href="public/assets/css/estyle.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
  <script src="public/assets/js/validacao.js"></script>


</head>

<body class="is-preload">
  <nav class="menu-lateral">
    <div class="btn-expandir">
      <i class="bi bi-list" id="btn-exp"></i>
    </div>
    <ul>

      <li class="item-menu">
        <a href="index">
          <span class="icon"><i class="bi bi-house"></i></span>
          <span class="txt-link">HOME</span>
        </a>
      </li>
      <li class="item-menu">
        <a href="textos">
          <span class="icon"><i class="bi bi-layout-text-window"></i></span>
          <span class="txt-link">TEXTOS</span>
        </a>
      </li>
      <li class="item-menu">
        <a href="#">
          <span class="icon"><i class="bi bi-shop"></i></span>
          <span class="txt-link">PRODUTOS</span>
        </a>
      </li>
      <li class="item-menu">
        <a href="contato">
          <span class="icon"><i class="bi bi-envelope-at"></i></span>
          <span class="txt-link">CONTATOS</span>
        </a>
      </li>
      <li class="item-menu ativo">
        <a href="logindani">
          <span class="icon"><i class="bi bi-box-arrow-in-right"></i></span>
          <span class="txt-link">LOGIN</span>
        </a>
      </li>
    </ul>
  </nav>
  <script src="public/assets/js/menu.js">
  </script>
  <!-- formulário do cadastro-->
  <div class="conteinercad">

    <div class="form">
      <form action="app/controller/controlVendedora.php" method="post">
        <div class="form-header">

          <h1>Cadastre-se</h1>

          <div class="login-button">
            <button><a href="logindani">Entrar</a></button>
          </div>
        </div>
        <?php
        session_start();
        // Verifique se a mensagem está definida na sessão
        if (isset($_SESSION['mensagem'])) {
          echo '<div class="mensagem">' . $_SESSION['mensagem'] . '</div>';
          unset($_SESSION['mensagem']); // Limpe a mensagem da sessão após exibi-la
        }
        ?>
        <div class="input-group">
          <div id="mensagemSucesso" style="display: none; color: green;">
            Cadastro realizado com sucesso!
          </div>
          <div class="input-box">
            <label for="name">Nome</label>
            <input id="name" type="text" name="nome" placeholder="Digite seu nome" required>
          </div>

          <div class="input-box">
            <label for="cpf">CPF</label>
            <input id="cpf" type="text" name="cpf" placeholder="Digite seu CPF" required>
          </div>


          <div class="input-box">
            <label for="cep">CEP</label>
            <input id="cep" type="text" name="cep" placeholder="Digite seu cep" required>
          </div>
          <div class="input-box">
            <label for="logradouro">Logradouro</label>
            <input id="logradouro" type="text" name="logradouro" placeholder="Digite seu logradouro" required>
          </div>

          <div class="input-box">
            <label for="bairro">Bairro</label>
            <input id="bairro" type="text" name="bairro" placeholder="Digite seu bairro" required>
          </div>

          <div class="input-box">
            <label for="localidade">Localidade</label>
            <input id="localidade" type="text" name="cidade" placeholder="Digite sua Localidade" required>
          </div>

          <div class="input-box">
            <label for="uf">UF</label>
            <input id="uf" type="text" name="uf" placeholder="Digite seu UF" required>
          </div>



          <div class="input-box">
            <label for="telefone">Telefone</label>
            <input id="telefone" type="text" name="telefone" placeholder="(xx) 9xxxxxxxx" required>
          </div>

          <div class="input-box">
            <label for="email">Seu email</label>
            <input id="email" type="email" name="email" placeholder="Digite seu email" required>
          </div>

          <div class="input-box">
            <label for="perguntarec">Pergunta para recuperar senha</label>
            <input id="perguntarec" type="text" name="perguntarec" placeholder="1º animal de estimação?" required>
          </div>
          <div class="input-box">
            <label for="senha">Senha</label>
            <input id="senha" type="password" name="senha" placeholder="Digite sua senha" required>
          </div>

        </div>

        <div class="continue-button">
          <input type="hidden" name="acao" value="IncluirVendedora">

          <button type="submit" name="acao" value="IncluirVendedora">ENVIAR</button>
        </div>
      </form>
    </div>
  </div>



  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"> </script> <!-- para os ícones!-->
  <script nomodule src="https://unpkg .com/ionicons@5.5.2/dist/ionicons/ionicons.js"> </script>

</body>

</html>