<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Tienda de Camisetas</title>
</head>

<body>
    <div id="container">

        <!-- cabecera -->
        <header id="header">
            <div id="logo">
                <img src="assets/img/camiseta.png" alt="Camiseta Logo">
                <a href="index.php">
                    Tienda de Camisetas
                </a>
            </div>
        </header>

        <!-- Menu -->
        <nav id="menu">
            <ul>
                <li><a href="#">Inicio</a></li>
                <li><a href="#">Camisas</a></li>
                <li><a href="#">Manga corta</a></li>
                <li><a href="#">Manga Larga</a></li>
                <li><a href="#">Polera</a></li>
                <li><a href="#">Carrito (2)</a></li>
            </ul>
        </nav>
        <!-- Barra lateral -->
        <div id="content">

            <aside id="lateral">

                <div id="login" class="block_aside">
                    <h3>Iniciar sesion</h3>
                    <form action="#" method="POST">
                        <label for="email">Email</label>
                        <input type="email" name="email">

                        <label for="password">Constraseña</label>
                        <input type="password" name="password">
                        <input type="submit" value="Enviar">
                    </form>
                    <ul id="lista-pedidos">
                        <li><a href="#">Mis pedidos</a></li>
                        <li><a href="#">Gestionar pedidos</a></li>
                        <li><a href="#">Gestionar categorias</a></li>
                    </ul>
                </div>
            </aside>


            <!-- contenido central -->
            <div id="central">
                <h1>Productos destacados</h1>
                <section id="productos">
                    <div class="product">
                        <img src="assets/img/camiseta.png">
                        <h2>Camiseta Azul Ancha</h2>
                        <p>30 Euros</p>
                        <a href="" class="button">Comprar</a>
                    </div>

                    <div class="product">
                        <img src="assets/img/camiseta.png">
                        <h2>Camiseta Azul Ancha</h2>
                        <p>30 Euros</p>
                        <a href="" class="button">Comprar</a>
                    </div>

                    <div class="product">
                        <img src="assets/img/camiseta.png">
                        <h2>Camiseta Azul Ancha</h2>
                        <p>30 Euros</p>
                        <a href="" class="button">Comprar</a>
                    </div>
                </section>
            </div>
        </div>

        <!-- Pie de pagina -->
        <footer>
            <p>Desarrollado por Agustin Silbestro &copy; <?= date('Y') ?></p>
        </footer>
    </div>
</body>

</html>