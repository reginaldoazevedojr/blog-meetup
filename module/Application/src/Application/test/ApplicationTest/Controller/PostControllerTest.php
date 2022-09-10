<?php

namespace Application\Controller;

use Application\Exception\BusinessException;
use ApplicationTest\Support\Builder\PostBuilder;
use Zend\Mvc\Application;
use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;

class PostControllerTest extends AbstractHttpControllerTestCase
{
    public function setUp()
    {
        $this->setApplicationConfig(
            include __DIR__ . '/../../../../../../../config/application.config.php'
        );
        parent::setUp();
    }

    public function testReturnCreatedInPost()
    {
        $post = PostBuilder::build();
        $data = [
            'title' => $post->getTitle(),
            'description' => $post->getDescription()
        ];
        $this->dispatch('/post', "POST", $data);

        $this->assertResponseStatusCode(201);
        $this->assertModuleName('application');
        $this->assertControllerName('application\controller\postcontroller');
        $this->assertControllerClass('postcontroller');
        $this->assertMatchedRouteName('post');
    }

    public function testReturnStatusCode500WhenInvalidParam()
    {
        $statusCodeBadRequest = 400;
        $post = PostBuilder::build();
        $data = [
            'title' => $post->getTitle()
        ];
        $this->dispatch('/post', "POST", $data);
        $this->assertResponseStatusCode($statusCodeBadRequest);
        $data = json_decode($this->getResponse()->getContent(), true);
        $this->assertTrue(isset($data['message']));
    }
}
