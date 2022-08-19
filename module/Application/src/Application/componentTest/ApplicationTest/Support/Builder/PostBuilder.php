<?php
namespace ApplicationTest\Support\Builder;

use Application\Model\Entity\Post;
use Ramsey\Uuid\Uuid;

class PostBuilder
{
    public static function build(Array $data = []): Post
    {
        $default = [
            'id' => Uuid::uuid4()->toString(),
            'title' => 'Title Test',
            'description' => 'Post with build test'
        ];
        $dataFinal = array_merge($default, $data);
        $post = new Post();
        $post->setId($dataFinal['id']);
        $post->setTitle($dataFinal['title']);
        $post->setDescription($dataFinal['description']);

        return $post;
    }
}