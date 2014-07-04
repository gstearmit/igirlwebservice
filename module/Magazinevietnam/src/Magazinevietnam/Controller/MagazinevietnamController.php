<?php

namespace Magazinevietnam\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Magazinevietnam\Model\Magazinevietnam;
use Magazinevietnam\Form\MagazinevietnamForm;

use Magazinevietnam\Form\MagazinevietnamSearchForm as SearchFromMagazinevietnam ;


use Zend\Db\Sql\Select;
use Zend\Paginator\Paginator;
use Zend\Paginator\Adapter\Iterator as paginatorIterator;
// check login
use ZfcUser\Service\User as UserService;
use ZfcUser\Options\UserControllerOptionsInterface;
use Zend\Validator\File\Size;
use Zend\Validator\File\Extension;
use Mgvndetail\Model\MgvndetailTable;

class MagazinevietnamController extends AbstractActionController {
	protected $magazinevietnamTable;
	
	public function searchAction()
	{
	
		$request = $this->getRequest();
	
		$url = 'index';
	
		if ($request->isPost()) {
			$formdata    = (array) $request->getPost();
			$search_data = array();
			foreach ($formdata as $key => $value) {
				if ($key != 'submit') {
					if (!empty($value)) {
						$search_data[$key] = $value;
					}
				}
			}
			if (!empty($search_data)) {
				$search_by = json_encode($search_data);
				$url .= '/search_by/' . $search_by;
			}
		}
		$this->redirect()->toUrl($url);
	}
	
	
	public function indexAction() {
		// check login
// 		if (! $this->zfcUserAuthentication ()->hasIdentity ()) {
// 			return $this->redirect ()->toRoute ( 'zfcuser/login' );
// 		} else {
			
			$searchform = new SearchFromMagazinevietnam();
			$searchform->get('submit')->setValue('Search');
			
			$select = new Select ();
			
			$order_by = $this->params ()->fromRoute ( 'order_by' ) ? $this->params ()->fromRoute ( 'order_by' ) : 'id';
			$order = $this->params ()->fromRoute ( 'order' ) ? $this->params ()->fromRoute ( 'order' ) : Select::ORDER_DESCENDING;
			$page = $this->params ()->fromRoute ( 'page' ) ? ( int ) $this->params ()->fromRoute ( 'page' ) : 1;
			$search_by = $this->params()->fromRoute('search_by') ? $this->params()->fromRoute('search_by') : '';
			$select->order($order_by . ' ' . $order);
			$where    = new \Zend\Db\Sql\Where();
			$formdata = array();
			if (!empty($search_by)) {
				$formdata = (array) json_decode($search_by);
				if (!empty($formdata['descriptionkey'])) {
					$where->addPredicate(
							new \Zend\Db\Sql\Predicate\Like('descriptionkey', '%' . $formdata['descriptionkey'] . '%')
					);
				}
				if (!empty($formdata['title'])) {
					$where->addPredicate(
							new \Zend\Db\Sql\Predicate\Like('title', '%' . $formdata['title'] . '%')
					);
				}
			
			}
			if (!empty($where)) {
				$select->where($where);
			}
			
			$magazinevietnams = $this->getMagazinevietnamTable ()->fetchAll ( $select) ;
			$itemsPerPage = 10; // is Number record/page
			$totalRecord  = $magazinevietnams->count();
			$magazinevietnams->current ();
			$paginator = new Paginator ( new paginatorIterator ( $magazinevietnams ) );
			$paginator->setCurrentPageNumber ( $page )->setItemCountPerPage ( $itemsPerPage )->setPageRange ( 4 ); // is number page want view
			
			return new ViewModel ( array (
					'search_by'  => $search_by,
					'order_by' => $order_by,
					'order_by' => $order_by,
					'order' => $order,
					'page' => $page,
					'paginatormagazinevietnam' => $paginator ,
					'pageAction' => 'magazinevietnams ',
					'form'       => $searchform,
					'totalRecord' => $totalRecord,
			) );
		//} // login
	}
	public function addAction() {
		$dbAdapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
		$form = new MagazinevietnamForm($dbAdapter); // include Form Class
		$form->get ( 'submit' )->setAttribute ( 'value', 'Add' );
		
		$request = $this->getRequest ();
		
		if ($request->isPost ()) {
			
			$magazinevietnam = new Magazinevietnam ();
			
			$form->setInputFilter ( $magazinevietnam->getInputFilter () ); // check validate
			
			$data = array_merge_recursive ( $this->getRequest ()->getPost ()->toArray (), $this->getRequest ()->getFiles ()->toArray () );
			
			$form->setData ( $data ); // get all post
			

			if ($form->isValid ()) {
				
				$renname_file_img = $this->uploadImageAlatca($data ['imgkey']);
				$magazinevietnam->dataArraySwap($data,$renname_file_img);
				
				$this->getMagazinevietnamTable ()->saveMagazinevietnam ( $magazinevietnam );
				// Redirect to list of magazinevietnams
				return $this->redirect ()->toRoute ( 'magazinevietnam' );
			} else {
				// echo('Magazine is Form Not Validate');
			}
		}
		
		return array (
				'form' => $form 
		);
	}
	
	

	
	
