<?php

namespace ApplicationTest\Controller\DTO;

use Application\Controller\DTO\PostDTO;
use Application\Exception\BusinessException;
use PHPUnit_Framework_TestCase;

class PostRepositoryTest extends PHPUnit_Framework_TestCase
{
    public function testReturnValidPostDTO( )
    {
        $title = 'LORIENENEN'; 
        $description = 'Testes';

        $subject = new PostDTO(['title' => $title, 'description' => $description]);

        $this->assertEquals( $title, $subject->getValue('title') );
        $this->assertEquals( $description, $subject->getValue('description') );
    }

    public function testReturnEntityCorrectly( )
    {
        $title = 'LORIENENEN'; 
        $description = 'Testes';

        $subject = new PostDTO(['title' => $title, 'description' => $description]);
        $entity = $subject->toEntity();

        $this->assertEquals( $title, $entity->getTitle() );
        $this->assertEquals( $description, $entity->getDescription() );
    }

    public function testReturnInvalidPostDTO( )
    {        
        $title = ''; 
        $description = 'Testes';
        
        $this->setExpectedException( BusinessException::class );

        $subject = new PostDTO(['title' => $title, 'description' => $description]);   
    }
}