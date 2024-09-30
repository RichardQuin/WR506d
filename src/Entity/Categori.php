<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\CategoriRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoriRepository::class)]
#[ApiResource]
class Categori
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $createdAT = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $updatedAT = null;

    /**
     * @var Collection<int, Movie>
     */
    #[ORM\ManyToMany(targetEntity: Movie::class, mappedBy: 'categories')]
    private Collection $movies;

    /**
     * @var Collection<int, movie>
     */
    #[ORM\ManyToMany(targetEntity: movie::class, inversedBy: 'categoris')]
    private Collection $movie;

    public function __construct()
    {
        $this->movies = new ArrayCollection();
        $this->movie = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getCreatedAT(): ?\DateTimeImmutable
    {
        return $this->createdAT;
    }

    public function setCreatedAT(?\DateTimeImmutable $createdAT): static
    {
        $this->createdAT = $createdAT;

        return $this;
    }

    public function getUpdatedAT(): ?\DateTimeInterface
    {
        return $this->updatedAT;
    }

    public function setUpdatedAT(\DateTimeInterface $updatedAT): static
    {
        $this->updatedAT = $updatedAT;

        return $this;
    }

    /**
     * @return Collection<int, Movie>
     */
    public function getMovies(): Collection
    {
        return $this->movies;
    }

    public function addMovie(Movie $movie): static
    {
        if (!$this->movies->contains($movie)) {
            $this->movies->add($movie);
            $movie->addCategory($this);
        }

        return $this;
    }

    public function removeMovie(Movie $movie): static
    {
        if ($this->movies->removeElement($movie)) {
            $movie->removeCategory($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, movie>
     */
    public function getMovie(): Collection
    {
        return $this->movie;
    }
}
