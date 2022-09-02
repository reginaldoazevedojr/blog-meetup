<?php

namespace ApplicationTest\Model\Repository;

use Application\Model\Entity\Post;
use ApplicationTest\Support\Builder\PostBuilder;
use Doctrine\ORM\EntityManager;
use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;

class PostRepositoryTest extends AbstractHttpControllerTestCase
{
    public function setUp()
    {
        $this->setApplicationConfig(
            include __DIR__ . '/../../../../../../../../config/application.config.php'
        );
        parent::setUp();

        $serviceManager = $this->getApplicationServiceLocator();
        /** @var EntityManager $entityManager */
        $entityManager = $serviceManager->get(EntityManager::class);
        $query = $entityManager->createQuery('DELETE Application\Model\Entity\Post');
        $query->execute();
    }

    public function testShouldInsertInPostTable()
    {
        $serviceManager = $this->getApplicationServiceLocator();
        /** @var EntityManager $entityManager */
        $subject = $serviceManager->get(EntityManager::class);
        $postRepository = $subject->getRepository(Post::class);
        $post = PostBuilder::build();
        $subject->persist($post);
        $subject->flush();

        /** @var Post $postSaved */
        $postSaved = $postRepository->find($post->getId());
        $this->assertEquals($post->getId(), $postSaved->getId());
        $this->assertEquals($post->getTitle(), $postSaved->getTitle());
        $this->assertEquals($post->getDescription(), $postSaved->getDescription());
    }
}