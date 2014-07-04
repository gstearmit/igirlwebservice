<?php
namespace Appeditor\Controller;

use Zend\Mvc\Controller\AbstractActionController;

use Zend\View\Model\ViewModel;
use Zend\Db\TableGateway\TableGateway;
use Zend\Mvc\MvcEvent;

class IndexController extends AbstractActionController
{
	
    public function indexAction()
    {    	
   		
    	$this->layout('layout/appeditor');
    	return new ViewModel(array('action'=>'index'));
    }
    
    public function magazinepublishAction()
    {
    	die('magazinepublish');
//     	$viewModel = new ViewModel();
//     	$viewModel->setTemplate('template/index');
//     	return new $viewModel;
//     	$this->layout('layout/home');
//     	return new ViewModel(array('action'=>'index'));
    }
    
    public function storyAction()
    {	    	
    	die('Story');
    	$this->layout('layout/appeditor');
    }
    
    public function ebookAction()
    {
    	die('Ebook');
    	$this->layout('layout/appeditor');
    }
    
    public function appmobileAction()
    {    
       die('appmobile');
    	$this->layout('layout/appeditor');
    }
    
    public function buildappAction()
    {    
        die('buildappbuildapp');
    	$this->layout('layout/appeditor');
    }
}

