<h1>Detalles del pedido</h1>

<?php if (isset($pedido)) : ?>
    <?php if (isset($_SESSION['admin'])) : ?>
        <h3>Cambiar estado del pedido</h3><br>
        <form action="<?= base_url ?>pedido/estado" method="POST">
            <input type="hidden" value="<?= $pedido->id ?>" name="pedido_id">
            <select name="estado">
                <option value="Confirmado" <?= $pedido->estado == 'confirmado' ? 'selected' : ''; ?>>Pendiente</option>
                <option value="preparation" <?= $pedido->estado == 'preparation' ? 'selected' : ''; ?>>En preparación</option>
                <option value="ready" <?= $pedido->estado == 'ready' ? 'selected' : ''; ?>>Preparado para enviar</option>
                <option value="sended" <?= $pedido->estado == 'sended' ? 'selected' : ''; ?>>Enviado</option>

                <input type="submit" value="Cambiar estado">
            </select>
        </form>
        <br>

        <h3>Datos del usuario:</h3><br>
        Nombre: <?= $detailUser->nombreuser; ?><br>
        Email: <?= $detailUser->email; ?><br>
        <br>
    <?php endif; ?>

    <h3>Datos de envio:</h3><br>
    Provincia: <?= $pedido->provincia ?><br>
    Ciudad: <?= $pedido->localidad ?><br>
    Dirección: <?= $pedido->direccion ?><br><br>

    <h3>Datos del pedido:</h3><br>
    Estado: <?= Utils::showStatus($pedido->estado) ?><br>
    Numero de pedido: <?= $pedido->id ?><br>
    Productos:

    <table>
        <tr>
            <th>
                Nombre producto
            </th>
            <th>
                Precio
            </th>
            <th>
                Unidades
            </th>
        </tr>

        <?php while ($producto = $productos->fetch_object()) : ?>

            <tr>
                <th>
                    <?= $producto->nombre ?>
                </th>
                <th>
                    <?= $producto->precio ?>
                </th>
                <th>
                    <?= $producto->unidades ?>
                </th>
            </tr>

        <?php endwhile; ?>
    </table><br>
    <h3>
        Total pedido: $<?= $pedido->coste ?>
    </h3>
<?php endif; ?>