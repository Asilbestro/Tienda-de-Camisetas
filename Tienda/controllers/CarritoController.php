<?php
require_once 'models/producto.php';

class carritoController
{

    public function index()
    {
        if (isset($_SESSION['carrito']) && count($_SESSION['carrito']) >= 1) {

            $carrito = $_SESSION['carrito'];
        } else {
            $carrito = array();
        }
        require_once 'views/carrito/index.php';
    }

    public function add()
    {
        if (isset($_GET['id'])) {
            $producto_id = $_GET['id'];
        } else {
            header("Location:" . base_url . "carrito/index");
        }

        if (isset($_SESSION['carrito'])) {
            $counter = 0;
            foreach ($_SESSION['carrito'] as $indice => $elemento) {
                if ($elemento['id_producto'] == $producto_id) {
                    $_SESSION['carrito'][$indice]['unidades']++;
                    $counter++;
                }
            }
        }

        if (!isset($counter) || $counter == 0) {
            //Conseguir producto
            $producto = new Producto;
            $producto->setId($producto_id);
            $producto = $producto->getOne();

            //Añadir al carrito
            if (is_object($producto)) {
                $_SESSION['carrito'][] = array(
                    "id_producto" => $producto->id,
                    "precio" => $producto->precio,
                    "unidades" => 1,
                    "producto" => $producto
                );
            }
        }
        header("Location:" . base_url . "carrito/index");
    }

    public function up()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            $producto = new Producto;
            $producto->setId($id);
            $stock = $producto->getStockByProduct();

            $max_stock = $stock->stock;

            //Te deja aumentar la unidad hasta la cantidad de stock disponible
            foreach ($_SESSION['carrito'] as $indice => $elemento) {
                if ($elemento['id_producto'] == $id) {
                    $unidades = $elemento['unidades'];

                    if (($unidades + 1) <= $max_stock) {

                        if (isset($_GET['index'])) {
                            $index = $_GET['index'];
                            $_SESSION['carrito'][$index]['unidades']++;
                        }
                    }
                }
            }
        }

        header("Location:" . base_url . 'carrito/index');
    }

    public function down()
    {
        if (isset($_GET['index'])) {
            $indice = $_GET['index'];
            $_SESSION['carrito'][$indice]['unidades']--;

            if ($_SESSION['carrito'][$indice]['unidades'] == 0) {
                unset($_SESSION['carrito'][$indice]);
            }
        }
        header("Location:" . base_url . 'carrito/index');
    }

    public function remove()
    {
        if (isset($_GET['index'])) {
            $indice = $_GET['index'];
            unset($_SESSION['carrito'][$indice]);
        }

        header("Location:" . base_url . "carrito/index");
    }

    public function delete_all()
    {
        unset($_SESSION['carrito']);
        header("Location:" . base_url . "carrito/index");
    }
}
