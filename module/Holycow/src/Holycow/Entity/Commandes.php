<?php
namespace Holycow\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/** @ORM\Entity
 * @ORM\Table(name="commandes")
 */
class Commandes {
	/**
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 * @ORM\Column(type="integer")
	 */
	protected $commandeid ;

	/** 
	 * @ORM\Column(type="integer") 
	 */
	protected $livraisonid;
	
	/** 
	 * @ORM\Column(type="string") 
	 */
	protected $contact;
	
	/**
	 * @ORM\Column(type="string")
	 */
	protected $details;
	
	/**
	 * @ORM\Column(type="float")
	 */
	protected $prix;
	
	
	/**
	 * @ORM\ManyToOne(targetEntity="Livraisons", inversedBy="commandes")
	 * @ORM\JoinColumn(name="livraisonid", referencedColumnName="livraisonid")
	 */
	protected $livraisons;
	
	
	/**
     * @return the $commandeid
     */
    public function getCommandeid ()
    {
        return $this->commandeid;
    }

	/**
     * @return the $livraisonid
     */
    public function getLivraisonid ()
    {
        return $this->livraisonid;
    }

	/**
     * @return the $contact
     */
    public function getContact ()
    {
        return $this->contact;
    }

	/**
     * @return the $details
     */
    public function getDetails ()
    {
        return $this->details;
    }

	/**
     * @return the $prix
     */
    public function getPrix ()
    {
        return $this->prix;
    }

	/**
     * @return the $livraisons
     */
    public function getLivraisons ()
    {
        return $this->livraisons;
    }

	/**
     * @param field_type $commandeid
     */
    public function setCommandeid ($commandeid)
    {
        $this->commandeid = $commandeid;
    }

	/**
     * @param field_type $livraisonid
     */
    public function setLivraisonid ($livraisonid)
    {
        $this->livraisonid = $livraisonid;
    }

	/**
     * @param field_type $contact
     */
    public function setContact ($contact)
    {
        $this->contact = $contact;
    }

	/**
     * @param field_type $details
     */
    public function setDetails ($details)
    {
        $this->details = $details;
    }

	/**
     * @param field_type $prix
     */
    public function setPrix ($prix)
    {
        $this->prix = $prix;
    }

	/**
     * @param \Doctrine\Common\Collections\ArrayCollection $livraisons
     */
    public function setLivraisons ($livraisons)
    {
        $this->livraisons = $livraisons;
    }

	
	
	
}