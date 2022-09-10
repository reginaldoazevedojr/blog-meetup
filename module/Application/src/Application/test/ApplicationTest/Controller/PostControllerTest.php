<?php

namespace Application\Controller;

use ApplicationTest\Support\Builder\PostBuilder;
use Doctrine\ORM\EntityManager;
use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;

class PostControllerTest extends AbstractHttpControllerTestCase
{
    public function setUp()
    {
        $this->setApplicationConfig(
            include __DIR__ . '/../../../../../../../config/application.config.php'
        );
        parent::setUp();

        $serviceManager = $this->getApplicationServiceLocator();
        /** @var EntityManager $entityManager */
        $entityManager = $serviceManager->get(EntityManager::class);
        $query = $entityManager->createQuery('DELETE Application\Model\Entity\Post');
        $query->execute();
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

    public function testReturnAllPost()
    {
        $statusCodeOk = 200;
        $post = PostBuilder::build();
        $postSecond = PostBuilder::build();
        $serviceManager = $this->getApplicationServiceLocator();
        /** @var EntityManager $entityManager */
        $entityManager = $serviceManager->get(EntityManager::class);
        $entityManager->persist($post);
        $entityManager->persist($postSecond);
        $entityManager->flush();

        $this->dispatch('/post/find-all', "GET");
        $data = json_decode($this->getResponse()->getContent(), true);
        $this->assertResponseStatusCode($statusCodeOk);
        $this->assertModuleName('application');
        $this->assertControllerName('application\controller\postcontroller');
        $this->assertControllerClass('postcontroller');
        $this->assertMatchedRouteName('post-find-all');
        $this->assertCount(2, $data);
    }
}
