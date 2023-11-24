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
$consulta = $pdo->query("SELECT idpostagem, titulo FROM postagem");
$posts = $consulta->fetchAll(PDO::FETCH_ASSOC);

$consultaprod = $pdo->query("SELECT idProduto, nome FROM produtos");
$prods = $consultaprod->fetchAll(PDO::FETCH_ASSOC);



?>


<html>

<head>

    <meta charset="utf-8" />
    <title>Ateliê Psicopedagógico</title>
    <link rel="shortcut icon" href="../../public/assets/images/logoremovido.png">
    <link rel="stylesheet" href="css/mainal.css" />


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
            <li class="item-menu">
                <a href="deletar.php">
                    <span class="icon"><i class="bi bi-trash3"></i></i></span>
                    <span class="txt-link">DELETAR</span>
                </a>
            </li>
            <li class="item-menu ativo">
                <a href="#">
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
                            <p class="text-title">ALTERAR PRODUTOS</p>
                            <p class="text-body">Clique aqui para alterar produtos da sua loja</p>
                        </div>
                        <div class="w3-container">
                            <button class="card-button" onclick="document.getElementById('id01').style.display='block'" class="w3-button w3-black">ALTERAR</button>

                            <div id="id01" class="w3-modal">
                                <div class="w3-modal-content w3-card-4">
                                    <header class="w3-container w3-yellow">
                                        <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-display-topright" style="font-size: 24px; padding: 10px;">&times;</span>
                                    </header>
                                    <div class="w3-container">
                                        <!-- Conteúdo do seu modal aqui -->
                                        <br>
                                        <form class="form" action="../controller/controlProdutos.php" method="post" enctype="multipart/form-data">
                                            <p class="title">ATUALIZAR PRODUTOS </p>
                                            <label>
                                                Selecione um Produto:<br>
                                                <select id="produtos" name="produtos">
                                                    <?php foreach ($prods as $prod) : ?>
                                                        <option value="<?php echo $prod['idProduto']; ?>"><?php echo $prod['nome']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </label>
                                            <div class="flex">

                                                <label>
                                                    <input class="input" type="text" placeholder="" name="nome" required>
                                                    <span>Atualizar nome do produto:</span>
                                                </label>


                                            </div>
                                            <label>
                                                <textarea class="input" placeholder="" required name="descricao"></textarea>
                                                <span>Atualizar a descrição do produto:</span>
                                            </label>
                                            <label>
                                                <input class="input" type="text" placeholder="" name="preco" required oninput="formatCurrency(this)">
                                                <span text-align="end">Alterar Preço (00,00)</span>
                                            </label>

                                            <script>
                                                function formatCurrency(input) {
                                                    // Remove qualquer caractere que não seja um dígito ou vírgula
                                                    input.value = input.value.replace(/[^\d,]/g, '');

                                                    // Adiciona 'R$' no início do valor
                                                    if (input.value.length > 0 && input.value !== 'R$') {
                                                        input.value = 'R$' + input.value;
                                                    }

                                                    // Divide a string em partes separadas por vírgula
                                                    var parts = input.value.split(',');

                                                    // Verifica se há mais de uma vírgula (,). Se houver, mantenha apenas a primeira parte
                                                    if (parts.length > 2) {
                                                        input.value = parts[0] + ',' + parts[1];
                                                    }

                                                    // Verifica se a parte decimal (após a vírgula) tem mais de dois dígitos
                                                    if (parts.length === 2 && parts[1].length > 2) {
                                                        input.value = parts[0] + ',' + parts[1].substring(0, 2);
                                                    }
                                                }
                                            </script>

                                            <label for="fileNoticia" class="custum-file-upload">
                                                <div class="text">
                                                    <span>Clique para fazer upload da imagem da notícia</span>
                                                </div>
                                                <input id="fileNoticia" type="file" required="" onchange="displayFileName('fileNoticia', 'fileNameNoticia')" name="fileFoto">
                                            </label>
                                            <p id="fileNameNoticia">Nenhum arquivo selecionado</p>

                                            <script>
                                                function displayFileName(inputId, outputId) {
                                                    const input = document.getElementById(inputId);
                                                    const fileName = document.getElementById(outputId);

                                                    if (input.files.length > 0) {
                                                        fileName.textContent = input.files[0].name;
                                                    } else {
                                                        fileName.textContent = 'Nenhum arquivo selecionado';
                                                    }
                                                }
                                            </script>
                                            <br><br>

                                            <button type="submit" name="acao" class="submit" value="AlterarProd">ENVIAR</button>
                                        </form>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-details">
                            <p class="text-title">ALTERAR TEXTOS</p>
                            <p class="text-body">Clique aqui para alterar postagens</p>

                        </div>
                        <div class="w3-container">
                            <button class="card-button" onclick="document.getElementById('id02').style.display='block'" class="w3-button w3-black">ALTERAR</button>

                            <div id="id02" class="w3-modal">
                                <div class="w3-modal-content w3-card-4">
                                    <header class="w3-container w3-yellow">
                                        <span onclick="document.getElementById('id02').style.display='none'" class="w3-button w3-display-topright" style="font-size: 24px; padding: 10px;">&times;</span>
                                    </header>
                                    <div class="w3-container">
                                        <!-- Conteúdo do seu modal aqui -->
                                        <br>
                                        <form class="form" action="../controller/controlPostagem.php" method="post" enctype="multipart/form-data">
                                            <p class="title">ATUALIZAR NOTÍCIAS </p>
                                            <label>
                                                Selecione uma postagem:<br>
                                                <select id="postagem" name="postagem">
                                                    <?php foreach ($posts as $post) : ?>
                                                        <option value="<?php echo $post['idpostagem']; ?>"><?php echo $post['titulo']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </label>
                                            <div class="flex">

                                                <label>

                                                    <input class="input" type="text" placeholder="" required="" name="nomeVendedora">
                                                    <span>Atualizar autor para:</span>
                                                </label>

                                                <label>
                                                    <input class="input" type="text" placeholder="" required="" name="titulo">
                                                    <span>Novo título</span>
                                                </label>
                                            </div>

                                            <label>
                                                <textarea class="input" placeholder="" required="" heigh name="texto"></textarea>
                                                <span>Atualizar o Conteúdo:</span>
                                            </label>

                                            <label for="fileNoticiaa" class="custum-file-upload">
                                                <div class="text">
                                                    <span>Clique para fazer upload da imagem da notícia</span>
                                                </div>
                                                <input id="fileNoticiaa" type="file" required="" onchange="displayFileName('fileNoticiaa', 'fileNameNoticiaa')" name="fileFoto">
                                            </label>
                                            <p id="fileNameNoticiaa">Nenhum arquivo selecionado</p>

                                            <script>
                                                function displayFileName(inputId, outputId) {
                                                    const input = document.getElementById(inputId);
                                                    const fileName = document.getElementById(outputId);

                                                    if (input.files.length > 0) {
                                                        fileName.textContent = input.files[0].name;
                                                    } else {
                                                        fileName.textContent = 'Nenhum arquivo selecionado';
                                                    }
                                                }
                                            </script>
                                            <br><br>

                                            <button type="submit" name="acao" class="submit" value="AlterarPost">ENVIAR</button>
                                        </form>
                                    </div>

                                </div>
                            </div>
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