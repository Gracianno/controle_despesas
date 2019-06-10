<?php
namespace App\Models;
use MF\Model\Model;
class Categoria_despesa extends Model{
    private $id;
    private $nome;
    
    public function __get($atributo){
        return $this->$atributo;
    }
    
    public function __set($atributo, $valor){
        $this->$atributo = $valor;
    }
    
    public function listaCategorias(){
        $query = "select id, nome from categoria_despesa";
        
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        
        $cat_despesa = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $cat_despesa;
    }
       
    }
    
    ?>