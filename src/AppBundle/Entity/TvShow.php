<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * TvShow
 *
 * @ORM\Table(name="tv_show")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TvShowRepository")
 */
class TvShow
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
     * @ORM\Column(name="name", type="string")
     */
    private $name;

    /**
     * @var array
     *
     * @Serializer\Type("array")
     *
     * @ORM\Column(name="created_by", type="array")
     */
    private $createdBy;

    /**
     * @var array
     *
     * @Serializer\Type("array")
     *
     * @ORM\Column(name="episode_run_time", type="array")
     */
    private $episodeRunTime;

    /**
     * @var string
     *
     * @Serializer\Type("string")
     *
     * @ORM\Column(name="first_air_date", type="string", length=255)
     */
    private $firstAirDate;

    /**
     * @var array
     *
     * @Serializer\Type("array")
     *
     * @ORM\Column(name="genres", type="array")
     */
    private $genres;

    /**
     * @var string
     *
     * @Serializer\Type("string")
     *
     * @ORM\Column(name="homepage", type="string", length=255)
     */
    private $homepage;

    /**
     * @var bool
     *
     * @Serializer\Type("bool")
     *
     * @ORM\Column(name="in_production", type="boolean")
     */
    private $inProduction;

    /**
     * @var array
     *
     * @Serializer\Type("array")
     *
     * @ORM\Column(name="languages", type="array")
     */
    private $languages;

    /**
     * @var int
     *
     * @Serializer\Type("int")
     *
     * @ORM\Column(name="number_of_episodes", type="integer")
     */
    private $numberOfEpisodes;

    /**
     * @var int
     *
     * @Serializer\Type("int")
     *
     * @ORM\Column(name="number_of_seasons", type="integer")
     */
    private $numberOfSeasons;

    /**
     * @var array
     *
     * @Serializer\Type("array")
     *
     * @ORM\Column(name="origin_country", type="array")
     */
    private $originCountry;

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
     * @var array
     *
     * @Serializer\Type("array")
     *
     * @ORM\Column(name="production_companies", type="array")
     */
    private $productionCompanies;

    /**
     * @var array
     *
     * @Serializer\Type("array")
     *
     * @ORM\Column(name="seasons", type="array")
     */
    private $seasons;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

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
     * Set createdBy.
     *
     * @param array $createdBy
     *
     * @return TvShow
     */
    public function setCreatedBy($createdBy)
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    /**
     * Get createdBy.
     *
     * @return array
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * Set episodeRunTime.
     *
     * @param int $episodeRunTime
     *
     * @return TvShow
     */
    public function setEpisodeRunTime($episodeRunTime)
    {
        $this->episodeRunTime = $episodeRunTime;

        return $this;
    }

    /**
     * Get episodeRunTime.
     *
     * @return int
     */
    public function getEpisodeRunTime()
    {
        return $this->episodeRunTime;
    }

    /**
     * Set firstAirDate.
     *
     * @param string $firstAirDate
     *
     * @return TvShow
     */
    public function setFirstAirDate($firstAirDate)
    {
        $this->firstAirDate = $firstAirDate;

        return $this;
    }

    /**
     * Get firstAirDate.
     *
     * @return string
     */
    public function getFirstAirDate()
    {
        return $this->firstAirDate;
    }

    /**
     * Set genres.
     *
     * @param array $genres
     *
     * @return TvShow
     */
    public function setGenres($genres)
    {
        $this->genres = $genres;

        return $this;
    }

    /**
     * Get genres.
     *
     * @return array
     */
    public function getGenres()
    {
        $genres = [];

        foreach ($this->genres as $genre) {
            $genres[] = $genre['name'];
        }

        return implode(", ", $genres);
    }

    /**
     * Set homepage.
     *
     * @param string $homepage
     *
     * @return TvShow
     */
    public function setHomepage($homepage)
    {
        $this->homepage = $homepage;

        return $this;
    }

    /**
     * Get homepage.
     *
     * @return string
     */
    public function getHomepage()
    {
        return $this->homepage;
    }

    /**
     * Set inProduction.
     *
     * @param bool $inProduction
     *
     * @return TvShow
     */
    public function setInProduction($inProduction)
    {
        $this->inProduction = $inProduction;

        return $this;
    }

    /**
     * Get inProduction.
     *
     * @return bool
     */
    public function getInProduction()
    {
        return $this->inProduction;
    }

    /**
     * Set languages.
     *
     * @param array $languages
     *
     * @return TvShow
     */
    public function setLanguages($languages)
    {
        $this->languages = $languages;

        return $this;
    }

    /**
     * Get languages.
     *
     * @return array
     */
    public function getLanguages()
    {
        return implode(", ", $this->languages);
    }

    /**
     * Set numberOfEpisodes.
     *
     * @param int $numberOfEpisodes
     *
     * @return TvShow
     */
    public function setNumberOfEpisodes($numberOfEpisodes)
    {
        $this->numberOfEpisodes = $numberOfEpisodes;

        return $this;
    }

    /**
     * Get numberOfEpisodes.
     *
     * @return int
     */
    public function getNumberOfEpisodes()
    {
        return $this->numberOfEpisodes;
    }

    /**
     * Set numberOfSeasons.
     *
     * @param int $numberOfSeasons
     *
     * @return TvShow
     */
    public function setNumberOfSeasons($numberOfSeasons)
    {
        $this->numberOfSeasons = $numberOfSeasons;

        return $this;
    }

    /**
     * Get numberOfSeasons.
     *
     * @return int
     */
    public function getNumberOfSeasons()
    {
        return $this->numberOfSeasons;
    }

    /**
     * Set originCountry.
     *
     * @param array $originCountry
     *
     * @return TvShow
     */
    public function setOriginCountry($originCountry)
    {
        $this->originCountry = $originCountry;

        return $this;
    }

    /**
     * Get originCountry.
     *
     * @return array
     */
    public function getOriginCountry()
    {
        return $this->originCountry;
    }

    /**
     * Set overview.
     *
     * @param string $overview
     *
     * @return TvShow
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
     * @return TvShow
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
     * Set productionCompanies.
     *
     * @param array $productionCompanies
     *
     * @return TvShow
     */
    public function setProductionCompanies($productionCompanies)
    {
        $this->productionCompanies = $productionCompanies;

        return $this;
    }

    /**
     * Get productionCompanies.
     *
     * @return array
     */
    public function getProductionCompanies()
    {
        return $this->productionCompanies;
    }

    /**
     * Set seasons.
     *
     * @param array $seasons
     *
     * @return TvShow
     */
    public function setSeasons($seasons)
    {
        $this->seasons = $seasons;

        return $this;
    }

    /**
     * Get seasons.
     *
     * @return array
     */
    public function getSeasons()
    {
        return $this->seasons;
    }
}
