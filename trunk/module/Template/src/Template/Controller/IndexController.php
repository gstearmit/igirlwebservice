<?php
namespace Template\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Igirlxinhcom\Model\Igirlxinhcom;
use Igirlxinhcom\Model\IgirlxinhcomTable;
use Igirlxinhcom\Form\IgirlxinhcomForm;
use Zend\Paginator\Paginator;
use Zend\Paginator\Adapter\Iterator as paginatorIterator;
use Zend\Db\Sql\Select;

use Zend\Db\TableGateway\TableGateway;
use Zend\Mvc\MvcEvent;

class IndexController extends AbstractActionController
{
	protected $igirlxinhcomTable;
	public function getIgirlxinhcomTable() {
		if (! $this->igirlxinhcomTable) {
			$sm = $this->getServiceLocator ();
			$this->igirlxinhcomTable = $sm->get ( 'Igirlxinhcom\Model\IgirlxinhcomTable' );
		}
		return $this->igirlxinhcomTable;
	}
    public function indexAction()
    {    	
//    		$igirl = new Igirlxinhcom();
//    		$arr = $igirl->fetch_All_Igirlxinhcomrest_Rest_Orderbyiddesc();
//    		echo "ssdsdsdsd";
//    		var_dump($arr);
//    		die;
    	  $arr  = "Hoang OPcng Phuc";
//    		$select = new Select ();
//    		$order_by = $this->params ()->fromRoute ( 'order_by' ) ? $this->params ()->fromRoute ( 'order_by' ) : 'id';
//    		$order = $this->params ()->fromRoute ( 'order' ) ? $this->params ()->fromRoute ( 'order' ) : Select::ORDER_ASCENDING;
//    		$page = $this->params ()->fromRoute ( 'page' ) ? ( int ) $this->params ()->fromRoute ( 'page' ) : 1;
   		
//    		$igirlxinhcoms = $this->getIgirlxinhcomTable ()->fetchAll ( $select->order ( $order_by . ' ' . $order ) );
//    		$itemsPerPage = 3;
   		
//    		$igirlxinhcoms->current ();
//    		$paginator = new Paginator ( new paginatorIterator ( $igirlxinhcoms ) );
//    		$paginator->setCurrentPageNumber ( $page )->setItemCountPerPage ( $itemsPerPage )->setPageRange ( 4 );
   		
//    		return new ViewModel ( array (
//    				// 'igirlxinhcoms' => $this->getIgirlxinhcomTable()->fetchAll(),
//    				'order_by' => $order_by,
//    				'order' => $order,
//    				'page' => $page,
//    				'paginator' => $paginator
//    		) );
    	
    	$this->layout('layout/home');
    	return new ViewModel(array(
    			//'action'=>'index',
    			'girlxinh'=>$arr,
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
}

