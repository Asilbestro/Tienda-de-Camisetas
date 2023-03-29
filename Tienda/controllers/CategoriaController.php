<?php
require_once 'models/categoria.php';
require_once 'models/producto.php';

class categoriaController
{

    public function index()
    {
        //Funcion que no te deja entrar si no sos admin
        Utils::isAdmin();
        $categoria = new Categoria();
        $categorias = $categoria->getAll();


        require_once 'views/categoria/index.php';
    }

    public function ver()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            //Conseguir categorias
            $categoria = new Categoria;
            $categoria->setId($id);
            $categoria = $categoria->getOne();

            //Conseguir productos
            $producto = new Producto;
            $producto->setCategoria_id($id);
            $productos = $producto->getAllCategory();
        }

        require_once 'views/categoria/ver.php';
    }


    public function crear()
    {
        Utils::isAdmin();
        require_once 'views/categoria/crear.php';
    }

    public function save()
    {
        Utils::isAdmin();

        if (isset($_POST) && isset($_POST['nombre'])) {

            //guardar la categoria en la BD
            $categoria = new Categoria();
            $categoria->setNombre($_POST['nombre']);

            $switch = $categoria->save();

            //Para mostrar alerta en la view
            if ($switch) {
                $_SESSION['correct'] = true;
            } else {
                $_SESSION['incorrect'] = true;
            }
        }
        header("Location:" . base_url . "categoria/index");
    }

    public function delete()
    {
        Utils::isAdmin();

        if (isset($_GET['id'])) {
            $categoria = new Categoria();
            $deleted = $categoria->delete($_GET['id']);
        }

        if ($deleted) {
            $_SESSION['ok'] = true;
        } else {
            $_SESSION['noOk'] = true;
        }
        header("Location:" . base_url . "categoria/index");
    }
}
