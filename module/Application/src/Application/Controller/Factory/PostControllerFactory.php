<?php

namespace Application\Controller\Factory;

use Application\Controller\PostController;
use Application\Model\Service\PostService;
use Zend\Mvc\Controller\ControllerManager;

class PostControllerFactory
{

    public function __invoke( ControllerManager $container )
    {
        $serviceLocator = $container->getServiceLocator();
        $postService = $serviceLocator->get( PostService::class );
        return new PostController($postService);
    }
    
}