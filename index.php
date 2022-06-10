<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="palavras chave do meu site">
    <meta name="description" content="descrição do meu site">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="fontawesome-free-6.1.1-web/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <meta>
    <title>Site-dinamico</title>
</head>
<body>
    
    <header>
        <div class="center">
            <div class="logo left">JP-CODE</div>
            <nav class="desktop right">  
                <ul>
                    <li><a href="">Home</a></li>
                    <li><a href="">Sobre</a></li>
                    <li><a href="">Serviços</a></li>
                    <li><a href="">Contato</a></li>
                </ul>
            </nav><!--DESKTOP-->

            <nav class="mobile right">  
                <div class="botao-mobile"><i class="fa-solid fa-bars-staggered"></i></div>
                <ul>
                    <li><a href="">Home</a></li>
                    <li><a href="">Sobre</a></li>
                    <li><a href="">Serviços</a></li>
                    <li><a href="">Contato</a></li>
                </ul>
            </nav><!--MOBILE-->
            <div class="clear"></div>
        </div><!--center-->
    </header>

    <section class="banner-principal">
        <div class="overlay"></div>
        <div class="center">
            <form>
                <h2>Qual o seu melhor e-mail?</h2>
                <input type="email" name="email" required>
                <input type="submit" value="Enviar" name="acao">
            </form>
        </div><!--center-->
    </section><!--BANNER_PRINCIPAL-->

    <section class="descricao-autor">
        <div class="center">
            <div class="w50 descricao-autor-box left">
                <h2>Joao Pedro Alves</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque porta at felis eu dignissim.
                Nunc arcu nulla, suscipit at arcu at, condimentum ultrices dolor. Curabitur a augue eget elit s
                agittis ornare sit amet a orci. Aenean mattis dolor purus, nec efficitur velit tincidunt nec. 
                </p>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque porta at felis eu dignis
                sim. Nunc arcu nulla, suscipit at arcu at, condimentum ultrices dolor. Curabitur a augue ege
                t elit sagittis ornare sit amet a orci. Aenean mattis dolor purus, nec efficitur velit tincid
                    s.
                </p>
            </div><!--W50-->
            <div class="w50 left">
                <img class="center-x" src="image/autor.jpg"/>
            </div><!--W50-->
            <div class="clear"></div>
        </div><!--center-->
    </section><!--Descricao-autor-->

    <section class="especialidades">
        <div class="center">
        <h2 class="title">Especialidades</h2>
            <div class=" w33 left box-especialidades">
                <h3><i class="fa-brands fa-css3-alt"></i></h3>
                <h3>CSS3</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque porta at felis
                 eu dignissim. Nunc arcu nulla, suscipit at arcu at, condimentum ultrices dolor. Curabi
                 tur a augue eget elit sagittis ornare sit amet a orci. Aenean mattis dolor purus, nec e
                 fficitur velit tincidunt nec. Class aptent taciti sociosqu ad litora torquent per conub
                 ia nostra
                </p>
            </div><!--especialidades-->

            <div class="w33 left box-especialidades">
                <h3><i class="fa-brands fa-html5"></i></h3>
                <h3>HTML5</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque porta at felis
                 eu dignissim. Nunc arcu nulla, suscipit at arcu at, condimentum ultrices dolor. Curabi
                 tur a augue eget elit sagittis ornare sit amet a orci. Aenean mattis dolor purus, nec e
                 fficitur velit tincidunt nec. Class aptent taciti sociosqu ad litora torquent per conub
                 ia nostra
                </p>
            </div><!--especialidades-->

            <div class="w33 left box-especialidades">
                <h3><i class="fa-brands fa-js"></i></h3>
                <h3>JAVASCRIPT</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque porta at felis
                 eu dignissim. Nunc arcu nulla, suscipit at arcu at, condimentum ultrices dolor. Curabi
                 tur a augue eget elit sagittis ornare sit amet a orci. Aenean mattis dolor purus, nec e
                 fficitur velit tincidunt nec. Class aptent taciti sociosqu ad litora torquent per conub
                 ia nostra
                </p>
            </div><!--especialidades-->
            <div class="clear"></div>
        </div><!--CENTER-->
    </section><!--especialiadades-->

    <section class="extras">
        <div class="center">
            <div class="w50 left">
                <h3>Depoimentos dos nossos clientes</h3>
                <div class="depoimento-single">
                    <p class="depoimento-descricao">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque porta at felis eu dignissim.
                     Nunc arcu nulla, suscipit at arcu at, condimentum ultrices dolor. Curabitur a augue eget elit sagi
                     ttis ornare sit amet a orci. Aenean mattis dolor purus, nec efficitur velit tincidunt nec. Class ap
                     tent taciti sociosqu ad litora torquent per conubia nostra,
                    </p>
                    <p class="nome-autor">Lorem Ipsum</p>
                </div><!--depoimento-single-->

                <div class="depoimento-single">
                    <p class="depoimento-descricao">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque porta at felis eu dignissim.
                     Nunc arcu nulla, suscipit at arcu at, condimentum ultrices dolor. Curabitur a augue eget elit sagi
                     ttis ornare sit amet a orci. Aenean mattis dolor purus, nec efficitur velit tincidunt nec. Class ap
                     tent taciti sociosqu ad litora torquent per conubia nostra,
                    </p>
                    <p class="nome-autor">Lorem Ipsum</p>
                </div><!--depoimento-single-->

                <div class="depoimento-single">
                    <p class="depoimento-descricao">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque porta at felis eu dignissim.
                     Nunc arcu nulla, suscipit at arcu at, condimentum ultrices dolor. Curabitur a augue eget elit sagi
                     ttis ornare sit amet a orci. Aenean mattis dolor purus, nec efficitur velit tincidunt nec. Class ap
                     tent taciti sociosqu ad litora torquent per conubia nostra,
                    </p>
                    <p class="nome-autor">Lorem Ipsum</p>
                </div><!--depoimento-single-->
            </div><!--w50-->

            <div class="w50 left">
                <h3>Serviços</h3>
                <div class="servicos">
                    <ul>
                        <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque porta at felis eu dignissim. Nunc arcu nulla, suscipit at arcu at, condimentum ultrices dolor. Curabitur a</li>
                        <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque porta at felis eu dignissim. Nunc arcu nulla, suscipit at arcu at, condimentum ultrices dolor. Curabitur a</li>
                        <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque porta at felis eu dignissim. Nunc arcu nulla, suscipit at arcu at, condimentum ultrices dolor. Curabitur a</li>
                        <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque porta at felis eu dignissim. Nunc arcu nulla, suscipit at arcu at, condimentum ultrices dolor. Curabitur a</li>
                    </ul>
                </div><!--servicos-->
            </div><!--w50-->
            <div class="clear"></div>
        </div><!--center-->
    </section><!--Extras-->

    <footer>
        <div class="center">
            <p>Todos os direitos reservados</p>
        </div><!--center-->
    </footer>

</body>
</html>