<?php if (isset($product)) : ?>
    <h1><?= $product->nombre ?></h1>
    <div id="detail-product">
        <div class="image">
            <?php $sourceImg = $product->imagen != null ?  base_url . "/uploads/images/" . $product->imagen : base_url . "assets/img/camiseta.png" ?>
            <img src="<?= $sourceImg ?>">
        </div>
        <div class="data">
            <h2><?= $product->nombre ?></h2>
            <p><?= $product->descripcion ?></p>
            <p><?= '$' . $product->precio ?></p>
            <p>Stock: <?= $product->stock ?></p>
            <a href="<?= base_url ?>carrito/add&id=<?= $product->id ?>" class="button">Comprar</a>
        </div>
    </div>
<?php else : ?>
    <h1>El producto no existe</h1>
<?php endif; ?>