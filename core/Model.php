<?php
namespace core;

use ErrorException;
use PDO;
use PDOException;

abstract class Model
{
    protected $db;
    protected $query;
    protected $table;

    public function __construct()
    {
        $class = get_class($this);
        $table = strtolower(substr($class, strrpos($class, '\\') + 1)) . 's';
        $this->table = $table;
    }

    public function getInstance()
    {
        if ($this->db === null) {
            $dns =
                'mysql:host=localhost:3306;dbname=' .
                Config::get('database.name');
            $username = Config::get('database.username');
            $password = Config::get('database.password');

            try {
                $this->db = new PDO($dns, $username, $password);
            } catch (PDOException $e) {
                throw new ErrorException($e->getMessage());
            }
        }

        return $this->db;
    }

    public function find($id)
    {
        $db = $this->getInstance();
        $query = $db->prepare("SELECT * FROM $this->table WHERE id = :id");
        $query->bindParam(':id', $id);
        $query->execute();

        return $query->fetch(PDO::FETCH_OBJ);
    }
}
?>