	public function editAction() {
		$id = ( int ) $this->params ( 'id' );
		if (! $id) {
			return $this->redirect ()->toRoute ( 'magazinevietnam', array (
					'action' => 'add' 
			) );
		}
		$magazinevietnam = $this->getMagazinevietnamTable ()->getMagazinevietnam ( $id );
		$nameimg = $magazinevietnam->imgkey;
		
		$dbAdapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
		$form = new MagazinevietnamForm($dbAdapter,$id);
		$form->bind ( $magazinevietnam );
		$form->get ( 'submit' )->setAttribute ( 'value', 'Edit' );
		
		$request = $this->getRequest ();
		
		if ($request->isPost ()) {
			
			$data = array_merge_recursive ( $this->getRequest ()->getPost ()->toArray (), $this->getRequest ()->getFiles ()->toArray () );
			
// 			echo '<pre>';
// 			print_r($data);
// 			echo '</pre>';
	
			$form->setData ( $data );
			
// 			var_dump($form->isValid());
// 			die;
			
			if ($form->isValid()) {
			
				if( $data['imgkeyedit']['name'] !== '')
				{
						
					$magazinevietnam2 = new Magazinevietnam ();
					$renname_file_img = $this->uploadImageAlatca($data['imgkeyedit']);
					$magazinevietnam2->dataArraySwap($data,$renname_file_img);
					$this->getMagazinevietnamTable ()->saveMagazinevietnam2 ( $magazinevietnam2 );
				}else
				{
					
					$magazinevietnam2 = new Magazinevietnam ();
					$magazinevietnam2->dataArraySwap($data,$nameimg);
					$this->getMagazinevietnamTable ()->saveMagazinevietnam2 ( $magazinevietnam2 );
				}
				
				
				// Redirect to list of magazinevietnams
				return $this->redirect ()->toRoute ( 'magazinevietnam' );
			}
		}
		
		return array (
				'id' => $id,
				'form' => $form ,
				'nameimg'=>$nameimg,
		);
	}
	public function deleteAction() {
		$id = ( int ) $this->params ( 'id' );
		if (! $id) {
			return $this->redirect ()->toRoute ( 'magazinevietnam' );
		}
		
		$dir = ROOT_PATH . UPLOAD_PATH_IMG;
		// getname- img
		$image_array_all = $this->getMagazinevietnamTable()->getReadMagazinevietnam($id);
		
// 		echo '<pre>';
// 		print_r($image_array_all);
// 		echo '</pre>';
	    
		
		$image_array = array();
		if (is_array($image_array_all) and !empty($image_array_all))
			{
						foreach ($image_array_all as $result)
							{
								$tmp = array();
								$tmp= $result['img'];
								$image_array[] = $tmp;
							}
				
			}//else { Echo 'Not get name Imges'; die;}
			
			
			
			$array = array();
			if(is_array($image_array) and !empty($image_array))
			{
			
				foreach ($image_array as $result)
				{
					$arr_temp = explode('/', $result);
					$dir_name = $arr_temp[0];
					$tmp = array();
					$tmp= $arr_temp[1];
					$array[] = $tmp;
				}
			}
			
		
// 			echo '</br>';
// 			echo '<pre>';
// 			print_r($image_array);
// 			echo '</pre>';
			
// 			echo '</br>';
// 			var_dump($dir.$dir_name);
// 			echo '<pre>';
// 			print_r($array);
// 			echo '</pre>';
// 			//die;
		
			
			
			
		$request = $this->getRequest ();
		if ($request->isPost ()) {
			$del = $request->getPost ()->get ( 'del', 'No' );
			if ($del == 'Yes') {
				
				$id = ( int ) $request->getPost ()->get ( 'id' );
				$this->getMagazinevietnamTable ()->deleteMagazinevietnam ( $id );
				// delete table con cua no
				$this->getMagazinevietnamTable()->getTableByIdDelete($id);
				
// 				// delete img 
// 				foreach ( $array as $image)
// 				{
// 				   $result = $this->deleteImage($image, $dir.$dir_name);
				  
// 				}
				
			}
			
			// Redirect to list of magazinevietnams
			return $this->redirect ()->toRoute ( 'magazinevietnam' );
		}
		
		return array (
				'id' => $id,
				'magazinevietnam' => $this->getMagazinevietnamTable ()->getMagazinevietnam ( $id ) 
		);
	}
	
	
	public function readdetailAction()
	{
		$id = ( int ) $this->params ( 'id' );
		if (! $id) {
			return $this->redirect ()->toRoute ( 'magazinevietnam' );
		}
	
		$read = $this->getMagazinevietnamTable ()->getReadMagazinevietnam( $id ) ;
		return array (
				'id' => $id,
				'readdetail' => $read,
		);
	}
	
	
	public function getMagazinevietnamTable() {
		if (! $this->magazinevietnamTable) {
			$sm = $this->getServiceLocator ();
			$this->magazinevietnamTable = $sm->get ( 'Magazinevietnam\Model\MagazinevietnamTable' );
		}
		return $this->magazinevietnamTable;
	}
	

	
	
