<?php


namespace AppBundle\Services\Comment;


use AppBundle\Entity\Comment;

interface CommentServiceInterface
{
    public function create(Comment $comment, int $movieId): bool;
    public function getAllByMovieId(int $movieId);
}