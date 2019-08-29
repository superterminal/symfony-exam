<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * TrendingMovie
 *
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TrendingMovieRepository")
 */
class TrendingMovie
{
    /**
     * @var int
     *
     * @Serializer\Type("integer")
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     */
    private $id;

    /**
     * @var string
     *
     * @Serializer\Type("string")
     *
     * @ORM\Column(name="original_title", type="string", length=255)
     */
    private $originalTitle;

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
     * @var string
     *
     * @Serializer\Type("string")
     *
     * @ORM\Column(name="original_language", type="string", length=255)
     */
    private $originalLanguage;

    /**
     * @var array
     *
     * @Serializer\Type("array")
     *
     * @ORM\Column(name="genre_ids", type="array")
     */
    private $genreIds;

    /**
     * @var \DateTime
     *
     * @Serializer\Type("datetime")
     *
     * @ORM\Column(name="release_date", type="date")
     */
    private $releaseDate;

    /**
     * @var float
     *
     * @Serializer\Type("float")
     *
     * @ORM\Column(name="vote_average", type="float")
     */
    private $voteAverage;

    /**
     * @var float
     *
     * @Serializer\Type("float")
     *
     * @ORM\Column(name="vote_count", type="float")
     */
    private $voteCount;

    /**
     * @var float
     *
     * @Serializer\Type("float")
     *
     * @ORM\Column(name="popularity", type="float")
     */
    private $popularity;


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
     * Set originalTitle.
     *
     * @param string $originalTitle
     *
     * @return TrendingMovie
     */
    public function setOriginalTitle($originalTitle)
    {
        $this->originalTitle = $originalTitle;

        return $this;
    }

    /**
     * Get originalTitle.
     *
     * @return string
     */
    public function getOriginalTitle()
    {
        return $this->originalTitle;
    }

    /**
     * Set overview.
     *
     * @param string $overview
     *
     * @return TrendingMovie
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
     * @return TrendingMovie
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
     * Set originalLanguage.
     *
     * @param string $originalLanguage
     *
     * @return TrendingMovie
     */
    public function setOriginalLanguage($originalLanguage)
    {
        $this->originalLanguage = $originalLanguage;

        return $this;
    }

    /**
     * Get originalLanguage.
     *
     * @return string
     */
    public function getOriginalLanguage()
    {
        return $this->originalLanguage;
    }

    /**
     * Set genreIds.
     *
     * @param array $genreIds
     *
     * @return TrendingMovie
     */
    public function setGenreIds($genreIds)
    {
        $this->genreIds = $genreIds;

        return $this;
    }

    /**
     * Get genreIds.
     *
     * @return array
     */
    public function getGenreIds()
    {
        return $this->genreIds;
    }

    /**
     * Set releaseDate.
     *
     * @param \DateTime $releaseDate
     *
     * @return TrendingMovie
     */
    public function setReleaseDate($releaseDate)
    {
        $this->releaseDate = $releaseDate;

        return $this;
    }

    /**
     * Get releaseDate.
     *
     * @return \DateTime
     */
    public function getReleaseDate()
    {
        return $this->releaseDate;
    }

    /**
     * Set voteAverage.
     *
     * @param float $voteAverage
     *
     * @return TrendingMovie
     */
    public function setVoteAverage($voteAverage)
    {
        $this->voteAverage = $voteAverage;

        return $this;
    }

    /**
     * Get voteAverage.
     *
     * @return float
     */
    public function getVoteAverage()
    {
        return $this->voteAverage;
    }

    /**
     * Set voteCount.
     *
     * @param float $voteCount
     *
     * @return TrendingMovie
     */
    public function setVoteCount($voteCount)
    {
        $this->voteCount = $voteCount;

        return $this;
    }

    /**
     * Get voteCount.
     *
     * @return float
     */
    public function getVoteCount()
    {
        return $this->voteCount;
    }

    /**
     * Set popularity.
     *
     * @param float $popularity
     *
     * @return TrendingMovie
     */
    public function setPopularity($popularity)
    {
        $this->popularity = $popularity;

        return $this;
    }

    /**
     * Get popularity.
     *
     * @return float
     */
    public function getPopularity()
    {
        return $this->popularity;
    }
}
