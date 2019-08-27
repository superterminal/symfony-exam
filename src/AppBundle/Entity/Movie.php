<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;


/**
 * Movie
 *
 * @ORM\Table(name="movie")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MovieRepository")
 */
class Movie
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
     * @ORM\Column(name="original_language", type="string", length=255)
     */
    private $originalLanguage;

    /**
     * @var string
     *
     * @Serializer\Type("string")
     *
     * @ORM\Column(name="status", type="string", length=255)
     */
    private $status;

    /**
     * @var string
     *
     * @Serializer\Type("string")
     *
     * @ORM\Column(name="tagline", type="string", length=255)
     */
    private $tagline;

    /**
     * @var float
     *
     * @Serializer\Type("float")
     *
     * @ORM\Column(name="revenue", type="float")
     */
    private $revenue;

    /**
     * @var string
     *
     * @Serializer\Type("string")
     *
     * @ORM\Column(name="runtime", type="string", length=255)
     */
    private $runtime;

    /**
     * @var string
     *
     * @Serializer\Type("string")
     *
     * @ORM\Column(name="release_date", type="string")
     */
    private $releaseDate;

    /**
     * @var array
     *
     * @Serializer\Type("array")
     *
     * @ORM\Column(name="spoken_languages", type="array")
     */
    private $spokenLanguages;

    /**
     * @var array
     *
     * @Serializer\Type("array")
     *
     * @ORM\Column(name="production_countries", type="array")
     */
    private $productionCountries;

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
     * @ORM\Column(name="imdb_id", type="string")
     */
    private $imdbId;

    /**
     * @var string
     *
     * @Serializer\Type("string")
     *
     * @ORM\Column(name="backdrop_path", type="string", length=255)
     */
    private $backdropPath;

    /**
     * @var array
     *
     * @Serializer\Type("array")
     *
     * @ORM\Column(name="genres", type="array")
     */
    private $genres;

    /**
     * @var int
     *
     * @Serializer\Type("int")
     *
     * @ORM\Column(name="vote_count", type="integer")
     */
    private $voteCount;

    /**
     * @var float
     *
     * @Serializer\Type("float")
     *
     * @ORM\Column(name="vote_average", type="float")
     */
    private $voteAverage;

    /**
     * @var string
     *
     * @Serializer\Type("string")
     *
     * @ORM\Column(name="homepage", type="string")
     */
    private $homepage;

    /**
     * @var float
     *
     * @Serializer\Type("float")
     *
     * @ORM\Column(name="budget", type="float")
     */
    private $budget;

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
     * @return Movie
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
     * @return Movie
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
     * Set originalLanguage.
     *
     * @param string $originalLanguage
     *
     * @return Movie
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
     * Set status.
     *
     * @param string $status
     *
     * @return Movie
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status.
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set tagline.
     *
     * @param string $tagline
     *
     * @return Movie
     */
    public function setTagline($tagline)
    {
        $this->tagline = $tagline;

        return $this;
    }

    /**
     * Get tagline.
     *
     * @return string
     */
    public function getTagline()
    {
        return $this->tagline;
    }

    /**
     * Set revenue.
     *
     * @param float $revenue
     *
     * @return Movie
     */
    public function setRevenue($revenue)
    {
        $this->revenue = $revenue;

        return $this;
    }

    /**
     * Get revenue.
     *
     * @return float
     */
    public function getRevenue()
    {
        return number_format($this->revenue, 0, '.', ',');
    }

    /**
     * Set runtime.
     *
     * @param string $runtime
     *
     * @return Movie
     */
    public function setRuntime($runtime)
    {
        $this->runtime = $runtime;

        return $this;
    }

    /**
     * Get runtime.
     *
     * @return string
     */
    public function getRuntime()
    {
        return $this->runtime;
    }

    /**
     * Set releaseDate.
     *
     * @param \DateTime $releaseDate
     *
     * @return Movie
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
     * Set spokenLanguages.
     *
     * @param array $spokenLanguages
     *
     * @return Movie
     */
    public function setSpokenLanguages($spokenLanguages)
    {
        $this->spokenLanguages = $spokenLanguages;

        return $this;
    }

    /**
     * Get spokenLanguages.
     *
     * @return array
     */
    public function getSpokenLanguages()
    {
        $langs = [];
        foreach ($this->spokenLanguages as $spokenLanguage) {
            $langs[] = $spokenLanguage['name'];
        }
        return implode(', ', $langs);
    }

    /**
     * Set productionCountries.
     *
     * @param array $productionCountries
     *
     * @return Movie
     */
    public function setProductionCountries($productionCountries)
    {
        $this->productionCountries = $productionCountries;

        return $this;
    }

    /**
     * Get productionCountries.
     *
     * @return array
     */
    public function getProductionCountries()
    {
        return $this->productionCountries;
    }

    /**
     * Set posterPath.
     *
     * @param string $posterPath
     *
     * @return Movie
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
     * Set imdbId.
     *
     * @param string $imdbId
     *
     * @return Movie
     */
    public function setImdbId($imdbId)
    {
        $this->imdbId = $imdbId;

        return $this;
    }

    /**
     * Get imdbId.
     *
     * @return string
     */
    public function getImdbId()
    {
        return $this->imdbId;
    }

    /**
     * Set backdropPath.
     *
     * @param string $backdropPath
     *
     * @return Movie
     */
    public function setBackdropPath($backdropPath)
    {
        $this->backdropPath = $backdropPath;

        return $this;
    }

    /**
     * Get backdropPath.
     *
     * @return string
     */
    public function getBackdropPath()
    {
        return $this->backdropPath;
    }

    /**
     * Set genres.
     *
     * @param array $genres
     *
     * @return Movie
     */
    public function setGenres($genres)
    {
        $this->genres = $genres;

        return $this;
    }

    /**
     * Get genres.
     *
     * @return string
     */
    public function getGenres()
    {
        $genres = [];
        foreach ($this->genres as $genre) {
            $genres[] =  $genre['name'];
        }

        return implode(", ", $genres);
    }

    /**
     * Set voteCount.
     *
     * @param int $voteCount
     *
     * @return Movie
     */
    public function setVoteCount($voteCount)
    {
        $this->voteCount = $voteCount;

        return $this;
    }

    /**
     * Get voteCount.
     *
     * @return int
     */
    public function getVoteCount()
    {
        return $this->voteCount;
    }

    /**
     * Set voteAverage.
     *
     * @param float $voteAverage
     *
     * @return Movie
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
     * @return string
     */
    public function getHomepage(): ?string
    {
        return $this->homepage;
    }

    /**
     * @param string $homepage
     */
    public function setHomepage(string $homepage): void
    {
        $this->homepage = $homepage;
    }

    /**
     * @return float|int
     */
    public function getBudget()
    {
        return number_format($this->budget, 0, '.', ',');
    }

    /**
     * @param float $budget
     */
    public function setBudget(float $budget): void
    {
        $this->budget = $budget;
    }


}
