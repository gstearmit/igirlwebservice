<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Phototamtayvnrest\Controller\Phototamtayvnrest' => 'Phototamtayvnrest\Controller\PhototamtayvnrestController',
        ),
    ),

    // The following section is new` and should be added to your file
    'router' => array(
        'routes' => array(
            'phototamtayvn-rest' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/phototamtayvn-rest[/:id]',
                    'constraints' => array(
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Phototamtayvnrest\Controller\Phototamtayvnrest',
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