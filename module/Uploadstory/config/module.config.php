<?php
return array(
    'controllers' => array(
        'invokables' => array(
           'Uploadstory\Controller\Uploadstory' => 'Uploadstory\Controller\UploadstoryController'
        ),
    ),

    'router' => array(
        'routes' => array(
            'uploadstory' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/uploadstory[/:action][/:id][/page/:page][/order_by/:order_by][/:order][/search_by/:search_by]',
                    'constraints' => array(
                    	'action' => '(?!\bpage\b)(?!\border_by\b)(?!\bsearch_by\b)[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                        'page' => '[0-9]+',
                        'order_by' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'order' => 'ASC|DESC',
                    ),
                    'defaults' => array(
                    	'__NAMESPACE__' => 'Uploadstory\Controller',
                        'controller' => 'Uploadstory\Controller\Uploadstory',
                        'action'     => 'uploadnew',
                    ),
                ),
            ),
        ),
    		
    ),

    'view_manager' => array(
        'template_path_stack' => array(
            'Uploadstory' => __DIR__ . '/../view',
        ),
        'template_map' => array(
            'page-upload' => __DIR__ . '/../view/layout/slidePaginator.phtml',
        ),
    ),
);