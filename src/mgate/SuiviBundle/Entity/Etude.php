<?php

namespace mgate\SuiviBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\ArrayCollection as ArrayCollection;

/**
 * mgate\SuiviBundle\Entity\Etude
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="mgate\SuiviBundle\Entity\EtudeRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Etude extends \Symfony\Component\DependencyInjection\ContainerAware {

    /**
     * @var bool
     */
    private $knownProspect = false;

    /**
     *
     */
    private $newProspect;

    /**
     * @var integer $stateID
     *
     * @ORM\Column(name="stateID", type="integer", nullable=true)
     */
    private $stateID;

    /**
     * @var string $Description
     *
     * @ORM\Column(name="stateDescription", type="text", nullable=true)
     */
    private $stateDescription;

    /**
     * @var boolean $confidentiel
     *
     * @ORM\Column(name="confidentiel", type="boolean", nullable=true)
     */
    private $confidentiel;

    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="mgate\PersonneBundle\Entity\Prospect", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    protected $prospect;

    /**
     * @ORM\ManyToOne(targetEntity="mgate\PersonneBundle\Entity\Personne")
     * @ORM\JoinColumn(nullable=true)
     */
    protected $suiveur;

    /**
     * @ORM\OneToOne(targetEntity="\mgate\CommentBundle\Entity\Thread", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $thread;

    /**
     * @var \DateTime $dateCreation
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="dateCreation", type="datetime")
     */
    private $dateCreation;

    /**
     * @var \DateTime $dateModification
     *
     * @ORM\Column(name="dateModification", type="datetime")
     * @Gedmo\Timestampable(on="update")
     */
    private $dateModification;

    /**
     * @var integer $mandat
     *
     * @ORM\Column(name="mandat", type="integer")
     */
    private $mandat;

    /**
     * @var integer $num
     *
     * @ORM\Column(name="num", type="integer", nullable=true)
     */
    private $num;

    /**
     * @var boolean $dossierCree
     *
     * @ORM\Column(name="dossierCree", type="boolean", nullable=true)
     */
    private $dossierCree;

    /**
     * @var string $nom
     *
     * @ORM\Column(name="nom", type="text", nullable=false, length=50)
     */
    private $nom;

    /**
     * @var string $description
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var string $competences
     *
     * @ORM\Column(name="competences", type="text", nullable=true)
     */
    private $competences;

    /**
     * @var boolean $mailEntretienEnvoye
     *
     * @ORM\Column(name="mailEntretienEnvoye", type="boolean", nullable=true)
     */
    private $mailEntretienEnvoye;

    /**
     * @var boolean $annonceSelectionne
     *
     * @ORM\Column(name="annonceSelectionne", type="boolean", nullable=true)
     */
    private $annonceSelectionne;

    /**
     * @var \DateTime $dateDebut
     *
     * @ORM\Column(name="dateDebut", type="datetime", nullable=true)
     */
    private $dateDebut;

    /**
     * @var \DateTime $dateFin
     *
     * @ORM\Column(name="dateFin", type="datetime", nullable=true)
     */
    private $dateFin;

    /**
     * @var \DateTime $auditDate
     *
     * @ORM\Column(name="auditDate", type="date", nullable=true)
     */
    private $auditDate;

    /**
     * @var string $auditType
     *
     * @ORM\Column(name="auditType", type="integer", nullable=true)
     */
    private $auditType;

    /**
     * @ORM\OneToMany(targetEntity="ClientContact", mappedBy="etude", cascade={"persist", "remove"})
     * @ORM\OrderBy({"date" = "DESC"})
     */
    private $clientContacts;
    
    /**
     * @ORM\OneToMany(targetEntity="Suivi", mappedBy="etude", cascade={"persist", "remove"})
     */
    private $suivis;

    /**
     * @ORM\OneToMany(targetEntity="Candidature", mappedBy="etude")
     */
    private $candidatures;

    /**
     * @ORM\OneToOne(targetEntity="Ap", mappedBy="etude", cascade={"persist", "remove"})
     */
    private $ap;

    /**
     * @ORM\OneToMany(targetEntity="Phase", mappedBy="etude", cascade={"persist", "remove"})
     * @ORM\OrderBy({"position" = "ASC"})
     */
    private $phases;
    
    /**
     * @ORM\OneToMany(targetEntity="GroupePhases", mappedBy="etude", cascade={"persist", "remove"})
     * @ORM\OrderBy({"numero" = "ASC"})
     */
    private $groupes;

    /**
     * @ORM\OneToOne(targetEntity="Cc", mappedBy="etude", cascade={"persist", "remove"})
     */
    private $cc;

    /**
     * @ORM\OneToMany(targetEntity="Mission", mappedBy="etude", cascade={"persist","remove"})
     */
    private $missions;

    /**
     * @ORM\OneToMany(targetEntity="Facture", mappedBy="etude", cascade={"persist", "remove"})
     */
    private $factures;

    /**
     * @ORM\OneToMany(targetEntity="ProcesVerbal", mappedBy="etude", cascade={"persist", "remove"})
     */
    private $procesVerbaux;

    /**
     * @ORM\OneToMany(targetEntity="Av", mappedBy="etude")
     */
    private $avs;

    /**
     * @ORM\OneToMany(targetEntity="AvMission", mappedBy="etude")
     */
    private $avMissions;

    /**
     * @var boolean $acompte
     *
     * @ORM\Column(name="acompte", type="boolean", nullable=true)
     */
    private $acompte;

    /**
     * @var integer $pourcentageAcompte
     *
     * @ORM\Column(name="pourcentageAcompte", type="decimal", scale=2, nullable=true)
     */
    private $pourcentageAcompte;

    /**
     * @var integer $fraisDossier
     *
     * @ORM\Column(name="fraisDossier", type="integer", nullable=true)
     */
    private $fraisDossier;

    /**
     * @var text $presentationProjet
     *
     * @ORM\Column(name="presentationProjet", type="text", nullable=true)
     */
    private $presentationProjet;

    /**
     * @var text $descriptionPrestation
     *
     * @ORM\Column(name="descriptionPrestation", type="text", nullable=true)
     */
    private $descriptionPrestation;

    /**
     * @var text $typePrestation
     *
     * @ORM\Column(name="prestation", type="integer", nullable=true)
     *
     */
    private $typePrestation;

    /**
     * Constructor
     */
    public function __construct() {
        $this->clientContacts = new \Doctrine\Common\Collections\ArrayCollection();
        $this->suivis = new \Doctrine\Common\Collections\ArrayCollection();
        $this->candidatures = new \Doctrine\Common\Collections\ArrayCollection();
        $this->phases = new \Doctrine\Common\Collections\ArrayCollection();
        $this->groupes = new \Doctrine\Common\Collections\ArrayCollection();
        $this->missions = new \Doctrine\Common\Collections\ArrayCollection();
        $this->factures = new \Doctrine\Common\Collections\ArrayCollection();
        $this->procesVerbaux = new \Doctrine\Common\Collections\ArrayCollection();
        $this->avs = new \Doctrine\Common\Collections\ArrayCollection();
        $this->avMissions = new \Doctrine\Common\Collections\ArrayCollection();

        $this->fraisDossier = 90;
        $this->pourcentageAcompte = 0.40;
        $this->stateID = 1;
    }

