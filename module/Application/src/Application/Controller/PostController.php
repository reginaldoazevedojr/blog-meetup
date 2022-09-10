<?php

namespace Application\Controller;

use Application\Controller\DTO\PostDTO;
use Application\Model\Service\PostService;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\JsonModel;

class PostController extends AbstractActionController
{

    private  $postService;

    public function __construct( PostService $postService )
    {
        $this->postService = $postService;
    }

    public function createAction()
    {
        $params =$this->getRequest()->getPost()->toArray();
        
        $post = (new PostDTO( $params ))->toEntity();
        
        $this->postService->save($post);

        $this->getResponse()->setStatusCode(201);

        return new JsonModel( $post->toArray() );
    }
}