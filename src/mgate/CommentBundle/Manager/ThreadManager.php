<?php

namespace mgate\CommentBundle\Manager;

use FOS\CommentBundle\Entity\ThreadManager as FOSthread;
use Doctrine\ORM\EntityManager;
use mgate\CommentBundle\Entity\Thread as mgateThread;


class ThreadManager
{
    protected $tm;
    protected $em;
    
    public function __construct( FOSthread $threadManager, EntityManager $entitymanager)
    {
        $this->tm = $threadManager;
        $this->em = $entitymanager;
    }
    
    public function ajouterAction($name, $permaLink, $entity)
    {
        //get('fos_comment.manager.thread')
        //$thread = new mgateThread;
        
        $thread = $this->tm->createThread($name.$entity->getId());
        $thread->setId($name.$entity->getId());
        $thread->setPermalink( $permaLink );
        $entity->setThread($thread);
        //$this->em->persist($thread); 
    }
}
