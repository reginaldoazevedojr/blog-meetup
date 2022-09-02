<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;

class PostController extends AbstractActionController
{
    public function createAction() {
        $title = $this->getRequest()->getPost('title', null);
        $description = $this->getRequest()->getPost('description', null);
    }
}