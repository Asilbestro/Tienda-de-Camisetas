<h1>carrito de la compra</h1>

<?php if (isset($_SESSION['carrito']) && count($_SESSION['carrito']) >= 1) : ?>
    <table>
        <tr>
            <th>Imagen</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Unidades</th>
            <th>Acciones</th>
        </tr>
        <?php foreach ($carrito as $indice => $elemento) :
            $producto = $elemento['producto'];
        ?>
            <tr>
                <td>
                    <?php $sourceImg = $producto->imagen != null ?  base_url . "/uploads/images/" . $producto->imagen : base_url . "assets/img/camiseta.png" ?>
                    <img src="<?= $sourceImg ?>" class="img_carrito">
                </td>
                <td>
                    <?= $producto->nombre; ?>
                </td>
                <td>
                    <?= $producto->precio; ?>

                </td>
                <td>
                    <a href="<?= base_url ?>carrito/up&index=<?= $indice ?>&id=<?=$producto->id?>" class="unit" >+</a>
                    <?= $elemento['unidades']; ?>
                    <a href="<?= base_url ?>carrito/down&index=<?= $indice ?>" class="unit" >-</a>
                </td>
                <td>
                    <a href="<?= base_url ?>carrito/remove&index=<?= $indice ?>" class="button button-gestion">Eliminar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <?php $stats = Utils::statsCarrito(); ?>

    <div class="div-pedido">
        <h3>Precio total: $<?= $stats['total'] ?></h3>
        <a href="<?= base_url ?>carrito/delete_all" class="button button-carrito red">Vaciar carrito</a>
        <a href="<?= base_url ?>pedido/hacer" class="button button-pedido">Hacer pedido</a>
    </div>

<?php else : ?>
    <p>El carrito está vacío, añade algún producto</p>
<?php endif; ?>