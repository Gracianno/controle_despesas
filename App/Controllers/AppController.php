<?php

namespace App\Controllers;


use MF\Controller\Action;
use MF\Model\Container;

class AppController extends Action{
    public function inicio(){
        session_start();
        $despesa = Container::getModel('Despesa');
        
        //peril 1 funcionarios
        if($_SESSION['id'] != '' && $_SESSION['nome'] != '' && $_SESSION['perfil'] == 1){
            $despesa->__set('id_usuario', $_SESSION['id']);
            $despesas = $despesa->listaDespesasPorUsuario();
            
            $this->view->despesas = $despesas;
            $this->render('inicio');
            
            //perfil 2 Gestor
        }else if($_SESSION['id'] != '' && $_SESSION['nome'] != '' && $_SESSION['perfil'] == 2){
            $despesas = $despesa->listaTodasDespesas();
            
            $this->view->despesas = $despesas;
            $this->render('inicio');
        }else{
            header('Location:/?login=erro');
        }  
    }
    
    public function nova_despesa(){
            $this->view->erroDespesa = false;
            $this->view->cadastro = false;
        $categoria = Container::getModel('categoria_despesa');

        session_start();
      
        
        if($_SESSION['id'] != '' && $_SESSION['nome'] != '' && $_SESSION['perfil'] == 1){
            $categorias = $categoria->listaCategorias();
            
            $this->view->categorias = $categorias;
            $this->render('nova_despesa');

        }else{
            header(('Location: /'));
        }
    }
    
     public function registrar_despesa(){
         session_start();
        $despesa = Container::getModel('Despesa');
        if($_SESSION['id'] != '' && $_SESSION['nome'] != '' && $_SESSION['perfil'] == 1){
            $despesa->__set('titulo', $_POST['titulo']);
            $despesa->__set('valor', $_POST['valor']);
            $despesa->__set('categoria', $_POST['categoria']);
            $despesa->__set('descricao', $_POST['descricao']);
            $despesa->__set('id_usuario', $_SESSION['id']);
            $despesa->__set('status', 1);
         
            if($despesa->validarDespesa()){

            $despesa->salvar();
            $this->view->cadastro = true;
            $this->view->erroDespesa = false;
            $this->render('nova_despesa');
         }else{
            $this->view->erroDespesa = true;
            $this->view->cadastro = false;

            $this->render('nova_despesa');
         }   
        }else{
            header('Location: /');
        }
    }
    
    public function despesas_pendentes(){
        session_start();
        $despesa = Container::getModel('Despesa');
        
        if($_SESSION['id'] != '' && $_SESSION['nome'] != '' && $_SESSION['perfil'] == 2){
            $despesas = $despesa->listaDespesasPendentes();
            
            $this->view->despesas = $despesas;
        
        
            $this->render('despesas_pendentes');
        }else{
            header('Location: /');
        }
    }
    
    public function setStatus(){
        session_start();
        $despesa = Container::getModel('Despesa');
        if($_SESSION['id'] != '' && $_SESSION['nome'] != '' && $_SESSION['perfil'] == 2 && $_GET['id_despesa'] != ''){
            $despesa->__set('id', $_GET['id_despesa']);
            if($_GET['status'] == 'reprovar'){
                $despesa->setStatusReprovado();
            }else if($_GET['status'] == 'aprovar'){
                $despesa->setStatusAprovado();
            }
            header("Refresh: 0; url=despesas_pendentes");
    }
    }
    
    public function detalhes(){
        session_start();
        $despesa = Container::getModel('Despesa');
        if($_SESSION['id'] != '' && $_SESSION['nome'] != '' && $_SESSION['perfil'] == 2 && $_GET['id_despesa'] != ''){
            $despesa->__set('id', $_GET['id_despesa']);
            $despesa_detalhes = $despesa->despesaDetalhes();
            $this->view->despesa = $despesa_detalhes;
            $this->render('detalhes');
        }
    }
}

?>