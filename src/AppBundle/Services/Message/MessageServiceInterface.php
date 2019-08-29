<?php


namespace AppBundle\Services\Message;


use AppBundle\Entity\Message;

interface MessageServiceInterface
{
    public function create(Message $message, int $recipientId): bool;
    public function getAllByUser();
    public function getOne(int $id): ?Message;
    public function getAllUnseenByUser();
}