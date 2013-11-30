<?php

namespace mgate\SuiviBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RepartitionJEH
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class RepartitionJEH
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @ORM\ManyToOne(targetEntity="mgate\SuiviBundle\Entity\Mission", inversedBy="repartitionsJEH") 
     */
    private $mission;
    
    /**
     * @var integer $nbrJEH
     * @ORM\Column(name="nombreJEH", type="integer", nullable=true)
     */
    private $nbrJEH;


    /**
     * @var integer $prixJEH
     * @ORM\Column(name="prixJEH", type="integer", nullable=true)
     */
    private $prixJEH;

    /**
     * @ORM\ManyToOne(targetEntity="AvMission", inversedBy="nouvelleRepartition")
     */
    private $avMission;
    
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
     * Set mission
     *
     * @param \mgate\SuiviBundle\Entity\Mission $mission
     * @return RepartitionJEH
     */
    public function setMission(\mgate\SuiviBundle\Entity\Mission $mission = null)
    {
        $this->mission = $mission;
    
        return $this;
    }

    /**
     * Get mission
     *
     * @return \mgate\SuiviBundle\Entity\Mission 
     */
    public function getMission()
    {
        return $this->mission;
    }

    /**
     * Set nbrJEH
     *
     * @param integer $nbrJEH
     * @return RepartitionJEH
     */
    public function setNbrJEH($nbrJEH)
    {
        $this->nbrJEH = $nbrJEH;
    
        return $this;
    }

    /**
     * Get nbrJEH
     *
     * @return integer 
     */
    public function getNbrJEH()
    {
        return $this->nbrJEH;
    }

    /**
     * Set prixJEH
     *
     * @param integer $prixJEH
     * @return RepartitionJEH
     */
    public function setPrixJEH($prixJEH)
    {
        $this->prixJEH = $prixJEH;
    
        return $this;
    }

    /**
     * Get prixJEH
     *
     * @return integer 
     */
    public function getPrixJEH()
    {
        return $this->prixJEH;
    }
    
    /**
     * Set avMission
     *
     * @param \mgate\SuiviBundle\Entity\AvMission $avenant
     * @return RepartitionJEH
     */
    public function setAvMission(\mgate\SuiviBundle\Entity\AvMission $avMission = null)
    {
        $this->avMission = $avMission;
    
        return $this;
    }

    /**
     * Get avMission
     *
     * @return \mgate\SuiviBundle\Entity\AvMission
     */
    public function getAvMission()
    {
        return $this->avMission;
    }
}