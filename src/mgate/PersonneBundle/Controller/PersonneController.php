<?php

namespace mgate\PersonneBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use JMS\SecurityExtraBundle\Annotation\Secure;
use mgate\PersonneBundle\Entity\Membre;
use mgate\PersonneBundle\Entity\Personne;
use mgate\PersonneBundle\Entity\Mandat;
use mgate\PersonneBundle\Form\MembreType;

class PersonneController extends Controller {
    /**
     * @Secure(roles="ROLE_SUIVEUR")
     */
    public function annuaireAction() {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('mgatePersonneBundle:Personne')->findAll();
        
        return $this->render('mgatePersonneBundle:Personne:annuaire.html.twig', array(
                    'personnes' => $entities,
                ));
    }
    
   /**
     * @Secure(roles="ROLE_SUIVEUR")
     */
    public function listeMailAction(){
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('mgatePersonneBundle:Personne')->findAll();
        
        $membres = $em->getRepository('mgatePersonneBundle:Membre')->getCotisants();
        
        $cotisants = array();
        $cotisantsEtu = array();
        foreach ($membres as $cotisant){
            $nom = $cotisant->getPersonne()->getNom() . ' ' . $cotisant->getPersonne()->getPrenom();
            
            $mailEtu = $cotisant->getEmailEMSE();
            $mail = $cotisant->getPersonne()->getEmail();
            if($mail != null) $cotisants[$nom] = $mail;
            if($mailEtu != null) $cotisantsEtu[$nom] = $mailEtu;
        }
        ksort($cotisants);
        ksort($cotisantsEtu);
        
        $nbrCotisants = count($cotisants);
        $nbrCotisantsEtu = count($cotisantsEtu);

        $listCotisants = "";
        $listCotisantsEtu = "";
        foreach ($cotisants as $nom => $mail)
            $listCotisants .= "$nom <$mail>; ";
        foreach ($cotisantsEtu as $nom => $mail)
            $listCotisantsEtu .= "$nom <$mail>; ";
        
        
        
        return $this->render('mgatePersonneBundle:Personne:listeDiffusion.html.twig', array(
                'personnes' => $entities,
                'cotisants' => $listCotisants,
                'cotisantsEtu' => $listCotisantsEtu,
                'nbrCotisants' => $nbrCotisants,
                'nbrCotisantsEtu' => $nbrCotisantsEtu,
                    
                ));
    }

    /**
     * @Secure(roles="ROLE_ADMIN")
     */    
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
   
           if( ! $entity = $em->getRepository('mgate\PersonneBundle\Entity\Personne')->find($id) )
                throw $this->createNotFoundException('Prospect[id='.$id.'] inexistant');
            
            $em->remove($entity);
            $em->flush();
        
        return $this->redirect($this->generateUrl('mgatePersonne_annuaire'));
    }
    
    
    
}