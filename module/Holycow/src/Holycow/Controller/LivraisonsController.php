<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/Holycow for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace Holycow\Controller;

use Holycow\Entity\Livraisons;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class LivraisonsController extends AbstractActionController
{

    protected $sm;

    public function indexAction()
    {
        $this->sm      = $this->getServiceLocator();
        $objectManager = $this->sm->get('Doctrine\ORM\EntityManager');
        $form          = $this->sm->get('FormElementManager')->get('Holycow\Form\LivraisonForm');
        $livraison     = new Livraisons();

        $form->bind($livraison);
        if ($this->getRequest()->isPost()) {

            $form->setData($this->getRequest()->getPost());
            if ($form->isValid()) {
                $objectManager->persist($livraison);
                $objectManager->flush();
                $this->flashMessenger()->addMessage('Livraison enregistrée ! Merci!');
                return $this->redirect()->toRoute(
                    'livraisons',
                    array(
                        'action' => 'success',
                    )
                );
            }
        }
        return array(
            'form' => $form,
        );
    }

    public function successAction()
    {
        return new ViewModel(array('flashMessages' => $this->flashMessenger()->getMessages()));
    }

    public function editAction()
    {
        $this->sm = $this->getServiceLocator();
        $form     = $this->sm->get('FormElementManager')->get('Holycow\Form\LivraisonForm');
        $form->get('recbtn')->setAttribute('value', 'Modifier');
        $livraisonid   = (int)$this->params()->fromRoute('livraisonid', 0);
        $objectManager = $this->sm->get('Doctrine\ORM\EntityManager');
        $livraison     = $objectManager->find('Holycow\Entity\Livraisons', $livraisonid);
        $form->bind($livraison);

        if ($this->getRequest()->getPost('recbtn')) {
            $form->setData($this->getRequest()->getPost());
            if ($form->isValid()) {
                $objectManager->flush();
                $this->flashMessenger()->addMessage('Livraison modifiée !');
                return $this->redirect()->toRoute(
                    'commandes',
                    array(
                        'action' => 'success',
                    )
                );
            }
        }
        return array(
            'form' => $form
        );
    }
}
