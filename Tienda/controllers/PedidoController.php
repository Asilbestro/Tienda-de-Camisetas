<?php
require_once 'models/pedido.php';
require_once 'models/producto.php';

class pedidoController
{

    public function hacer()
    {
        require_once 'views/pedidos/hacer.php';
    }

    public function add()
    {
        if (isset($_SESSION['identity'])) {

            $usuario_id = $_SESSION['identity']->id;
            $provincia = isset($_POST['provincia']) ? $_POST['provincia'] : false;
            $localidad = isset($_POST['localidad']) ? $_POST['localidad'] : false;
            $direccion = isset($_POST['direccion']) ? $_POST['direccion'] : false;

            $stats = Utils::statsCarrito();
            $coste = $stats['total'];

            if ($provincia && $localidad & $direccion) {
                //Guardar datos en la BD
                $pedido = new Pedido;
                $pedido->setUsuario_id($usuario_id);
                $pedido->setProvincia($provincia);
                $pedido->setLocalidad($localidad);
                $pedido->setDireccion($direccion);
                $pedido->setCoste($coste);

                $save = $pedido->save();

                //Guardar linea pedido
                $save_linea = $pedido->save_linea();

                if ($save_linea) {
                    $_SESSION['pedido'] = "complete";
                } else {
                    $_SESSION['pedido'] = "failed";
                }
            } else {
                $_SESSION['pedido'] = "failed";
            }

            header("Location:" . base_url . 'pedido/confirmado');
        } else {
            //Rederigir al index
            header("Location:" . base_url);
        }
    }

    public function confirmado()
    {
        if (isset($_SESSION['identity'])) {
            $identity = $_SESSION['identity'];

            //Datos del pedido
            $pedido = new Pedido;
            $pedido->setUsuario_id($identity->id);
            $pedido = $pedido->getOneByUser();


            //Datos de producto
            $pedido_producto = new Pedido;
            $productos = $pedido_producto->getProductosByPedido($pedido->id);


            if (isset($_SESSION['carrito'])) {
                $carrito = $_SESSION['carrito'];

                foreach ($carrito as $indice => $elemento) {
                    $id_producto = $elemento['id_producto'];
                    $unidades = $elemento['unidades'];

                    $producto = new Producto;
                    $producto->setId($id_producto);
                    $query_ok = $producto->updateStock($unidades);
                }
            }

            //Una vez realizada la compra, se borra el contenido del carrito
            unset($_SESSION['carrito']);

            require_once 'views/pedidos/confirmado.php';
        }
    }

    public function mis_pedidos()
    {
        Utils::isIdentity();
        $usuario_id = $_SESSION['identity']->id;
        $pedido = new Pedido();
        $pedido->setUsuario_id($usuario_id);
        $pedidos = $pedido->getAllByUser();


        require_once 'views/pedidos/mis_pedidos.php';
    }

    public function detalle()
    {
        Utils::isIdentity();

        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            //Sacar datos del pedido
            $pedido = new Pedido;
            $pedido->setId($id);
            $pedido = $pedido->getOne();

            //Sacar productos del pedido 
            $pedido_producto = new Pedido;
            $productos = $pedido_producto->getProductosByPedido($id);

            //Si es admin muestra el usuario que realizo el pedido
            if (isset($_SESSION['admin'])) {
                $user = $pedido_producto->getProductosByPedido($id);
                $detailUser = $user->fetch_object();
            }
            require_once 'views/pedidos/detalles.php';
        } else {
            header("Location:" . base_url . "pedidos/mis_pedidos");
        }
    }

    public function gestion()
    {
        Utils::isAdmin();
        $gestion = true;

        $pedido = new Pedido;
        $pedidos = $pedido->getAll();

        require_once 'views/pedidos/mis_pedidos.php';
    }

    public function estado()
    {
        Utils::isAdmin();
        if (isset($_POST['pedido_id'])) {
            //Recoger datos del form
            $id = $_POST['pedido_id'];
            $estado = $_POST['estado'];

            //Hacer un UPDATE del pedido 
            $pedido = new Pedido;
            $pedido->setId($id);
            $pedido->setEstado($estado);
            $pedido->updateOne();

            header("Location:" . base_url . 'pedido/detalle&id=' . $id);
        } else {
            header("Location:" . base_url);
        }
    }
}
