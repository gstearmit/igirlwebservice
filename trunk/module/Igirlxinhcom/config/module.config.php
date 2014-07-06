<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Igirlxinhcom\Controller\Igirlxinhcom' => 'Igirlxinhcom\Controller\IgirlxinhcomController',
        ),
    ),
    
    'router' => array(
        'routes' => array(
            'igirlxinhcom' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/igirlxinhcom[/:action][/:action][/:id][/page/:page][/order_by/:order_by][/:order][/search_by/:search_by]',
                    'constraints' => array(
            						'action' => '(?!\bpage\b)(?!\border_by\b)(?!\bsearch_by\b)[a-zA-Z][a-zA-Z0-9_-]*',
            						'id'     => '[0-9]+',
            						'page' => '[0-9]+',
            						'order_by' => '[a-zA-Z][a-zA-Z0-9_-]*',
            						'order' => 'ASC|DESC',
                    ),
                    'defaults' => array(
                        'controller' => 'Igirlxinhcom\Controller\Igirlxinhcom',
                        'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),

    'view_manager' => array(
        'template_path_stack' => array(
            'Igirlxinhcom' => __DIR__ . '/../view',
        ),
    		'template_map' => array(
    				'paginator-igirlxinhcom' => __DIR__ . '/../view/layout/slidePaginator.phtml',
    		),
    		'strategies' => array(
    				'ViewJsonStrategy',
    		),
    ),
);