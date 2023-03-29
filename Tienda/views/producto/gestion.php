<h1>Gestion de productos</h1>

<a href="<?= base_url ?>producto/crear" class="button button-small">
    Crear producto
</a>
<!-- Mostrar error de los productos -->
<?php if (isset($_SESSION['producto']) && $_SESSION['producto'] == 'complete') : ?>
    <strong class="alert_green">El producto se ha creado correctamenta</strong>
<?php elseif (isset($_SESSION['producto']) && $_SESSION['producto'] == 'failed') : ?>
    <strong class="alert_red">Fallo al cargar el producto</strong>
<?php endif; ?>
<?php Utils::deleteSession('producto'); ?>

<!-- Mostrar error del campo imagen -->
<?php if (isset($_SESSION['producto_imagen']) && $_SESSION['producto_imagen'] = "failed") : ?>
    <p class="error_red">Fallo al subir la imagen, revisa el archivo de la imagen</p>
<?php endif; ?>
<?php Utils::deleteSession('producto_imagen'); ?>

<!-- Mostrar error de los delete -->
<?php if (isset($_SESSION['delete']) && $_SESSION['delete'] == 'complete') : ?>
    <strong class="alert_green">El producto se ha borrado correctamenta</strong>
<?php elseif (isset($_SESSION['delete']) && $_SESSION['delete'] == 'failed') : ?>
    <strong class="alert_red">Fallo al intentar borrar el producto</strong>
<?php endif; ?>
<?php Utils::deleteSession('delete'); ?>

<table>
    <tr>
        <th>Id</th>
        <th>Nombre</th>
        <th>Precio</th>
        <th>Stock</th>
        <th>Acciones</th>
    </tr>
    <?php while ($pro = $productos->fetch_object()) : ?>
        <tr class="table-pro">
            <td> <?= $pro->id; ?></td>
            <td> <?= $pro->nombre; ?></td>
            <td> <?= $pro->precio; ?></td>
            <td> <?= $pro->stock; ?></td>
            <td>
                <a class="button button-gestion" href="<?= base_url ?>producto/eliminar&id=<?= $pro->id ?>">Eliminar</a>
                <a class="button button-gestion button-green" href="<?= base_url ?>producto/editar&id=<?= $pro->id ?>">Editar</a>
            </td>
        </tr>
    <?php endwhile; ?>
</table>