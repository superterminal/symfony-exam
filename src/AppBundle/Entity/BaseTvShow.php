<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * BaseTvShow
 *
 * @ORM\Table(name="base_tv_show")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\BaseTvShowRepository")
 */
class BaseTvShow
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
     * @ORM\Column(name="original_name", type="string", length=255)
     */
    private $originalName;

    /**
     * @var string
     *
     * @Serializer\Type("string")
     *
     * @ORM\Column(name="poster_path", type="string", length=255)
     */
    private $posterPath;


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
     * Set originalName.
     *
     * @param string $originalName
     *
     * @return BaseTvShow
     */
    public function setOriginalName($originalName)
    {
        $this->originalName = $originalName;

        return $this;
    }

    /**
     * Get originalName.
     *
     * @return string
     */
    public function getOriginalName()
    {
        return $this->originalName;
    }

    /**
     * Set posterPath.
     *
     * @param string $posterPath
     *
     * @return BaseTvShow
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
}
