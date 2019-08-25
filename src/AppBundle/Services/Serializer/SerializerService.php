<?php


namespace AppBundle\Services\Serializer;


use JMS\Serializer\SerializerBuilder;

class SerializerService implements SerializerServiceInterface
{

    /**
     * @var \JMS\Serializer\SerializerInterface
     */
    private $serializer;

    public function __construct()
    {
        $this->serializer = SerializerBuilder::create()->build();
    }

    /**
     * @param $data
     * @param $entity
     * @param string $format
     * @return mixed
     */
    public function deserialize($data, $entity, $format = 'json')
    {
        $type = 'AppBundle\Entity\\' . $entity;

        return $this->serializer->deserialize($data, $type, $format);
    }

    /**
     * @param $data
     * @param $entity
     * @param string $format
     * @return array
     */
    public function deserializeMovies($data, $entity, $format = 'json')
    {
        $movies = [];
        $type = 'AppBundle\Entity\\' . $entity;

        foreach ($data as $movie) {
            $movies[] = $this->serializer->deserialize(json_encode($movie), $type, $format);
        }

        return $movies;
    }
}