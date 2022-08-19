<?php
namespace Application\Entity;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

/**
 * @Entity
 */
class Post
{
    /**
     * @var Uuid
     * @ORM\Id
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string", length=100)
     */
    private $title;

    /**
     * @var string
     * @ORM\Column(type="string", length=5000)
     */
    private $description;

    public function __construct()
    {
        $this->id = Uuid::uuid4();
    }

    /**
     * @return Uuid|UuidInterface
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param Uuid|UuidInterface $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }
}