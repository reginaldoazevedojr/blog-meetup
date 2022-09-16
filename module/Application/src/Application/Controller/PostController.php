<?php

namespace Application\Controller;

use Application\Controller\DTO\PostDTO;
use Application\Exception\BusinessException;
use Application\Model\Service\PostService;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\JsonModel;

class PostController extends AbstractActionController
{
    private $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function createAction()
    {
        $statusCodeCreated = 201;
        $params = $this->getRequest()->getPost()->toArray();
        try {
            $post = (new PostDTO($params))->toEntity();
        } catch (\Exception $error) {
            $this->getResponse()->setStatusCode(400);
            return new JsonModel([
                'message' => $error->getMessage()
            ]);
        }

        $this->postService->save($post);

        $this->getResponse()->setStatusCode($statusCodeCreated);

        return new JsonModel($post->toArray());
    }

    public function findAllAction()
    {
        $statusCodeOk = 200;
        $this->getResponse()->setStatusCode($statusCodeOk);
        $posts = $this->postService->findAll();
        $data = [];
        foreach ($posts as $post) {
            $data[] = $post->toArray();
        }
        return new JsonModel($data);
    }

    public function findAction()
    {
        $statusCodeOk = 200;
        $statusNotFound = 404;
        $id = $this->params()->fromRoute('id');
        try {
            $post = $this->postService->find($id);
        } catch (BusinessException $error) {
            $this->getResponse()->setStatusCode($statusNotFound);
            return new JsonModel(['message' => $error->getMessage()]);
        }
        $this->getResponse()->setStatusCode($statusCodeOk);
        return new JsonModel($post->toArray());
    }

    public function deleteAction()
    {
        $statusCodeOk = 200;
        $statusNotFound = 400;
        $id = $this->params()->fromRoute('id');
        try {
            $this->postService->delete($id);
        } catch (BusinessException $error) {
            $this->getResponse()->setStatusCode($statusNotFound);
            return new JsonModel(['message' => $error->getMessage()]);
        }
        $this->getResponse()->setStatusCode($statusCodeOk);
        return new JsonModel();
    }
}