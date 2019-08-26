<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Browse
 *
 * @ORM\Table(name="browse")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\BrowseRepository")
 */
class Browse
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="order_by", type="string", length=255)
     */
    private $orderBy;

    /**
     * @var string
     *
     * @ORM\Column(name="genre", type="string", length=255)
     */
    private $genre;

    /**
     * @var string
     *
     * @ORM\Column(name="release_year", type="string", length=255)
     */
    private $releaseYear;


    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * @return string
     */
    public function getOrderBy(): ?string
    {
        return $this->orderBy;
    }

    /**
     * @param string $orderBy
     */
    public function setOrderBy(string $orderBy): void
    {
        $this->orderBy = $orderBy;
    }

    /**
     * @return string
     */
    public function getGenre(): ?string
    {
        return $this->genre;
    }

    /**
     * @param string $genre
     */
    public function setGenre(string $genre): void
    {
        $this->genre = $genre;
    }

    /**
     * @return string
     */
    public function getReleaseYear(): ?string
    {
        return $this->releaseYear;
    }

    /**
     * @param string $releaseYear
     */
    public function setReleaseYear(string $releaseYear): void
    {
        $this->releaseYear = $releaseYear;
    }
}
