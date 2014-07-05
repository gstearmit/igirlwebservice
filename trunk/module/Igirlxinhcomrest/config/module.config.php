<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Igirlxinhcomrest\Controller\Igirlxinhcomrest' => 'Igirlxinhcomrest\Controller\IgirlxinhcomrestController',
        ),
    ),

    // The following section is new` and should be added to your file
    'router' => array(
        'routes' => array(
            'igirlxinhcom-rest' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/igirlxinhcom-rest[/:id]',
                    'constraints' => array(
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Igirlxinhcomrest\Controller\Igirlxinhcomrest',
                    ),
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'strategies' => array(
            'ViewJsonStrategy',
        ),
    ),
);