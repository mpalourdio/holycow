<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/Holycow for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Holycow;

use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use Holycow\Form\CommandeFieldset;
use Holycow\Form\CommandeForm;
use Holycow\Form\LivraisonFieldset;
use Holycow\Form\LivraisonForm;
use Holycow\Strategy\DateToStringStrategy;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\Mvc\ModuleRouteListener;

class Module implements AutoloaderProviderInterface
{
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    // if we're in a namespace deeper than one level we need to fix the \ in the path
                    __NAMESPACE__ => __DIR__ . '/src/' . str_replace('\\', '/', __NAMESPACE__),
                ),
            ),
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getFormElementConfig()
    {
        return array(
            'factories' => array(
                'Holycow\Form\LivraisonFieldset' => function ($fm) {
                    $fieldset       = new LivraisonFieldset();
                    $serviceManager = $fm->getServiceLocator();
                    $entityManager  = $serviceManager->get('Doctrine\ORM\EntityManager');
                    $hydrator       = new DoctrineObject($entityManager, 'Holycow\Entity\Livraisons');
                    $hydrator->addStrategy('datelivraison', new DateToStringStrategy());
                    $hydrator->addStrategy('datedernierdelai', new DateToStringStrategy());
                    $fieldset->setHydrator($hydrator);
                    return $fieldset;
                },
                'Holycow\Form\LivraisonForm'     => function ($fm) {
                    $form           = new LivraisonForm();
                    $form->setName('livraison');
                    $form->setAttribute('method', 'post');
                    return $form;
                },
                'Holycow\Form\CommandeFieldset'  => function ($fm) {
                    $fieldset       = new CommandeFieldset();
                    $serviceManager = $fm->getServiceLocator();
                    $entityManager  = $serviceManager->get('Doctrine\ORM\EntityManager');
                    $hydrator       = new DoctrineObject($entityManager, 'Holycow\Entity\Commandes');
                    $fieldset->setHydrator($hydrator);
                    return $fieldset;
                },
                'Holycow\Form\CommandeForm'      => function ($fm) {
                    $form           = new CommandeForm();
                    $form->setName('commande');
                    $form->setAttribute('method', 'post');
                    return $form;
                },
            ),
        );
    }
}
