<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/** 
 * @ORM\Entity(repositoryClass=BookRepository::class)
*/
class Book{
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue()
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $title;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbPages;

    /**
    * @ORM\Column(type="date")
     */
    private $publishedAt;

    /**
     * @ORM\ManyToOne(targetEntity=Genre::class)
     */
    private $genre;

    /**
     * @ORM\ManyToOne(targetEntity=Author::class, inversedBy="books")
     */
    private $author;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getNbPages(): ?int
    {
        return $this->nbPages;
    }

    public function setNbPages(int $nbPages): self
    {
        $this->nbPages = $nbPages;

        return $this;
    }

    public function getPublishedAt(): ?\DateTimeInterface
    {
        return $this->publishedAt;
    }

    public function setPublishedAt(\DateTimeInterface $publishedAt): self
    {
        $this->publishedAt = $publishedAt;

        return $this;
    }

    public function getAuthor(): ?author
    {
        return $this->author;
    }

    public function getGenre(): ?genre
    {
        return $this->genre;
    }

    public function setGenre(?genre $genre): self
    {
        $this->genre = $genre;

        return $this;
    }

    public function setAuthor(?author $author): self
    {
        $this->author = $author;

        return $this;
    }

}