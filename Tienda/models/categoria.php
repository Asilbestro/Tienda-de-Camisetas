<?php

class Categoria
{

    private $id;
    private $nombre;
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

    function setId($id)
    {
        $this->id = $id;
    }

    function setNombre($nombre)
    {
        $this->nombre = $this->db->real_escape_string($nombre);
    }

    public function getAll()
    {
        $sql = "SELECT * FROM categoria;";
        $categorias = $this->db->query($sql);

        return $categorias;
    }

    public function getOne(){
        $sql = "SELECT * FROM categoria WHERE id={$this->getId()};";
        $categoria = $this->db->query($sql);

        return $categoria->fetch_object();
    }
    
    public function save()
    {

        $sql = "INSERT INTO categoria VALUES (NULL, '{$this->getNombre()}'); ";
        $save = $this->db->query($sql);

        $result = false;

        if ($save) {
            $result = true;
        }

        return $result;
    }

    public function delete($id)
    {
        $sql = "DELETE FROM categoria WHERE id = $id";
        $delete = $this->db->query($sql);


        $result = false;

        if ($delete) {
            $result = true;
        }

        return $result;
    }
}
