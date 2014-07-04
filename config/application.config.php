<?php
defined('SERVER_ENVIRONMENT') ||define('SERVER_ENVIRONMENT',$_SERVER["HTTP_HOST"]); //servicer_magazin_pulish.localhost:1910
defined('WEB_PATH') || define('WEB_PATH','http://'.$_SERVER["HTTP_HOST"]);//http://192.168.0.33:1910
defined('WEB_PATH2') || define('WEB_PATH2','http://'.$_SERVER["HTTP_HOST"]);//http://192.168.0.33:1910


defined('WEB_PATH_IMG') || define('WEB_PATH_IMG', WEB_PATH.'/images');
defined('Upload_NEWS') || define('Upload_NEWS', WEB_PATH2.'/imagesupload');
defined('APP_IMG') || define('APP_IMG', WEB_PATH2.'/imagesapp');
defined('CKEDITOR_PATH') || define('CKEDITOR_PATH', WEB_PATH.'/plugins/ckeditor/ckeditor.js');
defined('Thumb_')|| define('Thumb_', WEB_PATH_IMG . '/thumb_/thumb_');
// defined('Default_img')|| define('Thumb_', WEB_PATH_IMG . '/thumb_/thumb_');

return array(
    'modules' => array(
        'Application',
        'Album',
    	'AlbumRest',
    	'Booknews',
		'Magazinepublish',
		'MagazinePublishRest',
    	'MagazineRest',
		'Mzimg',
    	'Manastory',
		'Storydetail',
		'ManastoryRest',
		'MagastoryRestfull',
		'Catalogue',
		'CatalogueRest',
		'Cataloguerestfull',
		'Magazinevietnam',
		'Mgvndetail',
		'Magazinevnrest',
		'Magazinevnrestfull',
		'Librarybooks',
		'LibrarybooksRest',
		'Librarybooksrestfull',
		'Librarydetail',
		'Upload',
    	'Uploadmagazine',
    	'Uploadmagazinevietnam',
    	'Uploadlibrarybooks',
    	'Uploadstory',
    	//'Portcms',
    		'Editorapp',
		'NewdetailRest',
		'Allmagazinerestnews',
		'SanRestful',
		'ZendCart',
		'ShoppingCart',
		//'Newdetail',
		'News',
		'ZfcUser',
		'ZfcBase',
		'ZfcAdmin',
		'ZfcFacebook',
    	'Appeditor',
		//'ZfcAcl',
		//'BjyAuthorize',
		'FileUpload',
		'Uploadfilemutil',
		//'Test',
		//'ZendDeveloperTools',
		//'ZF2AuthAcl',
		//'DoctrineModule',
        //'DoctrineORMModule'
		//'ZfcUserList',
		//'ZfcRbac',
		//'ZfcUserDoctrineORM',
		'Admin',
		'Template',
        'Rssget',
    	'Apphaivltvrest',
    	'Apphaivlcomrest',
    	'Appzf2rest',
        'Appmincecraftrest',
    	//'Wattpad',
    	'Hamtruyencom',
    	'Chapter',
		'Igirlxinhcom',
		
		
    ),
    'module_listener_options' => array(
        'config_glob_paths'    => array(
            'config/autoload/{,*.}{global,local}.php',
        ),
        'module_paths' => array(
            './module',
            './vendor',
        ),
    ),
);
