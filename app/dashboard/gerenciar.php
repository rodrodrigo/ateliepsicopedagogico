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
<html>
<?php
require_once("../config/conexao.php");
$pdo = getPDOConnection(); // Obtém a conexão com o banco de dados
$consultaPedidos = $pdo->query("SELECT * FROM pedidos");
$pedidos = $consultaPedidos->fetchAll(PDO::FETCH_ASSOC);


$consulta = $pdo->query("SELECT idPedido, nomeUsuario, nomeProduto FROM pedidos");
$peds = $consulta->fetchAll(PDO::FETCH_ASSOC);


?>



<head>
    <meta charset="utf-8" />
    <title>Ateliê Psicopedagógico</title>
    <link rel="shortcut icon" href="../../public/assets/images/logoremovido.png">
    <link rel="stylesheet" href="css/maingerenciar.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../../public/assets/css/main.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
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
            <li class="item-menu">
                <a href="alterar.php">
                    <span class="icon"><i class="bi bi-house-up"></i></span>
                    <span class="txt-link">ALTERAR</span>
                </a>
            </li>
            <li class="item-menu ativo">
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
    <script src="../../public/assets/js/menu.js"></script>

    <!-- Wrapper -->
    <div id="wrapper">
        <!-- Main -->
        <div id="main">
            <div class="inner">
                <!-- Header -->
                <header id="header">
                    <a href="#" class="logo">
                        <img src="../../public/assets/images/logo.jpeg" alt="" />
                    </a>
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
                <h3>Últimos Pedidos</h3>


                <div class="a">
                    <button class="CartBtn" onclick="openAdicionarPedidoModal()">
                        <span class="IconContainer">
                            <i class="bi bi-cart-check"></i>
                        </span>
                        <p class="text">Adicionar pedido</p>
                    </button>
                    <button class="CartBtn yellowBtn" onclick="openAlterarPedidoModal()">
                        <span class="IconContainer">
                            <i class="bi bi-backspace-reverse-fill"></i>
                        </span>
                        <p class="text yellowText">Alterar pedido</p>
                    </button>

                    <button class="CartBtn redBtn" onclick="openExcluirPedidoModal()">
                        <span class="IconContainer">
                            <i class="bi bi-x"></i>
                        </span>
                        <p class="text redText">Deletar pedido</p>
                    </button>
                </div>

                <script src="../../public/assets/js/validacaog.js">
                </script>

                <!-- Modal -->
                <!-- Modal -->
                <div id="myModal" class="modal">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3>Formulário de Pedido</h3>
                            <span class="close">&times;</span>
                        </div>
                        <form action="../controller/controlPedidos.php" method="post">
                            <label for="nome">Nome do cliente:</label>
                            <input id="nome" type="text" name="nome" placeholder="Digite o nome do cliente" required><br><br>

                            <label for="email">Email:</label>
                            <input id="email" type="email" name="email" placeholder="Digite o email do cliente" required><br><br>

                            <label for="telefone">Telefone do cliente:</label>
                            <input id="telefone" type="text" name="telefone" placeholder="(xx) 9xxxxxxxx" required><br><br>

                            <label for="dataPedido">Dt Pedido:</label>
                            <input type="date" id="dataPedido" name="dataPedido" required><br><br>

                            <label for="modoPagamento">Modo de Pagamento:</label>
                            <input type="text" id="modoPagamento" name="modoPagamento" required><br><br>

                            <label for="cep">CEP:</label>
                            <input id="cep" type="text" name="cep" placeholder="Digite o cep da pessoa" required><br><br>

                            <label for="endereco">Logradouro:</label>
                            <input id="logradouro" type="text" name="logradouro" placeholder="Digite o logradouro" required><br><br>

                            <label for="numeroEndereco">Número:</label>
                            <input type="text" id="numeroEndereco" name="numeroEndereco" placeholder="nº" required><br><br>
                            <label for="bairro">Bairro:</label>
                            <input id="bairro" type="text" name="bairro" placeholder="Digite o bairro" required><br><br>



                            <label for="cidade">Cidade:</label>
                            <input id="localidade" type="text" name="cidade" placeholder="Digite a Localidade" required><br><br>

                            <label for="uf">UF:</label>
                            <input id="uf" type="text" name="uf" placeholder="Digite o UF" required><br><br>

                            <label for="produto">Produto da loja:</label>
                            <input type="text" id="produto" name="produto" placeholder="Produto da loja" required><br><br>

                            <label for="Preco">Preço</label>
                            <input class="text" type="text" placeholder="R$XX,XX" required oninput="formatCurrency(this)" name="preco">
                            </label>

                            <input type="hidden" name="acao" value="novopedido">
                            <button type="submit" name="acao" class="submit" value="novopedido">Enviar</button>
                        </form>
                    </div>
                </div>



                <div id="alterarPedidoModal" class="modal">
                    <div class="modal-content yellow-header">
                        <div class="modal-header">
                            <h3>Formulário de Pedido</h3>
                            <span class="close">&times;</span>
                        </div>

                        <form action="../controller/controlPedidos.php" method="post">
                            <select id="selectPedido" name="idPedido">
                                <?php foreach ($peds as $ped) : ?>
                                    <option value="<?php echo $ped['idPedido']; ?>"><?php echo $ped['idPedido'] . ' - ' . $ped['nomeUsuario'] . ' - ' . $ped['nomeProduto']; ?></option>
                                <?php endforeach; ?>
                            </select>

                            <label for="nome">Nome do cliente:</label>
                            <input id="nomeUsuario" type="text" name="nomeUsuario" placeholder="Digite o nome do cliente" required><br><br>

                            <label for="email">Email:</label>
                            <input id="emailUsuario" type="email" name="emailUsuario" placeholder="Digite o email do cliente" required><br><br>

                            <label for="telefone">Telefone do cliente:</label>
                            <input id="telefoneUsuario" type="text" name="telefoneUsuario" placeholder="(xx) 9xxxxxxxx" required><br><br>

                            <label for="dataPedido">Dt Pedido:</label>
                            <input type="date" id="dtPedido" name="dtPedido" required><br><br>

                            <label for="modoPagamento">Modo de Pagamento:</label>
                            <input type="text" id="metPag" name="metPag" required><br><br>

                            <label for="cep">CEP:</label>
                            <input id="entregaCEP" type="text" name="entregaCEP" placeholder="Digite o cep da pessoa" required><br><br>

                            <label for="endereco">Logradouro:</label>
                            <input id="entregaEndereco" type="text" name="entregaEndereco" placeholder="Digite o logradouro" required><br><br>

                            <label for="numeroEndereco">Número:</label>
                            <input type="text" id="entregaNumero" name="entregaNumero" placeholder="nº" required><br><br>
                            <label for="bairro">Bairro:</label>
                            <input id="entregaBairro" type="text" name="entregaBairro" placeholder="Digite o bairro" required><br><br>



                            <label for="cidade">Cidade:</label>
                            <input id="entregaCidade" type="text" name="entregaCidade" placeholder="Digite a Localidade" required><br><br>

                            <label for="uf">UF:</label>
                            <input id="" type="text" name="entregaUF" placeholder="Digite o UF" required><br><br>

                            <label for="produto">Produto da loja:</label>
                            <input type="text" id="nomeProduto" name="nomeProduto" placeholder="Produto da loja" required><br><br>

                            <label for="Preco">Preço</label>
                            <input class="text" type="text" placeholder="R$XX,XX" required oninput="formatCurrency(this)" name="valorTotal">

                            <input type="hidden" name="acao" value="alterarpedido">
                            <button type="submit" name="acao" class="submity" value="alterarpedido">Enviar</button>
                        </form>
                    </div>
                </div>

                <!-- Modal de Excluir Pedido -->
                <div id="excluirPedidoModal" class="modal">
                    <div class="modal-content red-header">
                        <div class="modal-header">
                            <h3>Formulário de Excluir Pedido</h3>
                            <span class="close">&times;</span>
                        </div>
                        <form action="../controller/controlPedidos.php" method="post">

                            <p class="title">DELETAR PEDIDO:</p>
                            <label>
                                <select id="pedido" name="pedido">
                                    <?php foreach ($peds as $ped) : ?>
                                        <option value="<?php echo $ped['idPedido'] . ' - '; ?>"><?php echo $ped['nomeUsuario'] . ' - '; ?><?php echo $ped['nomeProduto']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </label>
                            <div class="flex">
                                <button type="submit" name="acao" class="submitr" value="DeletarPedido">ENVIAR</button>
                            </div>
                        </form>

                        </form>
                    </div>
                </div>
                <script>
                    // Script para abrir e fechar o modal
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

                    function openAdicionarPedidoModal() {
                        var modal = document.getElementById("myModal");
                        modal.style.display = "block";
                    }

                    function openAlterarPedidoModal() {
                        var modal = document.getElementById("alterarPedidoModal");
                        modal.style.display = "block";
                    }

                    function openExcluirPedidoModal() {
                        var modal = document.getElementById("excluirPedidoModal");
                        modal.style.display = "block";
                    }

                    function closeModal(modalId) {
                        var modal = document.getElementById(modalId);
                        modal.style.display = "none";
                    }

                    var modals = ["myModal", "alterarPedidoModal", "excluirPedidoModal"];

                    modals.forEach((modalId) => {
                        var modal = document.getElementById(modalId);
                        var span = modal.getElementsByClassName("close")[0];

                        if (span) {
                            span.onclick = function() {
                                closeModal(modalId);
                            };
                        }

                        window.onclick = function(event) {
                            if (event.target == modal) {
                                closeModal(modalId);
                            }
                        };
                    });
                </script>



                <br><br>

                <?php


                echo '<table class="table">';
                echo '<thead class="table__header">';
                echo '<tr class="table__header__row">';
                echo '<th class="table__header__cell">Nº</th>';
                echo '<th class="table__header__cell">Nome</th>';
                echo '<th class="table__header__cell">Email</th>';
                echo '<th class="table__header__cell">Telefone</th>';
                echo '<th class="table__header__cell">Dt Pedido</th>';
                echo '<th class="table__header__cell">Md Pagamento</th>';
                echo '<th class="table__header__cell">CEP</th>';
                echo '<th class="table__header__cell">Endereço</th>';
                echo '<th class="table__header__cell">Número</th>';
                echo '<th class="table__header__cell">Bairro</th>';
                echo '<th class="table__header__cell">Cidade</th>';
                echo '<th class="table__header__cell">UF</th>';
                echo '<th class="table__header__cell">Produto</th>';
                echo '<th class="table__header__cell">Valor</th>';

                // Adicione mais cabeçalhos conforme necessário
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';

                foreach ($pedidos as $pedido) {
                    echo '<tr class="table__row">';
                    echo '<td class="table__cell">' . $pedido['idPedido'] . '</td>';
                    echo '<td class="table__cell">' . $pedido['nomeUsuario'] . '</td>';
                    echo '<td class="table__cell">' . $pedido['emailUsuario'] . '</td>';
                    echo '<td class="table__cell">' . $pedido['telefoneUsuario'] . '</td>';
                    echo '<td class="table__cell">' . date('d/m/Y', strtotime($pedido['dtPedido'])) . '</td>';
                    echo '<td class="table__cell">' . $pedido['metPag'] . '</td>';
                    echo '<td class="table__cell">' . $pedido['entregaCEP'] . '</td>';
                    echo '<td class="table__cell">' . $pedido['entregaEndereco'] . '</td>';
                    echo '<td class="table__cell">' . $pedido['entregaNumero'] . '</td>';
                    echo '<td class="table__cell">' . $pedido['entregaBairro'] . '</td>';
                    echo '<td class="table__cell">' . $pedido['entregaCidade'] . '</td>';
                    echo '<td class="table__cell">' . $pedido['entregaUF'] . '</td>';
                    echo '<td class="table__cell">' . $pedido['nomeProduto'] . '</td>';
                    echo '<td class="table__cell">' . $pedido['valorTotal'] . '</td>';
                    // Adicione mais colunas conforme necessário
                    echo '</tr>';
                }

                echo '</tbody>';
                echo '</table>';
                ?>

                <br>
                <hr>
            </div>
        </div>

    </div>

    <!-- Scripts -->
    <script src="../../public/assets/js/validacaog.js"></script>
    <script src="../../public/assets/js/jquery.min.js"></script>
    <script src="../../public/assets/js/browser.min.js"></script>
    <script src="../../public/assets/js/breakpoints.min.js"></script>
    <script src="../../public/assets/js/util.js"></script>
    <script src="../../public/assets/js/main.js"></script>

</body>

</html>