/// rajout à la main
    public function isKnownProspect() {
        return $this->knownProspect;
    }

    public function setKnownProspect($boolean) {
        $this->knownProspect = $boolean;
    }

    public function getNewProspect() {
        return $this->newProspect;
    }

    public function setNewProspect($var) {
        $this->newProspect = $var;
    }

    public function getDoc($doc, $key = -1) {
        switch (strtoupper($doc)) {
            case 'AP':
                return $this->getAp();
            case 'CC':
                return $this->getCc();
            case 'FA':
                return $this->getFa();
            case 'FI':
                return $this->getFis($key);
            case 'FS':
                return $this->getFs();
            case 'PVR':
                return $this->getPvr();
            case 'PVI':
                return $this->getPvis($key);
            case 'AV':
                return $this->getAvs()->get($key);
            case 'RM':
                if ($key == -1)
                    return NULL;
                else
                    return $this->getMissions()->get($key);
            default:
                return NULL;
        }
    }

/// fin rajout

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set dateCreation
     *
     * @param \DateTime $dateCreation
     * @return Etude
     */
    public function setDateCreation($dateCreation) {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    /**
     * Get dateCreation
     *
     * @return \DateTime 
     */
    public function getDateCreation() {
        return $this->dateCreation;
    }

    /**
     * Set dateModification
     *
     * @param \DateTime $dateModification
     * @return Etude
     */
    public function setDateModification($dateModification) {
        $this->dateModification = $dateModification;

        return $this;
    }

    /**
     * Get dateModification
     *
     * @return \DateTime 
     */
    public function getDateModification() {
        return $this->dateModification;
    }

    /**
     * Set mandat
     *
     * @param integer $mandat
     * @return Etude
     */
    public function setMandat($mandat) {
        $this->mandat = $mandat;

        return $this;
    }

    /**
     * Get mandat
     *
     * @return integer 
     */
    public function getMandat() {
        return $this->mandat;
    }

    /**
     * Set num
     *
     * @param integer $num
     * @return Etude
     */
    public function setNum($num) {
        $this->num = $num;

        return $this;
    }

    /**
     * Get num
     *
     * @return integer 
     */
    public function getNum() {
        return $this->num;
    }

    /**
     * Set dossierCree
     *
     * @param boolean $dossierCree
     * @return Etude
     */
    public function setDossierCree($dossierCree) {
        $this->dossierCree = $dossierCree;

        return $this;
    }

    /**
     * Get dossierCree
     *
     * @return boolean 
     */
    public function getDossierCree() {
        return $this->dossierCree;
    }

    /**
     * Set nom
     *
     * @param string $nom
     * @return Etude
     */
    public function setNom($nom) {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom() {
        return $this->nom;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Etude
     */
    public function setDescription($description) {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * Set competences
     *
     * @param string $competences
     * @return Etude
     */
    public function setCompetences($competences) {
        $this->competences = $competences;

        return $this;
    }

    /**
     * Get competences
     *
     * @return string 
     */
    public function getCompetences() {
        return $this->competences;
    }

    /**
     * Set mailEntretienEnvoye
     *
     * @param boolean $mailEntretienEnvoye
     * @return Etude
     */
    public function setMailEntretienEnvoye($mailEntretienEnvoye) {
        $this->mailEntretienEnvoye = $mailEntretienEnvoye;

        return $this;
    }

    /**
     * Get mailEntretienEnvoye
     *
     * @return boolean 
     */
    public function getMailEntretienEnvoye() {
        return $this->mailEntretienEnvoye;
    }

    /**
     * Set annonceSelectionne
     *
     * @param boolean $annonceSelectionne
     * @return Etude
     */
    public function setAnnonceSelectionne($annonceSelectionne) {
        $this->annonceSelectionne = $annonceSelectionne;

        return $this;
    }

    /**
     * Get annonceSelectionne
     *
     * @return boolean 
     */
    public function getAnnonceSelectionne() {
        return $this->annonceSelectionne;
    }

    /**
     * Set dateDebut
     *
     * @param \DateTime $dateDebut
     * @return Etude
     */
    public function setDateDebut($dateDebut) {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    /**
     * Get dateDebut
     *
     * @return \DateTime 
     */
    public function getDateDebut() {
        return $this->dateDebut;
    }

    /**
     * Set dateFin
     *
     * @param \DateTime $dateFin
     * @return Etude
     */
    public function setDateFin($dateFin) {
        $this->dateFin = $dateFin;

        return $this;
    }

    /**
     * Get dateFin
     *
     * @return \DateTime 
     */
    public function getDateFin() {
        return $this->dateFin;
    }

    /**
     * Set auditDate
     *
     * @param \DateTime $auditDate
     * @return Etude
     */
    public function setAuditDate($auditDate) {
        $this->auditDate = $auditDate;

        return $this;
    }

    /**
     * Get auditDate
     *
     * @return \DateTime 
     */
    public function getAuditDate() {
        return $this->auditDate;
    }

    /**
     * Set auditType
     *
     * @param string $auditType
     * @return Etude
     */
    public function setAuditType($auditType) {
        $this->auditType = $auditType;

        return $this;
    }

    /**
     * Get audit
     *
     * @return string 
     */
    public function getAuditType() {
        return $this->auditType;
    }

    public static function getAuditTypeChoice() {
        return array('1' => 'Déontologique',
            '2' => 'Exhaustif');
    }

    public static function getAuditTypeChoiceAssert() {
        return array_keys(Etude::getAuditTypeChoice());
    }

    public function getAuditTypeToString() {
        $tab = $this->getAuditTypeChoice();
        return $tab[$this->auditType];
    }

    /**
     * Set acompte
     *
     * @param boolean $acompte
     * @return Etude
     */
    public function setAcompte($acompte) {
        $this->acompte = $acompte;

        return $this;
    }

    /**
     * Get acompte
     *
     * @return boolean 
     */
    public function getAcompte() {
        return $this->acompte;
    }

    /**
     * Set pourcentageAcompte
     *
     * @param integer $pourcentageAcompte
     * @return Etude
     */
    public function setPourcentageAcompte($pourcentageAcompte) {
        $this->pourcentageAcompte = $pourcentageAcompte;

        return $this;
    }

    /**
     * Get pourcentageAcompte
     *
     * @return integer 
     */
    public function getPourcentageAcompte() {
        return $this->pourcentageAcompte;
    }

    /**
     * Set fraisDossier
     *
     * @param integer $fraisDossier
     * @return Etude
     */
    public function setFraisDossier($fraisDossier) {
        $this->fraisDossier = $fraisDossier;

        return $this;
    }

    /**
     * Get fraisDossier
     *
     * @return integer 
     */
    public function getFraisDossier() {
        return $this->fraisDossier;
    }

    /**
     * Set presentationProjet
     *
     * @param string $presentationProjet
     * @return Etude
     */
    public function setPresentationProjet($presentationProjet) {
        $this->presentationProjet = $presentationProjet;

        return $this;
    }

    /**
     * Get presentationProjet
     *
     * @return string 
     */
    public function getPresentationProjet() {
        return $this->presentationProjet;
    }

    /**
     * Set descriptionPrestation
     *
     * @param string $descriptionPrestation
     * @return Etude
     */
    public function setDescriptionPrestation($descriptionPrestation) {
        $this->descriptionPrestation = $descriptionPrestation;

        return $this;
    }

    /**
     * Get descriptionPrestation
     *
     * @return string 
     */
    public function getDescriptionPrestation() {
        return $this->descriptionPrestation;
    }

    /**
     * Set typePrestation
     *
     * @param string $typePrestation
     * @return Etude
     */
    public function setTypePrestation($typePrestation) {
        $this->typePrestation = $typePrestation;

        return $this;
    }

    /**
     * Get typePrestation
     *
     * @return string 
     */
    public function getTypePrestation() {
        return $this->typePrestation;
    }

    public static function getTypePrestationChoice() {
        return array('1' => 'ingénieur informatique',
            '2' => 'ingénieur électronique',
            '3' => 'ingénieur informatique et électronique',
            '4' => 'ingénieur microélectronique');
    }

    public static function getTypePrestationChoiceAssert() {
        return array_keys(Etude::getTypePrestationChoice());
    }

    public function getTypePrestationToString() {
        if ($this->typePrestation) {
            $tab = $this->getTypePrestationChoice();
            return $tab[$this->typePrestation];
        }
        else
            return null;
    }

    /**
     * Set prospect
     *
     * @param \mgate\PersonneBundle\Entity\Prospect $prospect
     * @return Etude
     */
    public function setProspect(\mgate\PersonneBundle\Entity\Prospect $prospect) {
        $this->prospect = $prospect;

        return $this;
    }

    /**
     * Get prospect
     *
     * @return \mgate\PersonneBundle\Entity\Prospect 
     */
    public function getProspect() {
        return $this->prospect;
    }

    /**
     * Set suiveur
     *
     * @param \mgate\PersonneBundle\Entity\Personne $suiveur
     * @return Etude
     */
    public function setSuiveur(\mgate\PersonneBundle\Entity\Personne $suiveur = null) {
        $this->suiveur = $suiveur;

        return $this;
    }

    /**
     * Get suiveur
     *
     * @return \mgate\PersonneBundle\Entity\Personne
     */
    public function getSuiveur() {
        return $this->suiveur;
    }

    /**
     * Add clientContacts
     *
     * @param \mgate\SuiviBundle\Entity\ClientContact $clientContacts
     * @return Etude
     */
    public function addClientContact(\mgate\SuiviBundle\Entity\ClientContact $clientContacts) {
        $this->clientContacts[] = $clientContacts;

        return $this;
    }

    /**
     * Remove clientContacts
     *
     * @param \mgate\SuiviBundle\Entity\ClientContact $clientContacts
     */
    public function removeClientContact(\mgate\SuiviBundle\Entity\ClientContact $clientContacts) {
        $this->clientContacts->removeElement($clientContacts);
    }

    /**
     * Get clientContacts
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getClientContacts() {
        return $this->clientContacts;
    }
    
    /**
     * Add suivi
     *
     * @param \mgate\SuiviBundle\Entity\Suivi $suivi
     * @return Etude
     */
    public function addSuivi(\mgate\SuiviBundle\Entity\Suivi $suivi) {
        $this->suivis[] = $suivi;

        return $this;
    }

    /**
     * Remove suivi
     *
     * @param \mgate\SuiviBundle\Entity\Suivi $suivi
     */
    public function removeSuivi(\mgate\SuiviBundle\Entity\Suivi $suivi) {
        $this->suivis->removeElement($suivi);
    }

    /**
     * Get suivis
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSuivis() {
        return $this->suivis;
    }

    /**
     * Add candidatures
     *
     * @param \mgate\SuiviBundle\Entity\Candidature $candidatures
     * @return Etude
     */
    public function addCandidature(\mgate\SuiviBundle\Entity\Candidature $candidatures) {
        $this->candidatures[] = $candidatures;

        return $this;
    }

    /**
     * Remove candidatures
     *
     * @param \mgate\SuiviBundle\Entity\Candidature $candidatures
     */
    public function removeCandidature(\mgate\SuiviBundle\Entity\Candidature $candidatures) {
        $this->candidatures->removeElement($candidatures);
    }

    /**
     * Get candidatures
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCandidatures() {
        return $this->candidatures;
    }

    /**
     * Set ap
     *
     * @param \mgate\SuiviBundle\Entity\Ap $ap
     * @return Etude
     */
    public function setAp(\mgate\SuiviBundle\Entity\Ap $ap = null) {
        if ($ap != null)
            $ap->setEtude($this);

        $this->ap = $ap;

        return $this;
    }

    /**
     * Get ap
     *
     * @return \mgate\SuiviBundle\Entity\Ap 
     */
    public function getAp() {
        return $this->ap;
    }

    /**
     * Add phases
     *
     * @param \mgate\SuiviBundle\Entity\Phase $phases
     * @return Etude
     */
    public function addPhase(\mgate\SuiviBundle\Entity\Phase $phases) {
        $this->phases[] = $phases;

        return $this;
    }

    /**
     * Remove phases
     *
     * @param \mgate\SuiviBundle\Entity\Phase $phases
     */
    public function removePhase(\mgate\SuiviBundle\Entity\Phase $phases) {
        $this->phases->removeElement($phases);
    }

    /**
     * Get phases
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPhases() {
        return $this->phases;
    }
    

    /**
     * Set cc
     *
     * @param \mgate\SuiviBundle\Entity\Cc $cc
     * @return Etude
     */
    public function setCc(\mgate\SuiviBundle\Entity\Cc $cc = null) {
        if ($cc != null)
            $cc->setEtude($this);

        $this->cc = $cc;

        return $this;
    }

    /**
     * Get cc
     *
     * @return \mgate\SuiviBundle\Entity\Cc 
     */
    public function getCc() {
        return $this->cc;
    }

    /**
     * Add mission
     *
     * @param \mgate\SuiviBundle\Entity\Mission $mission
     * @return Etude
     */
    public function addMission(\mgate\SuiviBundle\Entity\Mission $mission) {
        $this->missions[] = $mission;

        return $this;
    }

    /**
     * Remove missions
     *
     * @param \mgate\SuiviBundle\Entity\Mission $missions
     */
    public function removeMission(\mgate\SuiviBundle\Entity\Mission $missions) {
        $this->missions->removeElement($missions);
    }

    /**
     * Get missions
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMissions() {
        return $this->missions;
    }

    /**
     * Add facture
     *
     * @param \mgate\SuiviBundle\Entity\Facture $facture
     * @return Etude
     */
    public function addFacture(\mgate\SuiviBundle\Entity\Facture $facture) {
        $this->factures[] = $facture;

        return $this;
    }

    /**
     * Remove facture
     *
     * @param \mgate\SuiviBundle\Entity\Facture $facture
     */
    public function removeFacture(\mgate\SuiviBundle\Entity\Facture $facture) {
        $this->factures->removeElement($facture);
    }

    /**
     * Get factures
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFactures() {
        return $this->factures;
    }

    
    /**
     * Remove procesVerbal
     *
     * @param \mgate\SuiviBundle\Entity\ProcesVerbal $facture
     */
    public function removeProcesVerbal(\mgate\SuiviBundle\Entity\ProcesVerbal $pv) {
        $this->procesVerbaux->removeElement($pv);
    }

    /**
     * Get factures
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getProcesVerbaux() {
        return $this->procesVerbaux;
    }
    
    /**
     * Add pvis
     *
     * @param \mgate\SuiviBundle\Entity\ProcesVerbal $pvi
     * @return Etude
     */
    public function addPvi(\mgate\SuiviBundle\Entity\ProcesVerbal $pvi) {
        $this->procesVerbaux[] = $pvi;
        $pvi->setEtude($this);
        $pvi->setType('pvi');

        return $this;
    }

    /**
     * Remove pvis
     *
     * @param \mgate\SuiviBundle\Entity\PvProcesVerbali $pvis
     */
    public function removePvi(\mgate\SuiviBundle\Entity\ProcesVerbal $pvis) {
        $this->procesVerbaux->removeElement($pvis);
    }

    /**
     * Get pvis
     *
     * @return mixed(array, ProcesVerbal)
     */
    public function getPvis($key = -1) {
        $pvis = array();

        foreach ($this->procesVerbaux as $value) {
            if ($value->getType() == "pvi") {
                $pvis[] = $value;
            }
        }

        if ($key >= 0) {
            if ($key < count($pvis))
                return $pvis[$key];
            else
                return NULL;
        }
        
        usort($pvis, array($this, 'trieDateSignature'));
        return $pvis;
    }

    
    
    /**
     * Add avs
     *
     * @param \mgate\SuiviBundle\Entity\Av $avs
     * @return Etude
     */
    public function addAv(\mgate\SuiviBundle\Entity\Av $avs) {
        $this->avs[] = $avs;

        return $this;
    }

    /**
     * Remove avs
     *
     * @param \mgate\SuiviBundle\Entity\Av $avs
     */
    public function removeAv(\mgate\SuiviBundle\Entity\Av $avs) {
        $this->avs->removeElement($avs);
    }

    /**
     * Get avs
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAvs() {
        return $this->avs;
    }

    /**
     * Add avMissions
     *
     * @param \mgate\SuiviBundle\Entity\AvMission $avMissions
     * @return Etude
     */
    public function addAvMission(\mgate\SuiviBundle\Entity\AvMission $avMissions) {
        $this->avMissions[] = $avMissions;

        return $this;
    }

    /**
     * Remove avMissions
     *
     * @param \mgate\SuiviBundle\Entity\AvMission $avMissions
     */
    public function removeAvMission(\mgate\SuiviBundle\Entity\AvMission $avMissions) {
        $this->avMissions->removeElement($avMissions);
    }

    /**
     * Get avMissions
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAvMissions() {
        return $this->avMissions;
    }

    /**
     * Set pvr
     *
     * @param \mgate\SuiviBundle\Entity\ProcesVerbal $pvr
     * @return Etude
     */
    public function setPvr(\mgate\SuiviBundle\Entity\ProcesVerbal $pvr) {
        $pvr->setEtude($this);
        $pvr->setType('pvr');

        foreach ($this->procesVerbaux as $pv) {
            if ($pv->getType() == "pvr") {
                $pv = $pvr;
                return $this;
            }
        }
        $this->procesVerbaux[] = $pvr;
        
    }

    /**
     * Get pvr
     *
     * @return \mgate\SuiviBundle\Entity\ProcesVerbal
     */
    public function getPvr() {
        foreach ($this->procesVerbaux as $pv) {
            if ($pv->getType() == "pvr")
                return $pv;
        }
    }

    /**
     * Add fi
     *
     * @param \mgate\SuiviBundle\Entity\Facture $fi
     * @return Etude
     */
    public function addFi(\mgate\SuiviBundle\Entity\Facture $fi) {
        $this->fis[] = $fi;
        $fi->setEtude($this);
        $fi->setType('fi');

        return $this;
    }

    /**
     * Remove fis
     *
     * @param \mgate\SuiviBundle\Entity\Facture $fi
     */
    public function removeFi(\mgate\SuiviBundle\Entity\Facture $fi) {
        $this->fis->removeElement($fi);
    }

    function trieDateSignature($a, $b) {
        if ($a->getDateSignature() == $b->getDateSignature())
            return 0;
        else
            return ($a->getDateSignature() < $b->getDateSignature()) ? -1 : 1;
    }

    /**
     * Get fis
     *
     * @return mixed(array, Facture)
     */
    public function getFis($key = -1) {
        $fis = array();

        foreach ($this->factures as $value) {
            if ($value->getType() == "fi") {
                $fis[] = $value;
            }
        }

        if ($key >= 0) {
            if ($key < count($fis))
                return $fis[$key];
            else
                return NULL;
        }
        
        usort($fis, array($this, 'trieDateSignature'));
        return $fis;
    }

    /**
     * Get fa
     *
     * @return \mgate\SuiviBundle\Entity\Facture
     */
    public function getFa() {
        foreach ($this->factures as $facture) {
            if ($facture->getType() == "fa")
                return $facture;
        }
    }

    /**
     * Set fa
     *
     * @return \mgate\SuiviBundle\Entity\Facture
     */
    public function setFa(\mgate\SuiviBundle\Entity\Facture $fa) {
        $fa->setEtude($this);
        $fa->setType('fa');

        foreach ($this->factures as $facture) {
            if ($facture->getType() == "fa") {
                $facture = $fa;
                return;
            }
        }
        $this->factures[] = $fa;
    }

    /**
     * Get fs
     *
     * @return \mgate\SuiviBundle\Entity\Facture
     */
    public function getFs() {
        foreach ($this->factures as $facture) {
            if ($facture->getType() == "fs")
                return $facture;
        }
    }

    /**
     * Set fs
     *
     * @return \mgate\SuiviBundle\Entity\Facture
     */
    public function setFs(\mgate\SuiviBundle\Entity\Facture $fs) {
        $fs->setEtude($this);
        $fs->setType('fs');

        foreach ($this->factures as $facture) {
            if ($facture->getType() == "fs") {
                $facture = $fs;
                return;
            }
        }
        $this->factures[] = $fs;
    }

    /**
     * Set thread
     *
     * @param \mgate\CommentBundle\Entity\Thread $thread
     * @return Prospect
     */
    public function setThread(\mgate\CommentBundle\Entity\Thread $thread) {
        $this->thread = $thread;

        return $this;
    }

    /**
     * Get thread
     *
     * @return mgate\CommentBundle\Entity\Thread 
     */
    public function getThread() {
        return $this->thread;
    }

    /**
     * Set stateID
     *
     * @param integer $stateID
     * @return Etude
     */
    public function setStateID($stateID) {
        $this->stateID = $stateID;

        return $this;
    }

    /**
     * Get stateID
     *
     * @return integer 
     */
    public function getStateID() {
        return $this->stateID;
    }

    public static function getStateIDChoice() {
        return array('1' => 'En négociation',
            '2' => 'En cours',
            '3' => 'En pause',
            '4' => 'Clorurée',
            '5' => 'Avortée');
    }

    public static function getStateIDChoiceAssert() {
        return array_keys(Etude::getStateIDChoice());
    }

    public function getStateIDToString() {
        $tab = $this->getStateIDChoice();
        return $tab[$this->stateID];
    }

    /**
     * Set stateDescription
     *
     * @param string $stateDescription
     * @return Etude
     */
    public function setStateDescription($stateDescription) {
        $this->stateDescription = $stateDescription;

        return $this;
    }

    /**
     * Get stateDescription
     *
     * @return string 
     */
    public function getStateDescription() {
        return $this->stateDescription;
    }

    /**
     * Set confidentiel
     *
     * @param boolean $confidentiel
     * @return Etude
     */
    public function setConfidentiel($confidentiel) {
        $this->confidentiel = $confidentiel;

        return $this;
    }

    /**
     * Get confidentiel
     *
     * @return boolean 
     */
    public function getConfidentiel() {
        return $this->confidentiel;
    }
    
    
    /**
     * Add groupes
     *
     * @param \mgate\SuiviBundle\Entity\GroupePhases $groupes
     * @return Etude
     */
    public function addGroupe(\mgate\SuiviBundle\Entity\GroupePhases $groupe) {
        $this->groupes[] = $groupe;

        return $this;
    }

    /**
     * Remove groupes
     *
     * @param \mgate\SuiviBundle\Entity\GroupePhases $groupes
     */
    public function removeGroupe(\mgate\SuiviBundle\Entity\GroupePhases $groupe) {
        $this->groupes->removeElement($groupe);
    }

    /**
     * Get groupes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getGroupes() {
        return $this->groupes;
    }

}