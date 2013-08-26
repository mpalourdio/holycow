<?php
namespace Holycow\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/** @ORM\Entity
 * @ORM\Table(name="livraisons")
 */
class Livraisons {
	/**
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 * @ORM\Column(type="integer")
	 */
	protected $livraisonid;
	
	/** @ORM\Column(type="datetime") */
	protected $datelivraison;
	/** @ORM\Column(type="datetime") */
	protected $datedernierdelai;
	/** @ORM\Column(type="integer") */
	protected $actif;
	/** @ORM\Column(type="string") */
	protected $contact;
	
	/**
	* @ORM\OneToMany(targetEntity="Commandes", mappedBy="livraisons")
	* @ORM\JoinColumn(name="livraisonid", referencedColumnName="livraisonid")
	*/
	protected $commandes;
	
	public function __construct()
	{
		$this->commandes = new ArrayCollection();
	}
	/**
     * @return the $livraisonid
     */
    public function getLivraisonid ()
    {
        return $this->livraisonid;
    }

	/**
     * @return the $datelivraison
     */
    public function getDatelivraison ()
    {
        return $this->datelivraison;
    }

	/**
     * @return the $datedernierdelai
     */
    public function getDatedernierdelai ()
    {
        return $this->datedernierdelai;
    }

	/**
     * @return the $actif
     */
    public function getActif ()
    {
        return $this->actif;
    }

	/**
     * @return the $contact
     */
    public function getContact ()
    {
        return $this->contact;
    }

	/**
     * @return the $commandes
     */
    public function getCommandes ()
    {
        return $this->commandes;
    }

	/**
     * @param field_type $livraisonid
     */
    public function setLivraisonid ($livraisonid)
    {
        $this->livraisonid = $livraisonid;
    }

	/**
     * @param field_type $datelivraison
     */
    public function setDatelivraison ($datelivraison)
    {
        $this->datelivraison = $datelivraison;
    }

	/**
     * @param field_type $datedernierdelai
     */
    public function setDatedernierdelai ($datedernierdelai)
    {
        $this->datedernierdelai = $datedernierdelai;
    }

	/**
     * @param field_type $actif
     */
    public function setActif ($actif)
    {
        $this->actif = $actif;
    }

	/**
     * @param field_type $contact
     */
    public function setContact ($contact)
    {
        $this->contact = $contact;
    }

	/**
     * @param \Doctrine\Common\Collections\ArrayCollection $commandes
     */
    public function setCommandes ($commandes)
    {
        $this->commandes = $commandes;
    }

	
}