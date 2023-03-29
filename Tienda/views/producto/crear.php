<?php if (isset($edit) && isset($pro) && is_object($pro)) : ?>
    <h1>Editar producto: <?= $pro->nombre ?></h1>
    <?php $url_action = base_url . "producto/save&id=" . $pro->id ?>
<?php else : ?>
    <h1>Crear nuevos productos</h1>
    <?php $url_action = base_url . "producto/save"; ?>
<?php endif; ?>

<form class="form-container" action="<?= $url_action ?>" method="POST" enctype="multipart/form-data">
    <label for="nombre">Nombre</label>
    <input type="text" id="nombre" name="nombre" required value="<?= isset($pro) && is_object($pro) ? $pro->nombre : "" ?>">

    <label for="descripcion">Descripción</label>
    <textarea name="descripcion" id="descripcion" required><?= isset($pro) && is_object($pro) ? $pro->descripcion : "" ?></textarea>

    <label for="precio">Precio</label>
    <input type="text" name="precio" id="precio" required value="<?= isset($pro) && is_object($pro) ? $pro->precio : "" ?>">
    <?php if (isset($_SESSION['producto_precio']) && $_SESSION['producto_precio'] = "failed") : ?>
        <p class="error_red">Indique un precio correcto</p>
    <?php endif; ?>
    <?php Utils::deleteSession('producto_precio'); ?>

    <label for="stock">Stock</label>
    <input type="number" name="stock" id="stock" required value="<?= isset($pro) && is_object($pro) ? $pro->stock : "" ?>">

    <label for="categoria">Categoría</label>
    <?php $categorias = Utils::showCategorias(); ?>
    <select name="categoria">
        <?php while ($cat = $categorias->fetch_object()) : ?>
            <option value="<?= $cat->id ?>" <?= isset($pro) && is_object($pro) && $cat->id == $pro->categoria_id ? 'selected' : '' ?>>
                <?= $cat->nombre ?>
            </option>
        <?php endwhile; ?>
    </select>

    <label for="imagen">Imagen</label>
    <?php if (isset($pro) && is_object($pro) && !empty($pro->imagen)) : ?>
        <img src="<?= base_url ?>uploads/images/<?= $pro->imagen ?>" class="thumb">
    <?php endif; ?>

    <input type="file" name="imagen">

    <input type="submit" value="Guardar">
</form>