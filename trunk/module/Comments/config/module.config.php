<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Comments\Controller\Comments' => 'Comments\Controller\CommentsController'
        ),
    ),

    'router' => array(
        'routes' => array(
            'comments' => array(
                'type'    => 'segment',
                'options' => array(
                   'route'    => '/comments[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    
                    ),
                    'defaults' => array(
                    	'__NAMESPACE__' => 'Comments\Controller',
                        'controller' => 'Comments\Controller\Comments',
                        'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),

    'view_manager' => array(
        'template_path_stack' => array(
            'Comments' => __DIR__ . '/../view',
        ),
        'template_map' => array(
            'page-comments' => __DIR__ . '/../view/layout/slidePaginator.phtml',
        ),
    		'strategies' => array(
    				'ViewJsonStrategy',
    		),
    ),
);