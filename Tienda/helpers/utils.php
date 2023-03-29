<?php

class Utils
{

    public static function validacionRegistro($nombrePost, $apellidoPost, $emailPost, $passwordPost)
    {
        //Comprobrar que no este vacio los campos
        $nombre = isset($nombrePost) ? $nombrePost : false;
        $apellido = isset($apellidoPost) ?  $apellidoPost : false;
        $email = isset($emailPost) ? $emailPost : false;
        $password = isset($passwordPost) ? $passwordPost : false;

        //Validacion de nombre
        if (!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/", $nombre)) {
            $nombre_validado = true;
        } else {
            $nombre_validado = false;
            $errores['nombre'] = "El nombre no es válido";
        }
        //Validacion de apellidos
        if (!empty($apellido) && !is_numeric($apellido) && !preg_match("/[0-9]/", $apellido)) {
            $apellidos_validado = true;
        } else {
            $apellidos_validado = false;
            $errores['apellido'] = "El apellido no es válido";
        }
        //Validacion de email
        if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $email_validado = true;
        } else {
            $email_validado = false;
            $errores['email'] = "El email no es válido";
        }
        //Validacion de contraseña
        if (!empty($password)) {
            $password_validado = true;
        } else {
            $password_validado = false;
            $errores['nombre'] = "La constraseña está vacía";
        }

        $registroValidado = false;

        if ($nombre_validado && $apellidos_validado && $email_validado && $password_validado) {
            $registroValidado = true;
            return $registroValidado;
        } else {
            return $errores;
        }
    }

    public static function deleteSession($name)
    {
        if (isset($_SESSION[$name])) {

            $_SESSION[$name] = null;
            unset($_SESSION[$name]);
        }

        return $name;
    }

    public static function showErrors($errores, $campo)
    {
        $alerta = '';
        if (isset($errores[$campo]) && !empty($campo)) {
            $alerta = "<div class='error_red'>" . $errores[$campo] . '</div>';
        }
        return $alerta;
    }

    public static function isAdmin()
    {
        if (!isset($_SESSION['admin'])) {
            header("Location:" . base_url);
        } else {
            return true;
        }
    }

    public static function isIdentity()
    {
        if (!isset($_SESSION['identity'])) {
            header("Location:" . base_url);
        } else {
            return true;
        }
    }

    public static function showCategorias() 
    {
        require_once 'models/categoria.php';

        $categoria = new Categoria;
        $categorias = $categoria->getAll();

        return $categorias;
    }

    public static function statsCarrito()
    {
        $stats = array(
            'count' => 0,
            'total' => 0
        );

        if (isset($_SESSION['carrito'])) {
            //Cuenta la cantidad de productos que hay en el array
            $stats['count'] = count($_SESSION['carrito']);

            foreach ($_SESSION['carrito'] as $indice => $producto) {
                $stats['total'] += $producto['precio'] * $producto['unidades'];
            }
        }

        return $stats;
    }

    public static function showStatus($status)
    {
        $value = 'Pendiente';

        if ($status == 'Confirmado') {
            $value = 'Pendiente';
        } elseif ($status == 'preparation') {
            $value = 'En preparación';
        } elseif ($status == 'ready') {
            $value = 'Preparado para enviar';
        } elseif ($status = 'sended') {
            $value = 'Enviado';
        }
        return $value;
    }
}