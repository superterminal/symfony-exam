<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Unwatched
 *
 * @ORM\Table(name="unwatched")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UnwatchedRepository")
 */
class Unwatched
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
     * @var int
     *
     * @ORM\Column(name="movie_id", type="integer")
     */
    private $movieId;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="unwatched")
     */
    private $author;


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
     * Set movieId.
     *
     * @param int $movieId
     *
     * @return Unwatched
     */
    public function setMovieId($movieId)
    {
        $this->movieId = $movieId;

        return $this;
    }

    /**
     * Get movieId.
     *
     * @return int
     */
    public function getMovieId()
    {
        return $this->movieId;
    }

    /**
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param User $author
     * @return Unwatched
     */
    public function setAuthor(User $author)
    {
        $this->author = $author;

        return $this;
    }
}
