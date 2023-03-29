<?php if (isset($categoria)) : ?>

    <h1><?= $categoria->nombre ?></h1>
    <?php if ($productos->num_rows == 0) : ?>
        <p class="epigrafe">No hay productos de esta categoría</p>
    <?php endif; ?>

    <?php while ($product = $productos->fetch_object()) : ?>
        <!-- Si no es nulo el campo imagen la muestra, si es nula muestra una imagen predefinida -->
        <?php $sourceImg = $product->imagen != null ?  base_url . "/uploads/images/" . $product->imagen : base_url . "assets/img/camiseta.png" ?>
        <div class="product">
            <a href="<?= base_url ?>producto/ver&id=<?= $product->id ?>">
                <img src="<?= $sourceImg ?>">
                <h2><?= $product->nombre ?></h2>
            </a>
            <p><?= '$' . $product->precio ?></p>
            <a href="<?= base_url ?>carrito/add&id=<?= $product->id ?>" class="button">Comprar</a>
        </div>
    <?php endwhile ?>
<?php else : ?>
    <h1>La categoria no existe</h1>
<?php endif; ?>