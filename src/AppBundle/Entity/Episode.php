<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * Episode
 *
 * @ORM\Table(name="episode")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EpisodeRepository")
 */
class Episode
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
     * @ORM\Column(name="air_date", type="string", length=255)
     */
    private $airDate;

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
     * * @Serializer\Type("string")
     *
     * @ORM\Column(name="overview", type="text")
     */
    private $overview;

    /**
     * @var string
     *
     * @Serializer\Type("string")
     *
     * @ORM\Column(name="still_path", type="string", length=255)
     */
    private $stillPath;

    /**
     * @var int
     *
     * @Serializer\Type("int")
     *
     * @ORM\Column(name="episode_number", type="integer")
     */
    private $episode_number;


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
     * Set airDate.
     *
     * @param string $airDate
     *
     * @return Episode
     */
    public function setAirDate($airDate)
    {
        $this->airDate = $airDate;

        return $this;
    }

    /**
     * Get airDate.
     *
     * @return string
     */
    public function getAirDate()
    {
        return $this->airDate;
    }

    /**
     * Set name.
     *
     * @param string $name
     *
     * @return Episode
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
     * Set overview.
     *
     * @param string $overview
     *
     * @return Episode
     */
    public function setOverview($overview)
    {
        $this->overview = $overview;

        return $this;
    }

    /**
     * Get overview.
     *
     * @return string
     */
    public function getOverview()
    {
        return $this->overview;
    }

    /**
     * Set stillPath.
     *
     * @param string $stillPath
     *
     * @return Episode
     */
    public function setStillPath($stillPath)
    {
        $this->stillPath = $stillPath;

        return $this;
    }

    /**
     * Get stillPath.
     *
     * @return string
     */
    public function getStillPath()
    {
        return $this->stillPath;
    }

    /**
     * @return int
     */
    public function getEpisodeNumber(): int
    {
        return $this->episode_number;
    }

    /**
     * @param int $episode_number
     */
    public function setEpisodeNumber(int $episode_number): void
    {
        $this->episode_number = $episode_number;
    }
}
