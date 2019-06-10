<?php
namespace App\Models;
use MF\Model\Model;
class Despesa extends Model{
    private $id;
    private $titulo;
    private $valor;
    private $nome_categoria;
    private $id_categoria;
    private $id_usuario;
    private $descricao;

    
    public function __get($atributo){
        return $this->$atributo;
    }
    
    public function __set($atributo, $valor){
        $this->$atributo = $valor;
    }
    
   public function salvar(){
        $query = "select id, nome from categoria_despesa where nome = :categoria";
        
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':categoria', $this->__get('categoria'));
        $stmt->execute();
        
        $cat_despesa = $stmt->fetch(\PDO::FETCH_ASSOC);
        
        $this->__set('id_categoria', $cat_despesa['id']);
        
        $query = "insert into despesa(titulo, valor, id_categoria, id_usuario, descricao)values(:titulo, :valor, :id_categoria, :id_usuario, :descricao)";
        $stmt = $this->db->prepare($query);
        $stmt -> bindValue(':titulo', $this->__get('titulo'));
        $stmt -> bindValue(':valor', $this->__get('valor'));
        $stmt -> bindValue(':id_categoria', $this->__get('id_categoria'));
        $stmt -> bindValue(':id_usuario', $this->__get('id_usuario'));
        $stmt -> bindValue(':descricao', $this->__get('descricao'));

        $stmt->execute();
        return $this;
       
       
   }
    
    public function validarDespesa(){
        $valido = true;
        
        if(strlen($this->__get('titulo'))  < 3){
            $valido = false;
        }
        
        if($this->__get('valor') <= 0 || $this->__get('valor') == ''){
            $valido = false;
        }
        
        if(strlen($this->__get('descricao'))  < 5){
            $valido = false;
        }
        
        return $valido;
        
    }
    
    public function listaDespesasPorUsuario(){
        $query = "select titulo, status, valor, descricao, nome as categoria from despesa d, categoria_despesa c where d.id_usuario = :id_usuario and id_categoria = c.id";
        
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id_usuario', $this->__get('id_usuario'));
    
        $stmt->execute();
        
        $despesas = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        
        return $despesas;
    }
    
    public function listaTodasDespesas(){
        $query = "select titulo, status, valor, descricao, c.nome as categoria, u.nome from despesa d, categoria_despesa c, usuarios u where id_categoria = c.id and
        id_usuario = u.id";
        
        $stmt = $this->db->prepare($query);

        $stmt->execute();
        
        $despesas = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $despesas;
    }
    
    public function listaDespesasPendentes(){
         $query = "select d.id, titulo, status, valor, descricao, c.nome as categoria, u.nome from despesa d, categoria_despesa c, usuarios u where id_categoria = c.id and status = 1 and id_usuario = u.id";
        
        $stmt = $this->db->prepare($query);

        $stmt->execute();
        
        $despesas = $stmt->fetchAll(\PDO::FETCH_ASSOC);
    
        return $despesas;
    }
    
    public function setStatusReprovado(){
        $query = "update despesa set status = 3 where id = :id";
        $stmt = $this->db->prepare($query);
        $stmt -> bindValue(':id', $this->__get('id'));
        $stmt->execute();
    }
    
    public function setStatusAprovado(){
        $query = "update despesa set status = 2 where id = :id";
        $stmt = $this->db->prepare($query);
        $stmt -> bindValue(':id', $this->__get('id'));
        $stmt->execute();
    }
    
    public function despesaDetalhes(){
        $query = "select d.id, titulo, status, data, valor, descricao, c.nome as categoria, u.nome, u.email from despesa d, categoria_despesa c, usuarios u where d.id = :id";
        $stmt = $this->db->prepare($query);
        $stmt -> bindValue(':id', $this->__get('id'));
        $stmt->execute();
        
        $despesa = $stmt->fetch(\PDO::FETCH_ASSOC);
        
        return $despesa;
    }
    
}
    ?>