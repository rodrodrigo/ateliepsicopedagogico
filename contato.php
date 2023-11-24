<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/assets/css/main_ctt.css">
    <link rel="shortcut icon" href="public/assets/images/logoremovido.png">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <title>Ateliê Psicopedagógico</title>
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
                <a href="produtos">
                    <span class="icon"><i class="bi bi-shop"></i></span>
                    <span class="txt-link">PRODUTOS</span>
                </a>
            </li>
            <li class="item-menu ativo">
                <a href="contato">
                    <span class="icon"><i class="bi bi-envelope-at ativo"></i></span>
                    <span class="txt-link">CONTATOS</span>
                </a>
            </li>

        </ul>
    </nav>
    <script src="public/assets/js/menu.js">
    </script>
    <!--fim do menu-->
    <section>
        <h2>Contato</h2>
        <form action="https://api.staticforms.xyz/submit" method="post">
            <label>Nome</label>
            <input type="text" name="name" placeholder="Digite seu nome" autocomplete="off" required>
            <input type="text" name="email" placeholder="Digite seu email" autocomplete="off" required>
            <label>Mensagem</label>
            <textarea name="message" cols="30" rows="10" placeholder="Digite sua mensagem" required></textarea>
            <button type="submit">Enviar</button>


            <input type="hidden" name="accessKey" value="2240b7d5-e280-4d78-864e-a0d25b37a951">
            <input type="hidden" name="redirectTo" value="https://ateliepsicopedagogico.hostdeprojetosdoifsp.gru.br/cttr.html">
        </form>
        <div class="social-message">
            <div class="line"></div>
            <p class="message">Outros meios de comunicação!</p>
            <div class="line"></div>
        </div>
        <div class="social-icons">
            <a href="https://wa.me/5511976553216">
                <button aria-label="Whatsapp" class="icon">
                    <img src="public/assets/images/whatsapp.png" alt="whatsapp">


                </button>
            </a>
            <a href="https://www.instagram.com/ateliepsicopedagogico/">
                <button aria-label="Instagram" class="icon">
                    <img src="public/assets/images/instagram.png" alt="instagram">

                </button>
            </a>
            <a href="https://www.facebook.com/danineuropsicopedagoga/">
                <button aria-label="Facebook" class="icon">
                    <img src="public/assets/images/facebook.png" alt="facebook">


                </button>
            </a>
        </div>

    </section>


    <!-- Scripts -->
    <script src="public/assets/js/jquery.min.js"></script>
    <script src="public/assets/js/browser.min.js"></script>
    <script src="public/assets/js/breakpoints.min.js"></script>
    <script src="public/assets/js/util.js"></script>
    <script src="public/assets/js/main.js"></script>
</body>

</html>