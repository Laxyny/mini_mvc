<?php

namespace App\Repository;

use App\Entity\Comment;
use App\Db\Mysql;
use App\Tools\StringTools;

class CommentRepository extends Repository
{

    public function findOneById(int $id)
    {
        $query = $this->pdo->prepare("SELECT * FROM comment WHERE id = :id");
        $query->bindParam(':id', $id, $this->pdo::PARAM_STR);
        $query->execute();
        $comment = $query->fetch($this->pdo::FETCH_ASSOC);
        if ($comment) {
            return Comment::createAndHydrate($comment);;
        } else {
            return false;
        }
    }
    public function findAll()
    {
        $query = $this->pdo->prepare("SELECT * FROM comment");
        $query->execute();
        $comments = $query->fetchAll($this->pdo::FETCH_ASSOC);
        $articlesObjects = [];
        foreach ($comments as $comment) {
            $articlesObjects[] = Comment::createAndHydrate($comment);;
        }
        return $articlesObjects;
    }
    public function findOneByComment(string $title)
    {
        $query = $this->pdo->prepare("SELECT * FROM comment WHERE comment = :comment");
        $query->bindParam(':comment', $title, $this->pdo::PARAM_STR);
        $query->execute();
        $comment = $query->fetch($this->pdo::FETCH_ASSOC);
        if ($comment) {
            return Comment::createAndHydrate($comment);;
        } else {
            return false;
        }
    }

    public function findByArticleId(int $article_id)
    {
        $query = $this->pdo->prepare("SELECT * FROM comment WHERE article_id = :article_id");
        $query->bindParam(':article_id', $article_id, $this->pdo::PARAM_INT);
        $query->execute();
        $comments = $query->fetchAll($this->pdo::FETCH_ASSOC);
        $commentsObjects = [];
        foreach ($comments as $comment) {
            $commentsObjects[] = Comment::createAndHydrate($comment);
        }
        return $commentsObjects;
    }

    public function persist(Comment $comment)
    {
        if ($comment->getId() !== null) {
            $query = $this->pdo->prepare('UPDATE comment SET comment = :comment WHERE id = :id');
            $query->bindValue(':id', $comment->getId(), $this->pdo::PARAM_INT);
            $query->bindValue(':comment', $comment->getComment(), $this->pdo::PARAM_STR);
        } else {
            $query = $this->pdo->prepare('INSERT INTO comment (comment, user_id, article_id) VALUES (:comment, :user_id, :article_id)');
            $query->bindValue(':comment', $comment->getComment(), $this->pdo::PARAM_STR);
            $query->bindValue(':user_id', $comment->getUserId(), $this->pdo::PARAM_INT);
            $query->bindValue(':article_id', $comment->getArticleId(), $this->pdo::PARAM_INT);
        }
        return $query->execute();
    }
}
