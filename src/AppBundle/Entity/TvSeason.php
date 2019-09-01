<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * TvSeason
 *
 * @ORM\Table(name="tv_season")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TvEpisodeRepository")
 */
class TvSeason
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
     * @var int
     *
     * @Serializer\Type("int")
     *
     * @ORM\Column(name="episode_count", type="integer")
     */
    private $episodeCount;

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
     * @ORM\Column(name="overview", type="text")
     */
    private $overview;

    /**
     * @var string
     *
     * @Serializer\Type("string")
     *
     * @ORM\Column(name="poster_path", type="string", length=255)
     */
    private $posterPath;

    /**
     * @var integer
     *
     * @Serializer\Type("int")
     *
     * @ORM\Column(name="season_number", type="integer")
     */
    private $season_number;


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
     * @return TvSeason
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
     * Set episodeCount.
     *
     * @param int $episodeCount
     *
     * @return TvSeason
     */
    public function setEpisodeCount($episodeCount)
    {
        $this->episodeCount = $episodeCount;

        return $this;
    }

    /**
     * Get episodeCount.
     *
     * @return int
     */
    public function getEpisodeCount()
    {
        return $this->episodeCount;
    }

    /**
     * Set name.
     *
     * @param string $name
     *
     * @return TvSeason
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
     * @return TvSeason
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
     * Set posterPath.
     *
     * @param string $posterPath
     *
     * @return TvSeason
     */
    public function setPosterPath($posterPath)
    {
        $this->posterPath = $posterPath;

        return $this;
    }

    /**
     * Get posterPath.
     *
     * @return string
     */
    public function getPosterPath()
    {
        return $this->posterPath;
    }

    /**
     * @return int
     */
    public function getSeasonNumber()
    {
        return $this->season_number;
    }

    /**
     * @param int $season_number
     */
    public function setSeasonNumber(int $season_number): void
    {
        $this->season_number = $season_number;
    }
}
