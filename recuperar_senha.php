<!DOCTYPE HTML>
<html>




<head>
    <title>Ateliê Psicopedagógico</title>
    <link rel="shortcut icon" href="public/assets/images/logoremovido.png">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="shortcut icon" href="public/assets/images/logoremovido.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <meta charset="utf-8">
    <title>Recuperação de Senha</title>
    <link rel="stylesheet" href="public/assets/css/estyle.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        /* Estilos adicionais aqui */
        body {
            font-family: Arial, sans-serif;
            text-align: center;
        }

        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        input[type="text"],
        .texto {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        input[type="submit"] {
            background-color: #f56a6a;
            color: #fff;
            border: none;
            padding: 12px 20px;
            border-radius: 4px;
            font-size: 18px;
            cursor: pointer;
        }

        .error-message {
            color: #ff0000;
            font-size: 16px;
        }
    </style>
</head>

<body>
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
    <div class="container">

        <h1>Nova senha</h1>
        <?php
        session_start();
        if (isset($_SESSION['mensagem'])) {
            echo $_SESSION['mensagem'];
            unset($_SESSION['mensagem']);
        }
        ?>
        <form method="POST" action="app/controller/controlVendedora.php" onsubmit="return validarSenha()">
            <input type="hidden" name="email" value="<?php echo $_GET['email']; ?>">


            <input type="password" class="texto" placeholder="Nova senha" name="novaSenha" id="novaSenha" required>

            <input type="submit" name="acao" value="RecuperarSenha">
        </form>
    </div>

</body>

</html>