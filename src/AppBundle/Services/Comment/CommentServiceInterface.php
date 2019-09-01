<?php


namespace AppBundle\Services\Comment;


use AppBundle\Entity\Comment;

interface CommentServiceInterface
{
    public function create(Comment $comment, int $id): bool;
    public function getAllById(int $id);
}