<?php
/* Table intermédiaire ManyToMany avec attribut : Mandat = MembrePoste
 */
namespace mgate\PersonneBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Mandat
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="mgate\PersonneBundle\Entity\MandatRepository")
 */
class Mandat
{

    /**
     * @var \Date $debutMandat
     *
     * @ORM\Column(name="debutMandat", type="date",nullable=false)
     */
    private $debutMandat;
    
    /**
     * @var \Date $finMandat
     *
     * @ORM\Column(name="finMandat", type="date",nullable=false)
     */
    private $finMandat;
    
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     *
     * @ORM\ManyToOne(targetEntity="mgate\PersonneBundle\Entity\Membre", inversedBy="mandats")
     */
    private $membre;
    
    /**
     * @ORM\ManyToOne(targetEntity="mgate\PersonneBundle\Entity\Poste", inversedBy="Mandat")
     */
    private $poste;
        
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set debutMandat
     *
     * @param \DateTime $debutMandat
     * @return Mandat
     */
    public function setDebutMandat($debutMandat)
    {
        $this->debutMandat = $debutMandat;
    
        return $this;
    }

    /**
     * Get debutMandat
     *
     * @return \DateTime 
     */
    public function getDebutMandat()
    {
        return $this->debutMandat;
    }

    /**
     * Set finMandat
     *
     * @param \DateTime $finMandat
     * @return Mandat
     */
    public function setFinMandat($finMandat)
    {
        $this->finMandat = $finMandat;
    
        return $this;
    }

    /**
     * Get finMandat
     *
     * @return \DateTime 
     */
    public function getFinMandat()
    {
        return $this->finMandat;
    }

    /**
     * Set membre
     *
     * @param \mgate\PersonneBundle\Entity\Membre $membre
     * @return Mandat
     */
    public function setMembre(\mgate\PersonneBundle\Entity\Membre $membre)
    {
        $this->membre = $membre;
    
        return $this;
    }

    /**
     * Get membre
     *
     * @return \mgate\PersonneBundle\Entity\Membre 
     */
    public function getMembre()
    {
        return $this->membre;
    }

    /**
     * Set poste
     *
     * @param \mgate\PersonneBundle\Entity\Poste $poste
     * @return Mandat
     */
    public function setPoste(\mgate\PersonneBundle\Entity\Poste $poste)
    {
        $this->poste = $poste;
    
        return $this;
    }

    /**
     * Get poste
     *
     * @return \mgate\PersonneBundle\Entity\Poste 
     */
    public function getPoste()
    {
        return $this->poste;
    }
}