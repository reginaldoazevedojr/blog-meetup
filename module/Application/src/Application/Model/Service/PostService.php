<?php

namespace Application\Model\Service;

use Application\Model\Entity\Post;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\Entity;

class PostService
{
    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function save(Post $post)
    {
        $this->entityManager->persist($post);
        $this->entityManager->flush();
    }

    public function findAll(): array
    {
        $postRepository = $this->entityManager->getRepository(Post::class);
        return $postRepository->findAll();
    }

    public function find($id): ?Post
    {
        $postRepository = $this->entityManager->getRepository(Post::class);
        try {
            /** @var Post $post */
            $post = $postRepository->findOneBy(['id' => $id]);
            return $post;
        } catch (\Exception $error) {
            return null;
        }
    }

}