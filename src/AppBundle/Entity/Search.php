<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Search
 *
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SearchRepository")
 */
class Search
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="input", type="string", length=255)
     */
    private $input;


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
     * Set input.
     *
     * @param string $input
     *
     * @return Search
     */
    public function setInput($input)
    {
        $this->input = $input;

        return $this;
    }

    /**
     * Get input.
     *
     * @return string
     */
    public function getInput()
    {
        return $this->input;
    }
}
