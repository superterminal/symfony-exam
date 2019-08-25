<?php


namespace AppBundle\Services\Serializer;


interface SerializerServiceInterface
{
    public function deserialize($data, $entity, $format = 'json');
    public function deserializeMovies($data, $entity, $format = 'json');
}