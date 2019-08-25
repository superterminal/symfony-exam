<?php


namespace AppBundle\Services\Serializer;


interface SerializerServiceInterface
{
    public function deserialize($data, $type, $format = 'json');
}