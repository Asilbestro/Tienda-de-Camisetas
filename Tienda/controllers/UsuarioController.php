<?php
require_once 'models/usuario.php';

class usuarioController
{

    public function index()
    {
        echo "Controlador Usuarios, Accion index";
    }

    public function registro()
    {
        require_once 'views/usuario/registro.php';
    }

    public function save()
    {
        if (isset($_POST)) {
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            //Funcion que validada los formularios
            //Si la validacion es correcta devuelve true, si no un array con los errores
            $returnValidate = Utils::validacionRegistro($nombre, $apellido, $email, $password);

            if ($returnValidate && is_bool($returnValidate)) {
                $usuario = new Usuario();
                $usuario->setNombre($nombre);
                $usuario->setApellidos($apellido);
                $usuario->setEmail($email);
                $usuario->setPassword($password);

                $save = $usuario->save();

                if ($save) {
                    $_SESSION['register'] = "Complete";
                } else {
                    $_SESSION['register'] = "Failed";
                }
            } else {
                $_SESSION['register'] = "Failed";

                $_SESSION['errores'] = $returnValidate;
            }
        } else {
            $_SESSION['register'] = "Failed";
        }
        header("Location:" . base_url . 'usuario/registro');
    }

    public function login()
    {
        if (isset($_POST) && !empty($_POST['email'] && !empty($_POST['password']))) {
            //Identificar al usuario
            //Consulta a la BD 

            $usuario = new Usuario(); //Clase del modelo Usuario
            $usuario->setEmail($_POST['email']);
            $usuario->setPassword($_POST['password']);

            $identity = $usuario->login(); //Invoca el método login de la clase del modelo Usuario

            if ($identity && is_object($identity)) {
                $_SESSION['identity'] = $identity;

                if ($identity->rol == 'admin') {
                    $_SESSION['admin'] = true;
                }
            } else {
                $_SESSION['error_login'] = 'true';
            }
        }

        header("Location:" . base_url);
    }

    public function logout()
    {
        if (isset($_SESSION['identity'])) {
            unset($_SESSION['identity']);
        }

        if (isset($_SESSION['admin'])) {
            unset($_SESSION['admin']);
        }
        header("Location:" . base_url);
    }
}
