<?php

class Producto
{

    private $id;
    private $nombre;
    private $categoria_id;
    private $descripcion;
    private $precio;
    private $stock;
    private $oferta;
    private $fecha;
    private $imagen;
    private $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }

    function getId()
    {
        return $this->id;
    }

    function getNombre()
    {
        return $this->nombre;
    }

    function getCategoria_id()
    {
        return $this->categoria_id;
    }

    function getDescripcion()
    {
        return $this->descripcion;
    }

    function getPrecio()
    {
        return $this->precio;
    }

    function getStock()
    {
        return $this->stock;
    }

    function getOferta()
    {
        return $this->oferta;
    }

    function getFecha()
    {
        return $this->fecha;
    }

    function getImagen()
    {
        return $this->imagen;
    }

    function setId($id)
    {
        $this->id = $id;
    }

    function setNombre($nombre)
    {
        $this->nombre = $this->db->real_escape_string($nombre);
    }

    function setCategoria_id($categoria_id)
    {
        $this->categoria_id = $this->db->real_escape_string($categoria_id);
    }

    function setDescripcion($descripcion)
    {
        $this->descripcion = $this->db->real_escape_string($descripcion);
    }

    function setPrecio($precio)
    {
        $this->precio = $this->db->real_escape_string($precio);
    }

    function setStock($stock)
    {
        $this->stock = $this->db->real_escape_string($stock);
    }

    function setOferta($oferta)
    {
        $this->oferta = $this->db->real_escape_string($oferta);
    }

    function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

    function setImagen($imagen)
    {
        $this->imagen = $imagen;
    }

    public function getAll()
    {
        $sql = "SELECT * FROM productos ORDER BY id DESC;";
        $productos = $this->db->query($sql);

        return $productos;
    }

    public function getAllCategory()
    {
        $sql = "SELECT p.* , c.nombre AS 'nombre categoria' FROM productos p
        INNER JOIN categoria c ON c.id = p.categoria_id 
        WHERE p.categoria_id = {$this->getCategoria_id()}
        ORDER BY id DESC;";


        $productos = $this->db->query($sql);

        return $productos;
    }

    public function getRandom($limit)
    {
        $sql = "SELECT * FROM productos  WHERE stock > 0 ORDER BY RAND() LIMIT $limit;";
        $productos = $this->db->query($sql);

        return $productos;
    }

    public function getOne()
    {
        $sql = "SELECT * FROM productos WHERE id = {$this->id};";
        $producto = $this->db->query($sql);

        return $producto->fetch_object();
    }

    public function save()
    {
        $sql = "INSERT INTO productos VALUES (NULL, {$this->getCategoria_id()} ,'{$this->getNombre()}', '{$this->getDescripcion()}', {$this->getPrecio()}, {$this->getStock()}, null ,CURDATE(), '{$this->getImagen()}');";
        $save = $this->db->query($sql);

        $result = false;

        if ($save) {
            $result = true;
        }

        return $result;
    }

    public function editar()
    {

        if ($this->getImagen() != null) {
            $sql = "UPDATE productos SET nombre = '{$this->getNombre()}' , descripcion ='{$this->getDescripcion()}', precio= {$this->getPrecio()}, 
             stock= {$this->getStock()}, categoria_id={$this->getCategoria_id()}, imagen ='{$this->getImagen()}' WHERE id={$this->getId()};";
        } else {
            $sql = "UPDATE productos SET nombre = '{$this->getNombre()}' , descripcion ='{$this->getDescripcion()}', precio= {$this->getPrecio()}, 
            stock= {$this->getStock()}, categoria_id={$this->getCategoria_id()} WHERE id={$this->getId()};";
        }

        $save = $this->db->query($sql);

        $result = false;

        if ($save) {
            $result = true;
        }

        return $result;
    }

    public function updateStock($stock)
    {
        $query = "SELECT stock FROM productos WHERE id = {$this->getId()};";

        $query_ok = $this->db->query($query);
        $stockDisponible = $query_ok->fetch_object();

        $stockDisponible = $stockDisponible->stock;

        $sql = "UPDATE productos SET stock = $stockDisponible - $stock WHERE id = {$this->getId()};";

        $update = $this->db->query($sql);

        $result = false;

        if ($update) {
            $result = true;
        }

        return $result;
    }

    public function getStockByProduct()
    {
        $sql = "SELECT stock FROM productos WHERE id = {$this->getId()};";

        $stock = $this->db->query($sql);

        return $stock->fetch_object();
    }


    public function delete()
    {
        $sql = "DELETE FROM productos WHERE id = {$this->id};";
        $delete = $this->db->query($sql);

        $result = false;

        if ($delete) {
            $result = true;
        }

        return $result;
    }
}
