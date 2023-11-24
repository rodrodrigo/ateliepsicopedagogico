<!DOCTYPE HTML>
<html>
<?php

include("app/config/conexao.php");

$erro = array(); // Inicialize a variável de erro
if (isset($_POST['ok'])) {

    $email = $_POST['email'];
    $perguntaRecuperacao = $_POST['perguntarec']; // Capturando a pergunta de recuperação

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erro[] = "Email inválido";
    }

    try {
        $stmt = $pdoConnection->prepare("SELECT senha, perguntarec FROM vendedora WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
        $quantidade = $stmt->rowCount();

        if ($quantidade == 0) {
            $erro[] = "O e-mail informado não existe.";
        } else {
            // Verifique se a pergunta de recuperação fornecida corresponde à pergunta armazenada no banco de dados
            if ($usuario['perguntarec'] != $perguntaRecuperacao) {
                $erro[] = "A resposta à pergunta de segurança está incorreta.";
            } else {
                // Se o email e a pergunta de segurança estiverem corretos, redirecione para a página de recuperação de senha
                header("Location: recuperar_senha.php?email=" . urlencode($email));

                exit();
            }
        }
    } catch (PDOException $e) {
        echo "Erro na conexão: " . $e->getMessage();
    }
}
?>



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

        input[type="text"] {
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
        <h1>Recuperação de Senha</h1>
        <?php
        if (count($erro) > 0) {
            foreach ($erro as $msg) {
                echo "<p class='error-message'>$msg</p>";
            }
        }
        ?>
        <form method="POST" action="">
            <input type="text" placeholder="E-mail" name="email" required>
            <input type="text" placeholder="1º animal de estimação?" name="perguntarec" required>

            <input type="submit" name="ok" value="Recuperar Senha">
        </form>
    </div>
</body>

</html>