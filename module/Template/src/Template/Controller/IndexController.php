<?php
namespace Template\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Template\Model\Template;
//use Template\Model\TemplateTable;
use Template\Form\TemplateForm;
use Zend\Paginator\Paginator;
use Zend\Paginator\Adapter\Iterator as paginatorIterator;
use Zend\Db\Sql\Select;

use Zend\Db\TableGateway\TableGateway;
use Zend\Mvc\MvcEvent;
use Zend\View\Model\JsonModel;

class IndexController extends AbstractActionController
{
	protected $templateTable;
	
    public function indexAction()
    {    	
   		
   		$select = new Select ();
   		$order_by = $this->params ()->fromRoute ( 'order_by' ) ? $this->params ()->fromRoute ( 'order_by' ) : 'id';
   		$order = $this->params ()->fromRoute ( 'order' ) ? $this->params ()->fromRoute ( 'order' ) : Select::ORDER_ASCENDING;
   		$page = $this->params ()->fromRoute ( 'page' ) ? ( int ) $this->params ()->fromRoute ( 'page' ) : 1;
   		
   		$igirlxinhcoms = $this->getTemplateTable()->fetchAllTemplate($select->order ( $order_by . ' ' . $order));
   		
   		//var_dump($igirlxinhcoms);
   		
   		$itemsPerPage = 3;
   		
   		$igirlxinhcoms->current ();
   		$paginator = new Paginator ( new paginatorIterator ( $igirlxinhcoms ) );
   		$paginator->setCurrentPageNumber ( $page )->setItemCountPerPage ( $itemsPerPage )->setPageRange ( 4 );
   		
    	
    	$this->layout('layout/home');
    	return new ViewModel(array(
    			//'action'=>'index',
    			   				'order_by' => $order_by,
    			   				'order' => $order,
    			   				'page' => $page,
    			   				'paginator' => $paginator
    	));
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
    	$this->layout('layout/home');
    }
    
    public function ebookAction()
    {
    	die('Ebook');
    	$this->layout('layout/home');
    }
    
    public function appmobileAction()
    {    
       die('appmobile');
    	$this->layout('layout/home');
    }
    
    public function buildappAction()
    {    
        die('buildappbuildapp');
    	$this->layout('layout/home');
    }
    
    public function getTemplateTable() {
    	if (! $this->templateTable) {
    		$sm = $this->getServiceLocator ();
    		$this->templateTable = $sm->get ( 'Template\Model\TemplateTable' );
    	}
    	return $this->templateTable;
    }
}

