<?php
session_start();

include('app/config/conexao.php');

$erro = ''; // Inicialize a variável de erro

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cpf = $_POST['cpf'];
    $senha = $_POST['senha'];

    try {
        // Use a conexão PDO obtida do arquivo conexao.php
        $pdo = $pdoConnection;

        $stmt = $pdo->prepare("SELECT idVendedora FROM vendedora WHERE cpf = :cpf AND senha = :senha");
        $stmt->bindParam(':cpf', $cpf);
        $stmt->bindParam(':senha', $senha);

        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $_SESSION['user'] = $row['idVendedora'];
            header("Location: app/dashboard/dashboard.php");
            exit();
        } else {
            $erro = "CPF ou senha incorretos.";
        }
    } catch (PDOException $e) {
        echo "Erro na conexão: " . $e->getMessage();
    }
}
?>
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

<style>
    .password-recovery-link {
        margin-top: 16px;
        /* Espaçamento superior para separar o botão "Continuar" do link "Esqueceu sua senha?" */
        text-align: center;
    }

    .password-recovery-link a {
        text-decoration: none;
        /* Remova a decoração de sublinhado do link */
        color: #007bff;
        /* Cor do link */
        font-size: 16px;
        /* Tamanho da fonte do link */
    }

    .password-recovery-link a:hover {
        text-decoration: underline;
        /* Sublinhar o link quando o mouse passar por cima */
    }
</style>

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
                <a href="produtos">
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
    <!-- formulário do login -->
    <div class="conteinercadlog">
        <div class="form">
            <form action="logindani" method="post">
                <div class="form-header">
                    <h1>Login</h1>
                    <div class="login-button">
                        <button><a href="cadastrodani">Cadastre-se</a></button>
                    </div>
                </div>
                <?php
                if (isset($_SESSION['mensagem'])) {
                    echo $_SESSION['mensagem'];
                    unset($_SESSION['mensagem']);
                }
                if (!empty($erro)) {
                    echo "<p class='error-message'>$erro</p>"; // Exiba a mensagem de erro aqui
                }

                ?>
                <div class="input-group">
                    <div class="input-box">
                        <label for="cpf">CPF</label>
                        <input id="cpf" type="text" name="cpf" placeholder="Digite seu CPF" required>
                    </div>

                    <div class="input-box">
                        <label for="senha">Senha</label>
                        <input id="senha" type="password" name="senha" placeholder="Digite sua senha" required>
                    </div>
                </div>

                <div class="continue-button">
                    <button type="submit">Continuar</button> <!-- Use type="submit" para enviar o formulário -->
                </div>
                <div class="password-recovery-link">
                    <a href="recsenha.php">Esqueceu sua senha? Clique aqui para recuperá-la.</a>
                </div>



            </form>
        </div>
    </div>
</body>

</html>