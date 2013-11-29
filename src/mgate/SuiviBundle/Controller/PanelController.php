<?php

namespace mgate\SuiviBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use JMS\SecurityExtraBundle\Annotation\Secure;

use mgate\SuiviBundle\Entity\Etude;
use mgate\SuiviBundle\Form\EtudeType;
use mgate\SuiviBundle\Entity\Ap;
use mgate\SuiviBundle\Form\ApType;
use mgate\SuiviBundle\Entity\Cc;
use mgate\SuiviBundle\Form\CcType;
use mgate\SuiviBundle\Entity\Mission;
use mgate\SuiviBundle\Form\MissionType;
use mgate\SuiviBundle\Entity\Suivi;
use mgate\SuiviBundle\Form\SuiviEtudeType;
use mgate\SuiviBundle\Form\SuiviHandler;
use mgate\SuiviBundle\Entity\ClientContact;
use mgate\SuiviBundle\Form\ClientContactType;
use mgate\SuiviBundle\Entity\Av;
use mgate\SuiviBundle\Form\AvHandler;
use mgate\SuiviBundle\Form\AvType;
use mgate\SuiviBundle\Entity\AvMission;
use mgate\SuiviBundle\Form\AvMissionHandler;
use mgate\SuiviBundle\Form\AvMissionType;
use mgate\SuiviBundle\Entity\Facture;
use mgate\SuiviBundle\Form\FactureType;


use Ob\HighchartsBundle\Highcharts\Highchart;

class PanelController extends Controller
{
        
    /**
     * @Secure(roles="ROLE_SUIVEUR")
     */
    public function indexAction($page)
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('mgateSuiviBundle:Etude')->findAll();

        return $this->render('mgateSuiviBundle:Panel:index.html.twig', array(
            'etudes' => $entities,
        ));
         
    }
        
    /**
     * @Secure(roles="ROLE_SUIVEUR")
     */
    public function testAction()
    {
        // Chart
        $series = array(
            array("name" => "Data Serie Name",    "data" => array(1,2,4,5,6,3,8))
        );

        $ob = new Highchart();
        $ob->chart->renderTo('linechart');  // The #id of the div where to render the chart
        $ob->title->text('Chart Title');
        $ob->xAxis->title(array('text'  => "Horizontal axis title"));
        $ob->yAxis->title(array('text'  => "Vertical axis title"));
        $ob->series($series);

        return $this->render('mgateSuiviBundle:Panel:test.html.twig', array(
            'chart' => $ob
        ));
    }
 
}
