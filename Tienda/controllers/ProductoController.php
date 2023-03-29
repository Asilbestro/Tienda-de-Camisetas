<?php
require_once 'models/producto.php';

class productoController
{

    public function index()
    {
        $producto = new Producto;
        $productos = $producto->getRandom(6);

        require_once 'views/producto/destacados.php';
    }

    public function ver()
    {

        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            $producto = new Producto;
            $producto->setId($id);
            $product = $producto->getOne();


            require_once 'views/producto/ver.php';
        } else {
            header("Location:" . base_url . "producto/gestion");
        }
    }

    public function gestion()
    {
        Utils::isAdmin();

        $producto = new Producto;
        $productos = $producto->getAll();

        require_once 'views/producto/gestion.php';
    }

    public function crear()
    {
        Utils::isAdmin();
        require_once 'views/producto/crear.php';
    }

    public function save()
    {
        Utils::isAdmin();

        if (isset($_POST)) {
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
            $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : "";
            $precio = isset($_POST['precio']) ? $_POST['precio'] : false;
            $stock = isset($_POST['stock']) ? $_POST['stock'] : false;
            $categoria = isset($_POST['categoria']) ? $_POST['categoria'] : false;

            //Validando campo de precio, los demas campos se validan con HTML, este al ser float no se puede
            if (!empty($precio) && is_int($precio)) {
                $precio_validado = true;
            } else {
                $precio_validado = false;
                $_SESSION['producto_precio'] = "failed";
            }

            if ($nombre && $descripcion && $precio_validado && $stock && $categoria) {
                $producto = new Producto;
                $producto->setNombre($nombre);
                $producto->setDescripcion($descripcion);
                $producto->setPrecio($precio);
                $producto->setStock($stock);
                $producto->setCategoria_id($categoria);

                //Guardar imagen
                if (isset($_FILES['imagen'])) {
                    $file = $_FILES['imagen'];
                    $filename = $file['name'];
                    $mimetype = $file['type'];

                    if ($mimetype == "image/jpf" || $mimetype == "image/jpeg" || $mimetype == "image/png" || $mimetype == "image/gif") {
                        if (is_dir('uploads / images')) {
                            mkdir('uploads/images', 0777, true);
                        }
                        move_uploaded_file($file['tmp_name'], 'uploads/images/' . $filename);
                        $producto->setImagen($filename);
                    } elseif ($file['size'] > 0 &&  $mimetype != "image/jpf" && $mimetype != "image/jpeg" && $mimetype != "image/png" && $mimetype != "image/gif") {
                        $_SESSION['producto_imagen'] = "failed";
                    }
                }


                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $producto->setId($id);
                    $save = $producto->editar();
                } else {
                    $save = $producto->save();
                }

                if ($save) {
                    $_SESSION['producto'] = "complete";
                } else {
                    $_SESSION['producto'] = "failed";
                }
            } else {
                $_SESSION['producto'] = "failed";
            }
        } else {
            $_SESSION['producto'] = "failed";
        }

        if ($nombre && $descripcion && $precio_validado && $stock && $categoria) {
            header("Location:" . base_url . "producto/gestion");
        } elseif (!($precio_validado)) {
            header("Location:" . base_url . "producto/crear");
        }
    }

    public function eliminar()
    {
        Utils::isAdmin();

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $producto = new Producto;
            $producto->setId($id);
            $delete = $producto->delete($id);

            if ($delete) {
                $_SESSION['delete'] = 'complete';
            } else {
                $_SESSION['delete'] = 'failed';
            }
        } else {
            $_SESSION['delete'] = 'failed';
        }
        header("Location:" . base_url . "producto/gestion");
    }

    public function editar()
    {
        Utils::isAdmin();
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $edit = true;

            $producto = new Producto;
            $producto->setId($id);
            $pro = $producto->getOne();


            require_once 'views/producto/crear.php';
        } else {
            header("Location:" . base_url . "producto/gestion");
        }
    }
}
