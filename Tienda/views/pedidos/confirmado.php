<?php if (isset($_SESSION['pedido']) && $_SESSION['pedido'] = 'complete') : ?>
    <h1>Tu pedido se ha confirmado correctamente</h1>
    <p>Tu pedido ha sido guardado con éxito, una vez que realices la transferencia bancaria a la cuenta 77683200000023230
        con el monto del pedido, te enviaremos el pedido.
    </p>
    <br>
    <?php if (isset($pedido)) : ?>
        <h3>Datos del pedido:</h3><br>

        <li>Numero de pedido: <?= $pedido->id ?></li>
        <li>Productos:</li>
        </ul>

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
            Total a pagar: $<?= $pedido->coste ?>
        </h3>
    <?php endif; ?>
<?php elseif (isset($_SESSION['pedido']) && $_SESSION['pedido'] != 'complete') : ?>
    <h1>Ups, Hubo un error, tu pedido No se ha podido realizar, intenta nuevamente</h1>
<?php endif; ?>