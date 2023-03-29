<h1>Gestionar categorias</h1>

<a href="<?= base_url ?>categoria/crear" class="button button-small">
    Crear categoria
</a>

<!-- Mostrar los avisos de exito o fallo para cargar categorias -->
<div>
    <?php if (isset($_SESSION['correct'])) : ?>

        <strong class="alert_green"> Se agrego correctamente</strong>

        <?php Utils::deleteSession('correct'); ?>
    <?php elseif (isset($_SESSION['incorrect'])) : ?>

        <strong class="alert_red">Error al agregar categoría</strong>

        <?php Utils::deleteSession('incorrect'); ?>
    <?php endif; ?>
</div>

<?php if (isset($_SESSION['ok']) && $_SESSION['ok'] = true) : ?>

    <strong class="alert_green"> Se borro exitosamente</strong>
    <?php Utils::deleteSession('ok'); ?>

<?php elseif (isset($_SESSION['noOk']) && $_SESSION['noOk'] = true) : ?>

    <strong class="alert_red">No es posible borrar si tiene productos relacionados a la categoría </strong>
    <?php Utils::deleteSession('noOk'); ?>

<?php endif; ?>

<table>
    <tr >
        <th>Id</th>
        <th>Nombre</th>
        <th>Acciones</th>
    </tr>
    <?php while ($cat = $categorias->fetch_object()) : ?>
        <tr class="table-pro">
            <td> <?= $cat->id ?></td>
            <td> <?= $cat->nombre ?></td>
            <td>
                <a class="button button-gestion category" href="<?= base_url ?>categoria/delete&id=<?= $cat->id ?>">Eliminar</a>

            </td>

        </tr>
    <?php endwhile; ?>
</table>