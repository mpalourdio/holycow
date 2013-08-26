<?php
return array(
    'controllers'  => array(
        'invokables' => array(
            'Holycow\Controller\Commandes'  => 'Holycow\Controller\CommandesController',
            'Holycow\Controller\Livraisons' => 'Holycow\Controller\LivraisonsController',
        ),
    ),
    'router'       => array(
        'routes' => array(
            'livraisons' => array(
                'type'    => 'segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route'       => '/livraisons[/:action][/:livraisonid]',
                    'defaults'    => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Holycow\Controller',
                        'controller'    => 'Livraisons',
                        'action'        => 'index',
                    ),
                    'constraints' => array(
                        'livraisonid' => '[0-9]+',
                    ),
                ),
            ),
            'commandes'  => array(
                'type'    => 'segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route'       => '/commandes[/:action][/:livraisonid][/:commandeid]',
                    'defaults'    => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Holycow\Controller',
                        'controller'    => 'Commandes',
                        'action'        => 'index',
                    ),
                    'constraints' => array(
                        'livraisonid' => '[0-9]+',
                        'commandeid'  => '[0-9]+',
                    ),
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'Holycow' => __DIR__ . '/../view',
        ),
    ),
    'doctrine'     => array(
        'driver' => array(
            'holycow_entities' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/Holycow/Entity')
            ),
            'orm_default'      => array(
                'drivers' => array(
                    'Holycow\Entity' => 'holycow_entities'
                )
            )
        )
    )
);
