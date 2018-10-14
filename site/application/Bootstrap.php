<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    protected function _initDoctype()
    {
        $this->bootstrap('view');
        $view = $this->getResource('view');
        $view->doctype('XHTML1_STRICT');
    
    }
    
    protected  function _initRoutes()
    {
        //$route = new Zend_Controller_Router_Route('/', array('controller' => 'about', 'action' => 'index'));
    
        $router = Zend_Controller_Front::getInstance()->getRouter();
        $router->addRoute('home', new Zend_Controller_Router_Route('/', array('controller' => 'team', 'action' => 'list')));
        $router->addRoute('editTeam', new Zend_Controller_Router_Route('/team/edit', array('controller' => 'team', 'action' => 'edit')));
        $router->addRoute('addTeam', new Zend_Controller_Router_Route('/team/add', array('controller' => 'team', 'action' => 'add')));
        $router->addRoute('deleteTeam', new Zend_Controller_Router_Route('/team/delete', array('controller' => 'team', 'action' => 'delete')));
        
       $router->addRoute('teamRoster', new Zend_Controller_Router_Route('/teamroster/:id', array('controller' => 'roster', 'action' => 'list')));
       $router->addRoute('editPlayer', new Zend_Controller_Router_Route('/player/edit', array('controller' => 'roster', 'action' => 'edit')));
    }
}

