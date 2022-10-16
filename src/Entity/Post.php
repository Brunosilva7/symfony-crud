<?php

namespace App\Entity;

use App\Repository\PostRepository;
// use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

//main entity

#[ORM\Entity(repositoryClass: PostRepository::class)]
class Post
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    // #[Assert\NotBlank]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle(string $title)
    {
        $this->title = $title;

        return $this;
    }
}
