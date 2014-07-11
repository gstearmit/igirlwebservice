<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Contendetail\Controller\Contendetail' => 'Contendetail\Controller\ContendetailController'
        ),
    ),

    'router' => array(
        'routes' => array(
            'contendetail' => array(
                'type'    => 'segment',
                'options' => array(
                   'route'    => '/contendetail[/:action][/:id]/ig[/:ig]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    	'ig'     => '[0-9]+', // ig : igril_id
                    ),
                    'defaults' => array(
                    	'__NAMESPACE__' => 'Contendetail\Controller',
                        'controller' => 'Contendetail\Controller\Contendetail',
                        'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),

    'view_manager' => array(
        'template_path_stack' => array(
            'Contendetail' => __DIR__ . '/../view',
        ),
        'template_map' => array(
            'page-contendetail' => __DIR__ . '/../view/layout/slidePaginator.phtml',
        ),
    ),
);