	public function createImageThumbnail($filePathName, $destinationPath, $options) {
		$arr = explode('/', $filePathName);
		$file_name = end($arr);
		 
		$new_file_name = 'thumb_' . $file_name;
		$new_file_path = $destinationPath . '/' . $new_file_name;
		 
		list($img_width, $img_height) = @getimagesize($filePathName);
		if (!$img_width || !$img_height) {
			return false;
		}
		$scale = min(
				$options['max_width'] / $img_width, $options['max_height'] / $img_height
		);
		$new_width = $img_width * $scale;
		$new_height = $img_height * $scale;
		$new_img = @imagecreatetruecolor($new_width, $new_height);
		switch (strtolower(substr(strrchr($file_name, '.'), 1))) {
			case 'jpg':
			case 'jpeg':
				$src_img = @imagecreatefromjpeg($filePathName);
				$write_image = 'imagejpeg';
				$image_quality = isset($options['jpeg_quality']) ?
				$options['jpeg_quality'] : 75;
				break;
			case 'gif':
				@imagecolortransparent($new_img, @imagecolorallocate($new_img, 0, 0, 0));
				$src_img = @imagecreatefromgif($filePathName);
				$write_image = 'imagegif';
				$image_quality = null;
				break;
			case 'png':
				@imagecolortransparent($new_img, @imagecolorallocate($new_img, 0, 0, 0));
				@imagealphablending($new_img, false);
				@imagesavealpha($new_img, true);
				$src_img = @imagecreatefrompng($filePathName);
				$write_image = 'imagepng';
				$image_quality = isset($options['png_quality']) ?
				$options['png_quality'] : 9;
				break;
			default:
				$src_img = null;
		}
		$success = $src_img && @imagecopyresampled(
				$new_img, $src_img, 0, 0, 0, 0, $new_width, $new_height, $img_width, $img_height
		) && $write_image($new_img, $new_file_path, $image_quality);
		// Free up memory (imagedestroy does not delete files):
		@imagedestroy($src_img);
		@imagedestroy($new_img);
		if ($success)
			return $new_file_name;
		return $success;
	}
	 
	 
	public function deleteImage($image, $dir)
	{
		try {
			$this->deleteFile($dir .'/'. $image);
			$this->deleteFile($dir .'/thumb_/thumb_'. $image);
			 
			//$logger->writeLog("DEBUG", $userEmail, $arrLog[0], $arrLog[1], "Delete image, file : " . $dir .'/'. $image, ">>");
			//$logger->writeLog("INFO", $userEmail, $arrLog[0], $arrLog[1], "Delete image, file : " . $dir .'/thumb_/thumb_'. $image, ">>");
		} catch (\Exception $exc) {
		$this->errorMessage = $exc->getMessage();
		}
		 
		 
		}
		public function uploadImage($imageData = array(), $dir, $createThumb = true, $options = array()) {
		 
		if (!empty($imageData)) {
		$fileName = time() . '.jpg';
		$dirFileName = $dir .'/'. $fileName;
		 
		$filter = new \Zend\Filter\File\RenameUpload($dirFileName);
		if ($filter->filter($imageData)) {
		if($createThumb){
		$options = (!empty($options)) ? $options : array('max_width' => 65, 'max_height' => 65, 'jpeg_quality' => 100);
   		$this->createImageThumbnail($dirFileName, $dir . '/thumb_', $options);
		}
		 
		 
		return $fileName;
		}
		}
		 
		return false;
		}
		 
		public function uploadImageAlatca($imageData = array()) {
		if (!empty($imageData)) {
		$fileName = time() . '.jpg';
		$dir = ROOT_PATH . UPLOAD_PATH_IMG;
		$dirFileName = $dir .'/'. $fileName;
		 
		$filter = new \Zend\Filter\File\RenameUpload($dirFileName);
		if ($filter->filter($imageData)) {
		$options = array('max_width' => 102, 'max_height' => 102, 'jpeg_quality' => 100);
		$this->createImageThumbnail($dirFileName, $dir . '/thumb_', $options);
		return $fileName;
		}
		}
   				return false;
		}
		 
		public function deleteFile($file_path) {
		if (!empty($file_path) && file_exists($file_path)) {
		return @unlink($file_path);
		}
		return false;
		}
		 
	
}
