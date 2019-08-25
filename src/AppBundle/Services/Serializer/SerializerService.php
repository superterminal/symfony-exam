<?php


namespace AppBundle\Services\Serializer;


use JMS\Serializer\SerializerBuilder;

class SerializerService implements SerializerServiceInterface
{

    /**
     * @param $data
     * @param $type
     * @param string $format
     * @return mixed
     */
    public function deserialize($data, $type, $format = 'json')
    {
        $serializer = SerializerBuilder::create()->build();

        return $serializer->deserialize($data, $type, $format);
    }
}