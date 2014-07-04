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
                    'route'    => '/igirlxinhcom[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Igirlxinhcom\Controller\Igirlxinhcom',
                        'action'     => 'igirlxinhcomrest',
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