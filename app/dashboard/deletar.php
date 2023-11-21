<?php
session_start();

// Verifique se a sessão do usuário não está vazia (ou seja, se o usuário está logado)
if (!isset($_SESSION['user'])) {
    header("Location: ../../index"); // Redirecionar para a página de login
    exit();
}
?>
<script>
    function confirmLogout() {
        if (confirm("Tem certeza de que deseja sair?")) {
            window.location.href = "sair.php";
        }
    }
</script>

<!DOCTYPE HTML>
<?php




require_once("../config/conexao.php");
$pdo = getPDOConnection(); // Obtém a conexão com o banco de dados

$consulta = $pdo->query("SELECT idPostagem, titulo FROM postagem");
$posts = $consulta->fetchAll(PDO::FETCH_ASSOC);


$consultaproduto = $pdo->query("SELECT idProduto, nome FROM produtos");
$produtos = $consultaproduto->fetchAll(PDO::FETCH_ASSOC);



?>
<html>

<head>

    <meta charset="utf-8" />
    <title>Ateliê Psicopedagógico</title>
    <link rel="shortcut icon" href="../../public/assets/images/logoremovido.png">
    <link rel="stylesheet" href="css/maindel.css" />


    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="../../public/assets/css/main.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

</head>

<body class="is-preload">
    <nav class="menu-lateral">
        <div class="btn-expandir">
            <i class="bi bi-list" id="btn-exp"></i>
        </div>
        <ul>

            <li class="item-menu">
                <a href="dashboard.php">
                    <span class="icon"><i class="bi bi-plus-circle"></i></span>
                    <span class="txt-link">INCLUIR</span>
                </a>
            </li>
            <li class="item-menu ativo">
                <a href="#">
                    <span class="icon"><i class="bi bi-trash3"></i></i></span>
                    <span class="txt-link">DELETAR</span>
                </a>
            </li>
            <li class="item-menu">
                <a href="alterar.php">
                    <span class="icon"><i class="bi bi-house-up"></i></span>
                    <span class="txt-link">ALTERAR</span>
                </a>
            </li>
            <li class="item-menu">
                <a href="gerenciar.php">
                    <span class="icon"><i class="bi bi-table"></i></span>
                    <span class="txt-link">GERENCIAR</span>
                </a>
            </li>
            <li class="item-menu">
                <a href="#" onclick="confirmLogout()">
                    <span class="icon"><i class="bi bi-box-arrow-left"></i></span>
                    <span class="txt-link">SAIR</span>
                </a>
            </li>
        </ul>
    </nav>
    <script src="../../public/assets/js/menu.js">
    </script>
    <!-- Wrapper -->
    <div id="wrapper">

        <!-- Main -->
        <div id="main">
            <div class="inner">


                <!-- Header -->
                <header id="header">
                    <a href="#" class="logo"><img src="../../public/assets/images/logo.jpeg" alt="" /></a>
                    <a href="#" class="logo"><strong>Ateliê</strong> Psicopedagógico</a>
                </header>

                <!-- Banner -->
                <?php
                // Verifique se a mensagem está definida na sessão
                if (isset($_SESSION['msg'])) {
                    echo '<div class="mensagem">' . $_SESSION['msg'] . '</div>';
                    unset($_SESSION['msg']); // Limpe a mensagem da sessão após exibi-la
                }
                ?>
                <br><br>
                <div id="cartas" class="card-container">
                    <div class="card">
                        <div class="card-details">
                            <p class="text-title">DELETAR PRODUTOS</p>
                            <p class="text-body">Clique aqui para deletar produtos da sua loja</p>
                        </div>
                        <div class="w3-container">
                            <button class="card-button" onclick="document.getElementById('id01').style.display='block'" class="w3-button w3-black">DELETAR</button>

                            <div id="id01" class="w3-modal">
                                <div class="w3-modal-content w3-card-4">
                                    <header class="w3-container w3-red">
                                        <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-display-topright">&times;</span>
                                        <strong>
                                            <h2>DELETAR PRODUTOS</h2>
                                        </strong>
                                    </header>
                                    <div class="w3-container">
                                        <!-- Conteúdo do seu modal aqui -->
                                        <br>
                                        <form class="form" action="../controller/controlProdutos.php" method="post">
                                            <p class="title">DELETAR PRODUTOS</p>
                                            <label>
                                                Selecione um produtos para DELETAR:<br>
                                                <select id="produtos" name="produtos">
                                                    <?php foreach ($produtos as $produto) : ?>
                                                        <option value="<?php echo $produto['idProduto']; ?>"><?php echo $produto['nome']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </label>
                                            <div class="flex">
                                                <button type="submit" name="acao" class="submit" value="DeletarProd">ENVIAR</button>
                                            </div>
                                        </form>


                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>





                    <div class="card">
                        <div class="card-details">
                            <p class="text-title">DELETAR TEXTOS</p>
                            <p class="text-body">Clique aqui para deletar postagens</p>
                        </div>
                        <div class="w3-container">
                            <button class="card-button" onclick="document.getElementById('id02').style.display='block'" class="w3-button w3-black">DELETAR</button>

                            <div id="id02" class="w3-modal">
                                <div class="w3-modal-content w3-card-4">
                                    <header class="w3-container w3-red">
                                        <span onclick="document.getElementById('id02').style.display='none'" class="w3-button w3-display-topright" style="font-size: 24px; padding: 10px;">&times;</span>
                                    </header>
                                    <div class="w3-container">
                                        <!-- Conteúdo do seu modal aqui -->
                                        <br>
                                        <form class="form" action="../controller/controlPostagem.php" method="post">
                                            <p class="title">DELETAR NOTÍCIAS</p>
                                            <label>
                                                Selecione uma postagem para DELETAR:<br>
                                                <select id="postagem" name="postagem">
                                                    <?php foreach ($posts as $post) : ?>
                                                        <option value="<?php echo $post['idPostagem']; ?>"><?php echo $post['titulo']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </label>
                                            <div class="flex">
                                                <button type="submit" name="acao" class="submit" value="DeletarPost">ENVIAR</button>
                                            </div>
                                        </form>


                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>



            </div>

            <!-- Scripts -->
            <script src="../../public/assets/js/jquery.min.js"></script>
            <script src="../../public/assets/js/browser.min.js"></script>
            <script src="../../public/assets/js/breakpoints.min.js"></script>
            <script src="../../public/assets/js/util.js"></script>
            <script src="../../public/assets/js/main.js"></script>

</body>

</html>