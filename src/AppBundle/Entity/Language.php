<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * Language
 *
 * @ORM\Table(name="language")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\LanguageRepository")
 */
class Language
{

    /**
     * @var string
     *
     * @Serializer\Type("string")
     *
     * @ORM\Column(name="iso_639_1", type="string", length=255)
     */
    private $iso_639_1;

    /**
     * @var string
     *
     * @Serializer\Type("string")
     *
     * @ORM\Column(name="english_name", type="string", length=255)
     */
    private $englishName;

    /**
     * @var string
     *
     * @Serializer\Type("string")
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;


    /**
     * @return string
     */
    public function getIso6391(): string
    {
        return $this->iso_639_1;
    }

    /**
     * @param string $iso_639_1
     */
    public function setIso6391(string $iso_639_1): void
    {
        $this->iso_639_1 = $iso_639_1;
    }

    /**
     * Set englishName.
     *
     * @param string $englishName
     *
     * @return Language
     */
    public function setEnglishName($englishName)
    {
        $this->englishName = $englishName;

        return $this;
    }

    /**
     * Get englishName.
     *
     * @return string
     */
    public function getEnglishName()
    {
        return $this->englishName;
    }

    /**
     * Set name.
     *
     * @param string $name
     *
     * @return Language
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
}
