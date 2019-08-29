<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * Page
 *
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PageRepository")
 */
class Page
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
     * @Serializer\Type("int")
     *
     * @ORM\Column(name="page", type="integer")
     */
    private $page;

    /**
     * @var int
     *
     * @Serializer\Type("int")
     *
     * @ORM\Column(name="total_results", type="integer")
     */
    private $totalResults;

    /**
     * @var ArrayCollection
     *
     * @Serializer\Type("array")
     *
     * @ORM\Column(name="results", type="array")
     */
    private $results;

    /**
     * @var ArrayCollection
     *
     * @Serializer\Type("array")
     *
     * @ORM\Column(name="genres", type="array")
     */
    private $genres;

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
     * Set page.
     *
     * @param int $page
     *
     * @return Page
     */
    public function setPage($page)
    {
        $this->page = $page;

        return $this;
    }

    /**
     * Get page.
     *
     * @return int
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * Set totalResults.
     *
     * @param int $totalResults
     *
     * @return Page
     */
    public function setTotalResults($totalResults)
    {
        $this->totalResults = $totalResults;

        return $this;
    }

    /**
     * Get totalResults.
     *
     * @return int
     */
    public function getTotalResults()
    {
        return $this->totalResults;
    }

    /**
     * Set results.
     *
     * @param array $results
     *
     * @return Page
     */
    public function setResults($results)
    {
        $this->results = $results;

        return $this;
    }

    /**
     * Get results.
     *
     * @return array
     */
    public function getResults()
    {
        return $this->results;
    }

    /**
     * @return ArrayCollection
     */
    public function getGenres()
    {
        return $this->genres;
    }

    /**
     * @param ArrayCollection $genres
     */
    public function setGenres(ArrayCollection $genres): void
    {
        $this->genres = $genres;
    }


}
