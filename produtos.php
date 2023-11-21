<?php
// conexão com o banco
require_once("app/config/conexao.php");

$consultaProdutos = $pdoConnection->query("SELECT * FROM produtos ORDER BY idProduto DESC");
?>

<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8" />
    <title>Ateliê Psicopedagógico</title>
    <link rel="shortcut icon" href="public/assets/images/logoremovido.png">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="public/assets/css/main.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
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
            <li class="item-menu ativo">
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

        </ul>
    </nav>
    <script src="public/assets/js/menu.js"></script>

    <!-- Wrapper -->
    <div id="wrapper">
        <!-- Main -->
        <div id="main">
            <div class="inner">
                <!-- Header -->
                <header id="header">
                    <a href="index.php" class="logo"><img src="public/assets/images/logo.jpeg" alt="" /></a>
                </header>


                <!-- Banner -->
                <section id="container">
                    <img src="public/assets/images/produtos.png" width="100%">
                </section>

                <!-- Section -->
                <section>
                    <header class="major">
                        <h2>Produtos</h2>
                        <br>
                    </header>
                    <div class="container">
                        <div class="row">
                            <?php
                            if ($consultaProdutos) {
                                while ($conteudo = $consultaProdutos->fetch(PDO::FETCH_ASSOC)) {
                                    $nome =  $conteudo['nome'];
                                    $descricao =  $conteudo['descricao'];
                                    $preco =  $conteudo['preco'];
                                    $imagem =  $conteudo['imagem'];
                            ?>
                                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 d-flex align-items-stretch">
                                        <div class="card text-center bg-light">
                                            <a href="#" class="card-img-top">
                                                <img src="app/controller/<?= $imagem ?>" alt="" style="width: 100%; height: 140px; object-fit: cover;">
                                            </a>
                                            <div class="card-header">
                                                <?= $preco ?>
                                            </div>
                                            <div class="card-body">
                                                <h5 class="card-title"><?= $nome ?></h5>
                                                <p class="card-text">
                                                    <?= $descricao ?>
                                                </p>
                                            </div>
                                            <div class="card-footer">
                                                <form class="d-block">

                                                    <button class="btn btn-danger">
                                                        <a href="contato.php" style="text-decoration: none; color:white;">
                                                            Contactar
                                                    </button></a>
                                                </form>
                                                <small class="text-success">Em estoque</small>
                                            </div>
                                        </div>
                                    </div>
                            <?php
                                }
                            } else {
                                echo "Erro na consulta SQL: " . $pdoConnection->errorInfo()[2];
                            }
                            ?>
                        </div>
                    </div>
                </section>


                <hr>
                <section id="contactar">

                    <div class="content" style="display: flex; justify-content: center; align-items: center; flex-direction: column; text-align: center;">
                        <header style="text-align: center; color: black;">
                            <h1 style="font-family: 'Cinzel Decorative', cursive; font-size: 2.5em; color: black;">NÃO ENCONTROU O QUE QUERIA?</h1>
                            <h3 style="font-family: 'Cinzel Decorative', cursive; font-size: 1.5em; color: black;">Também personalizamos produtos!</h3>
                        </header>
                        <a href="contato.php" style="text-align: center;">
                            <button class="contactar" style="color: black;">Entrar em contato</button>
                        </a>
                    </div>

                </section>
            </div>
        </div>
    </div>
    <footer id="footer">
        <div class="inner">
            <div class="footer-content">
                <div class="social-icons">
                    <a href="https://www.facebook.com/danineuropsicopedagoga/" class="social-icon"><i class="bi bi-facebook"></i></a>
                    <a href="https://www.instagram.com/ateliepsicopedagogico/" class="social-icon"><i class="bi bi-instagram"></i></a>
                    <a href="https://wa.me/5511976553216" class="social-icon"><i class="bi bi-whatsapp"></i></a>
                </div>
                <div class="footer-info">
                    <p>"Me movo como educador, porque, primeiro, me movo como gente."</p>
                    <p>&copy; 2023 Ateliê Psicopedagógico.</p>

                    <p>Todos os direitos reservados</p>

                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="public/assets/js/jquery.min.js"></script>
    <script src="public/assets/js/browser.min.js"></script>
    <script src="public/assets/js/breakpoints.min.js"></script>
    <script src="public/assets/js/util.js"></script>
    <script src="public/assets/js/main.js"></script>
</body>

</html>