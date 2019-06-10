<?php

namespace App;

use MF\Init\Bootstrap;

class Route extends Bootstrap {

	protected function initRoutes() {

		$routes['home'] = array(
			'route' => '/',
			'controller' => 'indexController',
			'action' => 'index'
		);
        
        $routes['inscreverse'] = array(
			'route' => '/inscreverse',
			'controller' => 'indexController',
			'action' => 'inscreverse'
		);
        
        $routes['registrar'] = array(
			'route' => '/registrar',
			'controller' => 'indexController',
			'action' => 'registrar'
		);
        
         $routes['autenticar'] = array(
			'route' => '/autenticar',
			'controller' => 'AuthController',
			'action' => 'autenticar'
		);
        
         $routes['inicio'] = array(
			'route' => '/inicio',
			'controller' => 'AppController',
			'action' => 'inicio'
		);
        
         $routes['sair'] = array(
			'route' => '/sair',
			'controller' => 'AuthController',
			'action' => 'sair'
		);
        
        $routes['nova_despesa'] = array(
			'route' => '/nova_despesa',
			'controller' => 'AppController',
			'action' => 'nova_despesa'
		);
        
        $routes['registrar_despesa'] = array(
			'route' => '/registrar_despesa',
			'controller' => 'AppController',
			'action' => 'registrar_despesa'
		);
        
        $routes['listar_despesa'] = array(
			'route' => '/listar_despesa',
			'controller' => 'AppController',
			'action' => 'listar_despesa'
		);
        
        $routes['despesas_pendentes'] = array(
			'route' => '/despesas_pendentes',
			'controller' => 'AppController',
			'action' => 'despesas_pendentes'
		);
        
        $routes['setStatus'] = array(
			'route' => '/setStatus',
			'controller' => 'AppController',
			'action' => 'setStatus'
		);
        
        $routes['detalhes'] = array(
			'route' => '/detalhes',
			'controller' => 'AppController',
			'action' => 'detalhes'
		);

		$this->setRoutes($routes);
	}

}

?>