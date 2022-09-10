<?php
namespace Application\Model\Service\Factory;

use Application\Model\Service\PostService;
use Doctrine\ORM\EntityManager;
use Zend\Mvc\Controller\ControllerManager;
use Zend\ServiceManager\ServiceManager;

class PostServiceFactory
{

    public function __invoke( ServiceManager $serviceManager )
    {
        $entityManager = $serviceManager->get( EntityManager::class );
        return new PostService($entityManager);
    }

}