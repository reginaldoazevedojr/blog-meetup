<?php

namespace Application\Controller\DTO;

use Application\Exception\BusinessException;
use Application\Model\Entity\Post;
use Zend\InputFilter\InputFilter;

 class PostDTO extends InputFilter
 {
    private $titleFilter = [
        'name' => 'title',
        'filters' => [
            ['name' => 'StripTags'],
            ['name' => 'StringTrim'],
        ],
        'validators' => [
            ['name' => 'NotEmpty'],
        ]
    ];

    private $descriptionFilter = [
        'name' => 'description',
        'filters' => [
            ['name' => 'StripTags'],
            ['name' => 'StringTrim'],
        ],
        'validators' => [
            ['name' => 'NotEmpty'],
        ]
    ];

     /**
      * @throws BusinessException
      */
     public function __construct(array $params )
    {
        $this->add($this->titleFilter);
        $this->add($this->descriptionFilter);
        $this->setData($params);
        if (!$this->isValid()) {
            throw new BusinessException("Invalid Params");
        }
    }

    public function toEntity()
    {
        $post = new Post();
        $post->setTitle($this->getValue('title'));
        $post->setDescription($this->getValue('description'));
        return $post;
    }

 }
 