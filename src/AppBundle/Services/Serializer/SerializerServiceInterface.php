<?php


namespace AppBundle\Services\Serializer;


interface SerializerServiceInterface
{
    public function deserialize($data, $entity, $format = 'json');
    public function deserializeData($data, $entity, $format = 'json');
}