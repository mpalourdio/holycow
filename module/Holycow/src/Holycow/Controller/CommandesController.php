<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/Holycow for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Holycow\Controller;

use Holycow\Entity\Commandes;
use Zend\Feed\Writer\Feed;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class CommandesController extends AbstractActionController
{

    protected $sm;

    //affichage des prochaines livraisons
    public function indexAction()
    {
        $this->sm      = $this->getServiceLocator();
        $objectManager = $this->sm->get('Doctrine\ORM\EntityManager');
        $livraisons    = $objectManager->getRepository('Holycow\Entity\Livraisons')->findBy(
            array(),
            array('datedernierdelai' => 'desc')
        );
        return array('livraisons' => $livraisons,);
    }

    //can i haz cheezburger ?
    public function addAction()
    {
        $this->sm           = $this->getServiceLocator();
        $objectManager      = $this->sm->get('Doctrine\ORM\EntityManager');
        $form               = $this->sm->get('FormElementManager')->get('Holycow\Form\CommandeForm');
        $livraisonid        = (int)$this->params()->fromRoute('livraisonid', 0);
        $commande           = new Commandes();
        $livraison          = $objectManager->find('Holycow\Entity\Livraisons', $livraisonid);
        $isCommandePossible = true;
        //check si on n'a pas dépassé le délai de commande
        $now              = new \DateTime('now');
        $datedernierdelai = $livraison->getDatedernierdelai();
        $interval         = $now->diff($datedernierdelai);
        $moreorless       = $interval->format('%R');
        if ($moreorless == "-") {
            $isCommandePossible = false;
        }

        $commande->setLivraisons($livraison);

        $form->bind($commande);
        if ($this->getRequest()->isPost()) {

            $form->setData($this->getRequest()->getPost());
            if ($form->isValid()) {
                $objectManager->persist($commande);
                $objectManager->flush();
                $this->flashMessenger()->addMessage('Commande enregistrée !');
                return $this->redirect()->toRoute(
                    'commandes',
                    array(
                        'action' => 'success',
                    )
                );
            }
        }
        return array(
            'form'               => $form,
            'livraisonid'        => $livraisonid,
            'isCommandePossible' => $isCommandePossible
        );
    }

    public function feedAction()
    {
        $feed = new Feed();
        $feed->setDescription('Commandes Holycow Unil');
        $feed->setTitle('Commandes Holycow Unil');
        $feed->setLink('http://www.unil.ch/holycow');

        $this->sm      = $this->getServiceLocator();
        $objectManager = $this->sm->get('Doctrine\ORM\EntityManager');
        $livraisons    = $objectManager->getRepository('Holycow\Entity\Livraisons')->findBy(
            array(),
            array('datedernierdelai' => 'desc')
        );

        foreach ($livraisons as $k => $v) {

            $entry = $feed->createEntry();
            $entry->setTitle('Nouvelle livraison de burgers !');
            $entry->setLink(
                'http://' . $_SERVER['HTTP_HOST'] . $this->url()->fromRoute(
                    'commandes',
                    array(
                        'action'      => 'add',
                        'livraisonid' => $v->getLivraisonid()
                    )
                )
            );

            $entry->setDateModified(time());
            $entry->setDateCreated(time());
            $strDesc = 'ALO UI CER POUR UN BURGER.<br />';
            $strDesc .= 'Dernier délai pour passer commande : ' . $v->getDatedernierdelai()->format(
                'd.m.Y H:i'
            ) . '<br />';
            $strDesc .= 'Date de la livraison : ' . $v->getDatelivraison()->format('d.m.Y H:i') . '<br />';
            $strDesc .= 'Contact : <a href="mailto:' . $v->getContact() . '">' . $v->getContact() . '</a><br />';
            $entry->setDescription($strDesc);
            $feed->addEntry($entry);
        }


        $result = new ViewModel(
            array('out' => $feed->export('rss'))
        );
        $result->setTerminal(true);
        return $result;
    }

    public function editAction()
    {
        $this->sm = $this->getServiceLocator();
        $form     = $this->sm->get('FormElementManager')->get('Holycow\Form\CommandeForm');
        $form->get('recbtn')->setAttribute('value', 'Modifier');
        $commandeid    = (int)$this->params()->fromRoute('commandeid', 0);

        $objectManager = $this->sm->get('Doctrine\ORM\EntityManager');
        $commande      = $objectManager->find('Holycow\Entity\Commandes', $commandeid);

        $form->bind($commande);

        if ($this->getRequest()->getPost('recbtn')) {
            $form->setData($this->getRequest()->getPost());
            if ($form->isValid()) {
                $objectManager->flush();
                $this->flashMessenger()->addMessage('Commande modifiée !');
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

    public function successAction()
    {
        return new ViewModel(array('flashMessages' => $this->flashMessenger()->getMessages()));
    }
}
