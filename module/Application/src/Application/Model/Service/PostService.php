<?php
namespace Application\Model\Service;

use Application\Model\Entity\Post;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\Entity;

class PostService 
{
    private $entityManager; 

    public function __construct( EntityManager $entityManager )
    {
        $this->entityManager = $entityManager;
    }

    public function save( Post $post ){
        $this->entityManager->persist($post);
        $this->entityManager->flush();
    }

}