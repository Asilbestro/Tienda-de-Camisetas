<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url ?>assets/css/style.css">
    <title>Tienda de Ropa</title>
</head>

<body>
    <div id="container">

        <!-- cabecera -->
        <header id="header">
            <div id="logo">
                <img src="<?= base_url ?>assets/img/camiseta.png" alt="Camiseta Logo">
                <a href="<?= base_url ?>index.php">
                    Tienda de Ropa
                </a>
            </div>
        </header>

        <!-- Menu -->
        <!-- Me retorna un array de objetos -->
        <?php $categorias = Utils::showCategorias(); ?>
        <nav id="menu">
            <ul>
                <li><a href="<?= base_url ?>index.php">Inicio</a></li>

                <?php while ($cat = $categorias->fetch_object()) : ?>
                    <li>
                        <a href=" <?= base_url ?>categoria/ver&id=<?= $cat->id ?>"><?= $cat->nombre ?></a>
                    </li>
                <?php endwhile; ?>
            </ul>
        </nav>
        <!-- Barra lateral -->
        <div id="content">