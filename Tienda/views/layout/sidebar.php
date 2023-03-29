<aside id="lateral">

    <div id="carrito" class="block-aside">
        <h3>Mi carrito</h3>
        <ul>
            <?php $stats = Utils::statsCarrito(); ?>
            <li><a href="<?= base_url ?>carrito/index">Productos(<?= $stats['count'] ?>)</a></li>
            <li><a href="<?= base_url ?>carrito/index">Total: $ <?= $stats['total'] ?></a></li>
            <li><a href="<?= base_url ?>carrito/index">Ver en el carrito</a></li>
        </ul>
    </div>

    <div id="login" class="block_aside">
        <!-- Si no existe el usuario muestra los botones para entrar, sino los oculta -->
        <?php if (!isset($_SESSION['identity'])) : ?>
            <h3>Iniciar sesion</h3>
            <?php if (isset($_SESSION['error_login'])) : ?>
                <p class="error_red">La contraseña o el email no coincide</p>
                <?php Utils::deleteSession('error_login') ?>
            <?php endif; ?>

            <form action="<?= base_url ?>usuario/login" method="POST">
                <label for="email">Email</label>
                <input type="email" name="email">

                <label for="password">Constraseña</label>
                <input type="password" name="password">

                <input type="submit" value="Enviar">
            </form>
            <br>
            <a href="<?= base_url ?>usuario/registro ">Registrarse</a></li>
        <?php else : ?>
            <h3><?= $_SESSION['identity']->nombre ?> <?= $_SESSION['identity']->apellido ?></h3>
        <?php endif; ?>

        <ul id="lista-pedidos">
            <?php if (isset($_SESSION['admin'])) : ?>
                <li><a href="<?= base_url ?>categoria/index">Gestionar Categorias</a></li>
                <li><a href="<?= base_url ?>producto/gestion">Gestionar Productos</a></li>
                <li><a href="<?= base_url ?>pedido/gestion">Gestionar Pedidos</a></li>
            <?php endif; ?>

            <?php if (isset($_SESSION['identity'])) : ?>
                <li><a href="<?= base_url ?>pedido/mis_pedidos">Mis Pedidos</a></li>
                <li><a href=" <?= base_url ?>usuario/logout">Cerrar sesión</a></li>
            <?php endif; ?>

        </ul>
    </div>
</aside>


<!-- contenido central -->
<div id="central">