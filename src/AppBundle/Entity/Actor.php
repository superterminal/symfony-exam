<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * Actor
 *
 * @ORM\Table(name="actor")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ActorRepository")
 */
class Actor
{
    /**
     * @var int
     *
     * @Serializer\Type("int")
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @Serializer\Type("string")
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @Serializer\Type("string")
     *
     * @ORM\Column(name="birthday", type="string")
     */
    private $birthday;

    /**
     * @var string
     *
     * @Serializer\Type("string")
     *
     * @ORM\Column(name="place_of_birth", type="string", length=255)
     */
    private $placeOfBirth;

    /**
     * @var string
     *
     * @Serializer\Type("string")
     *
     * @ORM\Column(name="biography", type="text")
     */
    private $biography;

    /**
     * @var string
     *
     * @Serializer\Type("string")
     *
     * @ORM\Column(name="imdb_id", type="string")
     */
    private $imdbId;

    /**
     * @var string
     *
     * @Serializer\Type("string")
     *
     * @ORM\Column(name="profile_path", type="string", length=255)
     */
    private $profilePath;


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
     * Set name.
     *
     * @param string $name
     *
     * @return Actor
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set birthday.
     *
     * @param \DateTime $birthday
     *
     * @return Actor
     */
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;

        return $this;
    }

    /**
     * Get birthday.
     *
     * @return string
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * Set placeOfBirth.
     *
     * @param string $placeOfBirth
     *
     * @return Actor
     */
    public function setPlaceOfBirth($placeOfBirth)
    {
        $this->placeOfBirth = $placeOfBirth;

        return $this;
    }

    /**
     * Get placeOfBirth.
     *
     * @return string
     */
    public function getPlaceOfBirth()
    {
        return $this->placeOfBirth;
    }

    /**
     * Set biography.
     *
     * @param string $biography
     *
     * @return Actor
     */
    public function setBiography($biography)
    {
        $this->biography = $biography;

        return $this;
    }

    /**
     * Get biography.
     *
     * @return string
     */
    public function getBiography()
    {
        return $this->biography;
    }

    /**
     * @return string|null
     */
    public function getImdbId()
    {
        return $this->imdbId;
    }

    /**
     * @param string $imdbId
     */
    public function setImdbId(string $imdbId): void
    {
        $this->imdbId = $imdbId;
    }

    /**
     * Set profilePath.
     *
     * @param string $profilePath
     *
     * @return Actor
     */
    public function setProfilePath($profilePath)
    {
        $this->profilePath = $profilePath;

        return $this;
    }

    /**
     * Get profilePath.
     *
     * @return string
     */
    public function getProfilePath()
    {
        return $this->profilePath;
    }
}
